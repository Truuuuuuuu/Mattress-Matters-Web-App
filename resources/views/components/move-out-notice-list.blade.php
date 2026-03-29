@props(['movingOutTenant'])

<!-- row 1 -->
<tr>
    <td>
        <div class="flex items-center gap-3">
            <div class="avatar">
                <div class="mask mask-squircle h-12 w-12 bg-purple-700 flex items-center justify-center">
                    <p class="text-center text-xl font-bold">{{$movingOutTenant->tenant->user->name[0]}}</p>
                </div>
            </div>
            {{--Name--}}
            <div>
                <div class="font-bold -mb-1">{{$movingOutTenant->tenant->user->name}}</div>
                <div class="text-sm opacity-50">Since {{ $movingOutTenant->created_at->format('M Y') }}</div>
            </div>
        </div>
    </td>
    {{--M--}}
    <td>
        {{$movingOutTenant->listing->title}}
    </td>
    {{--notice filed--}}
    <td>{{ $movingOutTenant->moveOutNotice->created_at->format('M d, Y') }}</td>

    {{--Move out date--}}
    <td>{{ $movingOutTenant->moveOutNotice->move_out_date->format('M d, Y') }}</td>

    <td>
        <div class="badge badge-warning badge-soft gap-1 " >
            <span class="size-2 rounded-full bg-warning"></span>
            <p class="text-xs font-semibold">Moving out</p>
        </div>
    </td>
</tr>

