@props(['count', 'label', 'icon'])
<div class="flex flex-col w-full rounded-3xl p-5 gap-4  bg-base-100  backdrop-blur-lg
            border border-white/20 shadow-xs
    ">
    <div>
        <div class="p-2 bg-primary/10 rounded-xl w-11 h-10 flex justify-center items-center">
            <x-icon :name="'lucide-' . $icon" class="h-4 w-4 text-primary" />
        </div>
    </div>
    <div>
        <h1 class="text-3xl font-semibold">{{ $count }}</h1>
        <p class="text-sm sm:text-md font-semibold text-base-content/70">{{ ucfirst($label) }}</p>
    </div>
</div>
