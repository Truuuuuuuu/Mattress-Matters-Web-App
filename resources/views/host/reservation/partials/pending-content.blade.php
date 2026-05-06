{{-- Cards View --}}
<div x-show="activeView === 'cards'" x-transition class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 mt-7" >
    @forelse($pendingReservations as $pendingReservation)
        <x-host-reservation-card :$pendingReservation />
    @empty
        <div class="col-span-full flex flex-col items-center justify-center py-16 text-base-content/70 italic space-y-5">
            <img src="{{asset('images/pending-reservation.svg')}}" alt="Reservation" class="w-24 lg:w-32">
            <p class="text-base-content/70 text-center italic">You have no pending reservations today</p>
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
                <th class="md:hidden">Reservation list</th>
                <th class="hidden md:table-cell">Guest</th>
                <th class="hidden md:table-cell">Listing</th>
                <th class="hidden md:table-cell">Start Date</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
                @forelse($pendingReservations as $pendingReservation)
                    <x-host-reservation-list :$pendingReservation />
                @empty
                    <tr>
                        <td colspan="4" class=" text-center py-16 text-base-content/70 italic">
                            <img src="{{asset('images/pending-reservation.svg')}}" alt="Empty record" class="w-24 lg:w-32 mx-auto mb-5">
                            <p>You have no pending reservations today</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
