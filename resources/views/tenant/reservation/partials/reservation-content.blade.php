{{-- Cards View --}}
<div x-show="activeView === 'cards'" x-transition class="grid place-items-center mt-7" >
    @if($activeReservation)
        <x-active-reservation-card :$activeReservation />
    @else
        <div class="col-span-full flex flex-col items-center justify-center py-16 text-base-content/70 italic space-y-5">
            <img src="{{asset('images/active-reservation.svg')}}" alt="Reservation" class="w-32 lg:w-64">
            <p class="text-base-content/70 text-center italic">You don't have any active reservations right now</p>
        </div>
    @endif
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
            @if($activeReservation)
                <x-active-reservation-list :$activeReservation />
            @else
                <tr>
                    <td colspan="4" class=" text-center py-16 text-base-content/70 italic">
                        <img src="{{asset('images/active-reservation.svg')}}" alt="Empty record" class="w-24 lg:w-32 mx-auto mb-5">
                        <p>You don't have any active reservations right now</p>
                    </td>
                </tr>
            @endif

            </tbody>
        </table>
    </div>
</div>
