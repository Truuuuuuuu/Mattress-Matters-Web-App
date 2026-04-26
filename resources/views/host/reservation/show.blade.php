<x-layout>
    <x-slot:heading>Reservation Details</x-slot:heading>

    <div class="w-full max-w-3xl mx-auto px-5 py-7">

        {{-- Mobile back button --}}
        <a href="{{ route('reservation.index') }}"
           class="inline-flex items-center gap-2 text-sm text-primary mb-5 md:hidden">
            ← Back to Reservations
        </a>

        @include('host.reservation.partials.show-content')

    </div>

</x-layout>
