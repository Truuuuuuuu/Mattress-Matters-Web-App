{{-- Cards View --}}
<div x-show="activeView === 'cards'" x-transition class="grid md:grid-cols-2 xl:grid-cols-3 gap-4 mt-7" >
    @forelse($historyReservations as $historyReservation)
        <x-history-reservation-card :$historyReservation/>
    @empty
        <div class="col-span-full  flex flex-col  items-center justify-center py-16 text-base-content/70 italic space-y-5">
            <img src="{{asset('images/empty-record.svg')}}" alt="Reservation" class="w-24 lg:w-32">
            <p class="text-base-content/70 text-center italic">No reservation history yet</p>
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
                @forelse($historyReservations as $historyReservation)
                    <x-history-reservation-list :$historyReservation/>
                @empty
                    <tr>
                        <td colspan="4" class=" text-center py-16 text-base-content/70 italic">
                            <img src="{{asset('images/empty-record.svg')}}" alt="Empty record" class="w-24 lg:w-32 mx-auto mb-5">
                            <p>No reservation history yet</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
{{ $historyReservations->links()  }}
