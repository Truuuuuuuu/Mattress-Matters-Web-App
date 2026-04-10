<x-layout>
    <x-slot:heading>My Unit</x-slot:heading>

    <div class="w-full max-w-7xl mx-auto px-2 lg:px-10 pb-20">
        <div class="lg:flex items-center justify-center  ">
            @if($myUnit?->reservation?->status === 'checked_in')
                <div class=" flex-1 h-full lg:px-5 ">
                    <div class=" lg:flex gap-2 mt-5 ">
                        <div class="flex flex-col justify-center items-center flex-1 mb-3  items-center ">
                            <div class="w-42 lg:w-full p-5 ">
                                <img src="{{asset('images/3D-bhouse-model.svg')}}" alt="3D" class="cursor-pointer  object-contain transition-transform duration-300 hover:scale-110" >
                            </div>
                            <div class="flex flex-col items-center text-center">
                                <p class="text-lg font-semibold line-clamp-1" title="{{$myUnit->listing->title}}">{{$myUnit->listing->title}}</p>
                                <a href="{{route('listings.show', $myUnit->listing)}}" class="btn btn-neutral btn-sm px-10">Visit </a>
                            </div>
                        </div>
                        <div class="flex-2 border rounded-xl px-4 py-5 space-y-3 mb-3">
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
                        <div class="flex-1 space-y-3 ">
                            <div class="flex-1 border rounded-xl px-2 pt-7 pb-3 ">
                                <div>
                                    <div class="flex justify-between">
                                        <h1 class="text-sm font-bold text-base-content/70 -mb-2">Due Date</h1>
                                        <div class="badge badge-xs">
                                            @if($invoiceInfo['status'] === 'paid')
                                                <span class="badge badge-soft badge-success">Paid</span>
                                            @elseif($invoiceInfo['status'] === 'overdue')
                                                <span class="badge badge-soft badge-error">Overdue</span>
                                            @elseif($invoiceInfo['status'] === 'unpaid')
                                                <span class="badge badge-soft badge-warning">Unpaid</span>
                                            @else
                                                <span class="badge badge-soft badge-primary">Pending</span>
                                            @endif
                                        </div>
                                    </div>
                                    <h1 class="text-xl font-bold">
                                        @if($invoiceInfo['status'] === 'no_invoice')
                                            No invoice yet
                                        @elseif($invoiceInfo['status'] === 'paid')
                                            Wait for next invoice
                                        @elseif($invoiceInfo['status'] === 'overdue')
                                            <span class="text-error">{{ $invoiceInfo['due_date']?->format('F d, Y') }}</span>
                                        @else
                                            {{ $invoiceInfo['due_date']?->format('F d, Y') }}
                                        @endif
                                    </h1>
                                    @if($invoiceInfo['status'] === 'no_invoice' || $invoiceInfo['status'] === 'paid')
                                        <p class="text-xs text-base-content/50">Note: Invoice will be generated 7 days before due date</p>
                                    @endif


                                </div>
                                <div class="w-full mt-4">
                                    <a href="{{ route('tenant.soa') }}" class="btn btn-success w-full">Manage Billing</a>
                                </div>
                            </div>
                            <div class="flex-1 border rounded-xl px-2 py-4 space-y-2">
                                @php
                                    $electric_cost = $myUnit->listing->electricity_cost;
                                    $water_cost = $myUnit->listing->water_supply_cost;
                                @endphp
                                <div>
                                    <h1 class="text-sm font-bold text-base-content/70 -mb-2">Monthly Rent</h1>
                                    <h1 class="text-3xl font-bold">₱{{number_format($myUnit->listing->rent_cost,2)}}</h1>
                                </div>
                            </div>
                            <div class="border rounded-xl px-2 py-4 flex flex-col items-center mb-3">
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
                </div>
        </div>
        <div>
            {{--Danger Zone--}}
            <div class="w-full">
                <h1 class="text-xl font-bold mb-2">Danger Zone</h1>
                <div class="border border-red-900 rounded-xl px-4 py-3">
                    <div class="lg:flex items-center gap-4">
                        <div class="flex-1 flex flex-col justify-center">
                            <h1 class="font-semibold -mb-2 text-red-700">Leave this rental?</h1>
                            <p class="text-sm ">Your landlord will be notified and your rental will end on your selected date.</p>
                        </div>
                        {{-- Button column - only show if action is available --}}
                        <div >
                            @if ($myUnit->moveOutNotice?->isActive() && $myUnit->moveOutNotice->isCancellable())
                                <button onclick="cancel_move_out_modal.showModal()" class="btn w-full btn-outline btn-error shrink-0">
                                    Cancel Notice
                                </button>
                            @elseif (!$myUnit->moveOutNotice?->isActive() && (!$myUnit->moveOutNotice || $myUnit->moveOutNotice->canSubmitMoveOut()))
                                <button onclick="confirm_move_out_modal.showModal()" class="btn btn-outline btn-error shrink-0 w-full">
                                    Move Out
                                </button>
                            @endif
                        </div>
                    </div>
                    {{-- Warning messages span full width below --}}
                    <div>
                        @if ($myUnit->moveOutNotice?->isActive() && !$myUnit->moveOutNotice->isCancellable())
                            <p class="text-sm text-gray-500 mt-2">Your move out notice can no longer be cancelled. Contact your landlord directly.</p>
                        @elseif($myUnit->moveOutNotice?->isActive() && $myUnit->moveOutNotice->isCancellable())
                            @if($myUnit->moveOutNotice->hoursUntilCanCancel() <= 4 )
                                <div class="rounded-xl bg-red-300 px-4 mt-2">
                                    <p class="text-base-content text-sm">Cancellation window closing soon — only {{ $myUnit->moveOutNotice->hoursUntilCanCancel() }} hour(s) left.</p>
                                </div>
                            @else
                                <div class="rounded-xl bg-yellow-300 px-4 mt-2">
                                    <p class="text-base-content text-sm">You have {{ $myUnit->moveOutNotice->hoursUntilCanCancel() }} hour(s) left to
                                        cancel this notice.</p>
                                </div>
                            @endif
                        @elseif ($myUnit->moveOutNotice?->isCancelled() && !$myUnit->moveOutNotice->canSubmitMoveOut())
                            <p class="text-sm text-gray-500 mt-2">You recently cancelled a move out notice. Please wait {{$myUnit->moveOutNotice->daysUntilCanResubmit()}} days before submitting a new one.</p>
                        @endif
                    </div>
                </div>
            </div>

            @if ($myUnit->moveOutNotice?->isActive() && $myUnit->moveOutNotice->isCancellable())
                @include('components.cancel-move-out', ['rental' => $myUnit])
            @endif

            @if (!$myUnit->moveOutNotice?->isActive() && (!$myUnit->moveOutNotice || $myUnit->moveOutNotice->canSubmitMoveOut()))
                @include('components.confirm-move-out', ['rental' => $myUnit])
            @endif
        </div>



        @elseif($myUnit?->reservation?->status === 'accepted')
            <div class="w-full flex justify-center items-center py-10">
                <div class="w-full max-w-lg  flex flex-col items-center">
                    <div class=" w-full text-center text-2xl font-semibold mb-8">
                        <h1>Are you here?</h1>
                    </div>
                    <div class="w-xs  ">
                        <img src="{{asset('images/3D-bhouse-model.svg')}}" alt="3D" class="cursor-pointer w-full h-auto object-contain transition-transform duration-300 hover:scale-110" >
                    </div>
                    <div class="w-full mt-3">
                        <button onclick="confirmAction(
                            '{{route('reservation.checkedIn', $myUnit->reservation)}}',
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




                </div>

            </div>
        @else
            <div class=" flex mt-20 justify-center items-center">
                Don't have active rental yet.
            </div>
        @endif

    </div>

    <div class="{{!$myUnit ? 'h-0' : 'h-24'}}">

    </div>
</x-layout>
