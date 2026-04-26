{{--Host uses this!--}}

@props(['pendingReservation' => null , 'acceptedReservation' => null])

@php
    $reservation = $pendingReservation ?? $acceptedReservation;
@endphp


<!-- row  -->
<tr>
    <td>
        <div class="flex items-center gap-3">
            <div class="avatar">
                <div class="mask mask-squircle h-12 w-12 bg-purple-700 flex items-center justify-center">
                    <p class="text-center text-xl font-bold">{{$reservation->tenant->user->name[0]}}</p>
                </div>
            </div>
            {{--Name--}}
            <div>
                <div class="font-bold">{{$reservation->tenant->user->name}}</div>
                <div class="flex justify-start items-center gap-2">
                    <p class="text-sm font-semibold text-base-content/70">{{$reservation->tenant->getGender()}}</p>
                    <div class="size-1 rounded-full bg-base-content/50"></div>
                    <p class="text-sm font-semibold text-base-content/70">{{$reservation->tenant->getOccupation()}}</p>
                </div>
            </div>
        </div>
    </td>
    {{--Listing title--}}
    <td>
        <p class="font-semibold text-primary/90">{{$reservation->listing->title}}</p>
    </td>
    <td>
        <p class="font-semibold text-base-content/80"> {{ $reservation->start_date->format('M d, Y') }}</p>
    </td>
    <td>
        <a @click="$dispatch('view-reservation', { url: '{{ route('reservation.show', $reservation) }}' })"  class="btn btn-primary rounded-2xl btn-xs btn-outline">
            {{$reservation->status === 'pending' ? 'Review Request' : 'View Details'}}
        </a>
    </td>
</tr>



