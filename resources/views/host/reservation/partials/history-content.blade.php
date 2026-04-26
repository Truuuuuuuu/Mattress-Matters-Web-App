{{-- Cards View --}}
<div x-show="activeView === 'cards'" x-transition class="grid grid-cols-2 md:grid-cols-3  gap-4 mt-7" >
    @forelse($historyReservations as $historyReservation)
        <x-history-reservation-card :$historyReservation/>
    @empty
        <div>
            <p class="text-base-content/70 text-center italic">You have no history of reservation</p>
        </div>
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
                <th>Status</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
                @forelse($historyReservations as $historyReservation)
                    <x-history-reservation-list :$historyReservation/>
                @empty
                    <div>
                        <p class="text-base-content/70 text-center italic">You have no history of reservation</p>
                    </div>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
