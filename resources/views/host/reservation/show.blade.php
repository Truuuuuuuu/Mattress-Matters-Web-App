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
                    <div class=" flex flex-2 gap-2 items-center">
                        <div class="p-10 btn btn-circle bg-purple-700">
                            <p class="text-center text-3xl">{{$reservation->tenant->user->name[0]}}</p>
                        </div>
                        <div >
                            <h1 class="text-lg font-semibold line-clamp-1"
                                title="{{ $reservation->tenant->user->name }}">
                                {{ $reservation->tenant->user->name }}
                            </h1>
                            <p class="text-base-content/70 -mt-2 text-sm">
                                Joined {{$reservation->tenant->user->created_at->format('Y')}}</p>
                        </div>
                    </div>
                    <div class=" flex flex-col flex-1 px-2">
                        <div class="flex-1">
                            <p class="text-sm text-base-content/70">Gender</p>
                            <p class="text-lg font-bold -mt-2">{{ucfirst($reservation->tenant->gender)}}</p>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm text-base-content/70">Occupation</p>
                            <p class="text-lg font-bold -mt-2">{{ucfirst($reservation->tenant->occupation === 'working_individual' ? 'Working Individual' : 'None' )}}</p>
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
                        <p>End Date:</p>
                        <p class="mt-10">Payment Status:</p>
                    </div>
                    <div class="flex-1 flex flex-col items-end">
                        <p>{{$reservation->start_date->format('M j, Y')}}</p>
                        <p>{{$reservation->end_date?->format('M j, Y') ?? 'Not specified'}}</p>
                        <p class="mt-10">{{ucfirst($reservation->payment_status)}}</p>
                    </div>

                </div>
                <div class="flex flex-col justify-end items-center gap-2 mt-5">


                    @role('tenant')
                    <div class="w-full bg-green-500 text-center py-2 rounded-xl italic">
                        <p>Please complete your payment within 48 hours</p>

                        <div id="error-msg" class="hidden text-red-500 mt-2"></div>

                    </div>

                    <button
                        id="pay-btn"
                        class="btn btn-primary w-full mt-3"
                        data-url="/payment/{{ $reservation->id }}/gcash"
                        data-amount="{{ $reservation->listing->rent_cost }}"
                        data-description="Reservation for {{ $reservation->listing->title }}">
                        Pay with GCash
                    </button>


                    @endrole




                </div>
            </div>
        </div>
    </section>

</x-layout>
