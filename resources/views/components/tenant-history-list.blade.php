@props(['history'])

<!-- row 1 -->
<tr>
    <td>
        <div class="flex items-center gap-3">
            <div class="avatar">
                <div class="mask mask-squircle h-12 w-12 bg-purple-700 flex items-center justify-center">
                    <p class="text-center text-xl font-bold">{{$history->tenant->user->name[0]}}</p>
                </div>
            </div>
            {{--Tenant--}}
            <div>
                <div class="font-bold -mb-1">{{$history->tenant->user->name}}</div>

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
        <div class="flex items-center justify-start gap-5">
            <p>{{$history->listing->title}}</p>

        </div>
    </td>
    <td>
        <div class="flex items-center justify-start gap-5">
            <p>{{$history->lease_start_date->format('M, Y') }} - {{$history->updated_at->format('M, Y')}}</p>

        </div>
    </td>
    <td>
        <a href="{{route('host.tenants.show', $history->tenant)}}" class="btn btn-ghost btn-xs">details</a>
    </td>
</tr>

