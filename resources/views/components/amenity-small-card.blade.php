@props(['amenity'])

<div class="flex flex-col items-start gap-3 border rounded-2xl p-4">
    <div class="border p-2 rounded-xl">
        <x-icon :name="'lucide-' . $amenity->icon" class="h-5 w-5" />
    </div>
    <div>
        <h2 class="text-lg font-semibold">{{$amenity->description}}</h2>
        <p class="text-base-content/70">This is a placeholder only, replace this sentence later</p>
    </div>

</div>
