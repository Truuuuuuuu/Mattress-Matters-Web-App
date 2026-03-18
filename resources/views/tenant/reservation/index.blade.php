    <x-layout>
        <x-slot:heading>Reservation</x-slot:heading>


        <div class="flex items-start justify-center h-screen py-10 ">

                <div class="tabs tabs-lift   max-w-2xl w-full ">
                    <label  class="tab w-42 ">
                        <x-lucide-dot class="w-7 h-7 text-orange-500"/>
                        <input type="radio" name="my_tabs_4" checked="checked"/>
                        Pending
                    </label>
                    <div class="tab-content bg-base-100 border-base-300 p-6">
                        @if($pendingReservation)
                            <div>
                                <x-pending-reservation-card :$pendingReservation />
                            </div>
                        @else
                            <div>
                                <p class="text-base-content/70 text-center italic">You have no pending reservation</p>
                            </div>
                        @endif

                    </div>

                    <label class="tab w-42 gap-2">
                        <x-lucide-history class="w-4 h-4 "/>

                        <input type="radio" name="my_tabs_4"  />
                        History
                    </label>
                    <div class="tab-content bg-base-100 border-base-300 p-6 space-y-3">
                        @forelse($allReservations as $reservation)

                            <div>
                                <x-history-reservation-card :$reservation />
                            </div>
                        @empty
                            <div>
                                <p class="text-base-content/70 text-center italic">You have history of reservation</p>
                            </div>
                        @endforelse
                    </div>
                </div>

        </div>
    </x-layout>
