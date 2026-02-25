{{--Search bar--}}
<x-forms.form action="/search">
    <div class="relative w-full">
        <x-forms.input :label="false" name="q" placeholder="Search here..." class="rounded-4xl input input-primary input-lg text-sm pr-12 w-full "> </x-forms.input>
        <button type="submit" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-500 hover:text-primary transition cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
            </svg>
        </button>
    </div>
</x-forms.form>
