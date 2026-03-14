@props(['employer', 'width' => 200, 'cover'])
@if($cover)
    <img src="{{ asset('storage/' . $cover->image_path) }}"
         alt="Cover Photo"
         class="w-full h-full object-cover rounded-lg ">
@else
    <div class="w-full h-full flex items-center justify-center text-stone-400">
        <x-lucide-image class="w-8 h-8" />
    </div>
@endif
