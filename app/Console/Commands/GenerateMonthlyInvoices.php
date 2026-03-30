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

                $moveInDay  = Carbon::parse($rental->reservation->start_date)->day;

                // Due date is this month's move-in day
                $dueDate    = Carbon::today()->startOfMonth()->setDay($moveInDay);

                // Generate 7 days before due
                $generateOn = $dueDate->copy()->subDays(7);

                /*uncomment later*/
                /*if ($today->day !== $generateOn->day) return;*/

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
