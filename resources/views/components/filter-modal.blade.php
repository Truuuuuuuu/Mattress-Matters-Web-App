    <dialog id="feature_modal" class="modal modal-bottom  sm:modal-middle ">

        <div class="modal-box max-w-lg flex flex-col max-h-[90vh] p-0 ">
            {{--close btn--}}
            <div class="modal-action">
                <form method="dialog">
                    <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                </form>
            </div>

            <div class="overflow-y-auto flex-1 px-6 pt-6 pb-2">
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

                <div class="flex flex-wrap gap-4 w-full" id="rules_section">
                    @foreach($rules as $rule)
                        <x-option-exclusivity-badge type="checkbox" name="rules[]" value="{{$rule->id}}"
                                                    label="{{ucfirst($rule->description)}}" class="rule-option" >{{$rule->description}}
                        </x-option-exclusivity-badge>
                    @endforeach
                </div>
            </div>

            {{--Clear and results btn--}}
            <div class="sticky bottom-0 flex w-full gap-5 px-6 py-4 bg-base-100 border-t border-gray-200">
                <button id="clear_filters_btn" class="btn btn-ghost w-12">Clear</button>
                <form method="GET" action="{{route('listings.index')}}" class="flex-1" id="filter_form">
                    {{-- Price range hidden inputs (populated by your price range component) --}}
                    <input type="hidden" name="min_price" id="filter_min_price">
                    <input type="hidden" name="max_price" id="filter_max_price">
                    {{-- Mirror amenities checkboxes --}}
                    <div id="filter_amenities_mirror"></div>

                    {{-- Mirror exclusivity checkboxes --}}
                    <div id="filter_exclusivity_mirror"></div>

                    <button type="submit" class="btn btn-primary w-full">Show results</button>
                </form>
            </div>
        </div>
    </dialog>


