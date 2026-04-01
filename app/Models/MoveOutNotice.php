<?php

namespace App\Models;

use Carbon\Carbon;
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



    public function stayedFormatted(): string
    {
        if (!$this->rental || !$this->move_out_date) {
            return '0 days';
        }

        $start = Carbon::parse($this->rental->reservation->start_date)->startOfDay();
        $end = Carbon::parse($this->move_out_date)->startOfDay();
        $diff = $start->diff($end);

        $parts = [];
        if ($diff->m > 0 || $diff->y > 0) {
            // Include years as months
            $totalMonths = $diff->y * 12 + $diff->m;
            $parts[] = "$totalMonths month" . ($totalMonths > 1 ? "s" : "");
        }

        if ($diff->d > 0) {
            $parts[] = "$diff->d day" . ($diff->d > 1 ? "s" : "");
        }

        return implode(' ', $parts) ?: '0 days';
    }
}
