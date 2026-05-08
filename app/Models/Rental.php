<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class Rental extends Model
{
    use HasFactory;

    protected $fillable = [
        'tenant_id',
        'listing_id',
        'reservation_id',
        'status',
        'lease_start_date',
        'updated_at',
        'ended_at'
    ];

    protected $casts = [
        'updated_at' => 'datetime',
        'lease_start_date' => 'datetime'
    ];

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    public function listing(): BelongsTo
    {
        return $this->belongsTo(Listing::class);
    }

    public function reservation(): BelongsTo
    {
        return $this->belongsTo(Reservation::class);
    }

    public function moveOutNotice(): HasOne
    {
        return $this->hasOne(MoveOutNotice::class)->latestOfMany();
    }
    public function moveOutNotices()
    {
        return $this->hasMany(MoveOutNotice::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }



    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    public function isEnded(): bool
    {
        return $this->status === 'ended';
    }

    //scope to get active rentals only
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function totalAmountDue(): float
    {
        $listing = $this->listing;

        $rentCost    = $listing->rent_cost;
        $waterCost   = $listing->water_supply_cost ?? 0;
        $electricCost = $listing->electricity_cost ?? 0;

        return $rentCost + $waterCost + $electricCost;
    }

    public function stayedFormatted(): string
    {
        Log::debug('stayedFormatted', [
            'moveOutNotice' => $this->moveOutNotice,
            'lease_start_date' => $this->lease_start_date,
        ]);
        if (!$this->moveOutNotice || !$this->lease_start_date) {
            return '0 days';
        }

        $start = Carbon::parse($this->lease_start_date)->startOfDay();
        $end   = Carbon::parse($this->moveOutNotice->move_out_date)->startOfDay();
        $diff  = $start->diff($end);

        $parts = [];
        if ($diff->y > 0 || $diff->m > 0) {
            $totalMonths = $diff->y * 12 + $diff->m;
            $parts[] = "$totalMonths month" . ($totalMonths > 1 ? 's' : '');
        }
        if ($diff->d > 0) {
            $parts[] = "$diff->d day" . ($diff->d > 1 ? 's' : '');
        }

        return implode(' ', $parts) ?: '0 days';
    }
}
