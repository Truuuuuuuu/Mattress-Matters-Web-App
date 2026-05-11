<x-layout>
    <x-slot:heading>dashboard</x-slot:heading>

    <div class="w-full max-w-[1440px] mx-auto px-5 py-7 bg-primary/[4%]  min-h-[calc(100vh-5rem)]"
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
            <div class="flex mb-5  justify-between items-center">
                <div class="flex gap-3">
                    <x-avatar-squircle :user="auth()->user()" width="12" height="12"/>
                    <div>
                        <p class="text-xs md:text-sm text-base-content/70">{{auth()->user()->host->greetings()}}</p>
                        <p class="text-lg md:text-xl text-primary font-semibold">{{ auth()->user()->name }}</p>
                    </div>
                </div>
                <div class="px-5 py-5">

                </div>
            </div>

            <div>
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-5">
                    <x-dashboard-top-card :count="$active_listings" label="ACTIVE LISTINGS" icon="building"/>
                    <x-dashboard-top-card :count="$total_tenants" label="TOTAL TENANTS" icon="users"/>
                    <x-dashboard-top-card :count="$pending_reservations" label="PENDING RESERVATIONS"
                                               icon="clipboard-clock"/>
                    <x-dashboard-top-card :count="$move_out_notices" label="MOVE OUT NOTICES"
                                               icon="square-arrow-right-exit"/>
                </div>
            </div>
            <div class="flex flex-col-reverse lg:flex-row gap-4 mt-2">

                <div class="w-full">
                    <h1 class="text-xl text-primary font-semibold">Upcoming Check-ins</h1>
                    <div class="overflow-x-auto">
                        <table class="table">
                            <!-- head -->
                            <thead>
                            <tr>
                                <th>GUEST</th>
                                <th class="hidden lg:table-cell">LISTING</th>
                                <th class="hidden lg:table-cell">DATE</th>
                                <th class="hidden lg:table-cell">ACTION</th>
                            </tr>
                            </thead>
                            <tbody>

                            @forelse($reservations as $reservation)
                                <tr>
                                    <td>
                                        <div class="flex items-center gap-3 ">
                                            <x-avatar-squircle :user="$reservation->tenant->user"/>

                                            <div>
                                                <div class="font-bold">{{$reservation->tenant->user->name}}</div>
                                                <div
                                                    class="text-sm opacity-50">{{$reservation->tenant->getGender()}}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="font-semibold hidden md:table-cell">
                                        {{$reservation->listing->title}}
                                    </td>
                                    <td class="font-semibold hidden md:table-cell">{{$reservation->start_date->format('M d')}}</td>
                                    <th>
                                        <a @click="$dispatch('view-reservation', { url: '{{ route('reservation.show', $reservation) }}' })"
                                           class="btn btn-outline btn-primary btn-sm px-3 rounded-2xl">details</a>
                                    </th>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-base-content/70">None at the moment.</td>
                                </tr>

                            @endforelse

                            </tbody>
                            <!-- foot -->
                            <tfoot>
                            </tfoot>
                        </table>
                        {{ $reservations->links() }}
                    </div>
                </div>
                <div class="flex justify-center items-start w-full lg:w-112 ">
                    <x-card-hover-3d :$monthly_revenue/>
                </div>
            </div>

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

            <div x-show="!loading" x-html="content"></div>

        </div>
    </div>
</x-layout>

