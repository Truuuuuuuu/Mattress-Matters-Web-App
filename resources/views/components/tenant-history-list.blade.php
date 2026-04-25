@props(['history'])

<!-- row 1 -->
{{--<tr>
    <td>
        <div class="flex items-center gap-3">
            <div class="avatar">
                <div class="mask mask-squircle h-12 w-12 bg-purple-700 flex items-center justify-center">
                    <p class="text-center text-xl font-bold">{{$history->rental->tenant->user->name[0]}}</p>
                </div>
            </div>
            --}}{{--Tenant--}}{{--
            <div>
                <div class="font-bold -mb-1">{{$history->rental->tenant->user->name}}</div>

                @if($history->status === 'completed')
                    <div class="text-sm opacity-50">Stayed {{ $history->stayedFormatted() }}</div>
                @else
                    <div>
                        <div class="text-sm opacity-50">Active rental</div>
                    </div>
                @endif
            </div>
        </div>
    </td>

    <td>
        <div class="flex items-center justify-end gap-5">
            @if($history->status === 'completed')
                <div class="badge badge-success badge-soft gap-1 ">
                    <span class="size-2 rounded-full bg-success"></span>
                    <p class="text-xs font-semibold">Moved out</p>
                </div>
            @else
                <div class="badge badge-error badge-soft gap-1 ">
                    <span class="size-2 rounded-full bg-error"></span>
                    <p class="text-xs font-semibold">Cancelled</p>
                </div>
            @endif

            <div >
                @if($history->status === 'completed')
                    <p class="font-semibold -mb-1">Moved out {{$history->move_out_date->format('M d')}}</p>
                @else
                    <p class=" font-semibold -mb-1">Cancelled {{$history->cancelled_at->format('M d')}}</p>
                @endif

                <p class="text-xs font-semibold text-base-content/60">Notice issued {{$history->created_at->format('M d')}}</p>
            </div>
        </div>
    </td>
</tr>--}}

