<div>
    <div class="flex gap-3 items-center mb-6">
        <div class="avatar">
            <div class="mask mask-squircle h-12 w-12 bg-purple-700 flex items-center justify-center">
                <p class="text-center text-xl font-bold text-white">
                    {{ $reservation->tenant->user->name[0] }}
                </p>
            </div>
        </div>
        <div>
            <h2 class="text-xl font-semibold">{{ $reservation->tenant->user->name }}</h2>
            <p class="text-sm text-base-content/60">{{ $reservation->listing->title }}</p>
        </div>
    </div>

    <div class="space-y-3">
        <div class="flex justify-between">
            <span class="text-sm font-medium text-base-content/60">Status</span>
            <span class="badge badge-primary">{{ ucfirst($reservation->status) }}</span>
        </div>
        <div class="flex justify-between">
            <span class="text-sm font-medium text-base-content/60">Check-in</span>
            <span class="text-sm font-semibold">{{ $reservation->start_date->format('M d, Y') }}</span>
        </div>
        {{-- Add the rest of your reservation fields here --}}
    </div>
</div>
