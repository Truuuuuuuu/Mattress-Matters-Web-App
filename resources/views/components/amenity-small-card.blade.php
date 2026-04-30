@props(['amenity'])

<div class="flex flex-col items-start gap-3 bg-base-100  rounded-2xl p-4">
    <div class="bg-primary/10 p-2 rounded-xl ">
        <x-icon :name="'lucide-' . $amenity->icon" class="h-5 w-5 text-primary" />
    </div>
    <div>
        <h2 class="text-lg font-semibold text-primary">{{$amenity->description}}</h2>
        @php
            $amenityDesc = match($amenity->name){
                'wifi' => 'Fast and reliable internet access',
                'single_bed' => 'Comfortable single-sized bed for individual use',
                'bunk_bed' => 'Space-saving bunk bed suitable for shared rooms',
                'water_supply' => 'Continuous and accessible water service provided',
                'electricity' => 'Stable electrical power available for daily use',
                'parking' => 'Designated parking space for vehicles or motorcycles',
                'study_table' => 'Dedicated table for studying or working',
                'exterior_cctv' => 'Security cameras installed for safety and monitoring',
                default => 'Standard amenity provided as part of the accommodation'
            }
        @endphp
        <p class="text-base-content/70">{{$amenityDesc}}</p>
    </div>

</div>
