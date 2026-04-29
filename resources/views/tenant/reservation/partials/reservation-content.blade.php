{{-- Cards View --}}
<div x-show="activeView === 'cards'" x-transition class="grid place-items-center mt-7" >
    @if($activeReservation)
        <x-active-reservation-card :$activeReservation />
    @else
        <div>
            <p class="text-base-content/70 text-center italic">You have no history of reservation</p>
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
                <th >Guest</th>
                <th class="hidden md:table-cell">Listing</th>
                <th class="hidden md:table-cell">Status</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @if($activeReservation)
                <x-active-reservation-card :$activeReservation />
            @else
                <div>
                    <p class="text-base-content/70 text-center italic">You have no history of reservation</p>
                </div>
            @endif
            </tbody>
        </table>
    </div>
</div>
