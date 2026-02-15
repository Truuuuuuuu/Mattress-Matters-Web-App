<x-layout>
    <x-slot:heading>Mattress Matters | Boarding House Listings</x-slot:heading>
    <div class="space-y-10">
        <section class="pt-10 mt-10 ">
            <div class="grid lg:grid-cols-2 gap-8">
                <div>
                    <h1 class="text-5xl font-bold">Find Your Perfect Boarding House Now!</h1>
                    <p class="mt-5 font-normal">Connect with verified property owners offering
                        quality accommodations in Apostol Compound, Balogo. Simple,
                        secure, and transparent.</p>
                    <x-forms.form action="/search" class="mt-5">
                        <x-forms.input :label="false" name="q" placeholder="Search here..."></x-forms.input>
                    </x-forms.form>
                    <div class="grid grid-cols-3 gap-5 mt-6">
                        <div class="border-2 border-black/50 rounded-md p-4 text-center">
                            <p class="font-bold">143</p>
                            <p>Active Listings</p>
                        </div >
                        <div class="border-2 border-black/50 rounded-md p-4 text-center">
                            <p class="font-bold">200</p>
                            <p>Postive Feedbacks</p>
                        </div >
                        <div class="border-2 border-black/50 rounded-md p-4 text-center">
                            <p class="font-bold">86</p>
                            <p>Verified Owners</p>
                        </div >
                    </div>
                </div>
                {{--   Photo right side   --}}
                <div class="hidden lg:flex items-center justify-center px-5">
                    <img src="{{ asset('images/bhouse-placeholder.jpg') }}" alt="" class="w-132 h-auto rounded-2xl">
                </div>
            </div>
        </section>

        {{-- Featured listings--}}
        <section class="mt-20 bg-gray-100 -mx-10 px-10 py-5">
            <div>
                <h1 class="text-3xl font-semibold">Featured Listings</h1>
            </div>
        </section>
    </div>
</x-layout>
