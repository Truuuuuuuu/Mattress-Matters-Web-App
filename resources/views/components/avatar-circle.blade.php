@props(['user', 'width' => 10, 'height' => 10])

<div class="avatar">
    @if($user->profile_photo_public_id)
        <a href="{{ $user === auth()->user() ? route('profile.index') : route('profile.show', $user) }}">
            <div {{  $attributes->class(["h-8 w-8 ring-primary ring-offset-base-100  rounded-full ring-2 ring-offset-2 overflow-hidden cursor-pointer hover:bg-primary/10"]) }}>
                <img src="{{ $user->profile_photo_url }}" alt="Photo" class="w-full h-full object-cover"/>
            </div>
        </a>

    @else
        <a href="{{ $user === auth()->user() ? route('profile.index') : route('profile.show', $user) }}">
            <div {{ $attributes->class(["hidden lg:flex justify-center items-center  font-semibold rounded-full  text-base-content h-{$height} w-{$width} bg-base-300 hover:bg-primary/10"])  }} >
                <h1>{{$user->name[0]}}</h1>
            </div>
        </a>
    @endif

</div>
