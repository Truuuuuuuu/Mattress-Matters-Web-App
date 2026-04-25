<x-layout>
    <x-slot:heading>Listings</x-slot:heading>

    <div class="w-full max-w-7xl mx-auto  px-5 py-10">
        <div class="lg:px-12 xl:px-8">
            <div class="flex justify-between items-center ">
                <h1 class="text-3xl font-semibold">My Listings</h1>
                <a href="{{route('host.create')}}" class="hidden sm:flex btn btn-circle w-50 border border-black">
                    <div>
                        <x-lucide-plus class="w-6 h-6"/>
                    </div>
                    <span>Add Listing</span>
                </a>
            </div>
        </div>
        <div class="flex flex-col md:flex-row gap-2 lg:px-12 xl:px-8 py-5 justify-between">
            <div class="flex w-full gap-2">
                <div class="border w-full rounded-2xl p-5">
                    <p class="text-sm font-semibold text-base-content/70">Active Listings</p>
                    <h1 class="text-4xl font-semibold">{{$active_listings}}</h1>
                </div>
                <div class="border w-full rounded-2xl p-5">
                    <p class="text-sm font-semibold text-base-content/70">Active Tenants</p>
                    <h1 class="text-4xl font-semibold">{{$total_tenants}}</h1>
                </div>
            </div>
            <div class="border w-full rounded-2xl p-5">
                <p class="text-sm font-semibold text-base-content/70">Total Earnings</p>
                <h1 class="text-4xl font-semibold">₱30,000</h1>
            </div>
        </div>

        <div class=" space-y-3 grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-x-2 gap-y-1 lg:gap-x-2 lg:gap-y-6 mt-5 place-self-center">
                @forelse($listings as $listing)
                    <x-bhouse-card :$listing />
                @empty
                    <p class="col-span-full text-center text-gray-500">
                        No listings available.
                    </p>
                @endforelse
        </div>
    </div>

    {{-- FAB: visible only on mobile --}}
    <a href="{{ route('host.create') }}"
       class="sm:hidden fixed bottom-24 right-6 z-50 btn btn-circle w-20 h-20 shadow-lg bg-black text-white border-none">
        <x-lucide-plus class="w-12 h-12"/>
    </a>
</x-layout>
