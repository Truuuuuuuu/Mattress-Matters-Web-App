{{-- Cards View --}}
<div x-show="activeView === 'cards'" x-transition class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mt-7" >
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
                <th>Guest</th>
                <th>Listing</th>
                <th>Start Date</th>
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
