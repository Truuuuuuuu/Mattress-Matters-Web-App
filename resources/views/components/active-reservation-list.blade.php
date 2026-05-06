@props(['activeReservation'])

<!-- row  -->
<tr>
    <td>
        <div class="flex items-center gap-3">
            <x-avatar-squircle :listing="$activeReservation->listing" width="12" height="12"/>

            <div>
                <a href="{{route('listings.show', $activeReservation->listing)}}">
                    <p class="font-bold text-primary hover:opacity-80 cursor-pointer line-clamp-1">{{$activeReservation->listing->title}}</p>
                </a>
                <p class="font-semibold text-sm text-base-content/70">₱{{ number_format($activeReservation->listing->rent_cost, 2) }}</p>
            </div>
        </div>
    </td>
    {{--Listing title--}}
    <td class="hidden md:table-cell font-semibold">
        {{$activeReservation->start_date->format('M d, Y')}}
    </td>
    {{--listing rent cost--}}
    <td class="hidden md:table-cell"> @if($activeReservation->status === 'pending')
            <div class="badge badge-warning badge-soft  gap-1 " >
                <span class="size-2 rounded-full bg-warning"></span>
                <p class="text-xs font-semibold">Pending</p>
            </div>
        @elseif($activeReservation->status === 'accepted' && $activeReservation->payment_status === 'unpaid')
            <div class="badge badge-success badge-soft  gap-1 " >
                <span class="size-2 rounded-full bg-success"></span>
                <p class="text-xs font-semibold">Confirmed</p>
            </div>

        @elseif($activeReservation->status === 'accepted' && $activeReservation->payment_status === 'paid')
            <div class="badge badge-success badge-soft  gap-1 " >
                <span class="size-2 rounded-full bg-success"></span>
                <p class="text-xs font-semibold">Confirmed</p>
            </div>
        @endif
    </td>

    <td>
        <a @click="$dispatch('view-reservation', { url: '{{ route('reservation.show', $activeReservation) }}' })" class="btn btn-primary btn-outline rounded-2xl px-3 btn-xs">details</a>
    </td>
</tr>

