@props(['rule'])

<div class="flex items-center gap-3">
    <x-icon :name="'lucide-' . $rule->icon" class="h-6 w-6" />
    <p class="text-lg ">{{$rule->description}}</p>
</div>
