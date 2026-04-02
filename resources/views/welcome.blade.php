<x-layout>
    <x-slot:heading>Mattress Matters | Boarding House Listings</x-slot:heading>
    <div class="space-y-10 overflow-x-hidden">
        <section class="pt-10  lg:px-10 ">
            <div class=" flex justify-center gap-8 items-start ">
                <div class="flex flex-col justify-center items-center">
                    <div class="px-5 justify-center">
                        <div class=" flex items-center gap-2">
                            <h1 class="m-0 text-3xl lg:text-5xl font-bold text-base-content/70 leading-none">
                                Find Your
                            </h1>

                            <span class="text-rotate font-bold text-3xl lg:text-5xl leading-none">
                                <span class="flex flex-col items-center">
                                    <span class="text-blue-900">BUDGET</span>
                                    <span class="text-blue-900">PERFECT</span>
                                    <span class="text-blue-900">IDEAL</span>
                                </span>
                            </span>
                        </div>
                    </div>
                    <div class="px-5">
                        <h1 class="text-3xl lg:text-5xl font-bold text-base-content w-full lg:w-lg text-center">
                            Boarding House Now!
                        </h1>
                    </div>
                    <div class="px-5">
                        <p class="text-sm mt-2 font-normal text-base-content w-full lg:w-xl text-center ">Connect with verified property owners offering
                            quality accommodations in Apostol Compound, Balogo. Simple,
                            secure, and transparent.</p>
                    </div>


                    <div class=" w-full max-w-xs lg:max-w-lg  text-base-content mt-5">
                        @include('components.search-bar')
                    </div>
                </div>
            </div>

            {{--Display Latest Listings--}}
            <div class="mt-5 px-5">
                <h1 class="text-xl font-semibold"> Find Your Perfect Stay</h1>
            </div>
            {{--LARGE VIEW--}}
            <div class="hidden  lg:grid grid-cols-2 lg:grid-cols-4 gap-x-2 gap-y-1 lg:gap-x-4 lg:gap-y-4 mt-2 ">
                @forelse($listings as $listing)
                    <x-bhouse-card :$listing/>
                @empty
                    <p class="col-span-full text-center text-gray-500">
                        No listings available.
                    </p>
                @endforelse
            </div>

            {{--MOBILE VIEW--}}
            <div class="carousel carousel-center gap-4 w-full mt-5 lg:hidden px-5">
                @foreach($listings as $listing)<div class="carousel-item w-64"><x-bhouse-card :$listing /></div>@endforeach
            </div>

        </section>

        {{--Illustrations--}}
        <section class="space-y-5">
            <div class="px-3 lg:px-0 flex flex-col-reverse lg:flex-row justify-center gap-1 lg:gap-10" data-aos="fade-right">
                <div class="flex flex-col justify-center w-full max-w-md text-center lg:text-start" >
                    <h1 class="text-lg px-10 lg:px-0 lg:text-3xl font-bold">Your Boarding House Journey Starts Here</h1>
                    <p class="text-xs lg:text-md">Looking for a place to call home? We help you find safe, affordable, and comfortable boarding houses that fit your lifestyle and budget.</p>

                </div>
                <div class="flex justify-center ">
                    <img src="{{asset('images/house-searching.svg')}}" alt="house-search" class="w-34 lg:w-64">
                </div>

            </div>

            <div class="px-3 lg:px-0 flex flex-col lg:flex-row justify-center gap-1 lg:gap-10 " data-aos="fade-left">
                <div class="flex justify-center ">
                    <img src="{{asset('images/host-rent.svg')}}" alt="house-search" class="w-34 lg:w-64">
                </div>
                <div class="flex flex-col justify-center w-full max-w-md text-center lg:text-start">
                    <h1 class="text-lg px-10 lg:px-0 lg:text-3xl font-bold">Got a Room? Find the Right Tenant</h1>
                    <p class="text-xs lg:text-md">Turn your extra space into a steady income. We make it easy for hosts to list, manage, and fill their boarding houses with the right tenants.</p>

                </div>
            </div>
            <div class="px-3 lg:px-0 flex flex-col-reverse lg:flex-row justify-center gap-1 lg:gap-10" data-aos="fade-right">
                <div class="flex flex-col justify-center w-full max-w-md text-center lg:text-start">
                    <h1 class="text-lg px-10 lg:px-0 lg:text-3xl font-bold">Your All-in-One Boarding House Platform</h1>
                    <p class="text-xs lg:text-md">A smart and easy-to-use system designed to connect tenants and hosts seamlessly. From searching and listing to managing inquiries and everything you need is right here in one place.</p>

                </div>
                <div class="flex justify-center ">
                    <img src="{{asset('images/dashboard-system.svg')}}" alt="house-search" class="w-34 lg:w-64">
                </div>

            </div>

        </section>

        {{-- CTA--}}
        <section class="py-30 w-full bg-gradient-to-t from-black via-blue-900 to-blue-500 w-full" >
            <div class="place-self-center " data-aos="fade-up">
                <div class="text-white">
                    <h1 class="text-3xl px-10 lg:text-5xl font-bold text-center">Start Your Journey With Us</h1>
                    <p class="text-center px-5 lg:px-10">Join thousands of renters and property owners using Mattress Matters</p>
                </div>
                <div class="flex justify-center p-4  gap-x-5 mt-3">
                    <a href="{{ route('email.register') }}" class="items-center px-4 py-2 btn btn-default">Register Now</a>
                </div>
            </div>
        </section>

        {{--Testimonials--}}
        <section class="my-20 lg:px-10 " data-aos="fade-up">
            <h1 class="text-lg lg:text-3xl text-base-content font-bold text-center mb-5 ">Hear From Our Community</h1>
            <div class=" hidden lg:flex justify-center gap-4  w-full ">
                <x-testimonial/>
                <x-testimonial/>
                <x-testimonial/>
            </div>

            {{--MOBILE VIEW--}}
            <div class="carousel carousel-center gap-4 w-full mt-5 lg:hidden px-5">
                <div class="carousel-item w-64">
                    <x-testimonial/>
                </div>
                <div class="carousel-item w-64">
                    <x-testimonial/>
                </div>
                <div class="carousel-item w-64">
                    <x-testimonial/>
                </div>
                <div class="carousel-item w-64">
                    <x-testimonial/>
                </div>
            </div>
        </section>





        <x-footer/>
    </div>
</x-layout>
