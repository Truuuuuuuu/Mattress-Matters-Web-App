<?php
namespace App\Console\Commands;

use App\Models\Payment;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ExpirePendingPayments extends Command
{
    protected $signature   = 'payments:expire-pending';
    protected $description = 'Mark pending payments whose expiry window has passed as EXPIRED';

    public function handle(): void
    {
        $expired = Payment::where('status', 'PENDING')
            ->where('expires_at', '<=', now())
            ->get();

        foreach ($expired as $payment) {
            $payment->update(['status' => 'EXPIRED']);
            Log::info("Expired stale payment {$payment->reference_id} (invoice {$payment->invoice_id})");
        }

        $this->info("Expired {$expired->count()} stale payment(s).");
    }
}
