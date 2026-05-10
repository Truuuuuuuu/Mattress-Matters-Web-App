<?php

namespace App\Console\Commands;

use App\Models\Invoice;
use Illuminate\Console\Command;

class MarkOverdueRentals extends Command
{
    protected $signature   = 'invoices:mark-overdue';
    protected $description = 'Marked overdue rentals';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Invoice::where('status', 'unpaid')
            ->where('due_date', '<', now())
            ->update(['status' => 'overdue']);

        $this->info('Overdue invoices updated.');
    }
}
