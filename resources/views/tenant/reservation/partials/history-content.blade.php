{{-- Cards View --}}
<div x-show="activeView === 'cards'" x-transition class="grid md:grid-cols-2 xl:grid-cols-3 gap-4 mt-7" >
    @forelse($allReservations as $reservation)
        <x-history-reservation-card :$reservation />
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
                <th >Guest</th>
                <th class="hidden md:table-cell">Listing</th>
                <th class="hidden md:table-cell">Status</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @forelse($allReservations as $reservation)
                <x-history-reservation-card :$reservation />
            @empty
                <div>
                    <p class="text-base-content/70 text-center italic">You have no history of reservation</p>
                </div>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
