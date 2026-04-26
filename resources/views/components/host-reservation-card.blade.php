{{--Host uses this!--}}

@props(['pendingReservation' => null , 'acceptedReservation' => null])

@php
    $reservation = $pendingReservation ?? $acceptedReservation;
@endphp


<div class="border bg-base-100 border-base-300 rounded-3xl p-5">
    <div class="flex gap-3">
        <div class="avatar">
            <div class="mask mask-squircle h-12 w-12 bg-purple-700 flex items-center justify-center">
                <p class="text-center text-xl font-bold">{{$reservation->tenant->user->name[0]}}</p>
            </div>
        </div>
        <div>
            <h1 class="text-xl font-semibold">{{$reservation->tenant->user->name}}</h1>
            <div class="flex justify-start items-center gap-2">
                <p class="text-sm font-semibold text-base-content/70">{{$reservation->tenant->getGender()}}</p>
                <div class="size-1 rounded-full bg-base-content/50"></div>
                <p class="text-sm font-semibold text-base-content/70">{{$reservation->tenant->getOccupation()}}</p>
            </div>
        </div>
    </div>

    <div class="rounded-2xl flex justify-between my-5 bg-primary/10 py-2 px-3">
        <div class="flex-2  flex items-center">
            <p class="line-clamp-1 text-sm font-semibold text-primary" title="{{ $reservation->listing->title }}">{{ $reservation->listing->title }}</p>
        </div>
        <div class="flex-1  flex justify-end items-center text-base-content/70">
            <p class="text-sm font-semibold">{{ $reservation->start_date->format('M d') }}</p>
        </div>
    </div>

    @if($reservation->status === 'pending')
        <a href="{{route('reservation.show', $reservation)}}" class = "btn btn-outline btn-primary rounded-2xl w-full">
            REVIEW REQUEST
        </a>

    @else
        <a href="{{route('reservation.show', $reservation)}}" class = "btn btn-outline btn-primary rounded-2xl w-full">
            VIEW DETAILS
        </a>
    @endif

</div>


