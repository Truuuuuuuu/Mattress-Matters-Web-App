{{--Search bar--}}
<x-forms.form action="/listings" method="GET">
    <div class="relative -mt-1">
        <x-forms.input :label="false" name="search" placeholder="Search here..." class="rounded-4xl input input-primary input-lg text-sm pr-12 w-full"> </x-forms.input>
        <button type="submit" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-500 hover:text-primary transition cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
            </svg>
        </button>

        {{-- Clear Button, hidden empty search bar --}}
        @if(request('search'))
            <a
                href="/listings"
                class="absolute right-14 top-1/2 -translate-y-1/2 text-gray-400 hover:text-red-500 transition"
            >
                <div class="tooltip tooltip-bottom  flex items-center" data-tip="Clear">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x-icon lucide-x"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                </div>
            </a>
        @endif
    </div>
</x-forms.form>
