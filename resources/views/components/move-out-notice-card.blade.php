@props(['movingOutTenant'])



<div class="card bg-base-100  shadow-sm px-4 py-4 ">
    <div class="flex flex-start items-center gap-4 ">
        <div class="avatar avatar-placeholder">
            <div class="bg-purple-700    w-12 rounded-full">
                <span class="text-lg font-bold">J</span>
            </div>
        </div>
        <div>
            <p class="-mb-2 font-semibold">{{$movingOutTenant->tenant->user->name }}</p>
            <p class="text-sm text-base-content/60">{{Str::limit($movingOutTenant->listing?->title, 20)}}</p>
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
            @if($movingOutTenant->moveOutNotice->status === 'active')
                <div class="flex justify-between rounded-xl text-sm bg-yellow-100 p-3">
                    <p>Move-out date</p>
                    <p class="font-semibold">{{$movingOutTenant->moveOutNotice->move_out_date->format('M d, Y')}}</p>
                </div>
            @elseif($movingOutTenant->moveOutNotice->status === 'cancelled')
                <div class="flex justify-center items-center rounded-xl text-sm bg-red-100 p-3">
                    <p class="text-lg font-semibold text-red-700">Cancelled</p>
                </div>
            @elseif($movingOutTenant->moveOutNotice->status === 'completed')
                <div class="flex justify-center items-center rounded-xl text-sm bg-green-100 p-3">
                    <p class="text-lg font-semibold text-green-700">Moved out</p>
                </div>
            @endif

        </div>
</div>
