<x-layout>
    <x-slot:heading>dashboard</x-slot:heading>

    <div class="w-full max-w-7xl px-5 py-5 space-y-5">
        <div>
            <h1 class="text-3xl font-bold">Welcome back, {{auth()->user()->first_name}}</h1>
            <p class="text-sm font-semibold text-base-content/70">Here’s an overview of your activity today</p>
        </div>

        <div>
            <div class="grid grid-cols-4 gap-5">
                <x-host-dashboard-top-card :count="$active_listings" label="Active Listings" icon="building"/>
                <x-host-dashboard-top-card :count="$total_tenants" label="Total Tenants" icon="users"/>
                <x-host-dashboard-top-card :count="$pending_reservations" label="Pending Reservations" icon="clipboard-clock"/>
                <x-host-dashboard-top-card :count="$move_out_notices" label="Move out notices" icon="square-arrow-right-exit"/>
            </div>
        </div>
        <div class="grid grid-cols-[2fr_1fr] gap-8">

            <div>
                <h1 class="text-xl font-semibold">Upcoming Check-ins</h1>
                <div class="border rounded-2xl p-3">
                    table here
                </div>
            </div>
            <div >
                <h1 class="text-xl font-semibold">Earnings</h1>
                <div class="border rounded-2xl p-3">
                    card here
                </div>
            </div>
        </div>
    </div>
</x-layout>

