<x-layout>
    <x-slot:heading>My Profile</x-slot:heading>

  <div class="w-full max-w-7xl mx-auto px-3 lg:px-8 mt-10 text-base-content">
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

              <div class="border py-5 rounded-xl px-5">
                  <h1 class="text-lg font-bold mb-4">About</h1>
                  <p>Hello, this is a placeholder <only class=""></only></p>
              </div>
          </div>

          <div class="border flex justify-center items-center">
                content here
          </div>
          <div class="lg:hidden py-2 flex flex-col gap-3 justify-center items-center">
              <a href="{{route('settings.index')}}" class="btn  btn-outline w-full">Settings</a>
              <form method="POST" action="/logout" class=" w-full hover:bg-red-100 hover:text-red-900" >
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-error btn-outline w-full">Log out</button>
              </form>

          </div>
      </div>

  </div>
</x-layout>
