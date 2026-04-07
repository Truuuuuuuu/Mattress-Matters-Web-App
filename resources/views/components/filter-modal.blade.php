    <dialog id="feature_modal" class="modal modal-bottom  sm:modal-middle ">
        <div class="modal-box max-w-lg ">
            {{--content--}}
            <h3 class="text-xl font-normal mb-3 w-full text-center">Filters</h3>
            <x-divider class="bg-gray-200 mb-5"/>

            {{--Price range--}}
            <h1 class="text-xl font-semibold">Price range</h1>
            <x-price-range/>

            <x-divider class="bg-gray-200 my-5"/>
            {{--Amenities--}}
            <h1 class="text-xl font-semibold mb-3">Amenities</h1>
            <div class="flex flex-wrap gap-4 w-full">
                @foreach($amenities as $amenity)
                    <x-option-card id="amenities" type="checkbox" name="amenities[]" value="{{$amenity->id}}" icon="{{$amenity->icon}}" label="{{ ucfirst($amenity->name) }}"> {{ ucfirst($amenity->description )}} </x-option-card>
                @endforeach
            </div>
            <x-divider class="bg-gray-200 my-5"/>

            {{--Exclusivity--}}
            <h1 class="text-xl font-semibold mb-3">Exclusivity</h1>
            <div class="grid grid-cols-3 gap-4 w-full">
                @foreach($rules as $rule)
                    <x-option-card type="radio" name="{{$rule->name}}" value="{{$rule->id}}" icon="{{$rule->icon}}"
                                   label="{{ucfirst($rule->description)}}" >{{$rule->description}}

                    </x-option-card>
                @endforeach
            </div>
            <div class="modal-action">
                <form method="dialog">
                    {{--close btn--}}
                    <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                </form>
            </div>
            <div class="flex w-full gap-5">
                <button class="btn btn-ghost w-12">Clear</button>
                <button class="btn btn-primary flex-1">Show all</button>
            </div>
        </div>
    </dialog>
