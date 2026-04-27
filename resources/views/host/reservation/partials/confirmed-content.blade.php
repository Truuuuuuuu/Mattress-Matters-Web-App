{{-- Cards View --}}
<div x-show="activeView === 'cards'" x-transition class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 mt-7" >
    @forelse($acceptedReservations as $acceptedReservation)
        <x-host-reservation-card :$acceptedReservation />
    @empty
        <p class="text-base-content/70 italic text-center">You have no accepted reservations today</p>
    @endforelse
</div>


{{-- List View --}}
<div x-show="activeView === 'lists'" x-transition>
    <div class="overflow-x-auto">
        <table class="table">
            <!-- head -->
            <thead>
            <tr>
                <th class="md:hidden">Reservation list</th>
                <th class="hidden md:table-cell">Guest</th>
                <th class="hidden md:table-cell">Listing</th>
                <th class="hidden md:table-cell">Start Date</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @forelse($acceptedReservations as $acceptedReservation)
                <x-host-reservation-list :$acceptedReservation />
            @empty
                <p class="text-base-content/70 italic text-center">You have no accepted reservations today</p>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
