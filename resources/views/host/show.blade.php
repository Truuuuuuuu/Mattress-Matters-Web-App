<x-layout>
    <x-slot:heading>Mattress Matters | {{$listing->title}}</x-slot:heading>

    <div class="px-20">
        {{--Main content--}}
        <section class="mb-10">
            <div class="flex justify-between  items-center mt-15  ">
                <h1 class="text-2xl font-bold text-base-content">Mattress Matters in Sorsogon City</h1>
                {{--<a href="{{route('host.edit', $listing)}}" class="btn btn-neutral">Edit Listing</a>--}}
                <div class="hidden lg:flex dropdown dropdown-end" >
                    <div class="btn btn-ghost  rounded-xl " tabindex="0" role="button">
                        <x-lucide-ellipsis-vertical class="w-5 h-5"/>
                    </div>
                    <ul tabindex="0" class="dropdown-content menu bg-base-100 rounded-box z-50 mt-13 w-52 p-2 shadow-sm font-normal">
                        <li><a href="{{route('host.edit', $listing)}}" >Edit</a></li>
                        <li >
                                <form method="POST" action="{{route('host.delete', $listing)}} " class="hover:bg-red-100 hover:text-red-900">
                                    @csrf
                                    @method('DELETE')
                                    <button class="hover:cursor-pointer">Delete</button>
                                </form>

                        </li>
                    </ul>
                </div>

            </div>
            <div class="grid grid-cols-2 mt-5 gap-10">
                <div class=" rounded-2xl overflow-hidden">

                    @php
                        $cover = $listing->listingImages->where('is_cover', true)->first();
                        $add_photos = $listing->listingImages->where('is_cover', false);
                    @endphp
                    {{--big photo--}}
                    <div>
                        <img src="{{ asset('storage/' . $cover->image_path) }}" alt="" class="w-full h-full object-cover">
                    </div>

                    {{--smaller photo--}}
                    <div class="grid grid-cols-2 rounded-b-2xl overflow-hidden gap-2 mt-2">
                        @forelse($add_photos as $add_photo)
                        <div>
                            <img src="{{asset('storage/' . $add_photo->image_path)}}" alt="" class="w-full h-full object-cover">
                        </div>
                        @empty
                            {{-- Empty State --}}
                            <div id="empty-cover" class="flex flex-col items-center justify-center gap-2 text-stone-400 group-hover:text-primary transition-colors duration-200 border border-black/20 p-5 mb-5">
                                <div class="w-14 h-14 rounded-full bg-stone-200 group-hover:bg-primary/20 transition-colors duration-200 flex items-center justify-center">
                                    <x-lucide-image class="w-6 h-6"/>
                                </div>
                                <div class="text-center px-4">
                                    <p class="font-semibold text-sm">Additional Photo</p>
                                </div>
                            </div>
                            {{-- Empty State --}}
                            <div id="empty-cover" class="flex flex-col items-center justify-center gap-2 text-stone-400 group-hover:text-primary transition-colors duration-200 border border-black/20 p-5 mb-5">
                                <div class="w-14 h-14 rounded-full bg-stone-200 group-hover:bg-primary/20 transition-colors duration-200 flex items-center justify-center">
                                    <x-lucide-image class="w-6 h-6"/>
                                </div>
                                <div class="text-center px-4">
                                    <p class="font-semibold text-sm">Additional Photo</p>
                                </div>
                            </div>
                        @endforelse
                    </div>

                </div>
                <div class="px-5 text-base-content">
                    <h1 class="text-2xl font-semibold">{{$listing->title}}</h1>
                    <div class="flex gap-1  items-center ">
                        <x-lucide-map-pin class="w-4 h-4"/>
                        <p class="text-base-content/70"><span>{{$listing->address}}</p>
                    </div>

                    <div class="flex items-center gap-1 mb-5">
                        <x-lucide-star class="w-3 h-3 fill-black"/>
                        <p><strong>4.9</strong> • <span class="underline text-base-content/50 cursor-pointer">10 reviews</span></p>
                    </div>

                    {{--reserve card--}}
                    <div class="rounded-xl mt-8  border border-black/30 py-5 mb-10 grid grid-cols-2 place-items-center">
                        <div >
                            <h1 class="text-2xl font-semibold">₱{{number_format($listing->rent_cost)}} <span class="text-base-content/70 text-lg font-normal">monthly</span></h1>
                        </div>
                        <div >
                            <p class="text-base-content/50 text-md">Only <strong>{{$listing->slot}}</strong> slot/s remaining</p>
                        </div>
                    </div>

                    <x-divider class="bg-gray-300"/>

                    <div class="space-y-8 mt-8">
                        {{--Description--}}
                        <div>
                            <h1 class="text-2xl font-semibold ">Description</h1>
                            <p class="text-justify ">
                                {{$listing->description}}
                            </p>
                        </div>

                        {{--Prefered Tenant--}}
                        <div><h1 class="text-2xl font-semibold ">Preferred Tenants</h1>
                            <div class="grid grid-cols-2 mt-3 gap-y-5">
                                @foreach($listing->rules->whereIn('name', ['gender_rule', 'tenant_rule']) as $rule)
                                    <x-rule-small-card :$rule/>
                                @endforeach
                            </div>
                        </div>

                        {{--Amenities--}}
                        <div><h1 class="text-2xl font-semibold ">Amenities</h1>
                            <div class="grid grid-cols-2 mt-3 gap-y-5">
                                @foreach($listing->amenities as $amenity)
                                    <x-amenity-small-card :$amenity/>
                                @endforeach
                            </div>
                        </div>
                        {{--show all modal btn--}}
                        <div class="mt-5">
                            <!-- Open the modal using ID.showModal() method -->
                            <button class="btn border-base-content/70 rounded-2xl px-9" onclick="amenities_modal.showModal()">Show all</button>
                            <dialog id="amenities_modal" class="modal modal-bottom  sm:modal-middle">
                                <div class="modal-box max-w-lg">
                                    {{--content--}}
                                    <h3 class="text-2xl font-semibold mb-5">All Amenities</h3>

                                    <div class="flex items-center gap-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-fan-icon lucide-fan"><path d="M10.827 16.379a6.082 6.082 0 0 1-8.618-7.002l5.412 1.45a6.082 6.082 0 0 1 7.002-8.618l-1.45 5.412a6.082 6.082 0 0 1 8.618 7.002l-5.412-1.45a6.082 6.082 0 0 1-7.002 8.618l1.45-5.412Z"/><path d="M12 12v.01"/></svg>
                                        <p class="text-lg">Electric fan</p>
                                    </div>

                                    <x-divider class="bg-gray-200 my-5"/>

                                    <div class="flex items-center gap-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-fan-icon lucide-fan"><path d="M10.827 16.379a6.082 6.082 0 0 1-8.618-7.002l5.412 1.45a6.082 6.082 0 0 1 7.002-8.618l-1.45 5.412a6.082 6.082 0 0 1 8.618 7.002l-5.412-1.45a6.082 6.082 0 0 1-7.002 8.618l1.45-5.412Z"/><path d="M12 12v.01"/></svg>
                                        <p class="text-lg">Electric fan</p>
                                    </div>

                                    <x-divider class="bg-gray-200 my-5"/>

                                    <div class="flex items-center gap-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-fan-icon lucide-fan"><path d="M10.827 16.379a6.082 6.082 0 0 1-8.618-7.002l5.412 1.45a6.082 6.082 0 0 1 7.002-8.618l-1.45 5.412a6.082 6.082 0 0 1 8.618 7.002l-5.412-1.45a6.082 6.082 0 0 1-7.002 8.618l1.45-5.412Z"/><path d="M12 12v.01"/></svg>
                                        <p class="text-lg">Electric fan</p>
                                    </div>

                                    <x-divider class="bg-gray-200 my-5"/>

                                    <div class="modal-action">
                                        <form method="dialog">
                                            {{--close btn--}}
                                            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                                        </form>
                                    </div>
                                </div>
                            </dialog>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <x-divider class="bg-gray-200"/>

        {{--Reviews--}}
        <section>
            <div class="grid grid-cols-2 mt-10 gap-x-30 gap-y-10 mb-10">
                <x-review-card/>
                <x-review-card/>
                <x-review-card/>
                <x-review-card/>
                <x-review-card/>
                <x-review-card/>
            </div>
        </section>

        <x-divider class="bg-gray-200"/>

        {{--What You Should Know--}}
        <section class="mb-20 ">
            <h1 class="text-2xl font-semibold mt-20 text-center">What You Should Know</h1>
            <div class="flex justify-center gap-x-40 mt-15">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-house-icon lucide-house"><path d="M15 21v-8a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v8"/><path d="M3 10a2 2 0 0 1 .709-1.528l7-6a2 2 0 0 1 2.582 0l7 6A2 2 0 0 1 21 10v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/></svg>
                    <h2 class="font-semibold mt-4">House rules</h2>
                    <div class="text-base-content/60">
                        @forelse($listing->rules->whereIn('name',['guest_rule', 'pet_rule', 'curfew_rule', 'smoking_rule']) as $rule)
                            <p>{{$rule->description}}</p>

                        @empty
                            <p>Not specified</p>
                        @endforelse
                        <p class="underline cursor-pointer text-blue-900">Learn more</p>
                    </div>
                </div>

                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shield-check-icon lucide-shield-check"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/><path d="m9 12 2 2 4-4"/></svg>
                    <h2 class="font-semibold mt-4">Safety & Property</h2>
                    <div class="text-base-content/60">
                        @forelse($listing->amenities->where('id', 8) as $safety)
                            <p>Exterior CCTV</p>

                        @empty
                            <p>Not specified</p>
                        @endforelse
                        <p class="underline cursor-pointer text-blue-900">Learn more</p>
                    </div>
                </div>
            </div>
        </section>

    </div>

    <x-footer/>
</x-layout>


