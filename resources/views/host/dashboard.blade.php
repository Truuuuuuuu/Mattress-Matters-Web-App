<x-layout>
    <x-slot:heading>dashboard</x-slot:heading>

    <div class="w-full max-w-7xl px-5 py-5 space-y-5">
        <div>
            <h1 class="text-3xl font-bold">Welcome back, {{auth()->user()->first_name}}</h1>
            <p class="text-sm font-semibold text-base-content/70">Here’s an overview of your activity today</p>
        </div>

        <div>
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-5">
                <x-host-dashboard-top-card :count="$active_listings" label="Active Listings" icon="building"/>
                <x-host-dashboard-top-card :count="$total_tenants" label="Total Tenants" icon="users"/>
                <x-host-dashboard-top-card :count="$pending_reservations" label="Pending Reservations" icon="clipboard-clock"/>
                <x-host-dashboard-top-card :count="$move_out_notices" label="Move out notices" icon="square-arrow-right-exit"/>
            </div>
        </div>
        <div class="grid lg:grid-cols-[2fr_1fr] gap-8">

            <div>
                <h1 class="text-xl font-semibold">Upcoming Check-ins</h1>
                <div class="overflow-x-auto">
                    <table class="table">
                        <!-- head -->
                        <thead>
                        <tr>
                            <th>GUEST</th>
                            <th>LISTING</th>
                            <th>DATE</th>
                            <th>ACTION</th>
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
                                <td class="font-semibold">
                                    {{$reservation->listing->title}}
                                </td>
                                <td class="font-semibold ">{{$reservation->start_date->format('M d')}}</td>
                                <th>
                                    <a href="{{route('reservation.show', $reservation)}}"  class="btn btn-ghost btn-xs">details</a>
                                </th>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">None at the moment.</td>
                            </tr>

                        @endforelse

                        </tbody>
                        <!-- foot -->
                        <tfoot>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div>
                <h1 class="text-xl font-semibold">Earnings</h1>
                <div class="border rounded-2xl p-8">
                    <div>
                        <h1 class="text-3xl font-semibold">₱10,000</h1>
                        <p class="text-sm font-semibold text-base-content/70">Monthly Revenue</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>

