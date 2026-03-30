<x-layout>
    <x-slot:heading>Payment Success!</x-slot:heading>
    <div class="flex flex-col items-center justify-center min-h-screen">

        @if($payment)
            <div class="mt-4 p-4 border rounded-lg w-full max-w-lg">
                <div class="flex flex-col items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="green" class="size-10">
                        <path fill-rule="evenodd"
                              d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14Zm3.844-8.791a.75.75 0 0 0-1.188-.918l-3.7 4.79-1.649-1.833a.75.75 0 1 0-1.114 1.004l2.25 2.5a.75.75 0 0 0 1.15-.043l4.25-5.5Z"
                              clip-rule="evenodd"/>
                    </svg>

                    <h2 class="text-2xl font-bold text-green-600 "> Payment Successful!</h2>
                </div>
                <div class="flex mt-10 space-y-5 ">
                    <div class="flex-2">
                        <p class="text-base-content/70 text-sm font-bold">Reference</p>
                        <p class="-mt-2">{{ $payment->reference_id }}</p>
                    </div>

                    <div class="flex-1">
                       <p class="text-base-content/70 text-sm font-bold">Status</p>
                        <p class="-mt-2">{{$payment->status}}</p>
                    </div>
                </div>
                <div>
                    <p class="text-base-content/70 text-sm font-bold">Description</p>
                    <p class="-mt-2">{{$payment->description}}</p>
                </div>

                <x-divider class="border border-black/20 my-4"/>
                <div class="flex">
                    <div class="flex-1 text-base-content/70  font-bold">
                        <p>Date</p>
                        <p>Payment Method</p>
                        <p class="mt-3 text-xs font-semibold">Montly rent cost</p>
                        <p class="text-xs font-semibold">Security deposit</p>
                        <p class="text-xs font-semibold">Electricity cost</p>
                        <p class="text-xs font-semibold">Water supply cost</p>
                        <p class="text-2xl mt-5">AMOUNT</p>
                    </div>
                    <div class="flex-2 ">
                        <p class="text-end">{{$payment->created_at->format('F j, Y g:i A')}}</p>
                        <p class="text-end">{{$payment->payment_method}}</p>
                        <p class="text-end text-xs font-semibold mt-3">{{$payment->reservation->listing->rent_cost}}</p>
                        <p class="text-end text-xs font-semibold">{{$payment->reservation->listing->rent_cost}}</p>
                        <p class="text-end text-xs font-semibold">{{$payment->reservation->listing->electricity_cost ?? '0.00'}}</p>
                        <p class="text-end text-xs font-semibold">{{$payment->reservation->listing->water_supply_cost ?? '0.00'}}</p>
                        <p class="text-end text-2xl font-bold mt-5">₱{{ number_format($payment->totalAmount(), 2) }}</p>
                    </div>
                </div>


            </div>
        @endif

            <div class="w-full max-w-lg">
                <a href="{{route('reservation.index')}}" class="mt-6 px-10 btn btn-primary w-full ">Back</a>
            </div>
    </div>
</x-layout>
