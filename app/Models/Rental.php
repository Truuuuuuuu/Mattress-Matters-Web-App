<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rental extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'listing_id',
        'reservation_id',
        'status',
    ];

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    public function listing(): BelongsTo
    {
        return $this->belongsTo(Listing::class);
    }


    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    //scope to get active rentals only
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

}
