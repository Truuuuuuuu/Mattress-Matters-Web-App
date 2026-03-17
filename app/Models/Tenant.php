<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}
