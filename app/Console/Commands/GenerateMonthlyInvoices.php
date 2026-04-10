<?php

namespace App\Console\Commands;

use App\Models\Invoice;
use App\Models\Rental;
use Carbon\Carbon;
use Illuminate\Console\Command;

class GenerateMonthlyInvoices extends Command
{
    protected $signature   = 'invoices:generate-monthly';
    protected $description = 'Generate monthly rent invoices 7 days before due date';

    public function handle()
    {
        $today = Carbon::today();

        Rental::with(['listing', 'tenant', 'reservation'])
            ->where('status', 'active')
            ->get()
            ->each(function (Rental $rental) use ($today) {

                $moveInDay = Carbon::parse($rental->lease_start_date)->day;

                // Find the latest invoice for this rental
                $lastInvoice = Invoice::where('rental_id', $rental->id)
                    ->orderBy('due_date', 'desc')
                    ->first();

                if ($lastInvoice) {
                    // If last invoice is still unpaid, don't generate yet
                    if ($lastInvoice->status === 'unpaid') {
                        $this->info("Skipped: Rental #{$rental->id} still has unpaid invoice for {$lastInvoice->period_month}");
                        return;
                    }

                    // Last invoice is paid — next due is 1 month after the last due_date
                    $nextDueDate = Carbon::parse($lastInvoice->due_date)->addMonth();
                } else {
                    // No invoice yet — first due is lease_start + 1 month
                    $leaseStart  = Carbon::parse($rental->lease_start_date);
                    $nextDueDate = $leaseStart->copy()->addMonth()->setDay(
                        min($moveInDay, $leaseStart->addMonth()->daysInMonth)
                    );
                }

               /* //  Only generate 7 days before due date UNCOMMENT LATER!!!!!!!!!!
                $generateOn = $nextDueDate->copy()->subDays(7);
                if ($today->lt($generateOn)) {
                    $this->info("Too early: Rental #{$rental->id} — next due {$nextDueDate->toDateString()}, generate on {$generateOn->toDateString()}");
                    return;
                }*/

                $periodMonth = $nextDueDate->format('Y-m');
                $amountDue   = $rental->listing->rent_cost
                    + ($rental->listing->electricity_cost ?? 0)
                    + ($rental->listing->water_supply_cost ?? 0);

                $invoice = Invoice::firstOrCreate(
                    [
                        'rental_id'    => $rental->id,
                        'period_month' => $periodMonth,
                    ],
                    [
                        'tenant_id'                  => $rental->tenant_id,
                        'amount_due'                 => $amountDue,
                        'rent_cost_snapshot'         => $rental->listing->rent_cost,
                        'electricity_cost_snapshot'  => $rental->listing->electricity_cost,
                        'water_supply_cost_snapshot' => $rental->listing->water_supply_cost,
                        'status'                     => 'unpaid',
                        'due_date'                   => $nextDueDate,
                    ]
                );

                $verb = $invoice->wasRecentlyCreated ? 'Created' : 'Already exists';
                $this->info("{$verb}: Rental #{$rental->id} — {$periodMonth} (due {$nextDueDate->toDateString()})");
            });

        $this->info('Done.');
    }
}
