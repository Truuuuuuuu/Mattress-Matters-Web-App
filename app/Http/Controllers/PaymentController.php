<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Listing;
use App\Models\Payment;
use App\Models\Rental;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    private function headers()
    {
        return [
            'Authorization' => 'Basic ' . base64_encode(config('services.xendit.secret_key') . ':'),
            'Content-Type'  => 'application/json',
        ];
    }

    public function createGcashPayment(Request $request, Reservation $reservation)
    {
        $request->validate([
            'amount'      => 'required|numeric|min:1',
            'description' => 'required|string|max:255',
            'amountElectric' => 'nullable|numeric|min:0',
            'amountWater' => 'nullable|numeric|min:0',
        ]);


        $depositAmount = $reservation->listing->rent_cost;
        $amountUtilities = (float) $request->amountElectric + (float) $request->amountWater;
        $totalAmount = (float) $request->amount + (float) $depositAmount + $amountUtilities;



        $referenceId = 'ORDER-' . strtoupper(Str::random(10));
        $depositRefId = 'DEPOSIT-' . strtoupper(Str::random(10));

        // Single Xendit charge for both reservation fee and security deposit
        $response = Http::withHeaders($this->headers())
            ->post('https://api.xendit.co/ewallets/charges', [
                'reference_id'        => $referenceId,
                'currency'            => 'PHP',
                'amount'              => $totalAmount,
                'checkout_method'     => 'ONE_TIME_PAYMENT',
                'channel_code'        => 'PH_GCASH',
                'channel_properties' => [
                    'success_redirect_url' => route('payment.success'),
                    'failure_redirect_url' => route('payment.failed'),
                    'cancel_redirect_url'  => route('payment.failed'),
                ],
                'metadata' => [
                    'description' => $request->description . ' + Security Deposit',
                ],
            ]);

        if ($response->failed()) {
            Log::error('Xendit GCash error', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);
            return response()->json([
                'error'   => 'Failed to initiate GCash payment.',
                'details' => $response->status(),
            ], 422);
        }

        try {
            $charge = $response->json();
        } catch (\Exception $e) {
            Log::error('Failed to parse response as JSON', [
                'body' => $response->body(),
                'exception' => $e->getMessage(),
            ]);
            return response()->json([
                'error'   => 'Invalid response from payment gateway.',
                'details' => 'Failed to parse response',
            ], 422);
        }

        // Create reservation fee payment record with xendit charge id
        Payment::create([
            'reservation_id' => $reservation->id,
            'payment_type'   => 'reservation_fee',
            'xendit_id'      => $charge['id'],
            'reference_id'   => $referenceId,
            'status'         => $charge['status'],
            'amount'         => $request->amount + $amountUtilities,
            'description'    => $request->description,
            'payment_method' => 'GCASH',
            'created_at'     => now(),
        ]);

        // Create security deposit payment record with SAME xendit charge id
        Payment::create([
            'reservation_id' => $reservation->id,
            'payment_type'   => 'security_deposit',
            'xendit_id'      => $charge['id'],
            'reference_id'   => $depositRefId,
            'status'         => $charge['status'],
            'amount'         => $depositAmount,
            'description'    => 'Security Deposit',
            'payment_method' => 'GCASH',
            'created_at'     => now(),
        ]);

        session(['payment_reference' => $referenceId]);

        return response()->json([
            'checkout_url' => $charge['actions']['desktop_web_checkout_url']
                ?? $charge['actions']['mobile_web_checkout_url'],
        ]);
    }

    public function createRentPayment(Request $request, Invoice $invoice)
    {
        // Guard: only the tenant on this invoice can pay
        if ($invoice->tenant_id !== auth()->user()->tenant->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        if ($invoice->status === 'paid') {
            return response()->json(['error' => 'Invoice already paid.'], 422);
        }

        $listing = $invoice->rental->listing;

        $description = "Monthly Rent — {$invoice->rental->listing->title}";

        $referenceId = 'RENT-' . strtoupper(Str::random(10));

        $response = Http::withHeaders($this->headers())
            ->post('https://api.xendit.co/ewallets/charges', [
                'reference_id'       => $referenceId,
                'currency'           => 'PHP',
                'amount'             => (float) $invoice->amount_due,
                'checkout_method'    => 'ONE_TIME_PAYMENT',
                'channel_code'       => 'PH_GCASH',
                'channel_properties' => [
                    'success_redirect_url' => route('payment.success'),
                    'failure_redirect_url' => route('payment.failed'),
                    'cancel_redirect_url'  => route('payment.failed'),
                ],
                'metadata' => [
                    'description' => $description,
                ],
            ]);

        if ($response->failed()) {
            Log::error('Xendit rent payment error', $response->json());
            return response()->json([
                'error'   => 'Failed to initiate rent payment.',
                'details' => $response->json('message'),
            ], 422);
        }

        $charge = $response->json();

        Payment::create([
            'invoice_id'     => $invoice->id,
            'reservation_id' => null,
            'payment_type'   => 'rent',
            'xendit_id'      => $charge['id'],
            'reference_id'   => $referenceId,
            'status'         => $charge['status'],
            'amount'         => $invoice->amount_due,
            'description'    => $description,
            'payment_method' => 'GCASH',
            'expires_at'     => now()->addMinutes(5),
        ]);



        session(['payment_reference' => $referenceId]);

        return response()->json([
            'checkout_url' => $charge['actions']['desktop_web_checkout_url']
                ?? $charge['actions']['mobile_web_checkout_url'],
        ]);
    }

    public function success()
    {
        $reference = session('payment_reference');
        $payment = Payment::with(['reservation.listing', 'invoice.rental.listing'])
            ->where('reference_id', $reference)
            ->first();

        return view('payment.success', compact('payment'));
    }

    public function failed()
    {
        return view('payment.failed');
    }

    protected function handleFailedPayment(Payment $payment): void
    {
        Log::warning("Payment {$payment->reference_id} marked {$payment->status} — invoice {$payment->invoice_id} remains unpaid.");
    }

    /*public function webhook(Request $request)
    {
        $token = $request->header('x-callback-token');
        if ($token !== config('services.xendit.webhook_token')) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $payload  = $request->all();
        $status   = $payload['data']['status'] ?? null;
        $chargeId = $payload['data']['id'] ?? null;
        $referenceId = $payload['data']['reference_id'] ?? null;

        if ($chargeId) {
            $payment = Payment::where('xendit_id', $chargeId)
                ->orWhere('reference_id', $referenceId)
                ->first();

            if ($payment) {
                $payment->update(['status' => $status]);

                if ($status === 'SUCCEEDED') {

                        Reservation::where('id', $payment->reservation_id)
                                ->update(['payment_status' => 'paid']);

                        Rental::create([
                           'tenant_id' => $payment->reservation->tenant_id,
                           'listing_id' => $payment->reservation->listing_id,
                           'reservation_id' => $payment->reservation_id,
                           'status' => 'active'
                       ]);
                }

                Log::info("Xendit webhook: {$chargeId} → {$status}");
            }
        }

        return response()->json(['received' => true]);
    }*/

    public function webhook(Request $request)
    {
        $token = $request->header('x-callback-token');
        if ($token !== config('services.xendit.webhook_token')) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $payload     = $request->all();
        $status      = $payload['data']['status'] ?? null;
        $chargeId    = $payload['data']['id'] ?? null;
        $referenceId = $payload['data']['reference_id'] ?? null;

        if (!$chargeId) return response()->json(['received' => true]);

        // Get all payments with this xendit_id
        $payments = Payment::where('xendit_id', $chargeId)
            ->orWhere('reference_id', $referenceId)
            ->get();

        if ($payments->isEmpty()) return response()->json(['received' => true]);

        // Update all matching payments
        foreach ($payments as $payment) {
            $payment->update(['status' => $status]);

            if ($status === 'SUCCEEDED') {
                if (in_array($payment->payment_type, ['reservation_fee', 'security_deposit'])) {
                    $this->handleReservationPayment($payment);
                } elseif ($payment->payment_type === 'rent') {
                    $this->handleRentPayment($payment);
                }
            } elseif (in_array($status, ['EXPIRED', 'FAILED', 'VOIDED'])) {
                $this->handleFailedPayment($payment);
            }

            Log::info("Xendit webhook: {$chargeId} → {$status} [{$payment->payment_type}]");
        }


        return response()->json(['received' => true]);
    }

    private function handleReservationPayment(Payment $payment): void
    {
        $reservation = $payment->reservation;

        $reservation->update(['payment_status' => 'paid']);

        // Only create rental if it doesn't already exist for this reservation
        if (!$reservation->rental) {
            Rental::create([
                'tenant_id'      => $reservation->tenant_id,
                'listing_id'     => $reservation->listing_id,
                'reservation_id' => $reservation->id,
                'status'         => 'active',
            ]);
        }
    }

    private function handleRentPayment(Payment $payment): void
    {
        $invoice = $payment->invoice;

        if (!$invoice) return;

        $invoice->update(['status' => 'paid']);

        // optional: notify tenant their payment was confirmed
        $invoice->rental->tenant->user->notify(new RentPaidNotification($invoice));
    }

    public function soa()
    {
        $tenant  = auth()->user()->tenant;
        $rental  = $tenant->rental;

        if (!$rental) {
            return view('tenant.soa', ['invoices' => collect(), 'rental' => null, 'nextDue' => null]);
        }

        $moveInDay = \Carbon\Carbon::parse($rental->reservation->start_date)->day;
        $today     = \Carbon\Carbon::today();
        $dueDate   = $today->copy()->startOfMonth()->setDay($moveInDay);

        // If due date already passed this month, next due is next month
        $nextDue = $today->gt($dueDate)
            ? $dueDate->copy()->addMonth()
            : $dueDate;

        $invoices = Invoice::where('tenant_id', $tenant->id)
            ->orderBy('due_date', 'desc')
            ->get();

        return view('tenant.soa', compact('invoices', 'rental', 'nextDue'));
    }

    public function payRent(Invoice $invoice)
    {
        $tenant = auth()->user()->tenant;

        // Guard: only the tenant who owns this invoice
        if ($invoice->tenant_id !== $tenant->id) {
            abort(403);
        }

        if ($invoice->status === 'paid') {
            return back()->with('info', 'This invoice is already paid.');
        }

        // Delegate to existing createRentPayment
        return $this->createRentPayment(request()->merge([
            'amount' => $invoice->amount_due,
        ]), $invoice);
    }
}
