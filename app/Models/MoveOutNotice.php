<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MoveOutNotice extends Model
{
    protected $fillable = [
        'rental_id',
        'move_out_date',
        'reason',
        'status',
        'cancelled_at'
    ];

    protected $casts = [
        'cancelled_at' => 'datetime',
        'move_out_date' => 'datetime',
    ];

    public function rental():BelongsTo
    {
        return $this->belongsTo(Rental::class);
    }

    public function isActive(): bool
    {
        return $this->cancelled_at === null;
    }

    public function isCancelled(): bool
    {
        return $this->cancelled_at !== null;
    }

    public function isCancellable(): bool
    {

        return $this->status === 'active'  && $this->created_at->diffInHours(now()) <= 24;
    }

    public function canSubmitMoveOut(): bool
    {
        if ($this->status === 'active') {
            return false;
        }

        return $this->status === 'cancelled'
            && $this->cancelled_at->diffInDays(now()) >= 7;
    }

    public function daysUntilCanResubmit(): int
    {
        return max(0, 7 - (int) $this->cancelled_at->diffInDays(now()));
    }

    public function hoursUntilCanCancel(): int
    {
        return max(0, 24 - (int) $this->created_at->diffInHours(now()));
    }
}
