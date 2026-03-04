
<div class="space-y-10">
    <div class="grid px-20 mt-10"><h1 class="text-3xl font-semibold">Review & Confirm</h1></div>

    {{--STEP 1--}}
    <section>
        <div class="grid place-items-center">

            <section>
                <div class="flex items-center gap-4 my-6">
                    <div class="flex-1 h-px bg-base-content"></div>
                    <span class="text-sm font-semibold text-base-content">
                        STEP 1
                    </span>
                    <div class="flex-1 h-px bg-base-content"></div>
                </div>

                <h1 class="text-3xl font-semibold mt-5 text-base-content/50">Basic Information</h1>

                <div class="lg:w-xl mt-5">

                    <div class=" space-y-3 text-base-content/50">
                        <label for="review_title">Title</label>
                        <input  id="review_title" class="w-full border input input-neutral rounded-xl pointer-events-none " tabindex="-1" readonly>

                        <label for="review_address">Address</label>
                        <input id="review_address" class="w-full border input input-neutral rounded-xl pointer-events-none " tabindex="-1"  readonly>

                        <label for="review_description">Description</label>
                        <textarea rows="7" id="review_description" class="w-full border textarea textarea-neutral rounded-xl resize-none w-full overflow-y-auto" tabindex="-1"   readonly></textarea>
                    </div>
                </div>
            </section>

            <section>
                <h1 class="text-3xl font-semibold mt-5 text-base-content/50">Availability</h1>
                <div class="lg:w-xl grid lg:grid-cols-2 mt-5 place-items-center ">

                    <div class="overflow-hidden h-32 flex ">
                        <img src="{{asset('images/slot-illustration.svg')}}" alt="" class="w-full h-full object-fit">
                    </div>
                    <div class=" flex flex-col justify-center text-base-content/50">
                        <label for="slot" class="text-base-content/50 text-lg ">Available</label>
                        <div class="flex justify-start gap-5">
                            <H1 class="text-3xl font-bold leading-none">SLOT</H1>
                            <input type="number" id="review_slot"  min="1" readonly
                                   class="text-3xl w-30 border-b-3 border-black/40 focus:ring-0 focus:outline-none block" required>
                        </div>
                        <p class="text-sm text-gray-500 mt-2">
                            Specify how many tenants this listing can accommodate.
                        </p>
                    </div>
                </div>
            </section>

        </div>

    </section>

    {{--STEP 2--}}
    <section>
        <div class="space-y-10 px-25 text-base-content/50">
            <div class="flex items-center gap-4 my-6">
                <div class="flex-1 h-px bg-base-content"></div>
                <span class="text-sm font-semibold text-base-content">
                        STEP 2
                    </span>
                <div class="flex-1 h-px bg-base-content"></div>
            </div>
            <section>
                <h1 class="text-3xl font-semibold mt-5">Set your monthly rent</h1>
                <div class="grid lg:grid-cols-2 mt-15 ">

                    <div class="overflow-hidden h-32 ">
                        <img src="{{asset('images/house-rent.svg')}}" alt="" class="w-full h-full object-fit">
                    </div>
                    <div class=" px-10 py-6 flex flex-col justify-center">
                        <label for="price" class="text-base-content/50 text-lg ">Monthly</label>
                        <div class="flex justify-start gap-5">
                            <H1 class="text-3xl font-bold leading-none">PHP</H1>
                            <input type="number" id="review_rent_cost"  min="1" tabindex="-1"  readonly
                                   class="text-3xl w-64 border-b-3 border-black focus:ring-0 focus:outline-none block" required>
                        </div>
                        <p class="text-sm text-gray-500 mt-2">
                            Enter the monthly rent amount for this listing.
                        </p>
                    </div>
                </div>
            </section>

            {{--additional fee--}}
            <section>
                <h1 class="text-3xl font-semibold mt-5">Utility Charges <span class="text-base-content text-xl font-light italic">(optional)</span></h1>
                <div class="grid lg:grid-cols-2 mt-5 ">

                    <div class=" px-10 py-6 flex flex-col-2 justify-center  items-center gap-5">
                        <div>
                            <x-lucide-zap class="h-20 stroke-1"/>
                        </div>
                        <div>
                            <label for="electricity_cost" class="text-base-content/50 text-lg ">Electric</label>
                            <div class="flex justify-start gap-5">
                                <H1 class="text-3xl font-bold leading-none">PHP</H1>
                                <input type="number" id="review_electricity_cost"  min="0" tabindex="-1" readonly
                                       class="text-3xl w-64 border-b-3 border-black focus:ring-0 focus:outline-none block">
                            </div>
                            <div class="flex felx-col-2 items-center justify-start gap-1 mt-2">
                                <div>
                                    <x-lucide-info class="h-5 text-gray-500"/>
                                </div>
                                <div><p class="text-sm text-gray-500">
                                        Leave empty if utilities are included in the rent
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class=" px-10 py-6 flex flex-col-2 justify-center items-center gap-5">
                        <div>
                            <x-lucide-droplet class="h-20 stroke-1"/>
                        </div>
                        <div>
                            <label for="water_suppl_cost" class="text-base-content/50 text-lg text-start">Water</label>
                            <div class="flex justify-start gap-5">
                                <H1 class="text-3xl font-bold leading-none">PHP</H1>
                                <input type="number" id="review_water_supply_cost" min="0" tabindex="-1" readonly
                                       class="text-3xl w-64 border-b-3 border-black focus:ring-0 focus:outline-none block">
                            </div>
                            <div class="flex felx-col-2 items-center justify-start gap-1 mt-2">
                                <div>
                                    <x-lucide-info class="h-5 text-gray-500"/>
                                </div>
                                <div><p class="text-sm text-gray-500">
                                        Leave empty if utilities are included in the rent
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </section>

            {{-- Amenities --}}
            <section>
                <div>
                    <h1 class="text-3xl font-semibold">What does your place offer?</h1>
                    <div id="review_amenities" class="grid grid-cols-4 gap-4 mt-5">
                        <span class="text-stone-400 text-sm">—</span>
                    </div>
                </div>
            </section>
        </div>

    </section>

</div>
