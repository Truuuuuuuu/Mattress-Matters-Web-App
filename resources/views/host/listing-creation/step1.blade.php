<div class="grid place-items-center bg-base-200">

    <section>
        <h1 class="text-3xl font-semibold mt-5 text-primary">Basic Information</h1>
        <div class="w-full max-w-xl mt-5">

                <input name="title" type="text" id="title" maxlength="50"
                               class="w-full rounded-2xl focus:input-primary input input-default input-lg lg:input-md" placeholder="Title" required/>
                <p id="error-title" class="text-red-500 text-xs mt-1 hidden">Title must be at least 8 characters.</p>

                <input  name="address" type="text" id="address" maxlength="100"
                               class="w-full rounded-2xl focus:input-primary input input-default bg-base-100 input-lg lg:input-md mt-2" placeholder="Address"
                               required/>
                <p id="error-address" class="text-red-500 text-xs mt-1 hidden">Address must be at least 10 characters.</p>

                <textarea name="description" rows="7" id="description" maxlength="2000"
                          class="textarea border-base-400 focus:textarea-primary  mt-3 rounded-2xl resize-none w-full overflow-y-auto"
                          placeholder="Description"></textarea>
                <p id="error-description" class="text-red-500 text-xs mt-1 hidden">Please enter a description with at least 20 characters</p>

        </div>
    </section>

    <section>
        <h1 class="text-3xl font-semibold mt-5 text-primary">Availability</h1>
        <div class="w-full max-w-xl grid md:grid-cols-2 mt-5 place-items-center ">

            <div class="hidden md:flex overflow-hidden h-32  ">
                <img src="{{asset('images/slot-illustration.svg')}}" alt="" class="w-full h-full object-fit">
            </div>
            <div class=" flex flex-col justify-center">
                <label for="slot" class="text-base-content/50 text-lg ">Available</label>
                <div class="flex justify-start gap-5">
                    <H1 class="text-3xl font-bold leading-none">SLOT</H1>
                    <input type="number" id="slot" name="slot" min="1" max="15"
                           oninput="if (this.value > 15) this.value = 15;"
                           class="text-3xl w-32 border-b-3 border-black focus:ring-0 focus:outline-none block" required>
                </div>
                <p class="text-sm text-gray-500 mt-2">
                    Specify how many tenants this listing can accommodate. <span class="text-base-content/50 italic">You can add up to 15 slots only.</span>
                </p>
                <p id="error-slot" class="text-red-500 text-xs mt-1 hidden">Please enter how many slots are available for this listing</p>
            </div>
        </div>
    </section>

</div>
