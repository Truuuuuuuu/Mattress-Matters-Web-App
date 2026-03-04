<div class="grid place-items-center">

    <section>
        <h1 class="text-3xl font-semibold mt-5 ">Basic Information</h1>
        <div class="lg:w-xl mt-5">

            <x-forms.form {{--method="POST" action="" --}}class="mt-5">
                <x-forms.input :label="false" name="title" type="text"
                               class="rounded-xl input input-neutral input-lg lg:input-md" placeholder="Title" required/>
                <x-forms.input :label="false" name="address" type="text"
                               class="rounded-xl input input-neutral input-lg lg:input-md mt-2" placeholder="Address"
                               required/>
                <textarea name="description" rows="7" id="description"
                          class="textarea border-base-content/50 mt-3 rounded-xl resize-none w-full overflow-y-auto"
                          placeholder="Description"></textarea>
            </x-forms.form>
        </div>
    </section>

    <section>
        <h1 class="text-3xl font-semibold mt-5">Availability</h1>
        <div class="lg:w-xl grid lg:grid-cols-2 mt-5 place-items-center ">

            <div class="overflow-hidden h-32 flex ">
                <img src="{{asset('images/slot-illustration.svg')}}" alt="" class="w-full h-full object-fit">
            </div>
            <div class=" flex flex-col justify-center">
                <label for="slot" class="text-base-content/50 text-lg ">Available</label>
                <div class="flex justify-start gap-5">
                    <H1 class="text-3xl font-bold leading-none">SLOT</H1>
                    <input type="number" id="slot" name="slot" min="1"
                           class="text-3xl w-30 border-b-3 border-black focus:ring-0 focus:outline-none block" required>
                </div>
                <p class="text-sm text-gray-500 mt-2">
                    Specify how many tenants this listing can accommodate.
                </p>
            </div>


        </div>
    </section>

</div>
