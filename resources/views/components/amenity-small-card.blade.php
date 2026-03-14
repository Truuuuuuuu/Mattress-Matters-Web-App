@props(['amenity'])

<div class="flex items-center gap-3">
    <x-icon :name="'lucide-' . $amenity->icon" class="h-6 w-6" />
    <p class="text-lg ">{{$amenity->name}}</p>
</div>
