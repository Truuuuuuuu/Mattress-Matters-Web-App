<x-layout>
    <x-slot:heading>Reservation</x-slot:heading>


    <div class="flex items-start justify-center h-screen py-10 ">

        <div class="tabs tabs-lift   max-w-2xl w-full ">

            {{--pending tab--}}
            <label  class="tab w-42 ">

                    <x-lucide-dot class="w-7 h-7 text-orange-500"/>
                    <input type="radio" name="my_tabs_4" checked="checked"/>
                    Pending
            </label>
            <div class="tab-content bg-base-100 border-base-300 p-6">
                <div>
                    @forelse($pendingReservations as $pendingReservation)
                        <x-host-reservation-card :$pendingReservation />
                    @empty
                        <p class="text-base-content/70 italic text-center">You have no pending reservations today</p>
                    @endforelse
                </div>

            </div>

            {{--Approved tab--}}
            <label  class="tab w-42 ">

                <x-lucide-dot class="w-7 h-7 text-green-500"/>
                <input type="radio" name="my_tabs_4" />
                Approved
            </label>
            <div class="tab-content bg-base-100 border-base-300 p-6">
                <div>
                    @forelse($approvedReservations as $approvedReservation)
                        <x-host-reservation-card :$approvedReservation />
                    @empty
                        <p class="text-base-content/70 italic text-center">You have no approved reservations today</p>
                    @endforelse
                </div>

            </div>

            {{--History tab--}}
            <label class="tab w-42 gap-2">
                <x-lucide-history class="w-4 h-4 "/>

                <input type="radio" name="my_tabs_4"  />
                History
            </label>
            <div class="tab-content bg-base-100 border-base-300 p-6 space-y-3">

                    <div>
                        <p class="text-base-content/70 text-center italic">You have no history of reservation</p>
                    </div>
            </div>
        </div>

    </div>
</x-layout>
