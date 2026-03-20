@props(['reservation' => null, 'historyReservation' => null])

@php
    $reservation = $historyReservation ?? $reservation;
    $cover = $reservation->listing->listingImages->first();
@endphp

<div class=" border rounded-3xl w-full p-2 gap-4 items-center pr-5">

    <div class="flex gap-5">
        <div class="w-24 h-24 shrink-0">
            <img src="{{ asset('storage/' . $cover->image_path) }}"
                 alt=""
                 class="w-full h-full object-cover rounded-2xl">
        </div>
        <div class=" flex flex-col justify-center">
            <div>
                <h1 class="text-lg font-semibold line-clamp-1"
                   title="{{ $reservation->listing->title }}">
                    {{ $reservation->listing->title }}
                </h1>
            </div>
            <p class="text-sm text-gray-500 -mt-1.5">₱{{ number_format($reservation->listing->rent_cost, 2) }}</p>
            @php
                if($reservation->status === 'cancelled' && $reservation->cancelled_by === 'host')
                     $statusConfig = ['class' => 'badge-warning', 'label' => 'Cancelled by Host'];
                elseif($reservation->status === 'cancelled' && $reservation->cancelled_by === 'tenant')
                     $statusConfig = ['class' => 'badge-warning', 'label' => 'Cancelled by User'];
                else
                    $statusConfig = match($reservation->status) {
                        'rejected'  => ['class' => 'badge-error',    'label' => 'Rejected'],
                        'cancelled' => ['class' => 'badge-warning',  'label' => 'Cancelled'],
                        'completed' => ['class' => 'badge-neutral', 'label' => 'Completed'],
                        default     => ['class' => 'badge-ghost',    'label' => ucfirst($reservation->status)],
                    };
            @endphp
            <div class="badge {{ $statusConfig['class'] }} mt-2">
                {{ $statusConfig['label'] }}
            </div>
        </div>
    </div>



</div>
