<x-layout>
    <x-slot:heading>All Listings</x-slot:heading>

    <div class="px-10 mt-10">
        {{--Content--}}
        <section>
            <div>
                {{--search bar w filter--}}
                <div class=" flex justify-center items-center gap-5 ">
                    <div class="w-lg">
                        <x-search-bar class=""/>
                    </div>
                    <div>
                        <button class="flex btn btn-neutral rounded-3xl " onclick="feature_modal.showModal()">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75" />
                            </svg>
                            <p>Filters</p>
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
                <div class="grid grid-cols-2 lg:grid-cols-3 gap-x-2 gap-y-1 lg:gap-x-4 lg:gap-y-4 mt-5">
                    @forelse($listings as $listing)
                        <x-bhouse-card :$listing/>
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
