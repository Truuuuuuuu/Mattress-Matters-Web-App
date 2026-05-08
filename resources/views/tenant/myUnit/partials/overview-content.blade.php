<div class=" w-full mb-3">
    <h1 class="hidden lg:block text-xl lg:text-3xl  font-semibold">{{$myUnit->listing->title}}</h1>
    <div class="hidden lg:flex gap-1 items-center">
        <x-lucide-map-pin class="w-4 h-4 text-base-content/70"/>
        <p class="text-xs lg:text-md font-semibold text-base-content/70">{{$myUnit->listing->address}}</p>
    </div>
</div>
<div class="flex flex-col lg:flex-row w-full gap-3 ">
    <div class="hidden lg:block relative rounded-3xl overflow-hidden shadow-sm h-64 w-full">
        @php
            $cover = $myUnit->listing->listingImages->where('is_cover', true)->first();
        @endphp

        <img
            class="w-full h-full object-cover"
            src="{{ $cover->url  }}"
            alt="Cover"
        />
    </div>
    <div class="block lg:hidden relative rounded-2xl overflow-hidden shadow-sm h-52">
        <!-- The image, stretched to fill -->
        <img
            class="absolute inset-0 w-full h-full object-cover"
            src="{{ asset('storage/' . $cover->image_path) }}"
            alt="Shoes"
        />

        <!-- Dark overlay (mimics DaisyUI's image-full tint) -->
        <div class="absolute inset-0 bg-black/50"></div>

        <!-- Card body on top -->
        <div class="relative z-10 p-6 flex flex-col gap-2">
            <h2 class="text-white text-md font-bold">{{$myUnit->listing->title}}</h2>
            <p class="text-white/80 text-xs">{{$myUnit->listing->address}}</p>
        </div>

    </div>

    {{--Payment--}}
    <div class="shrink-0 w-full lg:w-96 bg-base-100 px-5 py-10 flex flex-col justify-between rounded-3xl">
        <div class="flex justify-between ">
            <div class="  bg-primary/10 text-primary rounded-2xl  p-2">
                <x-lucide-wallet class="w-7 h-7"/>
            </div>
            <div>
                <div class="badge badge-xs">
                    @if($invoiceInfo['status'] === 'paid')
                        <span
                            class="badge badge-soft badge-success">PAID FOR {{strtoupper($invoiceInfo['month'])}}</span>
                    @elseif($invoiceInfo['status'] === 'overdue')
                        <span class="badge badge-soft badge-error">Overdue</span>
                    @elseif($invoiceInfo['status'] === 'unpaid')
                        <span class="badge badge-soft badge-warning">Unpaid</span>
                    @else
                        <span class="badge badge-soft badge-primary">Pending</span>
                    @endif
                </div>
            </div>
        </div>
        <div>
            <p class="-mb-2">Monthly Rent</p>
            <h1 class="text-2xl font-bold">
                @if($invoiceInfo['status'] === 'no_invoice')
                    No invoice yet
                @elseif($invoiceInfo['status'] === 'paid')
                    Wait for next invoice
                @elseif($invoiceInfo['status'] === 'overdue')
                    <span class="text-red-700">{{ $invoiceInfo['due_date']?->format('F d, Y') }}</span>
                @else
                    {{ $invoiceInfo['due_date']?->format('F d, Y') }}
                @endif
            </h1>
            @if($invoiceInfo['status'] === 'no_invoice' || $invoiceInfo['status'] === 'paid')
                <p class="text-xs text-base-content/50">Note: Invoice will be generated 7 days before due date</p>
            @endif
        </div>

        <div class="w-full mt-4">
            <button class="btn btn-success text-success-content rounded-3xl w-full"
                    :class="{ 'active': activeTab === 'SOA' }" @click="activeTab = 'SOA'">Manage Billing
            </button>
        </div>
    </div>
</div>

{{--Middle section--}}
<div class="flex flex-col lg:flex-row gap-3 pt-5 ">
    <div class="flex-1 ">
        {{--Additional Info--}}
        <h1 class="text-2xl font-semibold mb-3">Stay Essentials</h1>
        <div class="flex justify-between gap-1 lg:gap-5">
            <div class="flex flex-col bg-base-100  gap-3 items-center  rounded-3xl w-full py-3 lg:py-7 px-3 border border-transparent transition-transform duration-200
                hover:scale-105 hover:border-primary cursor-pointer" onclick="amenities_modal.showModal()">
                <div class="p-3 bg-primary/10 text-primary rounded-2xl">
                    <x-lucide-washing-machine class="w-4 h-4 lg:w-8 lg:h-8"/>
                </div>
                <p class="text-xs lg:text-md font-semibold">Amenities</p>
            </div>
            <dialog id="amenities_modal" class="modal">
                <div class="modal-box rounded-3xl bg-base-300">
                    <form method="dialog">
                        <button class="btn btn-sm rounded-full  btn-ghost absolute right-2 top-2">✕</button>
                    </form>
                    <h3 class="text-lg font-bold mb-3">Amenities</h3>
                    <div class="flex flex-col gap-3">
                        @foreach($myUnit->listing->amenities as $amenity)
                            <x-amenity-small-card :$amenity/>
                        @endforeach
                    </div>

                </div>
                <form method="dialog" class="modal-backdrop">
                    <button>close</button>
                </form>
            </dialog>

            <div class="flex flex-col  gap-3 items-center bg-base-100 rounded-3xl w-full py-3 lg:py-7 px-3 cursor-pointer border border-transparent transition-transform duration-200
                hover:scale-105 hover:border-primary" onclick="rules_modal.showModal()">
                <div class="p-3 bg-primary/10 text-primary  rounded-2xl">
                    <x-lucide-scale class="w-4 h-4 lg:w-8 lg:h-8"/>
                </div>
                <p class="text-xs lg:text-md font-semibold">Rules</p>
            </div>
            <dialog id="rules_modal" class="modal">
                <div class="modal-box rounded-3xl bg-base-300">
                    <form method="dialog">
                        <button class="btn btn-sm rounded-full btn-ghost absolute right-2 top-2">✕</button>
                    </form>
                    <h3 class="text-lg font-bold mb-3">House Rules</h3>
                    <div class="flex flex-col gap-3">
                        @foreach($myUnit->listing->rules as $rule)
                            <x-rule-small-card :$rule/>
                        @endforeach
                    </div>
                </div>
                <form method="dialog" class="modal-backdrop">
                    <button>close</button>
                </form>
            </dialog>

            <div class="flex flex-col  gap-3 items-center bg-base-100 rounded-3xl w-full py-3 lg:py-7 px-3 cursor-pointer border border-transparent transition-transform duration-200
                hover:scale-105 hover:border-primary" onclick="description_modal.showModal()">
                <div class="p-3 bg-primary/10 text-primary  rounded-2xl">
                    <x-lucide-info class="w-4 h-4 lg:w-8 lg:h-8"/>
                </div>
                <p class="text-xs lg:text-md font-semibold">Information</p>
            </div>
            <dialog id="description_modal" class="modal">
                <div class="modal-box rounded-3xl bg-base-300">
                    <form method="dialog">
                        <button class="btn btn-sm rounded-full  btn-ghost absolute right-2 top-2">✕</button>
                    </form>
                    <h3 class="text-lg font-bold mb-3">Additional Information</h3>
                    <div class="flex flex-col gap-8">
                        <div>
                            <div class="flex gap-2 mb-3">
                                <x-lucide-banknote class="w-6 h-6 text-primary"/>
                                <p class="font-semibold text-md">Financial Breakdown</p>
                            </div>
                            <div class="flex flex-col gap-2 bg-base-100 rounded-3xl p-5">
                                <div class="flex justify-between items-center">
                                    <p class="text-sm font-semibold text-base-content/70">Monthly Rent</p>
                                    <p class="text-md font-semibold">
                                        ₱{{number_format($myUnit->listing->rent_cost,2)}}</p>
                                </div>
                                <div class="flex justify-between items-center">
                                    <p class="text-sm font-semibold text-base-content/70">Electricity Cost</p>
                                    <p class="text-md font-semibold">
                                        ₱{{number_format($myUnit->listing->electricity_cost,2)}}</p>
                                </div>
                                <div class="flex justify-between items-center">
                                    <p class="text-sm font-semibold text-base-content/70">Water Supply Cost</p>
                                    <p class="text-md font-semibold">
                                        ₱{{number_format($myUnit->listing->water_supply_cost,2)}}</p>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="flex gap-2 mb-3 items-center">
                                <x-lucide-building class="w-6 h-6 text-primary"/>
                                <p class="font-semibold text-md">Description</p>
                            </div>
                            <div class="bg-primary/10 border border-primary rounded-3xl p-5">
                                <p>{{$myUnit->listing->description}}</p>
                            </div>
                        </div>

                    </div>

                </div>
                <form method="dialog" class="modal-backdrop">
                    <button>close</button>
                </form>
            </dialog>

        </div>
    </div>
    {{--Host--}}
    <div class="shrink-0 w-full lg:w-96 px-5">
        <h1 class="text-2xl font-semibold mb-3">Host Support</h1>
        <div class="bg-base-100 gap-3 px-5 py-7 flex flex-col justify-evenly rounded-3xl items-center">
            <x-avatar-squircle :user="$myUnit->listing->host->user" width="24" height="24"/>
            <div class="flex flex-col items-center">
                <h class="font-semibold text-lg">{{$myUnit->listing->host->user->name}}</h>
                <div class="badge badge-soft badge-success flex">
                    <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                    <p>Online</p>
                </div>
            </div>
            <div class="w-full">
                <a href="{{route('messages.show', $myUnit->listing->host->user)}}"
                   class="btn btn-primary btn-outline rounded-3xl w-full mt-2">Message</a>
            </div>
        </div>
    </div>
</div>

{{--end section--}}
<div class="pb-20 lg:pb-0 ">
    {{--Danger Zone--}}
    <div class="w-full pt-10 ">
        <div class="border border-red-900 px-4 py-3 rounded-3xl">
            <div class="lg:flex items-center gap-4">
                @if(!$myUnit->moveOutNotice?->isActive() && !$myUnit->moveOutNotice->isCancellable())
                    <div class="flex-1 flex flex-col justify-center">
                        <h1 class="font-semibold text-error-content">Planning to move-out?</h1>
                        <p class="text-sm ">Your landlord will be notified and your rental will end on your selected
                            date.</p>
                    </div>
                @else
                    <div class="w-full">
                        <h1 class="text-xl text-primary font-semibold">Move-out Notice Information</h1>



                        <div class="flex flex-col gap-4 w-full mt-3">
                            <div class="flex justify-between">
                                <div>
                                    <p class="text-xs text-base-content/70 font-semibold">Move-out Date</p>
                                    <p class="text-lg font-semibold">{{ $moveOutNotice->move_out_date->format('M d, Y') }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-base-content/70 font-semibold">Notice Filed</p>
                                    <p class="text-lg font-semibold">{{ $moveOutNotice->created_at->format('M d, Y') }}</p>
                                </div>

                                <div class="w-sm max-w-xl overflow-auto">
                                    <p class="text-xs text-base-content/70 font-semibold">Reason</p>
                                    <p class="text-sm font-semibold">{{ $moveOutNotice->reason }}</p>
                                </div>
                            </div>

                            <!-- The "Request to Stay" Form -->
                            <div class="mt-4 border-t border-base-content/10 pt-4">
                                @if($moveOutNotice->canRequestReversal())
                                    <form action="{{ route('reversals.store', $moveOutNotice->id) }}" method="POST">
                                        @csrf

                                        <div class="form-control w-full mb-3">
                                            <label class="label">
                                                <span class="label-text text-xs text-base-content/70 font-semibold">Why do you want to stay?</span>
                                            </label>
                                            <textarea
                                                name="reason"
                                                class="textarea textarea-bordered w-full"
                                                placeholder="Please explain why you are requesting to cancel your move-out..."
                                                required
                                            ></textarea>

                                            <!-- Validation Error Display -->
                                            @error('reason')
                                            <span class="text-error text-xs mt-1">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <button type="submit" class="w-full btn btn-primary rounded-3xl">
                                            Request to Stay
                                        </button>
                                    </form>
                                @else
                                    <!-- Optional: Show why they can't request a reversal right now -->
                                    @if(!$moveOutNotice->latestReversal)
                                        <p class="text-sm text-center text-base-content/60 italic mt-2">
                                            A reversal cannot be requested at this time.
                                        </p>


                                    @else
                                        @php
                                            $reversal = $moveOutNotice->latestReversal;
                                            $status = match($reversal->status) {
                                                'pending' => ['class' => 'badge-warning',  'label' => 'Pending'],
                                                'approved' => ['class' => 'badge-success', 'label' => 'Approved'],
                                                'rejected' => ['class' => 'badge-error', 'label' => 'Rejected'],
                                                default     => ['class' => 'badge-ghost', 'label' => ucfirst($reversal->status)],
                                            };
                                        @endphp
                                        <div class="flex gap-3 items-center ">
                                            <h1 class="text-xl text-primary font-semibold">Move-out Reversal</h1>
                                            <div class="badge badge-soft {{ $status['class'] }} font-semibold rounded-2xl ">
                                                {{ $status['label'] }}
                                            </div>
                                        </div>

                                        <div class="flex justify-between mt-3">
                                            <div>
                                                <p class="text-xs text-base-content/70 font-semibold">Awaiting Host Review</p>
                                                <p class="text-lg font-semibold">{{ $moveOutNotice->rental->listing->host->user->name}}</p>
                                            </div>
                                            <div>
                                                <p class="text-xs text-base-content/70 font-semibold">Reviewed at</p>
                                                <p class="text-lg font-semibold">{{ $moveOutNotice->latestReversal?->reviewed_at?->format('M d, Y') ?? 'N/A'}}</p>
                                            </div>
                                            <div class="w-sm max-w-xl overflow-auto">
                                                <p class="text-xs text-base-content/70 font-semibold">Host Notes</p>
                                                <p class="text-lg font-semibold">{{ $moveOutNotice->latestReversal?->host_notes ?? 'N/A'}}</p>
                                            </div>
                                        </div>
                                    @endif



                                @endif
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Button column - only show if action is available --}}
                <div>
                    @if ($myUnit->moveOutNotice?->isActive() && $myUnit->moveOutNotice->isCancellable())
                        <button onclick="cancel_move_out_modal.showModal()"
                                class="btn w-full btn-outline rounded-3xl btn-error shrink-0">
                            Cancel Notice
                        </button>
                    @elseif (!$myUnit->moveOutNotice?->isActive() && (!$myUnit->moveOutNotice || $myUnit->moveOutNotice->canSubmitMoveOut()))
                        <button onclick="confirm_move_out_modal.showModal()"
                                class="btn btn-outline px-10 btn-error rounded-3xl shrink-0 w-full">
                            Submit Notice
                        </button>
                    @endif
                </div>
            </div>
            {{-- Warning messages span full width below --}}
            <div>
                @if ($myUnit->moveOutNotice?->isActive() && !$myUnit->moveOutNotice->isCancellable())
                    <div class="badge badge-soft badge-primary italic py-4 text-sm w-full mt-5 flex items-center">
                        <x-lucide-info class="w-5 h-5"/>
                            @if(!$moveOutNotice->reversals)
                                <p>
                                    Your move-out notice can no longer be cancelled through this page. If this was a mistake or you’ve changed your mind, you may submit a request to continue your stay.
                                </p>
                            @else
                                <p>Your move-out reversal request has been submitted and is awaiting approval.</p>
                            @endif

                    </div>
                @elseif($myUnit->moveOutNotice?->isActive() && $myUnit->moveOutNotice->isCancellable())
                    @if($myUnit->moveOutNotice->hoursUntilCanCancel() <= 4 )
                        <div class="rounded-xl bg-red-300 px-4 mt-2">
                            <p class="text-base-content text-sm">Cancellation window closing soon —
                                only {{ $myUnit->moveOutNotice->hoursUntilCanCancel() }} hour(s) left.</p>
                        </div>
                    @else
                        <div class="rounded-xl bg-yellow-300 px-4 mt-2">
                            <p class="text-base-content text-sm">You
                                have {{ $myUnit->moveOutNotice->hoursUntilCanCancel() }} hour(s) left to
                                cancel this notice.</p>
                        </div>
                    @endif
                @elseif ($myUnit->moveOutNotice?->isCancelled() && !$myUnit->moveOutNotice->canSubmitMoveOut())
                    <div class="badge badge-soft badge-primary text-sm w-full">
                        You recently cancelled a move out notice. Please
                            wait {{$myUnit->moveOutNotice->daysUntilCanResubmit()}} days before submitting a new one.
                    </div>
                @endif
            </div>
        </div>
    </div>

    @if ($myUnit->moveOutNotice?->isActive() && $myUnit->moveOutNotice->isCancellable())
        @include('tenant.myUnit.partials.cancel-move-out', ['rental' => $myUnit])
    @endif

    @if (!$myUnit->moveOutNotice?->isActive() && (!$myUnit->moveOutNotice || $myUnit->moveOutNotice->canSubmitMoveOut()))
        @include('tenant.myUnit.partials.confirm-move-out', ['rental' => $myUnit])
    @endif
</div>
