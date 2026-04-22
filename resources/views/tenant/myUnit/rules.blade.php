<div class=" w-full ">
    <div class="flex flex-col items-start w-full  gap-3">
        <h1 class="text-4xl font-semibold">Life at the Unit</h1>
        <p class="lg:w-180 text-base-content/70">Everything you need to know about your shared ecosystem, from quality facilities to the core principles that
            keep our community thriving</p>
    </div>
    <div class="flex flex-col lg:grid grid-cols-[2fr_1fr] mt-10 gap-5">
        <div >
            <h2 class="text-xl font-semibold mb-5">Amenities</h2>
            <div class="grid grid-cols-2 gap-3 ">
                @foreach($myUnit->listing->amenities as $amenity)
                        <x-amenity-small-card :$amenity/>
                @endforeach
            </div>
        </div>
        <div>
            <h2 class="text-xl font-semibold mb-5">House Rules</h2>
            <div class="space-y-4 border rounded-xl p-6" >
                @foreach($myUnit->listing->rules as $rule)
                    <x-rule-small-card :$rule/>
                @endforeach
            </div>
        </div>
    </div>
</div>

