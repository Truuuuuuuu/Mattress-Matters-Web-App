<x-layout>
    <x-slot:heading>Mattress Matters | Boarding House Listings</x-slot:heading>
    <div class="space-y-10">
        <section class="pt-10 mt-10 ">
            <div class="grid lg:grid-cols-2 gap-8 items-start">
                <div class="place-self-start self-center">
                    <h1 class="text-5xl font-bold text-base-content">Find Your Perfect Boarding House Now!</h1>
                    <p class="mt-5 font-normal text-base-content">Connect with verified property owners offering
                        quality accommodations in Apostol Compound, Balogo. Simple,
                        secure, and transparent.</p>
                    <x-forms.form action="/search" class="mt-5">
                        <x-forms.input :label="false" name="q" placeholder="Search here..." class="input input-primary"></x-forms.input>
                    </x-forms.form>
                </div>
                {{--   Photo right side   --}}
                <div class="hidden lg:flex items-center justify-center px-5">
                    <img src="{{ asset('images/bhouse-placeholder.jpg') }}" alt="" class="w-132 h-auto rounded-2xl">
                </div>
            </div>
        </section>

        {{-- Featured listings--}}
        <section class="mt-5 lg:mt-20  -mx-10 px-10 py-5">
            <div>
                <h1 class="text-3xl text-base-content font-semibold">Featured Listings</h1>
            </div>

            <div class="gap-y-2 grid grid-cols-2 lg:grid-cols-4 gap-x-2 mt-6">
                <x-bhouse-card />
                <x-bhouse-card />
                <x-bhouse-card />
                <x-bhouse-card />

            </div>
        </section>

        {{-- CTA--}}
        <section class="mt-5 lg:mt-20 relative bg-cover bg-center -mx-10 py-30" style="background-image: url('{{ asset('images/cta-bg.jpg') }}');">
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
        <section class="my-20">
            <h1 class="text-3xl text-base-content font-bold text-center mb-5">Hear From Our Community</h1>
            <div class=" grid grid-rows lg:grid-cols-3 gap-7">
                <x-testimonial/>
                <x-testimonial/>
                <x-testimonial></x-testimonial>
            </div>
        </section>

        {{--  Footer--}}
        <section class="bg-black/50 -mx-10 p-10 pt-30 text-base-content">
            <div class="grid gap-6">
                <div class="grid grid-cols lg:grid-cols-2">
                    <div class="lg:pr-40 text-justify">
                        <h1 class="text-lg font-bold">Mattress Matters</h1>
                        <p class="mt-3">Your trusted platform for quality boarding house listings in Balogo,
                            Sorsogon City. Connecting renters with verified property owners
                            since 2026.</p>
                    </div>
                    <div class="gap-x-10 mt-5 lg:gap-x-30 flex justify-end ">
                        <div>
                            <h1 class="font-bold">Platform</h1>
                            <ul class="mt-3">
                                <li>Browser Listing</li>
                                <li>How It Works</li>
                                <li>Pricing</li>
                                <li>FAQ</li>
                            </ul>
                        </div>
                        <div>
                            <h1 class="font-bold">Company</h1>
                            <ul class="mt-3">
                                <li>About Us</li>
                                <li>Contact</li>
                                <li>Careers</li>
                                <li>Blog</li>
                            </ul>
                        </div>
                        <div>
                            <h1 class="font-bold">Legal</h1>
                            <ul class="mt-3">
                                <li>Terms of Service</li>
                                <li>Privacy & Policy</li>
                                <li>Cookie Policy</li>
                            </ul>
                        </div>
                    </div>

                </div>
                <x-divider/>
                <div class="lg:flex justify-between text-xs">
                    <p >© 2026 Mattress Matters. All rights reserved.</p>
                    <p>Apostol Compound, Alegre St. Purok 1, Balogo, Sorsogon City</p>
                </div>
            </div>
        </section>
    </div>
</x-layout>
