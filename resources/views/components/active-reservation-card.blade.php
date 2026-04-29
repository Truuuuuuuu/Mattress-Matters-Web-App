{{--Tenant uses this!--}}

@props(['activeReservation'])

@php
    $cover = $activeReservation->listing->listingImages->first();
@endphp

<div class="flex flex-col rounded-3xl w-full max-w-xl p-5 gap-4 " style="box-shadow: 0 8px 32px rgba(37, 99, 235, 0.15)">

    <a href="{{ route('listings.show', $activeReservation->listing) }}"
       class="flex gap-4 items-center flex-1 min-w-0 ">
        <div class="w-24 h-24 shrink-0">
            <img src="{{ asset('storage/' . $cover->image_path) }}"
                 alt=""
                 class="w-full h-full object-cover rounded-2xl">
        </div>

        <div class="min-w-0">
            @if($activeReservation->status === 'accepted' && $activeReservation->payment_status === 'unpaid')
                <div class=" w-full px-2 py-1 rounded-xl bg-orange-500">
                    <p class="text-xs italic text-base-content/80 "> Please complete your payment within 48 hours.</p>
                </div>

            @elseif($activeReservation->status === 'accepted' && $activeReservation->payment_status === 'paid')
                <div class=" w-full px-2 py-1 rounded-xl bg-green-500">
                    <p class="text-xs italic text-base-content/80 "> You're all set! Please check in upon arrival.</p>
                </div>
            @endif

            <h1 class="text-lg font-semibold line-clamp-1"
                title="{{ $activeReservation->listing->title }}">
                {{ $activeReservation->listing->title }}
            </h1>
            <p class="text-sm text-gray-500 -mt-1">₱{{ number_format($activeReservation->listing->rent_cost, 2) }}</p>
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
        class="btn btn-error btn-outline btn-sm w-full text-error-content rounded-3xl py-5 text-lg">
        Cancel Reservation
        </button>
        @include('components.confirm-modal')
    @elseif($activeReservation->status === 'accepted')
        <div class="flex gap-3">
            <a href="#" class="btn btn-primary rounded-3xl btn-md flex-1">
                Message
            </a>
            <a href="{{route('reservation.show', $activeReservation)}}" class="btn btn-neutral btn-outline rounded-3xl flex-1 btn-md">
                View details
            </a>
        </div>
    @endif


</div>
