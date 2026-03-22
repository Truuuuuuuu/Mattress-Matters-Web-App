<x-layout>
    <x-slot:heading>My Profile</x-slot:heading>

    <div class="w-full   flex flex-col justify-start items-center mt-10">


            <div class="w-full max-w-lg">
                <h1 class="text-4xl font-semibold mb-2">Profile</h1>
            </div>
            <div class="w-full max-w-lg  border border-black/30 rounded-3xl py-10 flex flex-col items-center ">
                <div class="flex btn btn-ghost btn-circle h-40 w-40 bg-purple-700">
                    <h1 class="text-6xl font-bold">{{$userProfile->user->name[0]}}</h1>
                </div>
                <div class="flex flex-col items-center mt-5">
                    <h1 class="text-xl font-bold -mb-1">{{$userProfile->user->name}}</h1>
                    <p>{{$userProfile->user->email}}</p>
                </div>

                @if($userProfile->user->hasRole('host'))
                    <div class="w-xs flex  mt-5">
                        <div class="flex flex-col flex-1  items-center">
                            <h1 class="text-2xl font-bold">{{$userProfile->listings_count}}</h1>
                            <p class="text-sm font-semibold text-base-content/70">Active Listings</p>
                        </div>
                        <div class="flex flex-col flex-1  items-center">
                            <h1 class="text-2xl font-bold">5</h1>
                            <p class="text-sm font-semibold text-base-content/70">Host Rating</p>
                        </div>
                    </div>
                @else
                    <div class=" w-xs  space-y-4 mt-5">
                        <div>
                            <p class="text-sm font-semibold text-base-content/70">Gender</p>
                            <h1 class="text-xl font-bold -mt-2">{{ucfirst($userProfile->user->tenant->gender)}}</h1>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-base-content/70">Occupation</p>
                            <h1 class="text-xl font-bold -mt-2">{{ucfirst($userProfile->user->tenant->occupation === 'working_individual' ? 'Working Individual' : 'Student')}}</h1>
                        </div>
                    </div>

                @endif

                <button class="btn btn-primary mt-3 w-xs">Message</button>
            </div>
    </div>
</x-layout>
