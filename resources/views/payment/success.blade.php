<x-layout>
    <x-slot:heading>Payment Success!</x-slot:heading>
    <div class="flex flex-col items-center justify-center min-h-screen">
        <h2 class="text-2xl font-bold text-green-600">✅ Payment Successful!</h2>
        @if($payment)
            <div class="mt-4 p-4 border rounded-lg">
                <p><strong>Reference:</strong> {{ $payment->reference_id }}</p>
                <p><strong>Amount:</strong> ₱{{ number_format($payment->amount, 2) }}</p>
                <p><strong>Status:</strong> {{ $payment->status }}</p>
                <p><strong>Description:</strong> {{ $payment->description }}</p>
            </div>
        @endif
        <a href="/" class="mt-6 btn btn-primary">Back to Home</a>
    </div>
</x-layout>
