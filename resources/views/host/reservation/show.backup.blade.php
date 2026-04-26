<x-layout>
    <x-slot:heading>Reservation Details</x-slot:heading>

    <section class="w-full flex justify-center space-y-5">
        <div class="max-w-xl w-full  my-10">
            <h1 class="text-2xl font-semibold">Reservation Details</h1>

            <div class="border border-black/40 rounded-lg p-4">
                <div >
                    <img src="{{ asset('storage/' . $reservation->listing->listingImages->first()->image_path) }}"
                        alt="Cover Photo"
                        class="w-full h-full object-cover rounded-lg ">
                </div>
                <div>
                    <h1 class="text-lg font-semibold line-clamp-1" title="{{$reservation->listing->title}}">{{$reservation->listing->title}}</h1>
                    <h1>₱{{number_format($reservation->listing->rent_cost, 2)}}</h1>
                </div>
                <x-divider class="border border-black/20 my-5"/>


                @role('host')
                <h1 class="text-lg font-semibold italic text-base-content/70 mb-2">Reserved by</h1>
                <div class="flex ">
                    <a href="{{route('profile.show', $reservation->tenant->user)}}" class="flex flex-2  items-center gap-2">
                        <div class="p-10 btn btn-circle bg-purple-700">
                            <p class="text-center text-3xl">{{$reservation->tenant->user->name[0]}}</p>
                        </div>
                        <div>
                            <h1 class="text-lg font-semibold line-clamp-1"
                                title="{{ $reservation->tenant->user->name }}">
                                {{ $reservation->tenant->user->name }}
                            </h1>
                            <p class="text-base-content/70 -mt-2 text-sm">
                                Joined {{$reservation->tenant->user->created_at->format('Y')}}</p>
                        </div>
                    </a>
                    <div class=" flex flex-col flex-1 px-2">
                        <div class="flex-1">
                            <p class="text-sm text-base-content/70">Gender</p>
                            <p class="text-lg font-bold -mt-2">{{ucfirst($reservation->tenant->gender)}}</p>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm text-base-content/70">Occupation</p>
                            <p class="text-lg font-bold -mt-2">{{ucfirst($reservation->tenant->occupation === 'working_individual' ? 'Working Individual' : 'Student' )}}</p>
                        </div>
                    </div>
                </div>
                @endrole
                @role('tenant')
                <h1 class="text-lg font-semibold italic text-base-content/70 mb-2">Hosted by</h1>
                <div class="flex ">
                    <div class=" flex flex-2 gap-2 items-center">
                        <div class="p-10 btn btn-circle bg-purple-700">
                            <p class="text-center text-3xl">{{$reservation->listing->host->user->name[0]}}</p>
                        </div>
                        <div >
                            <h1 class="text-lg font-semibold line-clamp-1"
                                title="{{ $reservation->listing->host->user->name }}">
                                {{ $reservation->listing->host->user->name}}
                            </h1>
                            <p class="text-base-content/70 -mt-2 text-sm">
                                Joined {{$reservation->tenant->user->created_at->format('Y')}}</p>
                        </div>
                    </div>

                </div>
                @endrole

                <x-divider class="border border-black/20 my-5"/>
                <p class="text-end text-base-content/70">Applied: {{$reservation->created_at}}</p>
                <div class="flex">
                    <div class="flex-1 font-semibold">
                        <p>Start Date:</p>
                    </div>
                    <div class="flex-1 flex flex-col items-end">
                        <p>{{$reservation->start_date->format('M j, Y')}}</p>
                    </div>

                </div>
                @if(auth()->user()->hasRole('tenant') && $reservation->status === 'accepted' && $reservation->payment_status === 'unpaid' )
                    @php
                        $totalAmount = $reservation->listing->rent_cost * 2;
                    @endphp

                    <x-divider class="border border-base-content/10 my-5"/>
                    <div class="flex">
                        <div class="flex-1 font-semibold">
                            <p >Payment Status</p>
                            <p>Monthly rent cost</p>
                            <p>Security deposit</p>

                            <p class="mt-10 text-2xl font-bold">TOTAL</p>
                        </div>
                        <div class="flex-1 flex flex-col items-end font-bold">
                            <p class="font-normal">{{ucfirst($reservation->payment_status)}}</p>
                            <p>₱{{number_format($reservation->listing->rent_cost, 2)}}</p>
                            <p>₱{{number_format($reservation->listing->rent_cost, 2)}}</p>

                            <p class="mt-10 font-semibold text-xl">₱{{number_format($totalAmount, 2)}}</p>
                        </div>
                    </div>
                    <div class="flex flex-col justify-end items-center gap-2 mt-5">
                        <div class="w-full bg-green-500 text-center py-2 rounded-xl italic">
                            <p>Please complete your payment within 48 hours</p>
                            <div id="error-msg" class="hidden text-red-500 mt-2"></div>
                        </div>

                        <button

                            id="pay-btn"
                            class="btn btn-white btn-xl py-10 w-full mt-3 rounded-xl border-blue-900"
                            data-url="/payment/{{ $reservation->id}}/gcash"
                            data-amount="{{ $reservation->listing->rent_cost }}"
                            data-amount-electric="{{ $reservation->listing->electricity_cost ?? '' }}"
                            data-amount-water="{{ $reservation->listing->water_supply_cost ?? '' }}"
                            data-description="Reservation for {{ $reservation->listing->title }}">
                            <img src="{{asset('images/Gcash-logo.svg')}}" alt="">
                            Pay with GCash
                        </button>
                    </div>
                    <div>
                        <x-divider class="border border-black/20 my-5"/>
                        <button onclick="confirmAction(
                                '{{route('reservation.cancel', $reservation)}}',
                                'Cancel Reservation?',
                                'Are you sure you want to cancel this reservation? You are one step closer to securing this place',
                                'Yes, Cancel',
                                'Keep Reservation'

                            )"
                                class="btn btn-error  w-full">
                            Cancel
                        </button>
                    </div>

                @elseif(auth()->user()->hasRole('tenant') && $reservation->status === 'accepted' && $reservation->payment_status === 'paid')

                    <div>
                        <x-divider class="border border-black/20 my-5"/>
                        <button onclick="confirmAction(
                            '{{route('reservation.checkedIn', $reservation)}}',
                            'Confirm Check In?',
                            'Are you sure you want to check in? Your stay begins once confirmed.',
                            'Yes, I\'m here!',
                            'Not Yet',
                            'success'

                        )"
                                class="btn btn-success  w-full">
                            Check In
                        </button>
                    </div>
                @endif

                @if(auth()->user()->hasRole('host') && $reservation->status === 'pending')
                <x-divider class="border border-black/20 my-5"/>
                <div class="flex justify-stretch  gap-5">
                    <div class="w-full">
                        <button onclick="confirmAction(
                            '{{route('reservation.decline', $reservation)}}',
                            'Decline Reservation?',
                            'Are you sure you want to decline this reservation? You are one step closer to securing this place',
                            'Yes, Decline',
                            'Cancel'

                        )"
                                class="btn btn-error w-full">
                            Decline
                        </button>
                    </div>
                    <div class="w-full">

                        <button onclick="confirmAction(
                            '{{route('reservation.accept', $reservation)}}',
                            'Accept Reservation?',
                            'Are you sure you want to accept this reservation? You are one step closer to securing this place',
                            'Yes, Accept',
                            'Cancel',
                            'primary'

                        )"
                                class="btn btn-primary  w-full">
                            Accept
                        </button>
                    </div>
                </div>
                @endif
            </div>

        </div>
    </section>

</x-layout>
