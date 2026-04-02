<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Rental extends Model
{
    use HasFactory;

    protected $fillable = [
        'tenant_id',
        'listing_id',
        'reservation_id',
        'status',
        'updated_at'
    ];

    protected $casts = [
        'updated_at' => 'datetime'
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

}
