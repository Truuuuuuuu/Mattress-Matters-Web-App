<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'xendit_id',
        'reference_id',
        'status',
        'amount',
        'description',
        'payment_method',
        'reservation_id',
        'created_at'
    ];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}
