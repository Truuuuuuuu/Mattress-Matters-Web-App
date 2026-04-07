{{-- Range slider --}}
<div class="relative h-8 mx-2">

    {{-- Track background --}}
    <div class="absolute top-1/2 -translate-y-1/2 w-full h-1.5 rounded-full bg-base-300"></div>

    {{-- Track fill (controlled by JS) --}}
    <div id="trackFill" class="absolute top-1/2 -translate-y-1/2 h-1.5 rounded-full bg-primary pointer-events-none"></div>

    {{-- Min thumb --}}
    <input type="range"
           id="minRange"
           min="1000" max="6000" value="1000" step="10"
           class="absolute w-full top-1/2 -translate-y-1/2
                  appearance-none bg-transparent pointer-events-none
                  [&::-webkit-slider-thumb]:appearance-none
                  [&::-webkit-slider-thumb]:pointer-events-auto
                  [&::-webkit-slider-thumb]:w-5
                  [&::-webkit-slider-thumb]:h-5
                  [&::-webkit-slider-thumb]:rounded-full
                  [&::-webkit-slider-thumb]:bg-primary
                  [&::-webkit-slider-thumb]:border-[3px]
                  [&::-webkit-slider-thumb]:border-white
                  [&::-webkit-slider-thumb]:shadow-md
                  [&::-webkit-slider-thumb]:cursor-grab
                  [&::-moz-range-thumb]:appearance-none
                  [&::-moz-range-thumb]:pointer-events-auto
                  [&::-moz-range-thumb]:w-5
                  [&::-moz-range-thumb]:h-5
                  [&::-moz-range-thumb]:rounded-full
                  [&::-moz-range-thumb]:bg-primary
                  [&::-moz-range-thumb]:border-[3px]
                  [&::-moz-range-thumb]:border-white
                  [&::-moz-range-thumb]:cursor-grab"
    />

    {{-- Max thumb --}}
    <input type="range"
           id="maxRange"
           min="1000" max="6000" value="6000" step="10"
           class="absolute w-full top-1/2 -translate-y-1/2
                  appearance-none bg-transparent pointer-events-none
                  [&::-webkit-slider-thumb]:appearance-none
                  [&::-webkit-slider-thumb]:pointer-events-auto
                  [&::-webkit-slider-thumb]:w-5
                  [&::-webkit-slider-thumb]:h-5
                  [&::-webkit-slider-thumb]:rounded-full
                  [&::-webkit-slider-thumb]:bg-primary
                  [&::-webkit-slider-thumb]:border-[3px]
                  [&::-webkit-slider-thumb]:border-white
                  [&::-webkit-slider-thumb]:shadow-md
                  [&::-webkit-slider-thumb]:cursor-grab
                  [&::-moz-range-thumb]:appearance-none
                  [&::-moz-range-thumb]:pointer-events-auto
                  [&::-moz-range-thumb]:w-5
                  [&::-moz-range-thumb]:h-5
                  [&::-moz-range-thumb]:rounded-full
                  [&::-moz-range-thumb]:bg-primary
                  [&::-moz-range-thumb]:border-[3px]
                  [&::-moz-range-thumb]:border-white
                  [&::-moz-range-thumb]:cursor-grab"
    />

</div>
<div class="flex justify-between items-center mb-4">
    <div>
        <p class="text-sm text-center">Minimum</p>
        <div class="badge badge-primary badge-outline font-semibold px-3 py-3" id="minLabel"></div>
    </div>

    <span class="text-base-content/30 text-sm">–</span>

    <div>
        <p class="text-sm text-center">Maximum</p>
        <div class="badge badge-primary badge-outline font-semibold px-3 py-3" id="maxLabel"></div>
    </div>

</div>
