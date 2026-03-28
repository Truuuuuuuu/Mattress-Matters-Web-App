<x-layout>
    <x-slot:heading>My Unit</x-slot:heading>

    <div class="w-full flex items-center justify-center h-[calc(100vh-72.67px)]  px-10 mb-50">

        @if($myUnit)
            <div class=" flex-1">
                <div class="w-full p-5 ">
                    <img src="{{asset('images/3D-bhouse-model.svg')}}" alt="3D" class="cursor-pointer  object-contain transition-transform duration-300 hover:scale-110" >
                </div>
                <div class="flex flex-col items-center">
                    <p class="text-lg font-semibold line-clamp-1" title="{{$myUnit->listing->title}}">{{$myUnit->listing->title}}</p>
                    <a href="{{route('listings.show', $myUnit->listing)}}" class="btn btn-neutral btn-sm px-10">Visit </a>
                </div>

            </div>
            <div class=" flex-2 h-full px-5">
                <div class=" w-full max-w-lg mt-10 text-3xl font-bold">
                    Your Safe Place
                </div>

                <div class=" flex gap-2">
                    <div class="flex-2 border rounded-xl px-4 py-5 space-y-3">
                        <div>
                            <h1 class="text-sm font-bold text-base-content/70 -mb-2">Title</h1>
                            <p title="{{$myUnit->listing->title}}" class="line-clamp-1">{{$myUnit->listing->title}}</p>
                        </div>
                        <div>
                            <h1 class="text-sm font-bold text-base-content/70 -mb-2">Address</h1>
                            <p title="{{$myUnit->listing->address}}" class="line-clamp-1">{{$myUnit->listing->address}}</p>
                        </div>
                        <div>
                            <h1 class="text-sm font-bold text-base-content/70 ">Amenities</h1>
                            <div class="grid grid-cols-2">
                                @foreach($myUnit->listing->amenities as $amenity)
                                    <x-amenity-small-card :$amenity/>
                                @endforeach
                            </div>
                        </div>
                        <div>
                            <h1 class="text-sm font-bold text-base-content/70 ">House Rules</h1>
                            <div class="space-y-2">
                                @foreach($myUnit->listing->rules as $rule)
                                    <x-rule-small-card :$rule/>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="flex-1  space-y-3 ">
                        <div class="flex-1 border rounded-xl px-2 pt-7 pb-3">
                            <div>
                                <h1 class="text-sm font-bold text-base-content/70 -mb-2">Monthly Rent</h1>
                                <h1 class="text-3xl font-bold">₱{{number_format($myUnit->listing->rent_cost,2)}}</h1>
                            </div>
                            <div class="w-full">
                                <button class="btn btn-success w-full">Pay Now</button>
                            </div>
                        </div>
                        <div class="flex-1 border rounded-xl px-2 py-4 space-y-2">
                            @php
                                $electric_cost = $myUnit->listing->electricity_cost;
                                $water_cost = $myUnit->listing->water_supply_cost;
                            @endphp
                            <div>
                                <h1 class="text-sm font-bold text-base-content/70 -mb-2">Electricity Cost</h1>
                                <h1 class=" {{$electric_cost ? 'text-3xl text-bold ' : 'text-thin text-xl text-base-content/70 '}}">{{$myUnit->listing->electricity_cost ? '₱'. number_format( $myUnit->listing->electricity_cost,2) : 'N/A' }}</h1>
                            </div>
                            <div>
                                <h1 class="text-sm font-bold text-base-content/70 -mb-2">Water Supply Cost</h1>
                                <h1 class=" {{$water_cost ? 'text-3xl text-bold ' : 'text-thin text-xl text-base-content/70'}}">{{$myUnit->listing->water_supply_cost_cost ? '₱'. number_format( $myUnit->listing->water_supply_cost,2) : 'N/A' }}</h1>
                            </div>
                        </div>
                        <div class="border rounded-xl px-2 py-4 flex flex-col items-center">
                            <h1 class="text-center font-semibold text-base-content/70">Hosted by</h1>
                            <div class="flex btn btn-ghost btn-circle h-15 w-15 bg-purple-700 mt-5">
                                <p class="text-3xl">{{$myUnit->listing->host->user->name[0]}}</p>
                            </div>
                            <p class="font-semibold">{{$myUnit->listing->host->user->name}}</p>
                            <div class="w-full">

                                <button class="btn btn-neutral w-full mt-2">Message</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full my-10">
                    <h1 class="text-xl font-bold mb-2">Danger Zone</h1>
                    <div class="border border-red-900 rounded-xl px-4">
                        <div class="flex my-3">
                            <div class="flex-3 flex flex-col justify-center">
                                <h1 class="font-semibold -mb-2 text-red-700">Leave this rental?</h1>
                                <p class="text-sm">Your landlord will be notified and your rental will end on your selected date.</p>
                            </div>

                            <div class="flex-1 w-full">
                                <btn onclick="move_out_modal.showModal()" class="btn btn-outline btn-error w-full">Move Out</btn>
                            </div>

                            @include('components.confirm-move-out', ['rental' => $myUnit])


                        </div>
                    </div>
                </div>
            </div>
        @else
            <div>
                Don't have active rental yet.
            </div>
        @endif

    </div>
</x-layout>
