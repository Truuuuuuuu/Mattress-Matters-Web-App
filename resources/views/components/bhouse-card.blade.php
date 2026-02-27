@props(['listing'])
<x-panel class="flex flex-col text-start">
    <div class="py-0 lg:py-2 ">
        <div class="w-full aspect-4/3">
            <x-bhouse-photo/>
        </div>
        <h3 class="text-sm text-base-content lg:group-hover:text-blue-800 font-bold transition-colors duration-300">
            <a href="#" target="_blank">
                {{$listing->name}}
            </a>
        </h3>
        <p class="text-xs text-base-content lg:text-sm mt-1">P{{number_format($listing->price)}} monthly</p>
    </div>
</x-panel>
