@props(['myTenant'])

<!-- row  -->
<tr>
    <td>
        <div class="flex items-center gap-3">
            <div class="avatar">
                <div class="mask mask-squircle h-12 w-12 bg-purple-700 flex items-center justify-center">
                    <p class="text-center text-xl font-bold">{{$myTenant->tenant->user->name[0]}}</p>
                </div>
            </div>
            {{--Name--}}
            <div>
                <div class="font-bold">{{$myTenant->tenant->user->name}}</div>
                <div class="text-sm opacity-50">{{ucfirst($myTenant->tenant->gender)}}</div>
            </div>
        </div>
    </td>
    {{--Listing title--}}
    <td>
        {{$myTenant->listing->title}}
    </td>
    {{--listing rent cost--}}
    <td>₱{{number_format($myTenant->totalAmountDue(),2)}}</td>

    <td>
        <a @click="$dispatch('view-tenant', { url: '{{ route('host.tenants.show', $myTenant) }}' })" class="btn btn-primary btn-outline rounded-2xl px-3 btn-xs">details</a>
    </td>
</tr>

