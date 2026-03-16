<x-layout>
    <x-slot:heading>Edit page</x-slot:heading>

    <div class="px-20 py-10">
        <x-forms.form method="PATCH" action="{{ route('host.update', $listing) }}" enctype="multipart/form-data">
            {{--Basic info--}}
            <section class="space-y-5">
                <div>
                    <h1 class="text-3xl font-semibold mt-5 ">Basic Information</h1>
                    <div class="space-y-6 py-5">
                        <x-forms.input name="title" label="Title" :value="old('title', $listing->title)" placeholder="Title"
                                   class="rounded-xl input input-primary input-lg lg:input-md"/>

                        <x-forms.input name="address" label="Address" :value="old('address', $listing->address)"
                                   class="rounded-xl input input-primary input-lg lg:input-md"/>

                        <x-forms.textarea name="description" label="Description" :value="old('description', $listing->description)" placeholder="Description"
                                    class="rounded-xl textarea textarea-primary"/>
                    </div>
                </div>

                <div>
                    <h1 class="text-3xl font-semibold mt-5 ">Availability</h1>
                    <div class="lg:w-full grid lg:grid-cols-2 mt-5 place-items-center ">

                        <div class="overflow-hidden h-32 flex ">
                            <img src="{{asset('images/slot-illustration.svg')}}" alt="" class=" w-full h-full object-fit">
                        </div>
                        <div class=" flex flex-col justify-center">
                            <label for="slot" class="text-base-content/50 text-lg ">Available</label>
                            <div class="flex justify-start gap-5">
                                <H1 class="text-3xl font-bold leading-none">SLOT</H1>
                                <input type="number" id="slot" name="slot" min="1" max="15" value="{{$listing->slot}}"
                                       oninput="if (this.value > 15) this.value = 15;"
                                       class="text-3xl w-30 border-b-3 border-black focus:ring-0 focus:outline-none block" required>
                            </div>
                            <p class="text-sm text-gray-500 mt-2">
                                Specify how many tenants this listing can accommodate. <span class="text-base-content/50 italic">You can add up to 15 slots only.</span>
                            </p>
                            <p id="error-slot" class="text-red-500 text-xs mt-1 hidden">Please enter how many slots are available for this listing</p>
                        </div>


                    </div>

                </div>
            </section>

            {{--Pricing & Amenities--}}
            <section>
                <div class="space-y-10 ">
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
                                    <input type="number" id="rent_cost" name="rent_cost" min="1" max="99999" value="{{$listing->rent_cost}}"
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
                        <div class="flex gap-2 items-center">
                            <div>
                                <x-lucide-info class="h-3 text-gray-500"/>
                            </div>
                            <div><p class="text-xs text-gray-500">
                                    Leave empty if utilities are included in the rent
                                </p>
                            </div>
                        </div>
                        <div class="grid lg:grid-cols-2 mt-5 ">

                            <div class=" flex flex-col-2 justify-center  items-center gap-5 ">
                                <div>
                                    <x-lucide-zap class="h-20 stroke-1"/>
                                </div>
                                <div>
                                    <label for="electricity_cost" class="text-base-content/50 text-lg ">Electricity</label>
                                    <div class="flex justify-start gap-5">
                                        <H1 class="text-3xl font-bold leading-none">PHP</H1>
                                        <input type="number" id="electricity_cost" name="electricity_cost" min="0"  max="99999" value="{{$listing->electricity_cost}}"
                                               oninput="if(this.value.length > 5) this.value = this.value.slice(0,5);"
                                               class="text-3xl w-32 border-b-3 border-black focus:ring-0 focus:outline-none block">
                                    </div>

                                </div>
                            </div>



                            <div class=" px-10 py-6 flex flex-col-2 justify-center items-center gap-5">
                                <div>
                                    <x-lucide-droplet class="h-20 stroke-1"/>
                                </div>
                                <div>
                                    <label for="water_suppl_cost" class="text-base-content/50 text-lg text-start">Water Supply</label>
                                    <div class="flex justify-start gap-5">
                                        <H1 class="text-3xl font-bold leading-none">PHP</H1>
                                        <input type="number" id="water_supply_cost" name="water_supply_cost" min="0"  max="99999" value="{{$listing->water_supply_cost}}"
                                               oninput="if(this.value.length > 5) this.value = this.value.slice(0,5);"
                                               class="text-3xl w-32 border-b-3 border-black focus:ring-0 focus:outline-none block">
                                    </div>

                                </div>
                            </div>


                        </div>
                    </section>

                    {{-- Amenities --}}
                    <section>
                        <div>
                            <h1 class="text-3xl font-semibold">What does your place offer?</h1>
                            <div class="grid grid-cols-3 gap-4 mt-5">

                                @foreach($amenities as $amenity)
                                    <x-option-card
                                        id="amenity-{{ $amenity->id }}"
                                        type="checkbox"
                                        name="amenities[]"
                                        value="{{ $amenity->id }}"
                                        icon="{{ $amenity->icon }}"
                                        label="{{ ucfirst($amenity->name) }}"
                                        :checked="in_array($amenity->id, $listingAmenityIds)"
                                    >
                                        {{ ucfirst($amenity->name) }}
                                    </x-option-card>
                                @endforeach

                            </div>
                        </div>
                        <p id="error-amenities" class="text-red-500 text-xs mt-1 hidden">Please select at least one amenity</p>
                    </section>
                </div>
            </section>

            {{--Photos--}}
            <section>
                <div >
                    <section>
                        <div class="flex flex-col justify-center items-center">
                            <div class="w-full  mt-10 text-base-content mb-5">
                                <h1 class="text-3xl font-semibold">Update your photos</h1>
                                <p class="text-base-content/70 text-sm">Update your cover photo or additional photos.</p>
                            </div>

                            <div class="w-full ">
                                <div class="grid grid-cols-[2fr_1fr] gap-4">

                                    <div>
                                        {{-- Cover Photo --}}
                                        @php $cover = $listing->listingImages->where('is_cover', true)->first(); @endphp
                                        <div
                                            id="zone-cover"
                                            onclick="document.getElementById('input-cover').click()"
                                            ondragover="handleDragOver(event, 'cover')"
                                            ondragleave="handleDragLeave(event, 'cover')"
                                            ondrop="handleDrop(event, 'cover')"
                                            class="relative group overflow-hidden rounded-2xl border-2 border-dashed border-stone-300 bg-stone-50 hover:border-primary hover:bg-primary/10 cursor-pointer transition-all duration-300 h-full flex flex-col items-center justify-center gap-2"
                                        >
                                            {{-- Empty State --}}
                                            <div id="empty-cover" class="{{ $cover ? 'hidden' : '' }} flex flex-col items-center justify-center gap-2 text-stone-400 group-hover:text-primary transition-colors duration-200">
                                                <div class="w-14 h-14 rounded-full bg-stone-200 group-hover:bg-primary/20 transition-colors duration-200 flex items-center justify-center">
                                                    <x-lucide-image-plus class="w-6 h-6"></x-lucide-image-plus>
                                                </div>
                                                <div class="text-center px-4">
                                                    <p class="font-semibold text-sm">Upload Cover Photo</p>
                                                    <p class="text-xs text-stone-400 mt-0.5">Click or drag & drop</p>
                                                </div>
                                            </div>

                                            {{-- Preview --}}
                                            <img id="preview-cover"
                                                 src="{{ $cover ? asset('storage/' . $cover->image_path) : '' }}"
                                                 alt="Cover preview"
                                                 class="{{ $cover ? '' : 'hidden' }} absolute inset-0 w-full h-full object-cover" />

                                            {{-- Cover Badge --}}
                                            <div id="badge-cover" class="{{ $cover ? '' : 'hidden' }} absolute top-3 left-3 flex items-center gap-1.5 bg-amber-400 text-white text-xs font-bold px-2.5 py-1 rounded-full shadow z-10">
                                                <x-lucide-star class="w-3 h-3 fill-white"></x-lucide-star>
                                                Cover Photo
                                            </div>

                                            {{-- Hover Actions --}}
                                            <div id="actions-cover" class="{{ $cover ? '' : 'hidden' }} absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-200 flex items-center justify-center gap-3 z-20">
                                                <button type="button"
                                                        onclick="event.stopPropagation(); document.getElementById('input-cover').click()"
                                                        class="bg-white/90 hover:bg-white text-stone-700 text-xs font-semibold px-3 py-1.5 rounded-lg transition">
                                                    Replace
                                                </button>
                                                <button type="button"
                                                        onclick="event.stopPropagation(); clearImage('cover')"
                                                        class="bg-red-500/90 hover:bg-red-500 text-white text-xs font-semibold px-3 py-1.5 rounded-lg transition">
                                                    Remove
                                                </button>
                                            </div>

                                            {{-- Hidden input to track existing cover image ID --}}
                                            @if($cover)
                                                <input type="hidden" name="existing_cover_id" id="existing-cover-id" value="{{ $cover->id }}" />
                                            @endif
                                            <input type="hidden" name="remove_cover" id="remove-cover" value="0" />
                                            <input type="file" id="input-cover" name="cover_photo" accept="image/*" class="hidden"
                                                   onchange="handleFileSelect(this, 'cover')" />
                                        </div>
                                    </div>

                                    <div class="flex flex-col ">
                                        {{-- Two Additional Photos --}}
                                        @php $additionalPhotos = $listing->listingImages->where('is_cover', false)->values(); @endphp
                                        <div class="space-y-3">

                                            {{-- Photo 1 --}}
                                            @php $photo1 = $additionalPhotos->get(0); @endphp
                                            <div
                                                id="zone-photo1"
                                                onclick="document.getElementById('input-photo1').click()"
                                                ondragover="handleDragOver(event, 'photo1')"
                                                ondragleave="handleDragLeave(event, 'photo1')"
                                                ondrop="handleDrop(event, 'photo1')"
                                                class="relative group overflow-hidden rounded-2xl border-2 border-dashed border-stone-300 bg-stone-50 hover:border-primary hover:bg-primary/10 cursor-pointer transition-all duration-300 h-40 flex items-center justify-center"
                                            >
                                                <div id="empty-photo1" class="{{ $photo1 ? 'hidden' : '' }} flex flex-col items-center justify-center gap-2 text-stone-400 group-hover:text-primary transition-colors duration-200">
                                                    <div class="w-10 h-10 rounded-full bg-stone-200 group-hover:bg-primary/20 transition-colors duration-200 flex items-center justify-center">
                                                        <x-lucide-image-plus class="w-4 h-4"></x-lucide-image-plus>
                                                    </div>
                                                    <div class="text-center px-2">
                                                        <p class="font-semibold text-xs">Additional Photo</p>
                                                        <p class="text-[11px] text-stone-400">Click or drag & drop</p>
                                                    </div>
                                                </div>

                                                <img id="preview-photo1"
                                                     src="{{ $photo1 ? asset('storage/' . $photo1->image_path) : '' }}"
                                                     alt="Photo 1 preview"
                                                     class="{{ $photo1 ? '' : 'hidden' }} absolute inset-0 w-full h-full object-cover" />

                                                <div id="actions-photo1" class="{{ $photo1 ? '' : 'hidden' }} absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-200 flex items-center justify-center gap-2 z-20">
                                                    <button type="button"
                                                            onclick="event.stopPropagation(); document.getElementById('input-photo1').click()"
                                                            class="bg-white/90 hover:bg-white text-stone-700 text-xs font-semibold px-2 py-1 rounded-lg transition">
                                                        Replace
                                                    </button>
                                                    <button type="button"
                                                            onclick="event.stopPropagation(); clearImage('photo1')"
                                                            class="bg-red-500/90 hover:bg-red-500 text-white text-xs font-semibold px-2 py-1 rounded-lg transition">
                                                        Remove
                                                    </button>
                                                </div>

                                                @if($photo1)
                                                    <input type="hidden" name="existing_photo1_id" id="existing-photo1-id" value="{{ $photo1->id }}" />
                                                @endif
                                                <input type="hidden" name="remove_photo1" id="remove-photo1" value="0" />
                                                <input type="file" id="input-photo1" name="image_photo1" accept="image/*" class="hidden"
                                                       onchange="handleFileSelect(this, 'photo1')" />
                                            </div>

                                            {{-- Photo 2 --}}
                                            @php $photo2 = $additionalPhotos->get(1); @endphp
                                            <div
                                                id="zone-photo2"
                                                onclick="document.getElementById('input-photo2').click()"
                                                ondragover="handleDragOver(event, 'photo2')"
                                                ondragleave="handleDragLeave(event, 'photo2')"
                                                ondrop="handleDrop(event, 'photo2')"
                                                class="relative group overflow-hidden rounded-2xl border-2 border-dashed border-stone-300 bg-stone-50 hover:border-primary hover:bg-primary/10 cursor-pointer transition-all duration-300 h-40 flex items-center justify-center"
                                            >
                                                <div id="empty-photo2" class="{{ $photo2 ? 'hidden' : '' }} flex flex-col items-center justify-center gap-2 text-stone-400 group-hover:text-primary transition-colors duration-200">
                                                    <div class="w-10 h-10 rounded-full bg-stone-200 group-hover:bg-primary/20 transition-colors duration-200 flex items-center justify-center">
                                                        <x-lucide-image-plus class="w-4 h-4"></x-lucide-image-plus>
                                                    </div>
                                                    <div class="text-center px-2">
                                                        <p class="font-semibold text-xs">Additional Photo</p>
                                                        <p class="text-[11px] text-stone-400">Click or drag & drop</p>
                                                    </div>
                                                </div>

                                                <img id="preview-photo2"
                                                     src="{{ $photo2 ? asset('storage/' . $photo2->image_path) : '' }}"
                                                     alt="Photo 2 preview"
                                                     class="{{ $photo2 ? '' : 'hidden' }} absolute inset-0 w-full h-full object-cover" />

                                                <div id="actions-photo2" class="{{ $photo2 ? '' : 'hidden' }} absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-200 flex items-center justify-center gap-2 z-20">
                                                    <button type="button"
                                                            onclick="event.stopPropagation(); document.getElementById('input-photo2').click()"
                                                            class="bg-white/90 hover:bg-white text-stone-700 text-xs font-semibold px-2 py-1 rounded-lg transition">
                                                        Replace
                                                    </button>
                                                    <button type="button"
                                                            onclick="event.stopPropagation(); clearImage('photo2')"
                                                            class="bg-red-500/90 hover:bg-red-500 text-white text-xs font-semibold px-2 py-1 rounded-lg transition">
                                                        Remove
                                                    </button>
                                                </div>

                                                @if($photo2)
                                                    <input type="hidden" name="existing_photo2_id" id="existing-photo2-id" value="{{ $photo2->id }}" />
                                                @endif
                                                <input type="hidden" name="remove_photo2" id="remove-photo2" value="0" />
                                                <input type="file" id="input-photo2" name="image_photo2" accept="image/*" class="hidden"
                                                       onchange="handleFileSelect(this, 'photo2')" />
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <p id="photoCount" class="text-xs text-primary/70 mt-3"></p>

                                @error('cover_photo')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                                @enderror
                                @error('images.*')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </section>
                </div>
            </section>

            {{--Rules and policy--}}
            <section>
                <div class="space-y-10 mt-15">
                    <section>
                        <div class="space-y-10">
                            @php
                                $allRules = [
                                    'Gender'  => $genderRules,
                                    'Tenant'  => $tenantRules,
                                    'Guest'   => $guestRules,
                                    'Pet'     => $petRules,
                                    'Curfew'  => $curfewRules,
                                    'Smoking' => $smokingRules,
                                ];
                            @endphp

                            @foreach($allRules as $header => $rules)
                                <section>
                                    <div>
                                        <h1 class="text-3xl font-semibold">{{ $header }} Policy</h1>
                                        <div class="{{ $rules->count() === 3 ? 'grid grid-cols-3' : 'grid grid-cols-2' }} gap-7 mt-5">
                                            @foreach($rules as $rule)
                                                <x-option-card
                                                    type="radio"
                                                    name="{{ $rule->name }}"
                                                    value="{{ $rule->id }}"
                                                    icon="{{ $rule->icon }}"
                                                    label="{{ ucfirst($rule->description) }}"
                                                    :checked="in_array($rule->id, $listingRuleIds)"
                                                >
                                                    {{ $rule->description }}
                                                </x-option-card>
                                            @endforeach
                                        </div>
                                        <p id="error-{{ $rules->first()->name }}" class="text-red-500 text-xs mt-1 hidden">
                                            Please select a {{ strtolower($header) }}.
                                        </p>
                                    </div>
                                </section>
                            @endforeach
                        </div>
                    </section>
                </div>
            </section>

            <div class="flex justify-end gap-3">
                    <button type="button" onclick="history.back()" class="btn btn-neutral w-25">Cancel</button>
                <button type="submit" class="btn btn-primary w-25">Save</button>
            </div>
        </x-forms.form>
    </div>
</x-layout>

<script>
    // Count existing photos on load
    document.addEventListener('DOMContentLoaded', () => {
        updatePhotoCount();
    });

    function updatePhotoCount() {
        const slots = ['cover', 'photo1', 'photo2'];
        const count = slots.filter(slot => {
            const preview = document.getElementById('preview-' + slot);
            return preview && !preview.classList.contains('hidden');
        }).length;
        document.getElementById('photoCount').textContent = `${count} / 3 photos · Cover photo is required`;
    }

    function clearImage(slot) {
        // Hide preview, show empty state, hide actions
        document.getElementById('preview-' + slot).classList.add('hidden');
        document.getElementById('empty-' + slot).classList.remove('hidden');
        document.getElementById('actions-' + slot).classList.add('hidden');
        if (slot === 'cover') {
            document.getElementById('badge-cover')?.classList.add('hidden');
        }
        // Mark existing image for removal
        const removeInput = document.getElementById('remove-' + slot);
        if (removeInput) removeInput.value = '1';

        updatePhotoCount();
    }
</script>
