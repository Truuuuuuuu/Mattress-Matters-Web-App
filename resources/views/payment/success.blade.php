<x-layout>
    <x-slot:heading>Payment Success!</x-slot:heading>
    <div class="px-3 lg:px-0 flex flex-col items-center justify-center min-h-screen bg-primary">

        @if($payment)
            @php
                $listing = $payment->reservation?->listing
                    ?? $payment->invoice?->rental?->listing
                    ?? null;
            @endphp
            <div class="flex flex-col items-center px-4 rounded-t-lg bg-base-100 w-full max-w-lg">
                <div class="relative flex items-center justify-center w-64">
                    <div class="w-full h-0.5 bg-gray-800 "></div>
                    <div class="absolute flex items-center justify-center w-12 h-12 rounded-full border-2 bg-primary"  style="border: 3px solid white;">
                        <x-lucide-check class="w-6 h-6 text-base-100 " stroke-width="3"/>
                    </div>
                </div>

                <div class="w-0.5 h-8 bg-base-100"></div>

                <div class="flex flex-col items-center w-full gap-3">
                    <div class="flex flex-col items-center ">
                        <h1 class="text-lg md:text-xl font-semibold text-primary">{{ $listing->host->user->masked_name }}</h1>
                        <div class="rounded-3xl  bg-primary/10 px-2 font-semibold text-primary">
                            <p>+63 923 423 9827</p>
                        </div>
                    </div>
                    <p class="text-base-content/70 text-sm">Sent via Gcash</p>
                </div>

                <div class="w-full  my-3 border border-black/20"></div>

                <div class="flex  w-full items-center">
                    <div class="flex-1 text-base-content/70  font-bold">
                        @if($payment->payment_type === 'security_deposit')
                            <p class="text-xs font-semibold">Security deposit</p>
                        @elseif($payment->payment_type === 'rent')
                            <p class="text-xs font-semibold">Monthly rent</p>
                        @elseif($payment->payment_type === 'reservation_fee')
                            <p class="text-xs font-semibold">Rental cost</p>
                            <p class="text-xs font-semibold">Security Deposit</p>
                        @endif



                        <p class="text-xs font-semibold">Electricity cost</p>
                        <p class="text-xs font-semibold">Water supply cost</p>

                    </div>
                    <div class="flex-2">
                        @if($payment->payment_type !== 'rent')
                            <p class="text-end text-xs font-semibold ">
                                {{ $listing ? number_format($listing->rent_cost, 2) : number_format($payment->amount, 2) }}
                            </p>
                        @endif
                        <p class="text-end text-xs font-semibold ">
                            {{ $listing ? number_format($listing->rent_cost, 2) : number_format($payment->amount, 2) }}
                        </p>
                        <p class="text-end text-xs font-semibold">
                            {{ number_format($listing->electricity_cost ?? '0.00', 2) }}
                        </p>
                        <p class="text-end text-xs font-semibold">
                            {{ number_format($listing->water_supply_cost ?? '0.00', 2) }}
                        </p>

                    </div>
                </div>

                <div class="w-full  my-3 border border-black/50"></div>

                <div class="flex justify-between items-center w-full py-3">
                    <p class="text-md font-semibold">Total Amount Sent</p>
                    <p class="text-end text-2xl font-bold">
                        ₱{{ number_format(
                            $payment->payment_type === 'rent'
                                ? $payment->monthlyRentalAmount()
                                : $payment->totalAmount(),
                            2
                        ) }}
                    </p>
                </div>

            </div>
            <div class="flex w-full max-w-lg flex-col justify-between gap-8 px-4 py-4 bg-base-300 ">
                <div class=" flex justify-between items-center w-full   ">
                    <p class="text-sm font-semibold text-base-content/70">Ref No. <span class="text-sm font-semibold text-base-content">{{$payment->reference_id}}</span></p>
                    <p class="text-xs font-semibold">{{ $payment->created_at->format('M d, Y g:i A') }}</p>
                </div>

                <div class="bg-success px-3 py-2 rounded-lg opacity-80" style="border-left: 5px solid green;">
                    <div class="flex justify-start items-center gap-2">
                        <x-lucide-leaf class="w-5 h-5 text-green-900"/>
                        <p class=" font-semibold">279g <span class="text-xs">(gCO2e)</span></p>
                    </div>
                    <p class="text-xs">By going digital, you reduce your carbon footprint from transportation, paper, and plastic</p>
                </div>
            </div>
        @endif
        @if($payment->payment_type !== 'rent')
            <div class="w-full max-w-lg">
                <a href="{{route('reservation.index')}}" class="mt-6 px-10 btn btn-soft border-2 rounded-3xl w-full ">Done</a>
            </div>
        @else
            <div class="w-full max-w-lg">
                <a href="{{route('tenant.unit')}}" class="mt-6 px-10 btn btn-primary w-full ">Done</a>
            </div>
        @endif
    </div>


</x-layout>
