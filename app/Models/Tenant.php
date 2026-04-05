<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Tenant extends Model
{
    public $fillable = [
        'user_id',
        'gender',
        'occupation',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    public function rentals(): HasMany
    {
        return $this->hasMany(Rental::class);
    }

    public function rental(): HasOne
    {
        return $this->hasOne(Rental::class)->where('status', 'active')->latestOfMany();
    }

    public function hasActiveRental(): bool
    {
        return $this->rentals()->exists();
    }

    public function getOccupation(): string
    {
        return $this->occupation === 'working_individual' ? 'Working Individual' : 'Student';
    }

    public function getGender(): string
    {
        return $this->gender === 'male' ? 'Male' : 'Female';
    }


}
