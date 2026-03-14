<x-layout>
    <x-slot:heading>Listings</x-slot:heading>
    <section class="py-10">
        <div class="px-15 ">
            <div class="flex justify-between items-center ">
                <h1 class="text-3xl font-semibold">My Listings</h1>
                <a href="{{route('host.create')}}" class="btn btn-circle w-50 border border-black">
                    <div>
                        <x-lucide-plus class="w-6 h-6" />
                    </div>
                    <span>Add Listing</span>
                </a>
            </div>
        </div>

        <div class="grid place-items-center mt-20   ">
            <div class="w-full lg:max-w-6xl  grid grid-cols-3 gap-10">
                @forelse($listings as $listing)

                    <x-bhouse-card :$listing  />
                @empty
                    <p class="col-span-full text-center text-gray-500">
                        No listings available.
                    </p>
                @endforelse
            </div>

        </div>
    </section>
</x-layout>
