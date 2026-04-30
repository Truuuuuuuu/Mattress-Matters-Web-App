<x-layout>
    <x-slot:heading>My Profile</x-slot:heading>

  <div class="w-full max-w-7xl mx-auto px-3 lg:px-8 text-base-content bg-base-200 min-h-[calc(100vh-5rem)]">
      <div class="grid gap-4 md:grid-cols-[1fr_2fr] place-self-center w-full">
          <div class=" space-y-5">
              <div class=" py-5 rounded-3xl bg-base-100 mt-5"  >
                  <div class="flex flex-col items-center" >
                      <div class="avatar  mb-4" >
                          <div class="mask mask-squircle h-24 w-24 lg:h-32 lg:w-32 bg-purple-700 flex items-center justify-center" >
                              <p class="text-center text-xl font-bold">{{$profile->user->name[0]}}</p>
                          </div>
                      </div>
                      <h1 class="text-xl font-bold">{{$profile->user->name}}</h1>
                      <p class="text-sm text-base-content/70">{{$profile->user->email}}</p>
                  </div>
                  @role('tenant')
                  <div class="w-full  flex justify-center gap-3 my-3">
                      <div
                          class="badge {{$profile->getGender() === 'Male' ? 'badge-primary' : 'badge-secondary'}} badge-primary">{{$profile->getGender()}}</div>
                      <div class="badge badge-ghost">{{$profile->getOccupation()}}</div>
                  </div>

                  <div class="w-full flex flex-col items-center mt-10">
                      <h1 class="text-lg font-bold">{{$profile->created_at->format('M d, Y')}}</h1>
                      <p class="font-semibold text-base-content/70">Joined Since</p>
                  </div>
                  @endrole

                  @role('host')
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
                  @endrole
              </div>

              <div class=" py-5 rounded-3xl px-5 bg-base-100" >
                  <h1 class="text-lg font-bold mb-4 text-primary">About</h1>
                  <p>Hello, this is a placeholder <only class=""></only></p>
              </div>
          </div>

          <div class=" flex justify-center items-center bg-base-100 rounded-3xl" >
                content here
          </div>
          <div class="lg:hidden py-2 flex flex-col gap-3 justify-center items-center">
              <a href="{{route('settings.index')}}" class="flex  items-center justify-between btn btn-outline rounded-3xl py-7 w-full">
                  <div class="flex justify-start items-center gap-3">
                      <x-lucide-settings class="w-5 h-5"/>
                      <p>Settings</p>
                  </div>
                  <x-lucide-chevron-right class="w-5 h-5"/>
              </a>

              <form method="POST" action="/logout" class=" w-full" >
                  @csrf
                  @method('DELETE')
                  <button class="flex justify-start items-center btn text-base-content rounded-3xl py-7 btn-text-base-contnent btn-outline w-full">
                      <x-lucide-log-out class="w-5 h-5"/>
                      <p>Log Out</p>
                  </button>
              </form>

          </div>
      </div>

  </div>
</x-layout>
