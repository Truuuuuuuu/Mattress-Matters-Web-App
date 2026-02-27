<x-layout>
    <x-slot:heading>Login Success</x-slot:heading>
    {{--Bottom navbar for MOBILE--}}
    <div class="btm-nav md:hidden fixed bottom-0 left-0 right-0 z-50 bg-base-100 border-t">
        <a href="/">
            <svg class="h-5 w-5" ...>...</svg>
            <span class="btm-nav-label text-xs">Home</span>
        </a>
        <a href="/search">
            🔍
            <span class="btm-nav-label text-xs">Search</span>
        </a>
        <a href="/favorites">
            ❤️
            <span class="btm-nav-label text-xs">Saved</span>
        </a>
        <a href="/profile">
            👤
            <span class="btm-nav-label text-xs">Profile</span>
        </a>
    </div>

    {{--student meal--}}
    <section class="p-7 text-base-content">
        <div class="flex items-center gap-2">
            <h1 class="text-xl font-semibold">Affordable for students!</h1>
            <a href="#" class="btn btn-ghost btn-circle bg-gray-200 w-8 h-8">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                    <path fill-rule="evenodd" d="M12.97 3.97a.75.75 0 0 1 1.06 0l7.5 7.5a.75.75 0 0 1 0 1.06l-7.5 7.5a.75.75 0 1 1-1.06-1.06l6.22-6.22H3a.75.75 0 0 1 0-1.5h16.19l-6.22-6.22a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                </svg>
            </a>
        </div>
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-x-2 gap-y-1 lg:gap-x-4 lg:gap-y-4">
            @forelse($listings as $listing)
                <x-bhouse-card :$listing/>
            @empty
                <p class="col-span-full text-center text-gray-500">
                    No listings available.
                </p>
            @endforelse

        </div>
        <div class="flex justify-end mt-10">
            <a href="#" class="btn btn-primary w-50">
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
