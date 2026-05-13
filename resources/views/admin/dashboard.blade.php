<x-layout>

    <x-slot:heading>Admin Dashboard</x-slot:heading>
    <div class="mx-auto w-full max-w-7xl p-4 bg-primary/[4%]  min-h-[calc(100vh-5rem)] space-y-5 ">
        <div class="flex justify-between w-full  items-center">
            <div>
                <h1 class="text-primary text-5xl font-bold">System overview</h1>
                <p class="text-xs font-semibold text-base-content/70 mt-2">Monitor users, listings, and activity</p>
            </div>
            <div class="flex gap-2">
                <x-avatar-squircle :user="auth()->user()" :link="false"/>
                <div>
                    <p class="font-semibold">Admin</p>
                    <p class="text-xs text-base-content/70">{{ auth()->user()->email }}</p>
                </div>
            </div>
        </div>
        <div class="flex justify-between gap-3">
            <x-dashboard-top-card :count="$totalUsers" label="TOTAL USERS" icon="users"/>
            <x-dashboard-top-card :count="$totalActiveTenants" label="ACTIVE TENANTS" icon="user-round-key"/>
            <x-dashboard-top-card :count="$totalActiveListings" label="ACTIVE LISTINGS" icon="users"/>
        </div>
        <div class="flex w-full gap-5">
            <div class="flex-1 rounded-3xl p-5 bg-base-100 border border-white/20 shadow-xs">
                <h1 class="text-primary text-xl font-semibold">User Acquisition Trend</h1>
                <p class="text-xs font-semibold text-base-content/70">Hosts & Tenants over time</p>
                <div
                    id="userGrowthChart"
                    data-chart='@json($chartData)'></div>
            </div>

            <div class="flex flex-col justify-between w-sm rounded-3xl p-5 bg-base-100  backdrop-blur-lg
                    border border-white/20 shadow-xs">
                <h1 class="text-xl font-semibold text-primary">New Users</h1>
                <div >
                    @foreach ($recentUsers as $user)
                        <div class="flex items-center gap-3 py-2 ">
                            <x-avatar-squircle quircle :$user />
                            <div>
                                <p class="font-semibold text-sm">
                                    {{ $user->name }} <span class="text-base-content/70 font-normal capitalize">• {{ $user->getRoleNames()->first() }}</span>
                                </p>

                                <p class="text-xs text-base-content/60">
                                    {{ $user->email }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <a href="{{route('admin.manage.users')}}" class="w-full rounded-3xl btn btn-primary btn-outline">View all</a>
            </div>
        </div>

    </div>


</x-layout>
