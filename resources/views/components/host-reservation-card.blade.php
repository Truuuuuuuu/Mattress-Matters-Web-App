{{--Host uses this!--}}

@props(['pendingReservation' => null , 'acceptedReservation' => null])

@php
    $reservation = $pendingReservation ?? $acceptedReservation;
@endphp




<div class="flex border rounded-3xl w-full p-2 gap-4 items-end pr-5">

    <a href="{{ route('listings.show', $reservation->listing) }}"
       class="flex gap-4 items-center flex-1 min-w-0 ">
        <div class="w-24 h-24 shrink-0 border bg-purple-700 rounded-xl flex justify-center items-center">
            <h1 class="text-3xl font-bold text-white"> {{$reservation->tenant->user->name[0]}}</h1>
        </div>
        <div class="min-w-0 w-full ">
            <p class="text-md font-regular line-clamp-1 italic"
               title="{{ $reservation->listing->title}}">
                {{ $reservation->listing->title }}
            </p>
            <h1 class="text-lg font-semibold line-clamp-1"
                title="{{ $reservation->tenant->user->name }}">
                {{ $reservation->tenant->user->name }}
            </h1>
            <div class="flex gap-2 items-center">
                <x-icon :name="'lucide-' . ($reservation->tenant->gender === 'male' ? 'mars' : 'venus')"
                        class="h-5 w-5 text-{{$reservation->tenant->gender === 'male' ? 'blue' : 'pink'}}-900"/>
                <x-icon :name="'lucide-' . ($reservation->tenant->occupation === 'student' ? 'graduation_cap' : 'briefcase-business')"
                        class="h-5 w-5"/>
            </div>
        </div>
    </a>

   {{-- @if($reservation->status === 'pending')
        <button onclick="confirmAction(
            '{{route('reservation.reject', $reservation)}}',
            'Reject Reservation?',
            'Are you sure you want to reject this reservation? This cannot be undone.',
            'Yes, Reject',
            'Cancel'

        )"
        class="btn btn-error btn-sm shrink-0 w-24">
        Reject
        </button>

    @endif--}}
    @if($reservation->status === 'pending')
        <a href="{{route('reservation.show', $reservation)}}" class = "btn btn-primary">
            Review
        </a>

    @else
        <a href="{{route('reservation.show', $reservation)}}" class = "btn btn-primary">
            View
        </a>
    @endif


</div>
