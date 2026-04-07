<x-layout>
    <x-slot:heading>My Profile</x-slot:heading>

    <div class="w-full max-w-7xl mx-auto px-3 lg:px-8 mt-10">
        <div class="grid gap-4 md:grid-cols-[1fr_2fr] place-self-center w-full">
            <div class=" space-y-5">
                <div class="border py-5 rounded-xl">
                    <div class="flex flex-col items-center">
                        <div class="avatar avatar-placeholder my-3">
                            <div class="bg-neutral text-neutral-content w-24 rounded-xl">
                                <span class="text-3xl">{{$profile->user->name[0]}}</span>
                            </div>
                        </div>
                        <h1 class="text-xl font-bold">{{$profile->user->name}}</h1>
                    </div>


                    <div class="w-full grid grid-cols-3  mt-10 px-4">
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
                        <div class="  flex flex-col items-center ">
                            <div class="flex flex-col items-center justify-center h-12">
                                <h1 class="font-bold text-center">{{$profile->created_at->format('Y')}}</h1>
                                <p class="text-xs font-semibold text-base-content/70 text-center justify-center">JOINED </p>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="border py-5 rounded-xl px-5">
                    <h1 class="text-lg font-bold mb-4">About</h1>
                    <p>Hello, this is a placeholder <only class=""></only></p>
                </div>
            </div>

            <div class="border flex justify-center items-center">
                content here
            </div>
        </div>

    </div>
</x-layout>
