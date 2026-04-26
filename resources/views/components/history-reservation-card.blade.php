@props(['reservation' => null, 'historyReservation' => null])

@php
    $reservation = $historyReservation ?? $reservation;
    $cover = $reservation->listing->listingImages->first();
@endphp

<div class="border bg-base-100 border-base-300 rounded-3xl p-5 space-y-4 flex flex-col justify-between">
    <div class="flex ">
        <div class="flex-2 flex justify-start items-center gap-3 ">
            <div class="w-14 h-14 shrink-0">
                <img src="{{ asset('storage/' . $cover->image_path) }}"
                     alt=""
                     class="w-full h-full object-cover rounded-2xl">
            </div>
            <div>
                <p class="font-semibold text-md">
                    {{ Str::words($reservation->listing->title, 5, '...') }}
                </p>
                <p class="text-sm font-semibold text-base-content/70 -mt-1">Guest: {{$reservation->tenant->user->name}}</p>
            </div>
        </div>
        <div class="flex-1 flex justify-end items-start">
            @php
                $statusConfig = match($reservation->status) {
                    'declined'  => ['class' => 'badge-error',    'label' => 'Declined'],
                    'cancelled' => ['class' => 'badge-warning',  'label' => 'Cancelled'],
                    'checked_in' => ['class' => 'badge-primary', 'label' => 'Active'],
                    'completed' => ['class' => 'badge-neutral', 'label' => 'Move-out'],
                    default     => ['class' => 'badge-ghost',    'label' => ucfirst($reservation->status)],
                };
            @endphp
            <div class="badge badge-soft {{ $statusConfig['class'] }} mt-2 font-semibold rounded-2xl f">
                {{ $statusConfig['label'] }}
            </div>
        </div>
    </div>
    @if($reservation->status === 'checked_in')
        <div class="flex gap-2">
            <div class="flex flex-col">
                <p class="text-xs font-semibold text-base-content/70">CHECK-IN</p>
                <p class="text-sm font-semibold">{{$reservation->start_date->format('M d, Y')}}</p>
            </div>
            <div class="w-px h-8 bg-gray-300 mx-5 "></div>
            <div class="flex flex-col">
                <p class="text-xs font-semibold text-base-content/70">MOVED-OUT</p>
                <p class="text-sm font-semibold">N/A</p>
            </div>
        </div>
    @elseif($reservation->status === 'completed')
        <div class="flex gap-2">
            <div class="flex flex-col">
                <p class="text-xs font-semibold text-base-content/70">CHECK-IN</p>
                <p class="text-sm font-semibold">{{$reservation->start_date->format('M d, Y')}}</p>
            </div>
            <div class="w-px h-8 bg-gray-300 mx-5 "></div>
            <div class="flex flex-col">
                <p class="text-xs font-semibold text-base-content/70">MOVED-OUT</p>
                <p class="text-sm font-semibold">N/A</p>
            </div>
        </div>
    @elseif($reservation->status === 'cancelled')
        <div class="flex gap-2">
            <div class="flex flex-col">
                <p class="text-xs font-semibold text-base-content/70">CANCELLED AT</p>
                <p class="text-sm font-semibold">{{$reservation->updated_at->format('M d, Y')}}</p>
            </div>
        </div>
    @else
        <div class="flex gap-2">
        </div>
    @endif


    <a href="#" class="w-full btn btn-outline btn-primary rounded-2xl">
        <p class="text-primary font-semibold">VIEW DETAILS</p>
    </a>
</div>
