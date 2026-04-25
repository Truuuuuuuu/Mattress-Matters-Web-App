<x-layout>
    <x-slot:heading>Listings</x-slot:heading>

    <div class="w-full max-w-7xl mx-auto  px-5 py-10">
        <div class="lg:px-12 xl:px-8">
            <div class="flex justify-between items-center ">
                <h1 class="text-3xl font-semibold">My Listings</h1>
                <a href="{{route('host.create')}}" class="btn btn-circle w-50 border border-black">
                    <div>
                        <x-lucide-plus class="w-6 h-6"/>
                    </div>
                    <span>Add Listing</span>
                </a>
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
</x-layout>
