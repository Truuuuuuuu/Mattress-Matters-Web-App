{{--Tenant uses this!--}}

@props(['activeReservation'])


<div class="flex flex-col rounded-3xl w-full max-w-xl p-5 gap-4 "
     >

    <div class="flex gap-4 items-center flex-1 min-w-0 ">
        <x-avatar-squircle :listing="$activeReservation->listing" width="24" height="24"/>

        <div class="min-w-0">
            @if($activeReservation->status === 'pending')
                <div class="badge badge-warning badge-soft  gap-1 ">
                    <span class="size-2 rounded-full bg-warning"></span>
                    <p class="text-xs font-semibold">Pending</p>
                </div>
            @elseif($activeReservation->status === 'accepted' && $activeReservation->payment_status === 'unpaid')
                <div class="badge badge-success badge-soft  gap-1 ">
                    <span class="size-2 rounded-full bg-success"></span>
                    <p class="text-xs font-semibold">Confirmed</p>
                </div>

            @elseif($activeReservation->status === 'accepted' && $activeReservation->payment_status === 'paid')
                <div class="badge badge-success badge-soft  gap-1 ">
                    <span class="size-2 rounded-full bg-success"></span>
                    <p class="text-xs font-semibold">Confirmed</p>
                </div>
            @endif
            <a href="{{ route('listings.show', $activeReservation->listing) }}">
                <h1 class="text-lg text-primary font-semibold line-clamp-1 hover:opacity-70"
                    title="{{ $activeReservation->listing->title }}">
                    {{ $activeReservation->listing->title }}
                </h1>
            </a>

            <div class="flex gap-3 items-center ">
                <p class="text-sm font-semibold text-base-content/70">
                    ₱{{ number_format($activeReservation->listing->rent_cost, 2) }}</p>
                <div class="w-px h-5 bg-gray-300 mx-1"></div>
                <div class="w-full flex items-center justify-start gap-3">
                    <x-lucide-calendar-1 class="hidden sm:flex w-4 h-4 text-primary"/>
                    <p class="text-sm font-semibold text-base-content/70">
                        <span class="hidden sm:inline">START DATE:</span>
                        {{$activeReservation->start_date->format('M d, Y')}}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="w-full">
        @if($activeReservation->status === 'accepted' && $activeReservation->payment_status === 'unpaid')
            <div class="badge badge-warning badge-soft  gap-1 flex items-center w-full">
                <x-lucide-info class="text-warning w-3 h-3"/>
                <p class="text-xs font-semibold"> Please complete your payment within 48 hrs</p>
            </div>

        @elseif($activeReservation->status === 'accepted' && $activeReservation->payment_status === 'paid')
            <div class="badge badge-success badge-soft  gap-1 flex items-center w-full">
                <x-lucide-circle-check-big class="text-success w-3 h-3"/>
                <p class="text-xs font-semibold"> You're all set! Please check in upon arrival.</p>
            </div>
        @endif
    </div>
    <div class="flex gap-3  items-center">
        @if($activeReservation->status === 'pending')
            <div class="flex-1">
                <button onclick="confirmAction(
                '{{route('reservation.cancel', $activeReservation)}}',
                'Cancel Reservation?',
                'Are you sure you want to cancel this reservation? This cannot be undone.',
                'Yes, Cancel',
                'Keep Reservation',
                'bg-red-600'

            )"
                        class="btn bg-red-500  w-full text-base-100 hover:bg-red-600 rounded-3xl py-5 text-lg">
                    Cancel Reservation
                </button>
                @include('components.confirm-modal')</div>
        @elseif($activeReservation->status === 'accepted')
            <div class="flex gap-3 flex-1">
                <a href="{{route('messages.show', $activeReservation->listing->host)}}"
                   class="btn btn-primary rounded-3xl btn-md flex-1">
                    Message
                </a>
                @if($activeReservation->payment_status === 'unpaid')
                    <button

                        id="pay-btn"
                        class="btn btn-base-100 flex-1 py-3 btn-md rounded-3xl border-blue-900"
                        data-url="/payment/{{ $activeReservation->id}}/gcash"
                        data-amount="{{ $activeReservation->listing->rent_cost }}"
                        data-amount-electric="{{ $activeReservation->listing->electricity_cost ?? '' }}"
                        data-amount-water="{{ $activeReservation->listing->water_supply_cost ?? '' }}"
                        data-description="Reservation for {{ $activeReservation->listing->title }}">
                        <img src="{{asset('images/Gcash-logo.svg')}}" alt="" class="w-8 h-8">
                            <span class="sm:hidden">GCash</span>
                            <span class="hidden sm:inline">Pay with GCash</span>
                    </button>
                @endif

            </div>
            <div id="error-msg" class="hidden text-red-500 mt-2"></div>

        @endif


        <a @click="window.dispatchEvent(new CustomEvent('view-reservation', { detail: { url: '{{ route('reservation.show', $activeReservation) }}' } }))"
           class="flex justify-center items-center btn btn-circle btn-md bg-primary/10 hover:opacity-80">
            <x-lucide-info class="w-5 h-5 text-primary"/>
        </a>
    </div>


</div>
