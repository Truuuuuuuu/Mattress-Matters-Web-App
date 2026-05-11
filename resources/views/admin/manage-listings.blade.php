<x-layout>

    <x-slot:heading>Manage Listings</x-slot:heading>
    <div class="mx-auto w-full max-w-7xl p-4 bg-primary/[4%]  min-h-[calc(100vh-5rem)] space-y-5 ">
        <div class="w-full">
            <h1 class="text-primary text-5xl font-bold">Listing Management</h1>
            <p class="text-xs font-semibold text-base-content/70 mt-2">Oversee all property listings, including status, ownership, and visibility across the platform.</p>
        </div>
        <form method="GET" class="flex flex-col lg:flex-row gap-3 mb-4">

            {{-- Search --}}
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search title or address..."
                class="input input-bordered focus:input-primary w-full lg:max-w-xs rounded-2xl"
            />

            {{-- Status Filter --}}
            <select name="status" class="select select-bordered w-full max-w-32 rounded-2xl focus:select-primary">
                <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>All Status</option>
                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>


            <button class="btn btn-primary rounded-3xl w-24">
                Apply
            </button>

            {{-- Clear --}}
            <a href="{{ route('admin.manage.listings') }}" class="btn btn-ghost">
                Clear
            </a>

        </form>

        {{-- TABLE --}}
        <div class="overflow-x-auto">
            <table class="table table-sm w-full">

                <thead>
                <tr>
                    <th>Listing</th>
                    <th>Host</th>
                    <th>Status</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
                </thead>

                <tbody>
                @forelse ($listings as $listing)
                    <tr class="hover">

                        {{-- Listing --}}
                        <td class="flex gap-2 items-center">
                            <div>
                                <x-avatar-squircle :$listing/>
                            </div>
                            <div>
                                <div class="font-semibold text-md text-primary">
                                    {{ $listing->title }}
                                </div>
                                <div class="text-xs text-base-content/60">
                                    {{ $listing->address }}
                                </div>
                            </div>

                        </td>

                        {{-- Host --}}
                        <td class="text-sm">
                            {{ $listing->host->user->name ?? 'N/A' }}
                        </td>

                        {{-- Status --}}
                        <td>
                        <span class="badge badge-soft ronded-3xl {{ $listing->status === 'active' ? 'badge-success' : 'badge-ghost' }}">
                            {{ ucfirst($listing->status) }}
                        </span>
                        </td>

                        {{-- Date --}}
                        <td class="text-xs text-base-content/60">
                            {{ $listing->created_at->format('M d, Y') }}
                        </td>

                        <td class="flex gap-3">
                            <a href="#" class="btn btn-sm btn-error rounded-3xl">
                                <x-lucide-octagon-minus class="w-3 h-3"/> <span>Disable</span>
                            </a>
                            <a href="#" class="btn btn-sm btn-neutral rounded-3xl">
                                <x-lucide-eye class="w-3 h-3"/> <span>View Details</span>
                            </a>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-base-content/60 py-6">
                            No listings found.
                        </td>
                    </tr>
                @endforelse
                </tbody>

            </table>
        </div>

        <div class="mt-4">
            {{ $listings->links() }}
        </div>

    </div>


</x-layout>
