@props(['activeReservation'])

@php
    $cover = $activeReservation->listing->listingImages->first();
@endphp

<div class="flex border rounded-3xl w-full p-2 gap-4 items-end pr-5">

    <a href="{{ route('listings.show', $activeReservation->listing) }}"
       class="flex gap-4 items-center flex-1 min-w-0 ">
        <div class="w-24 h-24 shrink-0">
            <img src="{{ asset('storage/' . $cover->image_path) }}"
                 alt=""
                 class="w-full h-full object-cover rounded-2xl">
        </div>
        <div class="min-w-0">
            <h1 class="text-lg font-semibold line-clamp-1"
                title="{{ $activeReservation->listing->title }}">
                {{ $activeReservation->listing->title }}
            </h1>
            <p class="text-sm text-gray-500">₱{{ number_format($activeReservation->listing->rent_cost, 2) }}</p>
        </div>
    </a>

    @if($activeReservation->status === 'pending')
        <button onclick="confirmAction(
            '{{route('reservation.cancel', $activeReservation)}}',
            'Cancel Reservation?',
            'Are you sure you want to cancel this reservation? This cannot be undone.',
            'Yes, Cancel',
            'Keep Reservation'

        )"
        class="btn btn-error btn-sm shrink-0 w-24">
        Cancel
        </button>
        @include('components.confirm-modal')
    @elseif($activeReservation->status === 'approved')
        <a href="#" class="btn btn-primary btn-sm shrink-0 w-24">
            Message
        </a>

    @endif


</div>
