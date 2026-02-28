<x-layout>
    <x-slot:heading>Mattress Matters | Boarding House Listings</x-slot:heading>
    <div class="space-y-10">
        <section class="pt-10 mt-10 px-10">
            <div class="grid lg:grid-cols-2 gap-8 items-start">
                <div class="place-self-start self-center">
                    <h1 class="text-5xl font-bold text-base-content">Find Your Perfect Boarding House Now!</h1>
                    <p class="mt-5 font-normal text-base-content">Connect with verified property owners offering
                        quality accommodations in Apostol Compound, Balogo. Simple,
                        secure, and transparent.</p>
                    <x-forms.form action="/all-listings" class="mt-5">
                        <x-forms.input :label="false" name="q" placeholder="Search here..." class="rounded-xl input input-primary"></x-forms.input>
                    </x-forms.form>
                </div>
                {{--   Photo right side   --}}
                <div class="hidden lg:flex items-center justify-center px-5">
                    <img src="{{ asset('images/bhouse-placeholder.jpg') }}" alt="" class="w-132 h-auto rounded-2xl">
                </div>
            </div>
        </section>

        {{-- Featured listings--}}
        <section class="mt-5 lg:mt-20   px-10 py-5">
            <div>
                <h1 class="text-3xl text-base-content font-semibold">Featured Listings</h1>
            </div>

            <div class="gap-y-2 grid grid-cols-2 lg:grid-cols-4 gap-x-2 mt-6">
                @for($i = 0; $i < 4; $i++)
                    <x-panel class="flex flex-col text-start">
                        <div class="py-2 ">
                            <div class="w-full aspect-4/3">
                                <x-bhouse-photo/>
                            </div>
                            <h3 class="text-sm text-base-content lg:group-hover:text-blue-800 font-bold transition-colors duration-300">
                                <a href="#" target="_blank">
                                    Name
                                </a>
                            </h3>
                            <p class="text-xs text-base-content lg:text-sm mt-1">P2,000 monthly</p>
                        </div>
                    </x-panel>

                @endfor

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
