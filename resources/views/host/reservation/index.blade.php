<x-layout>
    <x-slot:heading>Reservation</x-slot:heading>

    <div class="w-full max-w-7xl mx-auto px-5 py-7 bg-base-200"
         x-data="{
             open: false,
             loading: false,
             content: '',

             async viewReservation(url) {
                 if (window.innerWidth < 768) {
                     window.location.href = url;
                     return;
                 }
                 this.open = true;
                 this.loading = true;
                 this.content = '';
                 const res = await fetch(url, {
                     headers: { 'X-Modal-Request': 'true' }
                 });
                 this.content = await res.text();
                 this.loading = false;
             },

             close() {
                 this.open = false;
                 this.content = '';
             }
         }"
         @view-reservation.window="viewReservation($event.detail.url)"
         @keydown.escape.window="close()">

        <div class="mb-5">
            <h1 class="text-4xl font-semibold text-primary">Reservations</h1>
            <p class="text-xs font-semibold ">Manage incoming requests and guest schedules</p>
        </div>
        <x-tabs :tabs="['pending', 'confirmed', 'history']" default="pending" :showViewToggle="true">

            <x-tab-panel name="pending">
                @include('host.reservation.partials.pending-content')
            </x-tab-panel>

            <x-tab-panel name="confirmed">
                @include('host.reservation.partials.confirmed-content')
            </x-tab-panel>

            <x-tab-panel name="history">
                @include('host.reservation.partials.history-content')
            </x-tab-panel>

        </x-tabs>

        {{-- Backdrop --}}
        <div x-show="open"
             x-transition.opacity
             @click="close()"
             class="fixed inset-0 bg-black/50 z-40 hidden md:block">
        </div>
        {{-- Modal --}}
        <div x-show="open"
             x-cloak
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             class="fixed z-50 hidden md:block
                    top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2
                    w-full max-w-2xl max-h-[90vh] overflow-y-auto
                    bg-base-100 rounded-3xl shadow-2xl">

            <div class="flex items-center justify-between p-5 border-b border-base-300 sticky top-0 bg-base-100 z-10">
                <h3 class="font-semibold text-lg text-primary">Reservation Details</h3>
                <button @click="close()" class="btn btn-sm btn-ghost btn-circle">✕</button>
            </div>

            <div x-show="loading" class="flex justify-center items-center py-16 text-base-content/50">
                <svg class="animate-spin h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"/>
                </svg>
                Loading...
            </div>

            <div x-show="!loading" x-html="content" class="p-6"></div>

        </div>
    </div>

</x-layout>
