@props(['reservation' => null, 'historyReservation' => null])

@php
    $reservation = $historyReservation ?? $reservation;
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
        @if($reservation->status === 'pending')
            <a href="{{route('reservation.show', $reservation)}}"  class="btn btn-primary rounded-2xl btn-xs btn-outline">Review Request</a>


        @else
            <a href="{{route('reservation.show', $reservation)}}"  class="btn btn-primary rounded-2xl btn-xs btn-outline">View Details</a>

        @endif
    </td>
</tr>
