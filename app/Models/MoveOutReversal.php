<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MoveOutReversal extends Model
{
    protected $fillable = [
        'move_out_notice_id',
        'reason',
        'status',
        'reviewed_by_host_id',
        'host_notes',
        'reviewed_at',
    ];

    protected $casts = [
        'reviewed_at' => 'datetime',
    ];

    // ─── Relationships ────────────────────────────────────────────────────────

    public function moveOutNotice(): BelongsTo
    {
        return $this->belongsTo(MoveOutNotice::class);
    }

    public function host(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewed_by_host_id');
    }

    // ─── State Helpers ────────────────────────────────────────────────────────

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }

    public function isRejected(): bool
    {
        return $this->status === 'rejected';
    }
}
