<x-layout>
    <x-slot:heading>Reservation</x-slot:heading>

    <div class="w-full max-w-7xl mx-auto px-5 py-7 bg-base-200">
        <div class="mb-5">
            <h1 class="text-4xl font-semibold">Reservations</h1>
            <p class="text-xs font-semibold ">Manage incoming requests and guest schedules</p>
        </div>
        <x-tabs :tabs="['pending', 'confirmed', 'history']" default="pending" :showViewToggle="true">

            <x-tab-panel name="pending">
                @include('host.reservations.partials.pending-content')
            </x-tab-panel>

            <x-tab-panel name="confirmed">
                @include('host.reservations.partials.confirmed-content')
            </x-tab-panel>

            <x-tab-panel name="cancelled">
                @include('host.reservations.partials.history-content')
            </x-tab-panel>

        </x-tabs>
    </div>

</x-layout>
