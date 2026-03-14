    <div class="space-y-10 px-25">
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
                        <input type="number" id="rent_cost" name="rent_cost" min="1" max="99999"
                               oninput="if(this.value.length > 5) this.value = this.value.slice(0,5);"
                               class="text-3xl w-64 border-b-3 border-black focus:ring-0 focus:outline-none block" required>
                    </div>

                    <p class="text-sm text-gray-500 mt-2">
                        Enter the monthly rent amount for this listing.
                    </p>
                    <p id="error-rent_cost" class="text-red-500 text-xs mt-1 hidden">Enter an exact amount of monthly rent</p>

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
                            <input type="number" id="electricity_cost" name="electricity_cost" min="0"  max="99999"
                                   oninput="if(this.value.length > 5) this.value = this.value.slice(0,5);"
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
                            <input type="number" id="water_supply_cost" name="water_supply_cost" min="0"  max="99999"
                                   oninput="if(this.value.length > 5) this.value = this.value.slice(0,5);"
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

        {{--Amenities--}}
        <section>
            <div>
                <h1 class="text-3xl font-semibold">What does your place offer?</h1>
                <div class="grid grid-cols-4 gap-4 mt-15">

                    @foreach($amenities as $amenity)
                        <x-option-card id="amenities" type="checkbox" name="amenities[]" value="{{$amenity->id}}" icon="{{$amenity->icon}}" label="{{ ucfirst($amenity->name) }}" >{{ucfirst($amenity->name)}}</x-option-card>
                    @endforeach

                </div>
            </div>
            <p id="error-amenities" class="text-red-500 text-xs mt-1 hidden">Please select at least one amenity</p>

        </section>
    </div>
