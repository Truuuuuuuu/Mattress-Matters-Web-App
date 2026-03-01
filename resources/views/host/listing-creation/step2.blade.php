<div class="space-y-10">
    <section>
        <h1 class="text-3xl font-semibold mt-5">Set your monthly rent</h1>
        <div class="grid lg:grid-cols-2 mt-10 ">

            <div class="overflow-hidden h-32 ">
                <img src="{{asset('images/house-rent.svg')}}" alt="" class="w-full h-full object-fit">
            </div>
            <div class=" px-10 py-6 flex flex-col justify-center">
                <label for="price" class="text-base-content/50 text-lg ">Monthy</label>
                <div class="flex justify-start gap-5">
                    <H1 class="text-3xl font-bold leading-none">PHP</H1>
                    <input type="number" id="price" name="price" min="0"
                           class="text-3xl w-64 border-b-3 border-black focus:ring-0 focus:outline-none block" required>
                </div>
                <p class="text-sm text-gray-500 mt-2">
                    Enter the monthly rent amount for this listing.
                </p>
            </div>


        </div>
    </section>

    {{--Amenities--}}
    <section>
        <div>
            <h1 class="text-3xl font-semibold">What does your place offer?</h1>
            <div class="grid grid-cols-4 gap-4 mt-5">
                <label class="card bg-base-200 shadow-sm p-6 cursor-pointer hover:bg-base-300 transition">
                    <input type="checkbox" name="amenities[]" value="Wifi" class="hidden peer"/>
                    <div class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="lucide lucide-wifi-icon lucide-wifi">
                            <path d="M12 20h.01"/>
                            <path d="M2 8.82a15 15 0 0 1 20 0"/>
                            <path d="M5 12.859a10 10 0 0 1 14 0"/>
                            <path d="M8.5 16.429a5 5 0 0 1 7 0"/>
                        </svg>
                        <div class="peer-checked:font-bold">
                            Wifi
                        </div>
                    </div>

                </label>

                <label class="card bg-base-200 shadow-sm p-6 cursor-pointer hover:bg-base-300 transition">
                    <input type="checkbox" name="amenities[]" value="shared_bathroom" class="hidden peer"/>
                    <div class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-bath-icon lucide-bath"><path d="M10 4 8 6"/><path d="M17 19v2"/><path d="M2 12h20"/><path d="M7 19v2"/><path d="M9 5 7.621 3.621A2.121 2.121 0 0 0 4 5v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-5"/></svg>
                        <div class="peer-checked:font-bold">
                            Shared Bathroom
                        </div>
                    </div>

                </label>

                <label class="card bg-base-200 shadow-sm p-6 cursor-pointer hover:bg-base-300 transition">
                    <input type="checkbox" name="amenities[]" value="Kitchen" class="hidden peer"/>
                    <div class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-cooking-pot-icon lucide-cooking-pot"><path d="M2 12h20"/><path d="M20 12v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-8"/><path d="m4 8 16-4"/><path d="m8.86 6.78-.45-1.81a2 2 0 0 1 1.45-2.43l1.94-.48a2 2 0 0 1 2.43 1.46l.45 1.8"/></svg>
                        <div class="peer-checked:font-bold">
                            Kitchen
                        </div>
                    </div>

                </label>

                <label class="card bg-base-200 shadow-sm p-6 cursor-pointer hover:bg-base-300 transition">
                    <input type="checkbox" name="amenities[]" value="Parking" class="hidden peer"/>
                    <div class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-motorbike-icon lucide-motorbike"><path d="m18 14-1-3"/><path d="m3 9 6 2a2 2 0 0 1 2-2h2a2 2 0 0 1 1.99 1.81"/><path d="M8 17h3a1 1 0 0 0 1-1 6 6 0 0 1 6-6 1 1 0 0 0 1-1v-.75A5 5 0 0 0 17 5"/><circle cx="19" cy="17" r="3"/><circle cx="5" cy="17" r="3"/></svg>
                        <div class="peer-checked:font-bold">
                            Parking
                        </div>
                    </div>

                </label>
            </div>
        </div>
    </section>
</div>
