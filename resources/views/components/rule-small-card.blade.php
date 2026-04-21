@props(['rule'])

<div class="flex items-start gap-3 ">
    <div class="border rounded-lg p-1">
        <x-icon :name="'lucide-' . $rule->icon" class="h-4 w-4" />
    </div>
    <div class="flex flex-col justify-start ">
        <h2 class="text-md font-semibold">{{$rule->description}}</h2>
        <p class="text-base-content/70">This is a placeholder only, replace this sentence later</p>
    </div>

</div>
