<x-layout>
    <x-slot:heading>Mattress Matters | {{$listing->title}}</x-slot:heading>

    <div class="px-5 lg:px-20">
        {{--Main content--}}
        <section class="mb-10">
            <h1 class="text-2xl font-bold mt-10 text-base-content">Mattress Matters in Sorsogon City</h1>
            <div class="grid lg:grid-cols-2 mt-5 gap-10">
                <div class=" rounded-2xl overflow-hidden ">
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
                <div class="text-base-content">
                    <h1 class="text-2xl font-semibold">{{$listing->title}}</h1>
                    <p>{{$listing->slot}} slot • 4 rooms • 2 bathrooms </p>
                    <div class="flex items-center gap-1 mb-10">
                        <x-lucide-star class="w-3 fill-base-content"/>
                        <p><strong>4.9</strong> • <span class="underline text-base-content/50 cursor-pointer">10 reviews</span></p>
                    </div>

                    {{--reserve card--}}
                    <div class="rounded-xl  mt-10 w-full  border border-black/30 py-5 px-3 lg:px-20 mb-10">
                        <div>
                            <h1 class="text-2xl font-semibold">₱{{number_format($listing->rent_cost)}} <span class="text-base-content/70 text-lg font-normal">monthly</span></h1>
                        </div>
                        <p class="text-base-content/50 text-sm">Only {{$listing->slot}} slot/s remaining</p>
                        <div class="mt-3">
                            @if(!auth()->check())
                                <a href="{{route('login')}}" class="btn btn-neutral w-full">Reserve</a>
                            @elseif($listing->slot >= 1 && auth()->user()->hasRole('tenant'))
                                <button onclick="document.getElementById('reservationModal').showModal()" class="btn btn-neutral w-full">Reserve</button>
                                @include('tenant.reservation.create', ['listing' => $listing])

                            @elseif($listing->slot == 0 && auth()->user()->hasRole('tenant'))
                                <button  class="btn btn-soft w-full" disabled>Not available</button>
                            @else
                                <p>...</p>
                            @endif

                            <p class="text-sm text-base-content/60 text-center mt-5">You won't be charged yet</p>
                        </div>
                    </div>

                    <x-divider class="bg-gray-300"/>
                    {{--host profile--}}

                    <a href="{{route('profile.show', $listing->host->user)}}">
                        <div class="py-5 flex justify-start gap-5">
                            <div class="btn btn-lg btn-circle btn-secondary ">
                                {{$listing->host->user->name[0]}}
                            </div>
                            <div>
                                @if(auth()->user()->id === $listing->host->user->id)
                                    <h1 class="font-semibold">Hosted by YOU</h1>
                                @else
                                    <h1 class="font-semibold">Hosted by {{$listing->host->user->name}}</h1>
                                @endif

                                <p class="text-base-content/70">Joined {{$listing->host->user->created_at->format('Y')}}</p>
                            </div>
                        </div>
                    </a>
                    <x-divider class="bg-gray-300"/>

                    {{--Description--}}
                    <h1 class="text-2xl font-semibold mt-7">Description</h1>
                    <p class="text-justify mt-3">
                        {{$listing->description}}
                    </p>

                    {{--Prefered Tenant--}}
                    <div class=" mt-7">
                        <h1 class="text-2xl font-semibold ">Preferred Tenants</h1>
                        <div class="grid lg:grid-cols-2 mt-3 gap-y-5">
                            @foreach($listing->rules->whereIn('name', ['gender_rule', 'tenant_rule']) as $rule)
                                <x-rule-small-card :$rule/>
                            @endforeach
                        </div>
                    </div>

                    {{--Amenities--}}
                    <div class=" mt-7">
                        <h1 class="text-2xl font-semibold ">Amenities</h1>
                        <div class="grid lg:grid-cols-2 mt-3 gap-y-5">
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

                                <div class="grid lg:grid-cols-2 mt-3 gap-y-5">
                                    @foreach($listing->amenities as $amenity)
                                        <x-amenity-small-card :$amenity/>
                                    @endforeach
                                </div>

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
        </section>



        <x-divider class="bg-gray-200"/>

        {{--What You Should Know--}}
        <section class="mb-20 ">
            <h1 class="text-2xl font-semibold mt-20 text-center ">What You Should Know</h1>
            <div class="lg:flex justify-center  gap-40 mt-15 space-y-3 lg:space-y-0 ">
                <div class="flex flex-1 flex-col items-center ">
                    <x-lucide-home class="w-8"/>
                    <h2 class="font-semibold mt-4">House rules</h2>
                    <div class="text-base-content/60 text-center">
                        @forelse($listing->rules->whereIn('name',['guest_rule', 'pet_rule', 'curfew_rule', 'smoking_rule']) as $rule)
                            <p>{{$rule->description}}</p>

                        @empty
                            <p>Not specified</p>
                        @endforelse
                        <p class="underline cursor-pointer text-blue-900">Learn more</p>
                    </div>
                </div>

                <div class="flex flex-1  flex-col items-center ">
                    <x-lucide-shield-check class="w-8"/>
                    <h2 class="font-semibold mt-4">Safety & Property</h2>
                    <div class="text-base-content/60 text-center ">
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

        <x-divider class="bg-gray-200"/>

        {{--Reviews--}}
        <section>
            <div class="grid lg:grid-cols-2 mt-10 gap-x-30 gap-y-10 mb-10">
                <x-review-card/>
                <x-review-card/>
                <x-review-card/>
                <x-review-card/>
                <x-review-card/>
                <x-review-card/>
            </div>
        </section>

    </div>

    <x-footer/>
</x-layout>





