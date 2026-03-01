<x-layout>
    <x-slot:heading>Listings</x-slot:heading>
    <section class="py-10">
        <div class="px-15 ">
            <div class="flex justify-between items-center ">
                <h1 class="text-3xl font-semibold">My Listing</h1>
                <a href="{{route('host.create')}}" class="btn btn-circle w-50 border border-black">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="lucide lucide-plus-icon lucide-plus">
                            <path d="M5 12h14"/>
                            <path d="M12 5v14"/>
                        </svg>
                    </div>
                    <span>Add Listing</span>
                </a>
            </div>

        </div>
    </section>
</x-layout>
