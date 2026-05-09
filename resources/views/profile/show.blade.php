<x-layout>
    <x-slot:heading>My Profile</x-slot:heading>

    <div class="w-full max-w-7xl mx-auto px-3 lg:px-8 mt-10 text-base-content bg-base-200 min-h-[calc(100vh-5rem)]" >
        <div class="grid gap-4 md:grid-cols-[1fr_2fr] place-self-center w-full">
            <div class=" space-y-5">
                <div class="bg-base-100 py-5 px-3 rounded-3xl bg-base-100 " style="box-shadow: 0 8px 32px rgba(37, 99, 235, 0.15)">
                    <div class="flex flex-col items-center mb-2">
                       <x-avatar-squircle :user="$profile->user"/>
                        <h1 class="text-xl font-bold">{{$profile->user->name}}</h1>
                    </div>

                    <div>
                        <a href="{{ route('messages.show', $profile->user) }}" class="btn btn-primary rounded-3xl w-full">Message</a>
                    </div>


                    <div class="w-full flex justify-between  mt-10 px-4">
                        @if($profile->user->hasRole('host'))
                            <div class=" flex flex-col items-center">
                                <div class="flex flex-col items-center justify-center h-12">
                                    <h1 class="font-bold">{{$profile->listings_count}}</h1>
                                    <p class="text-xs font-semibold text-base-content/70 text-center justify-center">LISTINGS</p>
                                </div>
                            </div>
                            <div class=" flex flex-col items-center">
                                <div class="flex flex-col items-center justify-center h-12">
                                    <h1 class="font-bold">5</h1>
                                    <p class="text-xs font-semibold text-base-content/70 justify-center">RATING</p>
                                </div>
                            </div>
                        @endif

                        <div class="  flex flex-col items-center mx-auto">
                            <div class="flex flex-col items-center justify-center h-12">
                                <h1 class="font-bold text-center">{{$profile->created_at->format('Y')}}</h1>
                                <p class="text-xs font-semibold text-base-content/70 text-center justify-center">JOINED </p>
                            </div>
                        </div>
                    </div>

                </div>

                <div class=" py-5 rounded-xl px-5 bg-base-100" style="box-shadow: 0 8px 32px rgba(37, 99, 235, 0.15)">
                    <h1 class="text-lg font-bold mb-4 text-primary">About</h1>
                    <p>Hello, this is a placeholder <only class=""></only></p>
                </div>
            </div>

            <div class="bg-base-100 flex justify-center items-center" style="box-shadow: 0 8px 32px rgba(37, 99, 235, 0.15)">
                content here
            </div>
        </div>

    </div>
</x-layout>
