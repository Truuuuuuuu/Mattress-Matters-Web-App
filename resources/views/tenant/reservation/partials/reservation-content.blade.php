{{-- Cards View --}}
<div x-show="activeView === 'cards'" x-transition class="grid place-items-center mt-7" >
    @if($activeReservation)
        <x-active-reservation-card :$activeReservation />
    @else
        <div>
            <p class="text-base-content/70 text-center italic">You don't have any active reservations right now.</p>
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
                    <td colspan="4" class="text-center py-16 text-base-content/70 italic">
                        You don't have any active reservations right now.
                    </td>
                </tr>
            @endif

            </tbody>
        </table>
    </div>
</div>
