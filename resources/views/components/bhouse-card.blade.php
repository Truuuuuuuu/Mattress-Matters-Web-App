@props(['listing'])
<a href="{{ auth()->user()?->hasRole('host') && auth()->id() === $listing->host_id
    ? route('host.show', $listing)
    : route('listings.show', $listing)
    }}"
   target="_blank"
   class="block w-full hover:scale-[1.02] transition-transform duration-200">
    <x-panel class="flex flex-col text-start " >
        <div class="py-0 lg:py-2 ">
            <div class="w-full aspect-4/3">
                @php
                    $cover = $listing->listingImages->where('is_cover', true)->first();
                @endphp
                <x-bhouse-photo :$cover />
            </div>
            <h3 class="text-xs lg:text-sm line-clamp-1 text-base-content lg:group-hover:text-blue-800
            font-semibold transition-colors duration-300 boder" title="{{$listing->title}}">
                {{$listing->title}}
            </h3>
            <p class="text-xs  text-base-content lg:text-sm lg:mt-1"><strong>₱{{number_format($listing->rent_cost)}}</strong> monthly</p>
        </div>
    </x-panel>

</a>
