<x-layout>
    <x-slot:heading>Mattress Matters | Boarding House Listings</x-slot:heading>
    {{--Bottom navbar for MOBILE--}}
    <div class="btm-nav md:hidden fixed bottom-0 left-0 right-0 z-50 bg-base-100 border-t border-gray-300 h-20">
        <div class="flex justify-between items-center  h-full px-8">
            <div>
                <a href="" class="flex flex-col items-center justify-center text-base-content/70">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-10">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>

                    <span class="btm-nav-label text-xs">Explore</span>
                </a>
            </div>

            <div>
                <a href="" class="flex flex-col items-center justify-center text-base-content/70">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-10">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.5V3.545M12.75 21h7.5V10.75M2.25 21h1.5m18 0h-18M2.25 9l4.5-1.636M18.75 3l-1.5.545m0 6.205 3 1m1.5.5-1.5-.5M6.75 7.364V3h-3v18m3-13.636 10.5-3.819" />
                    </svg>

                    <span class="btm-nav-label text-xs ">My Unit</span>
                </a>
            </div>

            <div>
                <a href="" class="flex flex-col justify-center items-center text-base-content/70">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-10">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 2.994v2.25m10.5-2.25v2.25m-14.252 13.5V7.491a2.25 2.25 0 0 1 2.25-2.25h13.5a2.25 2.25 0 0 1 2.25 2.25v11.251m-18 0a2.25 2.25 0 0 0 2.25 2.25h13.5a2.25 2.25 0 0 0 2.25-2.25m-18 0v-7.5a2.25 2.25 0 0 1 2.25-2.25h13.5a2.25 2.25 0 0 1 2.25 2.25v7.5m-6.75-6h2.25m-9 2.25h4.5m.002-2.25h.005v.006H12v-.006Zm-.001 4.5h.006v.006h-.006v-.005Zm-2.25.001h.005v.006H9.75v-.006Zm-2.25 0h.005v.005h-.006v-.005Zm6.75-2.247h.005v.005h-.005v-.005Zm0 2.247h.006v.006h-.006v-.006Zm2.25-2.248h.006V15H16.5v-.005Z" />
                    </svg>

                    <span class="btm-nav-label text-xs">Reservation</span>
                </a>
            </div>

            <div>
                <a href="" class="flex flex-col justify-center items-center text-base-content/70">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-10">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>

                    <span class="btm-nav-label text-xs">Profile</span>
                </a>
            </div>

        </div>


    </div>
        <div class="flex  w-full justify-center mt-5 ">
            <!-- Search -->
            <div class=" w-full max-w-xs lg:max-w-lg  text-base-content">
                @include('components.search-bar')
            </div>
        </div>

    {{--Display Listings--}}
    <section class="p-7 text-base-content">
        <div class="flex items-center gap-2 ">
            <h1 class="text-xl font-semibold">Affordable for students!</h1>
            <a href="{{route('listings.index')}}" class="btn btn-ghost btn-circle bg-gray-200 w-8 h-8">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"  class="size-6">
                    <path fill-rule="evenodd" d="M12.97 3.97a.75.75 0 0 1 1.06 0l7.5 7.5a.75.75 0 0 1 0 1.06l-7.5 7.5a.75.75 0 1 1-1.06-1.06l6.22-6.22H3a.75.75 0 0 1 0-1.5h16.19l-6.22-6.22a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                </svg>
            </a>
        </div>
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-x-2 gap-y-1 lg:gap-x-4 lg:gap-y-4 mt-5">
            @forelse($listings as $listing)
                <x-bhouse-card :$listing/>
            @empty
                <p class="col-span-full text-center text-gray-500">
                    No listings available.
                </p>
            @endforelse

        </div>
        <div class="flex justify-end mt-10">
            <a href="{{route('listings.index')}}" class="btn btn-primary w-50">
                See all
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
                    <path fill-rule="evenodd" d="M13.28 11.47a.75.75 0 0 1 0 1.06l-7.5 7.5a.75.75 0 0 1-1.06-1.06L11.69 12 4.72 5.03a.75.75 0 0 1 1.06-1.06l7.5 7.5Z" clip-rule="evenodd" />
                    <path fill-rule="evenodd" d="M19.28 11.47a.75.75 0 0 1 0 1.06l-7.5 7.5a.75.75 0 1 1-1.06-1.06L17.69 12l-6.97-6.97a.75.75 0 0 1 1.06-1.06l7.5 7.5Z" clip-rule="evenodd" />
                </svg>
            </a>


        </div>
    </section>

    {{--Footer--}}
    <x-footer/>
</x-layout>
