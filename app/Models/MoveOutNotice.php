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
        'cancelled_at'
    ];

    public function rental():BelongsTo
    {
        return $this->belongsTo(Rental::class);
    }

    public function isCancelled(): bool
    {
        return $this->cancelled_at !== null;
    }
}
