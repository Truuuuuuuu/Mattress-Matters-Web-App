@props(['job'])
<x-panel class="flex flex-col text-start">
    <div class="py-2 ">
        <div class="w-full aspect-4/3">
            <x-bhouse-photo/>
        </div>
        <h3 class="text-sm lg:text-xl group-hover:text-blue-800 font-bold transition-colors duration-300">
            <a href="#" target="_blank">
                Mago Residence
            </a>
        </h3>
        <p class="text-xs lg:text-sm mt-1">P3,500 monthly</p>
    </div>
    <div class="flex justify-between items-center mt-auto">
        <div>
{{--            @foreach($job->tags as $tag)--}}
{{--                <x-tag :$tag size="small"/>--}}
{{--            @endforeach--}}
        </div>

    </div>
</x-panel>
