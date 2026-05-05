@props(['user', 'width', 'height'])

<div class="avatar">
    @if($user->profile_photo_public_id)
        <a href="{{ $user === auth()->user() ? route('profile.index') : route('profile.show', $user) }}">
            <div class="avatar  mb-4" >
                <div class="mask mask-squircle h-24 w-24 lg:h-32 lg:w-32 bg-purple-700 flex items-center justify-center" style="box-shadow: 0 8px 32px rgba(37, 99, 235, 0.15)">
                    <img src="{{ $user->profile_photo_url }}" alt="Photo" class="w-full h-full object-cover"/>
                </div>
            </div>
        </a>

    @else
        <a href="{{ $user === auth()->user() ? route('profile.index') : route('profile.show', $user) }}">
            <div class="avatar  mb-4" >
                <div class="mask mask-squircle h-24 w-24 lg:h-32 lg:w-32 bg-purple-700 flex items-center justify-center" style="box-shadow: 0 8px 32px rgba(37, 99, 235, 0.15)">
                    <p class="text-center text-xl font-bold">{{$user->name[0]}}</p>
                </div>
            </div>
        </a>
    @endif

</div>

