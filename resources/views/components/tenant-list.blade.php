@props(['myTenant'])

<!-- row  -->
<tr>
    <td>
        <div class="flex items-center gap-3">
            <x-avatar-squircle :user="$myTenant->tenant->user"/>
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

