@props(['movingOutTenant'])



<div class="card bg-base-100 rounded-4xl px-4 py-4 " >
    <div class="flex flex-start items-center gap-4 ">
        <div class="avatar avatar-placeholder">
            <div class="bg-purple-700 w-12 mask mask-squircle">
                <span class="text-lg font-bold">J</span>
            </div>
        </div>
        <div class=" w-full">
            <p class="-mb-2 font-semibold">{{$movingOutTenant->tenant->user->name }}</p>
            <p class="text-sm text-base-content/60 line-clamp-1">{{$movingOutTenant->listing?->title}}</p>
        </div>
    </div>

    <x-divider class="border border-base-content/10 my-3"/>

        <div class="space-y-1">
            <div class="flex justify-between">
                <p class="text-sm font-semibold text-base-content/60">Monthly rent</p>
                <p class="text-sm font-semibold">₱{{number_format($movingOutTenant->totalAmountDue())}}</p>
            </div>
            <div class="flex justify-between">
                <p class="text-sm font-semibold text-base-content/60">Tenant since</p>
                <p class="text-sm font-semibold ">{{ $movingOutTenant->reservation->start_date->format('M Y') }}</p>
            </div>
            <div class="flex justify-between">
                <p class="text-sm font-semibold text-base-content/60">Notice filed</p>
                <p class="text-sm font-semibold ">{{ $movingOutTenant->moveOutNotice->created_at->format('M d') }}</p>
            </div>
        </div>

        <div class="mt-2">
            @if($movingOutTenant->moveOutNotice->latestReversal && $movingOutTenant->moveOutNotice->latestReversal->status === 'pending')
                @php
                    $reversal = $movingOutTenant->moveOutNotice->latestReversal;
                @endphp

                @if($reversal && $reversal->isPending())
                    <div x-data="{ open: false }">

                        <button
                            @click="open = true"
                            class="btn w-full btn-primary rounded-3xl"
                        >
                            Review Reversal Request
                        </button>

                        <div
                            x-show="open"
                            class="fixed inset-0 z-50 flex items-center justify-center bg-black/50"
                        >
                            <div class="relative bg-base-100 w-full max-w-lg p-6 rounded-3xl shadow-xl"
                                 @click.away="open = false">

                                <h2 class="text-lg font-bold">Reversal Request</h2>

                                <div class="w-full flex flex-col gap-3 mt-4">
                                    <div>
                                        <p class="text-sm font-semibold text-base-content/70">Move-out Date</p>
                                        <p class="text-md font-semibold ">
                                            {{ $movingOutTenant->moveOutNotice->move_out_date->format('M d, Y')}}
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-base-content/70">Reason</p>
                                        <p class="text-sm ">
                                            {{ $reversal->reason }}
                                        </p>
                                    </div>
                                </div>


                                <form method="POST" class="mt-4 space-y-3">
                                    @csrf

                                    <textarea
                                        name="host_notes"
                                        class="textarea w-full rounded-3xl min-h-32 resize-none overflow-auto focus:primary"
                                        placeholder="Add notes for the tenant (optional)"
                                    ></textarea>

                                    <div class="flex gap-2">
                                        <button
                                            formaction="{{ route('reversals.reject', $reversal) }}"
                                            class="btn bg-red-600 text-base-100 rounded-3xl flex-1"
                                        >
                                            Reject
                                        </button>
                                        <button
                                            formaction="{{ route('reversals.approve', $reversal) }}"
                                            class="btn bg-green-600 text-base-100 rounded-3xl flex-1"
                                        >
                                            Approve
                                        </button>


                                    </div>
                                </form>
                                <button
                                    @click="open = false"
                                    class="absolute top-3 right-3 btn btn-sm btn-circle btn-ghost"
                                >
                                    <x-lucide-x class="w-4 h-4"/>
                                </button>

                            </div>
                        </div>
                    </div>
                @endif
            @else
                @if($movingOutTenant->moveOutNotice->status === 'active')
                    <div class="flex w-full justify-between rounded-xl text-sm badge badge-warning badge-soft p-3">
                        <p>Move-out date</p>
                        <p class="font-semibold">{{$movingOutTenant->moveOutNotice->move_out_date->format('M d, Y')}}</p>
                    </div>
                @elseif($movingOutTenant->moveOutNotice->status === 'cancelled')
                    <div class="flex justify-between w-full  rounded-xl text-sm badge badge-error badge-soft">
                        <p class="text-md font-semibold text-red-700">Cancelled</p>
                        <p class="text-xs ">{{$movingOutTenant->moveOutNotice->updated_at->format('M d, Y g:i A')}}</p>
                    </div>
                @elseif($movingOutTenant->moveOutNotice->status === 'completed')
                    <div class="flex w-full justify-center items-center rounded-xl text-sm badge badge-success badge-soft p-3">
                        <p class="text-lg font-semibold text-green-700">Moved out</p>
                    </div>
                @endif
            @endif


        </div>
</div>
