<?php

namespace App\Http\Controllers;

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
        ]);

        $referenceId = 'ORDER-' . strtoupper(Str::random(10));

        $response = Http::withHeaders($this->headers())
            ->post('https://api.xendit.co/ewallets/charges', [
                'reference_id'        => $referenceId,
                'currency'            => 'PHP',
                'amount'              => (float) $request->amount,
                'checkout_method'     => 'ONE_TIME_PAYMENT',
                'channel_code'        => 'PH_GCASH',
                'channel_properties' => [
                    'success_redirect_url' => route('payment.success'),
                    'failure_redirect_url' => route('payment.failed'),
                    'cancel_redirect_url'  => route('payment.failed'),
                ],
                'metadata' => [
                    'description' => $request->description,
                ],
            ]);

        if ($response->failed()) {
            Log::error('Xendit GCash error', $response->json());
            return response()->json([
                'error'   => 'Failed to initiate GCash payment.',
                'details' => $response->json('message'),
            ], 422);
        }

        $charge = $response->json();

        Payment::create([
            'reservation_id' => $reservation->id,
            'xendit_id'      => $charge['id'],
            'reference_id'   => $referenceId,
            'status'         => $charge['status'],
            'amount'         => $request->amount,
            'description'    => $request->description,
            'payment_method' => 'GCASH',
            'created_at'     => now(),
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
        $payment = Payment::where('reference_id', $reference)->first();

        return view('payment.success', compact('payment'));
    }

    public function failed()
    {
        return view('payment.failed');
    }

    public function webhook(Request $request)
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
                            'user_id' => $payment->reservation->tenant_id,
                            'listing_id' => $payment->reservation->listing_id,
                            'reservation_id' => $payment->reservation_id,
                            'status' => 'active'
                        ]);

                        Listing::where('id', $payment->reservation->listing_id)
                            ->decrement('slot' , 1);
                }

                Log::info("Xendit webhook: {$chargeId} → {$status}");
            }
        }

        return response()->json(['received' => true]);
    }
}
