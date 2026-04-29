{{--Tenant uses this!--}}

@props(['activeReservation'])

@php
    $cover = $activeReservation->listing->listingImages->first();
@endphp

<div class="flex flex-col rounded-3xl w-full max-w-xl p-5 gap-4 " style="box-shadow: 0 8px 32px rgba(37, 99, 235, 0.15)">

    <a href="{{ route('listings.show', $activeReservation->listing) }}"
       class="flex gap-4 items-center flex-1 min-w-0 ">
        <div class="w-24 h-24 shrink-0 hover:scale-104 hover:opacity-80">
            <img src="{{ asset('storage/' . $cover->image_path) }}"
                 alt=""
                 class="w-full h-full object-cover rounded-2xl">
        </div>

        <div class="min-w-0">
            @if($activeReservation->status === 'pending')
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

            <h1 class="text-lg text-primary font-semibold line-clamp-1 hover:opacity-70"
                title="{{ $activeReservation->listing->title }}">
                {{ $activeReservation->listing->title }}
            </h1>
            <div class="flex gap-3 items-center ">
                <p class="text-sm font-semibold text-base-content/70">₱{{ number_format($activeReservation->listing->rent_cost, 2) }}</p>
                <div class="w-px h-5 bg-gray-300 mx-1"></div>
                <div class="w-full flex items-center justify-start gap-3">
                    <x-lucide-calendar-1 class="w-4 h-4 text-primary"/>
                    <p class="text-sm font-semibold text-base-content/70">START DATE: {{$activeReservation->start_date->format('M d, Y')}}</p>
                </div>
            </div>
        </div>
    </a>

    <div class="w-full">
        @if($activeReservation->status === 'accepted' && $activeReservation->payment_status === 'unpaid')
            <div class="badge badge-warning badge-soft  gap-1 flex items-center w-full" >
                <x-lucide-info class="text-warning w-3 h-3"/>
                <p class="text-xs font-semibold"> Please complete your payment within 48 hours.</p>
            </div>

        @elseif($activeReservation->status === 'accepted' && $activeReservation->payment_status === 'paid')
            <div class="badge badge-success badge-soft  gap-1 flex items-center w-full" >
                <x-lucide-circle-check-big class="text-success w-3 h-3"/>
                <p class="text-xs font-semibold"> You're all set! Please check in upon arrival.</p>
            </div>
        @endif
    </div>

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
            <a href="{{route('messages.show', $activeReservation->listing->host)}}" class="btn btn-primary rounded-3xl btn-md flex-1">
                Message
            </a>
            <a @click="$dispatch('view-reservation', { url: '{{ route('reservation.show', $activeReservation) }}' })" class="btn btn-neutral btn-outline rounded-3xl flex-1 btn-md">
                View details
            </a>
        </div>
    @endif


</div>
