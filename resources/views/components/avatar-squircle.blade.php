@props(['user' => null, 'listing' => null, 'width' => 12, 'height' => 12, 'link' => true])


<div class="avatar">

    @if($user && $link)
        @if(request()->routeIs('profile.index') || request()->routeIs('profile.show'))
            @if($user->profile_photo_public_id)
                <div class="avatar " >
                    <div class="mask mask-squircle h-24 w-24 lg:h-32 lg:w-32 bg-purple-700 flex items-center justify-center" >
                        <img src="{{ $user->profile_photo_url }}" alt="Photo" class="w-full h-full object-cover"/>
                    </div>
                </div>

            @else
                <div class="avatar " >
                    <div class="mask mask-squircle h-24 w-24 lg:h-32 lg:w-32 bg-base-300 flex items-center justify-center" >
                        <p class="text-center text-lg lg:text-3xl font-semibold">{{$user->name[0]}}</p>
                    </div>
                </div>
            @endif
        @else
            @if($user->profile_photo_public_id)
                <a href="{{ $user === auth()->user() ? route('profile.index') : route('profile.show', $user) }}">
                    <div class="avatar  " >
                        <div {{$attributes->class(["mask mask-squircle h-{$height} w-{$width} bg-purple-700 flex items-center justify-center  hover:scale-105" ])}} >
                            <img src="{{ $user->profile_photo_url }}" alt="Photo" class="w-full h-full object-cover "/>
                        </div>
                    </div>
                </a>

            @else
                <a href="{{ $user === auth()->user() ? route('profile.index') : route('profile.show', $user) }}">
                    <div class="avatar" >
                        <div {{$attributes->class(["mask mask-squircle h-{$height} w-{$width} bg-base-300 flex items-center justify-center hover:opacity-80" ])}} >
                            <p class="text-center text-xl font-semibold">{{$user->name[0]}}</p>
                        </div>
                    </div>
                </a>
            @endif
        @endif
    @elseif($listing && $link)
        <a href="{{ route('listings.show', $listing) }}">
            <div class="avatar hover:scale-104 hover:opacity-80" >
                <div {{$attributes->class(["mask mask-squircle w-{$width} h-{$height} shrink-0 "])}}  >
                    <img src="{{ $listing->cover_image->url }}" alt="Photo" class="w-full h-full object-cover"/>
                </div>
            </div>
        </a>
    @elseif($user && !$link)
        @if($user->profile_photo_public_id)
                <div class="avatar  " >
                    <div {{$attributes->class(["mask mask-squircle h-{$height} w-{$width} bg-purple-700 flex items-center justify-center  hover:scale-105" ])}} >
                        <img src="{{ $user->profile_photo_url }}" alt="Photo" class="w-full h-full object-cover "/>
                    </div>
                </div>

        @else
                <div class="avatar" >
                    <div {{$attributes->class(["mask mask-squircle h-{$height} w-{$width} bg-base-300 flex items-center justify-center hover:opacity-80" ])}} >
                        <p class="text-center text-xl font-semibold">{{$user->name[0]}}</p>
                    </div>
                </div>
        @endif
    @endif


</div>

