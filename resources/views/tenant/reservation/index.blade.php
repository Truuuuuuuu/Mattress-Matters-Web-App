<x-layout>
    <x-slot:heading>Reservation</x-slot:heading>


    <div class="flex items-center justify-center h-screen">


        @if($reservations)
            <div>
                <h1>Yes</h1>
            </div>
        @else
            <div>
                <h1>No reservation yet</h1>
            </div>
        @endif
    </div>
</x-layout>
