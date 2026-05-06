<div class="flex flex-col md:flex-row">
    <div class="w-full max-w-124  p-5 space-y-5">
        <div class="flex justify-center ">
            <x-avatar-squircle :listing="$reservation->listing" width="64" height="64"/>
        </div>
        <div class="flex gap-3">
            @if(auth()->user()->hasRole('tenant'))
                <x-avatar-squircle :user="$reservation->listing->host->user"/>
                <div>
                    <h1 class="text-xl font-semibold">{{$reservation->listing->host->user->name}}</h1>
                    <p class="text-sm font-semibold text-base-content/70">Host since {{$reservation->listing->host->created_at->format('Y')}}</p>
                </div>
            @else
                <x-avatar-squircle :user="$reservation->tenant->user"/>
                <div>
                    <h1 class="text-xl font-semibold">{{$reservation->tenant->user->name}}</h1>
                    <div class="flex justify-start items-center gap-2">
                        <p class="text-sm font-semibold text-base-content/70">{{$reservation->tenant->getGender()}}</p>
                        <div class="size-1 rounded-full bg-base-content/50"></div>
                        <p class="text-sm font-semibold text-base-content/70">{{$reservation->tenant->getOccupation()}}</p>
                    </div>
                </div>
            @endif

        </div>
    </div>
    <div class="w-full  p-5 bg-base-200 flex flex-col justify-between">
        <div >
            <h1 class="text-2xl font-semibold">Reservation Request</h1>
            <p class="text-xs font-semibold text-base-content/70">Please review the financial breakdown and reservation details before confirming the rental.</p>
        </div>

        <div class="bg-base-100 border-base-300 rounded-3xl p-3 flex justify-between items-center my-3">
            <div class="flex flex-col justify-center items-center  w-full">
                <p class="text-xs font-semibold text-base-content/70">START DATE</p>
                <h1 class="text-md font-semibold"> {{ $reservation->start_date->format('M d, Y') }}</h1>
            </div>
            <div class="w-px bg-gray-300 h-6 mx-5"></div>
            <div class=" flex justify-center   w-full ">
                @if($reservation->status !== 'accepted')
                    @php
                    $statusConfig = match($reservation->status) {
                        'pending' => ['class' => 'badge-warning', 'label' => 'Pending'],
                        'declined'  => ['class' => 'badge-error',    'label' => 'Declined'],
                        'cancelled' => ['class' => 'badge-error',  'label' => 'Cancelled'],
                        'checked_in' => ['class' => 'badge-primary', 'label' => 'Active'],
                        'completed' => ['class' => 'badge-neutral', 'label' => 'Moved-out'],
                        default     => ['class' => 'badge-ghost',    'label' => ucfirst($reservation->status)],
                    };
                    @endphp
                @else
                    @if($reservation->payment_status === 'unpaid')
                        @php
                            $statusConfig = ['class' => 'badge-warning', 'label' => 'Unpaid']
                        @endphp
                    @elseif($reservation->payment_status === 'paid')
                        @php
                            $statusConfig = ['class' => 'badge-success', 'label' => 'Paid']
                        @endphp
                    @endif
                @endif
                <div class="badge badge-soft {{ $statusConfig['class'] }} mt-2 font-semibold rounded-2xl    ">
                    {{ $statusConfig['label'] }}
                </div>
            </div>
        </div>
        <div class="flex flex-col gap-2">
            <div class="flex gap-3">
                <x-lucide-wallet class="text-primary w-5 h-5"/>
                <p class="text-primary text-sm font-semibold">FINANCIAL SUMMARY</p>
            </div>
            <div class="flex flex-col gap1">
                <div class="flex justify-between ">
                    {{--for history / active and completed reservation--}}

                    @if($reservation->status !== 'checked_in' && $reservation->status !== 'completed')
                        <p class="text-xs text-base-content/70">Monthly Rental</p>
                        <p class="text-xs text-base-content font-semibold">
                            ₱{{number_format($reservation->listing->rent_cost, 2)}}
                        </p>
                    @else
                        <p class="text-xs text-base-content/70">Monthly Rental + Utilities</p>
                        <p class="text-xs text-base-content font-semibold">
                            ₱{{number_format($rentalPayment?->amount, 2)}}
                        </p>
                    @endif
                </div>
                <div class="flex justify-between">
                    <p class="text-xs text-base-content/70">Security Deposit</p>
                    <p class="text-xs text-base-content font-semibold">₱{{ number_format($reservation->listing->rent_cost, 2) }}</p>
                </div>
                @if($reservation->status !== 'checked_in' && $reservation->status !== 'completed')
                    <div class="flex justify-between">
                        <p class="text-xs text-base-content/70">Utilities</p>
                        <p class="text-xs text-base-content font-semibold">₱{{ number_format($utilityCost, 2) }}</p>
                    </div>
                @endif

            </div>
            <x-divider class="bg-base-content/10 w-full "/>
            <div class="flex justify-between">
                <p class="text-md text-base-content font-semibold">First Payment</p>
                <p class="font-semibold text-primary">
                    {{$reservation->status !== 'checked_in' && $reservation->status !== 'completed' ? '₱'. number_format($totalCost, 2) : '₱'. number_format($snapshotTotal, 2) }}
                </p>
            </div>
        </div>
        <div class="flex gap-3 mt-5">
            @if(auth()->user()->hasRole('host') && $reservation->status === 'pending')
                <div class="flex-2">

                    <button onclick="confirmAction(
                            '{{route('reservation.accept', $reservation)}}',
                            'Accept Reservation?',
                            'Are you sure you want to accept this reservation? You are one step closer to securing this place',
                            'Yes, Accept',
                            'Cancel',
                            'primary'

                        )"
                            class="btn btn-primary rounded-3xl  w-full">
                        Accept Request
                    </button>
                </div>
                <div class="flex-1">
                    <button onclick="confirmAction(
                            '{{route('reservation.decline', $reservation)}}',
                            'Decline Reservation?',
                            'Are you sure you want to decline this reservation? You are one step closer to securing this place',
                            'Yes, Decline',
                            'Cancel'

                        )"
                            class="btn btn-base-100 rounded-3xl  w-full">
                        Decline
                    </button>
                </div>
            @elseif(auth()->user()->hasRole('host') && $reservation->status === 'accepted' && $reservation->payment_status === 'unpaid')
                <div class="badge badge-warning badge-soft w-full rounded-3xl py-5 border-warning/20">
                    <p>Awaiting Guest Payment</p>
                </div>
            @elseif(auth()->user()->hasRole('host') && $reservation->status === 'accepted' && $reservation->payment_status === 'paid')
                <div class="badge badge-primary badge-soft w-full rounded-3xl py-5 border-primary/20">
                    <p>Awaiting Tenant Check-In</p>
                </div>
            @endif

            @if(auth()->user()->hasRole('tenant') )
                    @if($reservation->status === 'pending')
                        <div class="flex-1">
                            <button onclick="confirmAction(
                        '{{route('reservation.cancel', $reservation)}}',
                        'Cancel Reservation?',
                        'Are you sure you want to cancel this reservation? This cannot be undone.',
                        'Yes, Cancel',
                        'Keep Reservation'

                        )"
                        class="btn btn bg-red-500  w-full text-base-100 hover:bg-red-600 w-full text-base-100 rounded-3xl py-5 text-lg">
                            Cancel Reservation
                        </button>
                        @include('components.confirm-modal')</div>
                @elseif($reservation->status === 'accepted')
                        @if($reservation->payment_status === 'unpaid')
                            <button

                                id="pay-btn"
                                class="btn btn-white btn-xl py-3 w-full mt-3 rounded-3xl border-blue-900"
                                data-url="/payment/{{ $reservation->id}}/gcash"
                                data-amount="{{ $reservation->listing->rent_cost }}"
                                data-amount-electric="{{ $reservation->listing->electricity_cost ?? '' }}"
                                data-amount-water="{{ $reservation->listing->water_supply_cost ?? '' }}"
                                data-description="Reservation for {{ $reservation->listing->title }}">
                                <img src="{{asset('images/Gcash-logo.svg')}}" alt="" class="w-8 h-8">
                                Pay with GCash
                            </button>
                            <div id="error-msg" class="hidden text-red-500 mt-2"></div>
                        @endif

                    @endif
            @endif

        </div>
    </div>
</div>
