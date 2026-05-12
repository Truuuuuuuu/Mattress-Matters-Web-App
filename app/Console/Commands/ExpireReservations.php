<?php

namespace App\Console\Commands;

use App\Models\Reservation;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;


class ExpireReservations extends Command
{
    protected $signature = 'reservation:expire';
    protected $description = 'Automatically expires a reservation after 48 hours';

    public function handle(): int
    {
        $expiredReservations = Reservation::query()
            ->where('status', 'accepted')
            ->where('payment_status', 'unpaid')
            ->where('updated_at', '<=', now()->subHours(48))
            ->with('listing')
            ->get();

        if ($expiredReservations->isEmpty()) {
            $this->info('No reservations to expire.');
            return self::SUCCESS;
        }

        foreach ($expiredReservations as $reservation) {
            DB::transaction(function () use ($reservation) {
                $reservation->update(['status' => 'expired']);
                $reservation->listing()->increment('slot');
            });
        }

        $this->info("Expired {$expiredReservations->count()} reservation(s).");
        return self::SUCCESS;
    }
}
