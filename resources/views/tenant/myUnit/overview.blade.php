<div class=" w-full ">
    <p class="text-xs lg:text-sm font-semibold">WELCOME HOME, {{strtoupper(str($myUnit->tenant->user->name)->before(' '))}}</p>
    <h1 class="hidden lg:block text-xl lg:text-3xl font-semibold">{{$myUnit->listing->title}}</h1>
    <div class="hidden lg:flex gap-1 items-center">
        <x-lucide-map-pin class="w-4 h-4"/>
        <p class="text-xs lg:text-md font-semibold">{{$myUnit->listing->address}}</p>
    </div>
</div>
<div class="flex flex-col lg:flex-row w-full gap-3 ">
    <div class="hidden lg:block relative rounded-3xl overflow-hidden shadow-sm h-64 w-full">
        @php
            $cover = $myUnit->listing->listingImages->where('is_cover', true)->first();
        @endphp

        <img
            class="w-full h-full object-cover"
            src="{{ asset('storage/' . $cover->image_path) }}"
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
    <div class="shrink-0 w-full lg:w-96 border px-5 py-10 flex flex-col justify-between rounded-3xl">
        <div class="flex justify-between ">
            <div class=" rounded-xl border  p-2">
                <x-lucide-wallet class="w-7 h-7"/>
            </div>
            <div>
                <div class="badge badge-xs">
                    @if($invoiceInfo['status'] === 'paid')
                        <span class="badge badge-soft badge-success">PAID FOR {{strtoupper($invoiceInfo['month'])}}</span>
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
            <button class="btn btn-success w-full" :class="{ 'active': activeSection === 'payments' }" @click="activeSection = 'payments'">Manage Billing</button>
        </div>
    </div>
</div>

{{--Middle section--}}
<div class="flex flex-col lg:flex-row gap-3 pt-5 ">
    <div class="flex-1 ">
        {{--Additional Info--}}
        <h1 class="text-2xl font-semibold mb-3">Stay Essentials</h1>
        <div class="flex justify-between gap-1 lg:gap-5">
            <div class="flex flex-col  gap-3 items-center border rounded-xl w-full py-3 lg:py-7 px-3 cursor-pointer" onclick="amenities_modal.showModal()">
                <div class="p-3 border rounded-2xl">
                    <x-lucide-washing-machine class="w-4 h-4 lg:w-8 lg:h-8"/>
                </div>
                <p class="text-xs lg:text-md font-semibold">Amenities</p>
            </div>
            <dialog id="amenities_modal" class="modal">
                <div class="modal-box">
                    <form method="dialog">
                        <button class="btn btn-sm  btn-ghost absolute right-2 top-2">✕</button>
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

            <div class="flex flex-col  gap-3 items-center border rounded-xl w-full py-3 lg:py-7 px-3 cursor-pointer" onclick="rules_modal.showModal()">
                <div class="p-3 border rounded-2xl">
                    <x-lucide-scale class="w-4 h-4 lg:w-8 lg:h-8"/>
                </div>
                <p class="text-xs lg:text-md font-semibold">Rules</p>
            </div>
            <dialog id="rules_modal" class="modal">
                <div class="modal-box">
                    <form method="dialog">
                        <button class="btn btn-sm  btn-ghost absolute right-2 top-2">✕</button>
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

            <div class="flex flex-col  gap-3 items-center border rounded-xl w-full py-3 lg:py-7 px-3 cursor-pointer" onclick="description_modal.showModal()">
                <div class="p-3 border rounded-2xl">
                    <x-lucide-info class="w-4 h-4 lg:w-8 lg:h-8"/>
                </div>
                <p class="text-xs lg:text-md font-semibold">Information</p>
            </div>
            <dialog id="description_modal" class="modal">
                <div class="modal-box">
                    <form method="dialog">
                        <button class="btn btn-sm  btn-ghost absolute right-2 top-2">✕</button>
                    </form>
                    <h3 class="text-lg font-bold">Additional Information</h3>
                    <div class="flex flex-col gap-3">
                        <div>
                            <p>{{$myUnit->listing->description}}</p>
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
        <div class="border gap-3 px-5 py-7 flex flex-col justify-evenly rounded-3xl items-center">
            <div class="avatar avatar-placeholder ">
                <div class="bg-neutral text-neutral-content w-24 rounded-xl">
                    <span class="text-3xl">{{$myUnit->listing->host->user->name[0]}}</span>
                </div>
            </div>
            <div class="flex flex-col items-center">
                <h class="font-semibold text-lg">{{$myUnit->listing->host->user->name}}</h>
                <div class="badge badge-soft badge-success flex">
                    <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                    <p>Online</p>
                </div>
            </div>
            <div class="w-full">
                <a href="{{route('messages.show', $myUnit->listing->host->user)}}" class="btn btn-neutral w-full mt-2">Message</a>
            </div>
        </div>
    </div>
</div>

{{--end section--}}
<div class="pb-20 lg:pb-0">
    {{--Danger Zone--}}
    <div class="w-full pt-10">
        <div class="border border-red-900 rounded-xl px-4 py-3">
            <div class="lg:flex items-center gap-4">
                <div class="flex-1 flex flex-col justify-center">
                    <h1 class="font-semibold ">Planning to move?</h1>
                    <p class="text-sm ">Your landlord will be notified and your rental will end on your selected date.</p>
                </div>
                {{-- Button column - only show if action is available --}}
                <div >
                    @if ($myUnit->moveOutNotice?->isActive() && $myUnit->moveOutNotice->isCancellable())
                        <button onclick="cancel_move_out_modal.showModal()" class="btn w-full btn-outline btn-error shrink-0">
                            Cancel Notice
                        </button>
                    @elseif (!$myUnit->moveOutNotice?->isActive() && (!$myUnit->moveOutNotice || $myUnit->moveOutNotice->canSubmitMoveOut()))
                        <button onclick="confirm_move_out_modal.showModal()" class="btn btn-outline px-10 btn-error shrink-0 w-full">
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
