<x-layout>
    <x-slot:heading>All Listings</x-slot:heading>

    <div class="px-10 mt-10">
        {{--Content--}}
        @guest
            <div class="mb-8">
                <a onclick="history.back()" class=" flex gap-1 items-center cursor-pointer group w-18 ">
                    <x-lucide-chevron-left class="w-7 h-7 group-hover:text-blue-800"/>
                    <p class="group-hover:text-blue-800">Back</p>
                </a>
            </div>
        @endguest

        <section>
            <div>
                {{--search bar w filter--}}
                <div class=" flex justify-center items-center gap-5 ">
                    <div class="w-lg">
                        <x-search-bar class=""/>
                    </div>
                    <div>
                        <button class="flex btn btn-neutral rounded-3xl " onclick="feature_modal.showModal()">
                            <x-lucide-sliders-horizontal class="w-5 h-5"/>
                            <p class="hidden lg:block">Filters</p>
                        </button>
                        <!-- Open the modal using ID.showModal() method -->
                        <dialog id="feature_modal" class="modal modal-bottom  sm:modal-middle">
                            <div class="modal-box max-w-lg ">
                                {{--content--}}
                                <h3 class="text-xl font-normal mb-3">Filters</h3>
                                <x-divider class="bg-gray-200"/>

                                <h1 class="text-2xl font-semibold">Exclusivity</h1>

                                <div class="modal-action">
                                    <form method="dialog">
                                        {{--close btn--}}
                                        <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                                    </form>
                                </div>
                            </div>
                        </dialog>
                    </div>
                </div>

                {{--Listings cards--}}
                <div class="w-full max-w-7xl space-y-3 grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-x-2 gap-y-1 lg:gap-x-2 lg:gap-y-6 mt-5 place-self-center">
                    @forelse($listings as $listing)
                        <x-bhouse-card :$listing />
                    @empty
                        <p class="col-span-full text-center text-gray-500">
                            No listings available.
                        </p>
                    @endforelse

                </div>
            </div>

            <div class="flex justify-center mt-15 mb-10 ">
                {{ $listings->links() }}
            </div>

        </section>




    </div>
    <x-footer></x-footer>
</x-layout>
