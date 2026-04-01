<x-layout>
    <x-slot:heading>My Profile</x-slot:heading>

  <div class="w-full px-4 lg:px-0 flex flex-col justify-start items-center mt-10">
      @isset($tenantProfile)
            <div class="w-full max-w-lg">
                <h1 class="text-4xl font-semibold mb-2">Profile</h1>
            </div>
            <div class="w-full max-w-lg  border border-black/30 rounded-3xl py-10 flex flex-col items-center ">
                <div class="flex btn btn-ghost btn-circle h-40 w-40 bg-purple-700">
                    <h1 class="text-6xl font-bold">{{Auth::user()->name[0]}}</h1>
                </div>
                <div class="flex flex-col items-center mt-5">
                    <h1 class="text-xl font-bold -mb-1">{{$tenantProfile->user->name}}</h1>
                    <p>{{$tenantProfile->user->email}}</p>
                </div>
                <div class="w-xs">
                    <x-divider class="border border-black/10 my-5"/>

                </div>
                <div class=" w-sm px-10 space-y-4">
                    <div>
                        <p class="text-sm font-semibold text-base-content/70">Gender</p>
                        <h1 class="text-xl font-bold -mt-2">{{ucfirst($tenantProfile->gender)}}</h1>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-base-content/70">Occupation</p>
                        <h1 class="text-xl font-bold -mt-2">{{ucfirst($tenantProfile->occupation === 'working_individual' ? 'Working Individual' : 'Student')}}</h1>
                    </div>
                </div>
            </div>
      @endisset

      @isset($hostProfile)
              <div class="w-full max-w-lg">
                  <h1 class="text-4xl font-semibold mb-2">Profile</h1>
              </div>
              <div class="w-full max-w-lg  border border-black/30 rounded-3xl py-10 flex flex-col items-center ">
                  <div class="flex btn btn-ghost btn-circle h-40 w-40 bg-purple-700">
                      <h1 class="text-6xl font-bold">{{Auth::user()->name[0]}}</h1>
                  </div>
                  <div class="flex flex-col items-center mt-5">
                      <h1 class="text-xl font-bold -mb-1">{{$hostProfile->user->name}}</h1>
                      <p>{{$hostProfile->user->email}}</p>
                  </div>
                  <div class="w-xs flex  mt-5">
                      <div class="flex flex-col flex-1  items-center">
                          <h1 class="text-2xl font-bold">{{$hostProfile->listings_count}}</h1>
                          <p class="text-sm font-semibold text-base-content/70">Active Listings</p>
                      </div>
                      <div class="flex flex-col flex-1  items-center">
                          <h1 class="text-2xl font-bold">5</h1>
                          <p class="text-sm font-semibold text-base-content/70">Host Rating</p>
                      </div>

                  </div>

              </div>
      @endisset
  </div>
</x-layout>
