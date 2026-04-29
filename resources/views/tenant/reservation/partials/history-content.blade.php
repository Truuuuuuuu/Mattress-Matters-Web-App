{{-- Cards View --}}
<div x-show="activeView === 'cards'" x-transition class="grid md:grid-cols-2 xl:grid-cols-3 gap-4 mt-7" >
    @forelse($allReservations as $reservation)
        <x-history-reservation-card :$reservation />
    @empty
        <div class="col-span-full flex flex-col items-center justify-center py-16 text-base-content/70 italic">
            <p>You have no history of reservation</p>
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
                <th >Listing</th>
                <th class="hidden md:table-cell">Start Date</th>
                <th class="hidden md:table-cell">Status</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @forelse($allReservations as $reservation)
                <x-history-reservation-list :$reservation />
            @empty
                <tr>
                    <td colspan="4" class="text-center py-16 text-base-content/70 italic">
                        You have no history of reservation
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

</div>
