<div class="px-25">
    <section>
        <div class="flex flex-col justify-center items-center">
            <div class="w-full max-w-lg mt-10 text-base-content mb-5">
                <h1 class="text-3xl font-semibold">Add your photos</h1>
                <p class="text-base-content/70 text-sm">A great cover photo gets more inquiries. Add up to 3 photos.</p>
            </div>

            <div class="w-full max-w-lg">
                <div class="flex flex-col gap-3">

                    {{-- Cover Photo --}}
                    <div
                        id="zone-cover"
                        onclick="document.getElementById('input-cover').click()"
                        ondragover="handleDragOver(event, 'cover')"
                        ondragleave="handleDragLeave(event, 'cover')"
                        ondrop="handleDrop(event, 'cover')"
                        class="relative group overflow-hidden rounded-2xl border-2 border-dashed border-stone-300 bg-stone-50 hover:border-primary hover:bg-primary/10 cursor-pointer transition-all duration-300 h-72 flex flex-col items-center justify-center gap-2"
                    >
                        {{-- Empty State --}}
                        <div id="empty-cover" class="flex flex-col items-center justify-center gap-2 text-stone-400 group-hover:text-primary transition-colors duration-200">
                            <div class="w-14 h-14 rounded-full bg-stone-200 group-hover:bg-primary/20 transition-colors duration-200 flex items-center justify-center">
                                <x-lucide-image-plus class="w-6 h-6"></x-lucide-image-plus>
                            </div>
                            <div class="text-center px-4">
                                <p class="font-semibold text-sm">Upload Cover Photo</p>
                                <p class="text-xs text-stone-400 mt-0.5">Click or drag & drop</p>
                            </div>
                        </div>

                        {{-- Preview --}}
                        <img id="preview-cover" src="" alt="Cover preview" class="hidden absolute inset-0 w-full h-full object-cover" />

                        {{-- Cover Badge --}}
                        <div id="badge-cover" class="hidden absolute top-3 left-3 flex items-center gap-1.5 bg-amber-400 text-white text-xs font-bold px-2.5 py-1 rounded-full shadow z-10">
                            <x-lucide-star class="w-3 h-3 fill-white"></x-lucide-star>
                            Cover Photo
                        </div>

                        {{-- Hover Actions --}}
                        <div id="actions-cover" class="hidden absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-200 flex items-center justify-center gap-3 z-20">
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

                        <input type="file" id="input-cover" name="cover_photo" accept="image/*" class="hidden"
                               onchange="handleFileSelect(this, 'cover')" />
                    </div>

                    {{-- Two Additional Photos --}}
                    <div class="grid grid-cols-2 gap-3">

                        {{-- Photo 1 --}}
                        <div
                            id="zone-photo1"
                            onclick="document.getElementById('input-photo1').click()"
                            ondragover="handleDragOver(event, 'photo1')"
                            ondragleave="handleDragLeave(event, 'photo1')"
                            ondrop="handleDrop(event, 'photo1')"
                            class="relative group overflow-hidden rounded-2xl border-2 border-dashed border-stone-300 bg-stone-50 hover:border-primary hover:bg-primary/10 cursor-pointer transition-all duration-300 h-40 flex items-center justify-center"
                        >
                            <div id="empty-photo1" class="flex flex-col items-center justify-center gap-2 text-stone-400 group-hover:text-primary transition-colors duration-200">
                                <div class="w-10 h-10 rounded-full bg-stone-200 group-hover:bg-primary/20 transition-colors duration-200 flex items-center justify-center">
                                    <x-lucide-image-plus class="w-4 h-4"></x-lucide-image-plus>
                                </div>
                                <div class="text-center px-2">
                                    <p class="font-semibold text-xs">Additional Photo</p>
                                    <p class="text-[11px] text-stone-400">Click or drag & drop</p>
                                </div>
                            </div>

                            <img id="preview-photo1" src="" alt="Photo 1 preview" class="hidden absolute inset-0 w-full h-full object-cover" />

                            <div id="actions-photo1" class="hidden absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-200 flex items-center justify-center gap-2 z-20">
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

                            <input type="file" id="input-photo1" name="images[]" accept="image/*" class="hidden"
                                   onchange="handleFileSelect(this, 'photo1')" />
                        </div>

                        {{-- Photo 2 --}}
                        <div
                            id="zone-photo2"
                            onclick="document.getElementById('input-photo2').click()"
                            ondragover="handleDragOver(event, 'photo2')"
                            ondragleave="handleDragLeave(event, 'photo2')"
                            ondrop="handleDrop(event, 'photo2')"
                            class="relative group overflow-hidden rounded-2xl border-2 border-dashed border-stone-300 bg-stone-50 hover:border-primary hover:bg-primary/10 cursor-pointer transition-all duration-300 h-40 flex items-center justify-center"
                        >
                            <div id="empty-photo2" class="flex flex-col items-center justify-center gap-2 text-stone-400 group-hover:text-primary transition-colors duration-200">
                                <div class="w-10 h-10 rounded-full bg-stone-200 group-hover:bg-primary/20 transition-colors duration-200 flex items-center justify-center">
                                    <x-lucide-image-plus class="w-4 h-4"></x-lucide-image-plus>
                                </div>
                                <div class="text-center px-2">
                                    <p class="font-semibold text-xs">Additional Photo</p>
                                    <p class="text-[11px] text-stone-400">Click or drag & drop</p>
                                </div>
                            </div>

                            <img id="preview-photo2" src="" alt="Photo 2 preview" class="hidden absolute inset-0 w-full h-full object-cover" />

                            <div id="actions-photo2" class="hidden absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-200 flex items-center justify-center gap-2 z-20">
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

                            <input type="file" id="input-photo2" name="images[]" accept="image/*" class="hidden"
                                   onchange="handleFileSelect(this, 'photo2')" />
                        </div>

                    </div>
                </div>

                {{-- Upload count hint --}}
                <p id="photoCount" class="text-xs text-primary/70 mt-3">0 / 3 photos added · Cover photo is required</p>

                {{-- Validation Errors --}}
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
