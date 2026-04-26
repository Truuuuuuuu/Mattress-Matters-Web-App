{{-- Cards View --}}
<div x-show="activeView === 'cards'" x-transition class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mt-7" >
    @forelse($pendingReservations as $pendingReservation)
        <x-host-reservation-card :$pendingReservation />
    @empty
        <p class="col-span-full text-base-content/70  italic text-center">You have no pending reservations today</p>
    @endforelse
</div>


{{-- List View --}}
<div x-show="activeView === 'lists'" x-transition>
    <div class="overflow-x-auto">
        <table class="table">
            <!-- head -->
            <thead>
            <tr>
                <th>Guest</th>
                <th>Listing</th>
                <th>Start Date</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
                @forelse($pendingReservations as $pendingReservation)
                    <x-host-reservation-list :$pendingReservation />
                @empty
                    <p class="col-span-full text-base-content/70  italic text-center">You have no pending reservations today</p>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
