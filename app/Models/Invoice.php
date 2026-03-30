<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'rental_id',
        'tenant_id',
        'period_month',
        'amount_due',
        'rent_cost_snapshot',
        'electricity_cost_snapshot',
        'water_supply_cost_snapshot',
        'due_date',
        'xendit_id',
        'xendit_invoice_url',
        'status',
    ];

    protected $casts = [
        'due_date'                     => 'date',
        'amount_due'                   => 'decimal:2',
        'rent_cost_snapshot'           => 'decimal:2',
        'electricity_cost_snapshot'    => 'decimal:2',
        'water_supply_cost_snapshot'   => 'decimal:2',
    ];

    public function rental()
    {
        return $this->belongsTo(Rental::class);
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function isPaid(): bool
    {
        return $this->status === 'paid';
    }

    public function isOverdue(): bool
    {
        return $this->status !== 'paid' && $this->due_date->isPast();
    }


    protected $appends = ['computed_status'];

    public function getComputedStatusAttribute()
    {
        if ($this->status === 'unpaid' && now()->gt($this->due_date)) {
            return 'overdue';
        }
        return $this->status;
    }
}
