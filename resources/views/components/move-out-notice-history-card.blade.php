@props(['moveOutNoticeHistory'])



<div class="card bg-base-100  shadow-sm px-4 py-4 ">
    <div class="flex flex-start items-center gap-4 ">
        <div class="avatar avatar-placeholder">
            <div class="bg-purple-700    w-12 rounded-full">
                <span class="text-lg font-bold">J</span>
            </div>
        </div>
        <div>
            <p class="-mb-2 font-semibold">{{$moveOutNoticeHistory->rental->tenant->user->name }}</p>
            <p class="text-sm text-base-content/60">{{Str::limit($moveOutNoticeHistory->rental->listing->title, 20)}}</p>
        </div>
    </div>

    <x-divider class="border border-base-content/10 my-3"/>

    <div class="space-y-1">
        <div class="flex justify-between">
            <p class="text-sm font-semibold text-base-content/60">Notice Issued</p>
            <p class="text-sm font-semibold">{{$moveOutNoticeHistory->created_at->format('M d, Y')}}</p>
        </div>
        <div class="flex justify-between">
            <p class="text-sm font-semibold text-base-content/60">Moved out date</p>
            <p class="text-sm font-semibold ">{{ $moveOutNoticeHistory->move_out_date->format('M d, Y') }}</p>
        </div>

        @if($moveOutNoticeHistory->status === 'completed')
            <div class="flex justify-between">
                <p class="text-sm font-semibold text-base-content/60">Stayed</p>
                <p class="text-sm font-semibold "> {{ $moveOutNoticeHistory->stayedFormatted() }}</p>
            </div>
        @else
            <div class="flex justify-between">
                <p class="text-sm font-semibold text-base-content/60">Cancelled date</p>
                <p class="text-sm font-semibold "> {{ $moveOutNoticeHistory->cancelled_at->format('M d, Y') }}</p>
            </div>
        @endif
    </div>

    <div class="mt-2">
        @if($moveOutNoticeHistory->status === 'completed')
            <div class="badge badge-success badge-soft gap-1 " >
                <span class="size-2 rounded-full bg-success"></span>
                <p class="text-xs font-semibold">Moved out</p>
            </div>
        @else
            <div class="badge badge-error badge-soft gap-1 " >
                <span class="size-2 rounded-full bg-error"></span>
                <p class="text-xs font-semibold">Cancelled</p>
            </div>
        @endif
    </div>
</div>
