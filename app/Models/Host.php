<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Host extends Model
{
    use HasFactory;

    public $fillable = [
        'user_id',
        'balance',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function listings(): HasMany
    {
        return $this->hasMany(Listing::class, 'host_id');
    }

    public function rentals()
    {
        return $this->hasManyThrough(Rental::class, Listing::class);
    }

    public function reservations()
    {
        return $this->hasManyThrough(Reservation::class, Listing::class);
    }

    public function moveOutNotices()
    {
        return $this->hasManyThrough(MoveOutNotice::class, Listing::class);
    }
    public static function dashboardStats(Host $host): array
    {
        $reservations = Reservation::query()
            ->with([
                'tenant.user:id,name,profile_photo_public_id',
                'listing:id,title',
            ])
            ->whereHas('listing', fn($q) => $q->where('host_id', $host->id))
            ->where('status', 'accepted')
            ->where('payment_status', 'paid')
            ->select('id', 'tenant_id', 'listing_id', 'start_date')
            ->latest()
            ->paginate(5);

        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth   = Carbon::now()->endOfMonth();

        $reservationRevenue = DB::table('payments')
            ->join('reservations', 'payments.reservation_id', '=', 'reservations.id')
            ->join('listings', 'reservations.listing_id', '=', 'listings.id')
            ->where('listings.host_id', $host->id)
            ->whereBetween('payments.created_at', [$startOfMonth, $endOfMonth])
            ->sum('payments.amount');

        $rentalRevenue = DB::table('payments')
            ->join('invoices', 'payments.invoice_id', '=', 'invoices.id')
            ->join('rentals', 'invoices.rental_id', '=', 'rentals.id')
            ->join('listings', 'rentals.listing_id', '=', 'listings.id')
            ->where('listings.host_id', $host->id)
            ->whereBetween('payments.created_at', [$startOfMonth, $endOfMonth])
            ->sum('payments.amount');

        $monthlyRevenue = $reservationRevenue + $rentalRevenue;
        return [
            'active_listings'      => $host->listings()->active()->count(),
            'total_tenants'        => $host->rentals()->where('rentals.status', 'active')->count(),
            'pending_reservations' => $host->reservations()->where('reservations.status', 'pending')->count(),
            'move_out_notices'     => MoveOutNotice::where('status', 'active')
                ->whereHas('rental', fn($q) => $q->whereHas('listing', fn($q) => $q->where('host_id', $host->id)))
                ->count(),
            'reservations' => $reservations,
            'monthly_revenue' => $monthlyRevenue,
        ];
    }

    public function greetings()
    {
        $hour = now()->hour;

        return match (true) {
            $hour < 12 => 'Good morning',
            $hour < 18 => 'Good afternoon',
            default => 'Good evening',
        };
    }

}
