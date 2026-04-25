<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Host extends Model
{
    use HasFactory;

    public $fillable = [
        'user_id',
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
        return [
            'active_listings'      => $host->listings()->active()->count(),
            'total_tenants'        => $host->rentals()->where('rentals.status', 'active')->count(),
            'pending_reservations' => $host->reservations()->where('reservations.status', 'pending')->count(),
            'move_out_notices'     => MoveOutNotice::where('status', 'active')
                ->whereHas('rental', fn($q) => $q->whereHas('listing', fn($q) => $q->where('host_id', $host->id)))
                ->count(),
        ];
    }


}
