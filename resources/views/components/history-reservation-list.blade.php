@props(['reservation' => null, 'historyReservation' => null])

@php
    $reservation = $historyReservation ?? $reservation;
@endphp

<!-- row  -->
<tr>
    <td>
        <div class="flex items-center gap-3">
            @if(auth()->user()->hasRole('host'))
                <x-avatar-squircle :user="$reservation->tenant->user"/>

                {{--Name--}}
                <div>
                    <div class="font-bold">{{$reservation->tenant->user->name}}</div>
                    <div class="flex justify-start items-center gap-2">
                        <p class="text-sm font-semibold text-base-content/70">{{$reservation->tenant->getGender()}}</p>
                        <div class="size-1 rounded-full bg-base-content/50"></div>
                        <p class="text-sm font-semibold text-base-content/70">{{$reservation->tenant->getOccupation()}}</p>
                    </div>
                </div>
            @else
                <x-avatar-squircle :listing="$reservation->listing" width="12" height="12"/>
                <div>
                    <a href="{{route('listings.show', $reservation->listing)}}">
                        <h1 class="text-md font-semibold text-primary line-clamp-1 hover:opacity-80">{{$reservation->listing->title}}</h1>
                    </a>
                    <p class="text-sm font-semibold text-base-content/70">Hosted by {{$reservation->listing->host->user->name}}</p>
                </div>
            @endif

        </div>
    </td>
    {{--Listing title--}}
    <td class="hidden md:table-cell">
        <p class="font-semibold text-base-content/70">{{$reservation->start_date->format('M d, Y')}}</p>
    </td>
    <td class="hidden md:table-cell">
        @php
            $statusConfig = match($reservation->status) {
                'declined'  => ['class' => 'badge-error',    'label' => 'Declined'],
                'cancelled' => ['class' => 'badge-warning',  'label' => 'Cancelled'],
                'checked_in' => ['class' => 'badge-primary', 'label' => 'Active'],
                'completed' => ['class' => 'badge-neutral', 'label' => 'Move-out'],
                default     => ['class' => 'badge-ghost',    'label' => ucfirst($reservation->status)],
            }
        @endphp
        <div class="badge badge-soft {{ $statusConfig['class'] }} mt-2 font-semibold rounded-2xl f">
            {{ $statusConfig['label'] }}
        </div>
    </td>
    <td>
            <a @click="$dispatch('view-reservation', { url: '{{ route('reservation.show', $reservation) }}' })" class="btn btn-primary rounded-2xl btn-xs btn-outline">
                {{$reservation->status === 'pending' ? 'Review Request' : 'Details'}}
            </a>
    </td>
</tr>
