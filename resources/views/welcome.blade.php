<x-layout>
    <x-slot:heading>Mattress Matters | Boarding House Listings</x-slot:heading>
    <div class="space-y-10">
        <section class="flex pt-10  px-10   h-[calc(100vh-73px)] justify-center items-center">
            <div class=" flex justify-center gap-8 items-start ">
                <div class="flex flex-col justify-center items-center">
                    <h1 class="text-5xl font-bold text-base-content w-lg text-center"><span class="text-base-content/50">Find Your Perfect</span> Boarding House Now!</h1>
                    <p class="mt-2 font-normal text-base-content w-xl text-center">Connect with verified property owners offering
                        quality accommodations in Apostol Compound, Balogo. Simple,
                        secure, and transparent.</p>
                    <div class=" w-full max-w-xs lg:max-w-lg  text-base-content mt-5">
                        @include('components.search-bar')
                    </div>
                </div>
                {{--   Photo right side   --}}
                {{--<div class="hidden lg:flex items-center justify-center px-5">
                    <img src="{{ asset('images/bhouse-placeholder.jpg') }}" alt="" class="w-132 h-auto rounded-2xl">
                </div>--}}
            </div>
        </section>




        {{--Display Latest Listings--}}
        <section class="p-7 text-base-content">
            <div>
                <h1 class="text-xl font-semibold"> Find Your Perfect Stay</h1>
            </div>
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-x-2 gap-y-1 lg:gap-x-4 lg:gap-y-4 mt-5">
                @forelse($listings as $listing)

                    <x-bhouse-card :$listing width="72"/>
                @empty
                    <p class="col-span-full text-center text-gray-500">
                        No listings available.
                    </p>
                @endforelse

            </div>
        </section>

        {{-- CTA--}}
        <section class="mt-5 lg:mt-20 relative bg-cover bg-center  py-30" style="background-image: url('{{ asset('images/cta-bg.jpg') }}');">
            <div class="place-self-center">
                <div>
                    <h1 class="text-3xl px-10 lg:text-5xl font-bold text-center">Start Your Journey With Us</h1>
                    <p class="text-center px-10">Join thousands of renters and property owners using Mattress Matters</p>
                </div>
                <div class="flex justify-center p-4  gap-x-5 mt-3">
                    <a href="/register" class="items-center bg-black text-white px-4 py-2 rounded">Register Now!</a>
                    <a href="/register" class="items-center bg-white text-black px-4 py-2 rounded">Become a Host</a>
                </div>
            </div>
        </section>

        {{--Testimonials--}}
        <section class="my-20 px-10">
            <h1 class="text-3xl text-base-content font-bold text-center mb-5">Hear From Our Community</h1>
            <div class=" grid grid-rows lg:grid-cols-3 gap-7">
                <x-testimonial/>
                <x-testimonial/>
                <x-testimonial></x-testimonial>
            </div>
        </section>

        <x-footer/>
    </div>
</x-layout>
