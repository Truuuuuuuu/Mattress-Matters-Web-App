<x-layout>
    <x-slot:heading>Mattress Matters | {{$listing->name}}</x-slot:heading>

    <div class="px-20">
        {{--Main content--}}
        <section class="mb-10">
            <h1 class="text-2xl font-bold mt-10 text-base-content">Mattress Matters in Sorsogon City</h1>
            <div class="grid grid-cols-2 mt-5 gap-10">
                <div class=" rounded-2xl overflow-hidden">
                    {{--big photo--}}
                    <div>
                        <img src="{{asset('images/bhouse-placeholder.jpg')}}" alt="" class="w-full h-full object-cover">
                    </div>

                    {{--smaller photo--}}
                    <div class="grid grid-cols-2 rounded-b-2xl overflow-hidden gap-2 mt-2">
                        <div>
                            <img src="{{asset('images/bhouse-placeholder.jpg')}}" alt="" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <img src="{{asset('images/bhouse-placeholder.jpg')}}" alt="" class="w-full h-full object-cover">
                        </div>
                    </div>

                </div>
                <div class="px-5 text-base-content">
                    <h1 class="text-2xl font-semibold">{{$listing->name}}</h1>
                    <p>8 slots • 4 rooms • 2 bathrooms </p>
                    <div class="flex items-center gap-1 mb-10">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-3">
                            <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z" clip-rule="evenodd" />
                        </svg>
                        <p><strong>4.9</strong> • <span class="underline text-base-content/50 cursor-pointer">10 reviews</span></p>
                    </div>

                    {{--reserve card--}}
                    <div class="rounded-xl  mt-10 w-full  border border-black/30 py-5 px-20 mb-10">
                        <div>
                            <h1 class="text-2xl font-semibold">₱{{number_format($listing->price)}} <span class="text-base-content/70 text-lg font-normal">monthly</span></h1>
                        </div>
                        <p class="text-base-content/50 text-sm">Only 4 slot/s remaining</p>
                        <div class="mt-3">
                            <a href="#" class="btn btn-neutral w-full">Reserve</a>
                            <p class="text-sm text-base-content/60 text-center mt-5">You won't be charged yet</p>
                        </div>
                    </div>

                    <x-divider class="bg-gray-300"/>
                    {{--host profile--}}
                    <div class="py-5 flex justify-start gap-5">
                        <div class="btn btn-lg btn-circle btn-secondary ">
                            {{$listing->host->user->name[0]}}
                        </div>
                        <div>
                            <h1 class="font-semibold">Hosted by {{$listing->host->user->name}}</h1>
                            <p class="text-base-content/70">Joined {{$listing->host->user->created_at->format('Y')}}</p>
                        </div>
                    </div>
                    <x-divider class="bg-gray-300"/>

                    {{--Description--}}
                    <h1 class="text-2xl font-semibold mt-5">Description</h1>
                    <p class="text-justify mt-3">A comfortable and affordable boarding house located in a convenient area,
                        ideal for students and working professionals. The property offers a safe
                        environment with essential amenities and easy access to public transportation,
                        schools, and commercial establishments.
                    </p>

                    {{--Amenities--}}
                    <h1 class="text-2xl font-semibold mt-5">Amenities</h1>
                    <div class="grid grid-cols-2 mt-3 gap-y-5">
                        <div class="flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-cooking-pot-icon lucide-cooking-pot"><path d="M2 12h20"/><path d="M20 12v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-8"/><path d="m4 8 16-4"/><path d="m8.86 6.78-.45-1.81a2 2 0 0 1 1.45-2.43l1.94-.48a2 2 0 0 1 2.43 1.46l.45 1.8"/></svg>
                            <p class="text-lg ">Kitchen</p>
                        </div>
                        <div class="flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-wifi-icon lucide-wifi"><path d="M12 20h.01"/><path d="M2 8.82a15 15 0 0 1 20 0"/><path d="M5 12.859a10 10 0 0 1 14 0"/><path d="M8.5 16.429a5 5 0 0 1 7 0"/></svg>
                            <p class="text-lg ">Wifi</p>
                        </div>
                        <div class="flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-bath-icon lucide-bath"><path d="M10 4 8 6"/><path d="M17 19v2"/><path d="M2 12h20"/><path d="M7 19v2"/><path d="M9 5 7.621 3.621A2.121 2.121 0 0 0 4 5v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-5"/></svg>
                            <p class="text-lg">Personal Bathroom</p>
                        </div>
                        <div class="flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-microwave-icon lucide-microwave"><rect width="20" height="15" x="2" y="4" rx="2"/><rect width="8" height="7" x="6" y="8" rx="1"/><path d="M18 8v7"/><path d="M6 19v2"/><path d="M18 19v2"/></svg>
                            <p class="text-lg">Microwave</p>
                        </div>
                        <div class="flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-cctv-icon lucide-cctv"><path d="M16.75 12h3.632a1 1 0 0 1 .894 1.447l-2.034 4.069a1 1 0 0 1-1.708.134l-2.124-2.97"/><path d="M17.106 9.053a1 1 0 0 1 .447 1.341l-3.106 6.211a1 1 0 0 1-1.342.447L3.61 12.3a2.92 2.92 0 0 1-1.3-3.91L3.69 5.6a2.92 2.92 0 0 1 3.92-1.3z"/><path d="M2 19h3.76a2 2 0 0 0 1.8-1.1L9 15"/><path d="M2 21v-4"/><path d="M7 9h.01"/></svg>
                            <p class="text-lg">Exterior CCTV</p>
                        </div>
                        <div class="flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-fan-icon lucide-fan"><path d="M10.827 16.379a6.082 6.082 0 0 1-8.618-7.002l5.412 1.45a6.082 6.082 0 0 1 7.002-8.618l-1.45 5.412a6.082 6.082 0 0 1 8.618 7.002l-5.412-1.45a6.082 6.082 0 0 1-7.002 8.618l1.45-5.412Z"/><path d="M12 12v.01"/></svg>
                            <p class="text-lg">Electric fan</p>
                        </div>
                    </div>
                    {{--show all modal btn--}}
                    <div class="mt-5">
                        <!-- Open the modal using ID.showModal() method -->
                        <button class="btn border-base-content/70 rounded-2xl px-9" onclick="amenities_modal.showModal()">Show all</button>
                        <dialog id="amenities_modal" class="modal modal-bottom  sm:modal-middle">
                            <div class="modal-box max-w-lg">
                                {{--content--}}
                                <h3 class="text-2xl font-semibold mb-5">All Amenities</h3>

                                <div class="flex items-center gap-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-fan-icon lucide-fan"><path d="M10.827 16.379a6.082 6.082 0 0 1-8.618-7.002l5.412 1.45a6.082 6.082 0 0 1 7.002-8.618l-1.45 5.412a6.082 6.082 0 0 1 8.618 7.002l-5.412-1.45a6.082 6.082 0 0 1-7.002 8.618l1.45-5.412Z"/><path d="M12 12v.01"/></svg>
                                    <p class="text-lg">Electric fan</p>
                                </div>

                                <x-divider class="bg-gray-200 my-5"/>

                                <div class="flex items-center gap-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-fan-icon lucide-fan"><path d="M10.827 16.379a6.082 6.082 0 0 1-8.618-7.002l5.412 1.45a6.082 6.082 0 0 1 7.002-8.618l-1.45 5.412a6.082 6.082 0 0 1 8.618 7.002l-5.412-1.45a6.082 6.082 0 0 1-7.002 8.618l1.45-5.412Z"/><path d="M12 12v.01"/></svg>
                                    <p class="text-lg">Electric fan</p>
                                </div>

                                <x-divider class="bg-gray-200 my-5"/>

                                <div class="flex items-center gap-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-fan-icon lucide-fan"><path d="M10.827 16.379a6.082 6.082 0 0 1-8.618-7.002l5.412 1.45a6.082 6.082 0 0 1 7.002-8.618l-1.45 5.412a6.082 6.082 0 0 1 8.618 7.002l-5.412-1.45a6.082 6.082 0 0 1-7.002 8.618l1.45-5.412Z"/><path d="M12 12v.01"/></svg>
                                    <p class="text-lg">Electric fan</p>
                                </div>

                                <x-divider class="bg-gray-200 my-5"/>

                                <div class="modal-action">
                                    <form method="dialog">
                                        {{--close btn--}}
                                        <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                                    </form>
                                </div>
                            </div>
                        </dialog>
                    </div>

                </div>
            </div>
        </section>

        <x-divider class="bg-gray-200"/>

        {{--Reviews--}}
        <section>
            <div class="grid grid-cols-2 mt-10 gap-x-30 gap-y-10 mb-10">
                <x-review-card/>
                <x-review-card/>
                <x-review-card/>
                <x-review-card/>
                <x-review-card/>
                <x-review-card/>
            </div>
        </section>

        <x-divider class="bg-gray-200"/>

        {{--What You Should Know--}}
        <section class="mb-20 ">
            <h1 class="text-2xl font-semibold mt-20 text-center">What You Should Know</h1>
            <div class="flex justify-center gap-x-40 mt-15">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-house-icon lucide-house"><path d="M15 21v-8a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v8"/><path d="M3 10a2 2 0 0 1 .709-1.528l7-6a2 2 0 0 1 2.582 0l7 6A2 2 0 0 1 21 10v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/></svg>
                    <h2 class="font-semibold mt-4">House rules</h2>
                    <div class="text-base-content/60">
                        <p>Tenants must be home on or before 11:00 PM</p>
                        <p>3 guests maximum</p>
                        <p class="underline">Learn more</p>
                    </div>
                </div>

                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shield-check-icon lucide-shield-check"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/><path d="m9 12 2 2 4-4"/></svg>
                    <h2 class="font-semibold mt-4">Safety & Property</h2>
                    <div class="text-base-content/60">
                        <p>CCTV installed</p>
                        <p>Smoke detector</p>
                        <p class="underline">Learn more</p>
                    </div>
                </div>
            </div>
        </section>

    </div>

    <x-footer/>
</x-layout>


