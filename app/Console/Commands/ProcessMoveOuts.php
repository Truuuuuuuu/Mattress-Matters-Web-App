<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\MoveOutNotice;
use Carbon\Carbon;

class ProcessMoveOuts extends Command
{
    protected $signature = 'rental:process-moveouts';
    protected $description = 'Automatically complete rentals whose move-out date has arrived';

    public function handle()
    {
        $now = Carbon::now();

        $notices = MoveOutNotice::with('rental')
            ->where('status', 'active')
            ->whereDate('move_out_date', '<=', $now)
            ->get();

        foreach ($notices as $notice) {

            // 1. mark notice completed
            $notice->update([
                'status' => 'completed',
            ]);

            // 2. end rental
            if ($notice->rental) {
                $notice->rental->update([
                    'status' => 'ended',
                    'ended_at' => $now,
                ]);

                //add slot back
                $notice->rental->listing->update([
                    'slot' => $notice->rental->listing->slot + 1,
                ]);
            }
        }

        $this->info("Processed {$notices->count()} move-outs.");
    }
}
