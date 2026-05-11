<x-layout>

    <x-slot:heading>All users</x-slot:heading>
    <div class="mx-auto w-full max-w-7xl p-4 bg-primary/[4%]  min-h-[calc(100vh-5rem)] space-y-5 "> <div class="w-full">
            <h1 class="text-primary text-5xl font-bold">User Management</h1>
            <p class="text-xs font-semibold text-base-content/70 mt-2">Manage and monitor all registered hosts and tenants, including roles, access, and account details.</p>
        </div>

        <form method="GET" class="flex flex-col lg:flex-row gap-3 mb-4">

            {{-- Search --}}
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search name or email..."
                class="input input-bordered w-full lg:max-w-xs rounded-2xl focus:input-primary"
            />

            {{-- Role Filter --}}
            <select name="role" class="select select-bordered w-full max-w-32 rounded-2xl">
                <option value="all" {{ request('role') == 'all' ? 'selected' : '' }}>All Users</option>
                <option value="host" {{ request('role') == 'host' ? 'selected' : '' }}>Host</option>
                <option value="tenant" {{ request('role') == 'tenant' ? 'selected' : '' }}>Tenant</option>
            </select>


            <button class="btn btn-primary rounded-3xl w-24">
                Apply
            </button>


            {{-- Clear Button --}}
            <a href="{{ route('admin.manage.users') }}" class="btn btn-ghost">
                Clear
            </a>

        </form>

        <div class="overflow-x-auto">
            <table class="table table-sm w-full">

                <thead>
                <tr>
                    <th>User</th>
                    <th>Role</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
                </thead>

                <tbody>
                @forelse ($allUsers as $user)
                    <tr class="hover">
                        <td class="flex items-center gap-3">
                            <x-avatar-squircle :$user />
                            <span class="font-semibold text-sm">
                            {{ $user->name }}
                        </span>
                        </td>

                        <td class="capitalize text-base-content/70">
                            {{ $user->getRoleNames()->first() }}
                        </td>

                        <td class="text-xs text-base-content/60">
                            {{ $user->email }}
                        </td>

                        <td class="flex gap-3">
                            <a href="{{route('profile.show', $user)}}" class="btn btn-sm btn-error rounded-3xl">
                                <x-lucide-ban class="w-3 h-3"/> <span>Ban</span>
                            </a>
                            <a href="{{route('profile.show', $user)}}" class="btn btn-sm btn-warning rounded-3xl">
                                <x-lucide-triangle-alert class="w-3 h-3"/> <span>Restrict</span>
                            </a>
                            <a href="{{route('profile.show', $user)}}" class="btn btn-sm btn-neutral rounded-3xl">
                                <x-lucide-cog class="w-3 h-3"/> <span>Modify</span>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center text-base-content/60 py-6">
                            No users found.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $allUsers->links() }}
        </div>
    </div>


</x-layout>
