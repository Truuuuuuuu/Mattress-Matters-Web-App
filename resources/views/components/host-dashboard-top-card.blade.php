@props(['count', 'label', 'icon'])
<div class="flex flex-col border rounded-xl p-3 gap-4 ">
    <div>
        <div class="p-2 border rounded-xl w-12 flex justify-center items-center">
            <x-icon :name="'lucide-' . $icon" class="h-4 w-4" />
        </div>
    </div>
    <div>
        <h1 class="text-3xl font-semibold">{{ $count }}</h1>
        <p class="font-semibold text-base-content/70">{{ ucfirst($label) }}</p>
    </div>
</div>
