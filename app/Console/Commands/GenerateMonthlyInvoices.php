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

                $moveInDay  = Carbon::parse($rental->lease_start_date)->day;

                $dueDate = Carbon::today()->startOfMonth()->setDay(min($moveInDay, Carbon::today()->daysInMonth));

                // First month is paid on reservation, so due date can't be earlier than lease_start + 1 month
                $firstDue = Carbon::parse($rental->lease_start_date)->addMonth();
                if ($dueDate->lt($firstDue)) {
                    $dueDate = $firstDue;
                }

                /*UNCOMMENT LATER!!!!*/
                /*$generateOn = $dueDate->copy()->subDays(7);

                if ($today->day !== $generateOn->day) return;*/

                $periodMonth = $dueDate->format('Y-m');

                $amountDue = $rental->listing->rent_cost + ($rental->listing->electricity_cost ?? 0) + ($rental->listing->water_supply_cost ?? 0);

                Invoice::firstOrCreate(
                    [
                        'rental_id'    => $rental->id,
                        'period_month' => $dueDate->format('Y-m'),
                    ],
                    [
                        'tenant_id'                  => $rental->tenant_id,
                        'amount_due'                 => $amountDue,
                        'rent_cost_snapshot'         => $rental->listing->rent_cost,
                        'electricity_cost_snapshot'  => $rental->listing->electricity_cost,
                        'water_supply_cost_snapshot' => $rental->listing->water_supply_cost,
                        'status'                     => 'unpaid',
                        'due_date'                   => $dueDate,
                    ]
                );
                $this->info("Invoice created: Rental #{$rental->id} — {$periodMonth}");
            });

        $this->info('Done.');
    }
}
