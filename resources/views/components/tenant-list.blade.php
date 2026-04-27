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
                <p class="font-bold">{{$myTenant->tenant->user->name}}</p>
                <p class="hidden md:block text-sm opacity-50">{{ucfirst($myTenant->tenant->gender)}}</p>
                <p class="md:hidden text-sm opacity-50 line-clamp-1">{{$myTenant->listing->title}}</p>
            </div>
        </div>
    </td>
    {{--Listing title--}}
    <td class="hidden md:table-cell">
        {{$myTenant->listing->title}}
    </td>
    {{--listing rent cost--}}
    <td class="hidden md:table-cell">₱{{number_format($myTenant->totalAmountDue(),2)}}</td>

    <td>
        <a @click="$dispatch('view-tenant', { url: '{{ route('host.tenants.show', $myTenant) }}' })" class="btn btn-primary btn-outline rounded-2xl px-3 btn-xs">details</a>
    </td>
</tr>

