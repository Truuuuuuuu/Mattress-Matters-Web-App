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
        'property_id',
        'start_date',
        'end_date',
        'status',
        'payment_status',
        'price',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function property(): BelongsTo
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
