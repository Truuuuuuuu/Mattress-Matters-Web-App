<x-layout>
    <x-slot:heading>dashboard</x-slot:heading>

    <div class="w-full max-w-7xl px-5 py-5 space-y-5 mx-auto bg-base-200 min-h-[calc(100vh-5rem)]">
        <div>
            <h1 class="text-2xl md:text-3xl text-primary font-bold">Welcome back, {{auth()->user()->first_name}}</h1>
            <p class="text-xs md:text-sm font-semibold text-base-content/70">Here’s an overview of your activity today</p>
        </div>

        <div>
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-5">
                <x-host-dashboard-top-card :count="$active_listings" label="ACTIVE LISTINGS" icon="building" />
                <x-host-dashboard-top-card :count="$total_tenants" label="TOTAL TENANTS" icon="users" />
                <x-host-dashboard-top-card :count="$pending_reservations" label="PENDING RESERVATIONS" icon="clipboard-clock" />
                <x-host-dashboard-top-card :count="$move_out_notices" label="MOVE OUT NOTICES" icon="square-arrow-right-exit"  />
            </div>
        </div>
        <div class="flex flex-col-reverse lg:flex-row gap-4">

            <div class="w-full">
                <h1 class="text-xl text-primary font-semibold">Upcoming Check-ins</h1>
                <div class="overflow-x-auto">
                    <table class="table">
                        <!-- head -->
                        <thead>
                        <tr>
                            <th>GUEST</th>
                            <th class="hidden lg:table-cell">LISTING</th>
                            <th class="hidden lg:table-cell">DATE</th>
                            <th class="hidden lg:table-cell">ACTION</th>
                        </tr>
                        </thead>
                        <tbody>

                        @forelse($reservations as $reservation)
                            <tr>
                                <td>
                                    <div class="flex items-center gap-3">
                                        <div class="avatar">
                                            <div class="mask mask-squircle h-12 w-12 bg-purple-700 flex items-center justify-center">
                                                <p class="text-center text-xl font-bold">{{$reservation->tenant->user->name[0]}}</p>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="font-bold">{{$reservation->tenant->user->name}}</div>
                                            <div class="text-sm opacity-50">{{$reservation->tenant->getGender()}}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="font-semibold hidden md:table-cell">
                                    {{$reservation->listing->title}}
                                </td>
                                <td class="font-semibold hidden md:table-cell">{{$reservation->start_date->format('M d')}}</td>
                                <th >
                                    <a href="{{route('reservation.show', $reservation)}}"  class="btn btn-outline btn-primary btn-sm px-3 rounded-2xl">details</a>
                                </th>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-base-content/70">None at the moment.</td>
                            </tr>

                        @endforelse

                        </tbody>
                        <!-- foot -->
                        <tfoot>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="flex justify-center items-center w-full lg:w-112 ">
                <x-card-hover-3d/>
            </div>
        </div>
    </div>
</x-layout>

