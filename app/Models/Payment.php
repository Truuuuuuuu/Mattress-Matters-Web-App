<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'xendit_id',
        'reference_id',
        'invoice_id',
        'payment_type',
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

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function totalAmount(): float
    {
        return self::where('xendit_id', $this->xendit_id)->sum('amount');
    }

    public function monthlyRentalAmount(): float
    {
        return (float) $this->amount;
    }
}
