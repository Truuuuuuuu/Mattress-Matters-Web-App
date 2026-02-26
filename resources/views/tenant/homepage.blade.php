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
        <div>
            <h1 class="text-xl font-semibold">Affordable for students!</h1>
        </div>
        <div class="grid grid-cols-2 gap-2 lg:grid-cols-6 ">
            <x-bhouse-card/>
            <x-bhouse-card/>
            <x-bhouse-card/>
            <x-bhouse-card/>
            <x-bhouse-card/>
            <x-bhouse-card/>
        </div>
    </section>
    {{--All genders--}}
    <section class="p-7 text-base-content">
        <div>
            <h1 class="text-xl font-semibold">All genders!</h1>
        </div>
        <div class="grid grid-cols-6 gap-2">
            <x-bhouse-card/>
            <x-bhouse-card/>
            <x-bhouse-card/>
            <x-bhouse-card/>
            <x-bhouse-card/>
            <x-bhouse-card/>
        </div>
    </section>
    {{--Female exlusive--}}
    <section class="p-7 text-base-content">
        <div>
            <h1 class="text-xl font-semibold">Accommodation for Female Tenants Only</h1>
        </div>
        <div class="grid grid-cols-6 gap-2">
            <x-bhouse-card/>
            <x-bhouse-card/>
            <x-bhouse-card/>
            <x-bhouse-card/>
            <x-bhouse-card/>
            <x-bhouse-card/>
        </div>
    </section>

</x-layout>
