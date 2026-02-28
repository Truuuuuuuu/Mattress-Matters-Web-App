@props(['listing'])
<a href="{{ route('listings.show', $listing) }}" target="_blank" class="block hover:scale-[1.02] transition-transform duration-200">
    <x-panel class="flex flex-col text-start">
        <div class="py-0 lg:py-2 ">
            <div class="w-full aspect-4/3">
                <x-bhouse-photo/>
            </div>
            <h3 class="text-sm text-base-content lg:group-hover:text-blue-800 font-bold transition-colors duration-300">
                <p>
                    {{$listing->name}}
                </p>
            </h3>
            <p class="text-xs text-base-content lg:text-sm mt-1"><strong>₱{{number_format($listing->price)}}</strong> monthly</p>
        </div>
    </x-panel>

</a>
