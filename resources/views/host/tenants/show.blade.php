<x-layout>
    <x-slot:heading>Tenants</x-slot:heading>
    @php $rental = $tenant->rentals->first() @endphp

   <div class="flex justify-center  w-full ">
       <div class="w-full max-w-4xl  flex">
           <div class=" flex-1">
               <div class="w-full p-5 ">
                   <img src="{{asset('images/3D-bhouse-model.svg')}}" alt="3D" class="cursor-pointer  object-contain transition-transform duration-300 hover:scale-110" >
               </div>
               <div class="flex flex-col items-center">
                   <p class="text-lg font-semibold line-clamp-1" title="{{$rental->listing->title}}">{{$rental->listing->title}}</p>
                   <a href="{{route('host.show', $rental->listing)}}" class="btn btn-neutral btn-sm px-10">Visit </a>
               </div>

           </div>
            <div class="flex-1  py-7 ">
                <div class="border rounded-xl h-full p-4">
                    <div class="flex items-center gap-3 ">
                        <div class="avatar">
                            <div class="mask mask-squircle h-22 w-22 bg-purple-700 flex items-center justify-center">
                                <p class="text-center text-3xl font-bold">{{$tenant->user->name[0]}}</p>
                            </div>
                        </div>
                        <div>
                            <div class="font-bold text-2xl -mb-1">{{$tenant->user->name}}</div>
                            <div class="text-md opacity-50">{{ucfirst($tenant->user->email)}}</div>
                        </div>
                    </div>
                    <div class="flex flex-col space-y-3 mt-4 px-2">
                        <div>
                            <p class="text-sm font-semibold text-base-content/70 -mb-2">Gender</p>
                            <p class="text-xl font-semibold">{{ucfirst($tenant->gender)}}</p>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-base-content/70 -mb-2">Occupation</p>
                            <p class="text-xl font-semibold">{{ucwords($tenant->occupation === 'student' ? 'Student' : 'Working Individual')}}</p>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-base-content/70 -mb-2">Started on</p>
                            <p class="text-xl font-semibold">{{$rental->reservation->start_date->format('F j, Y')}}</p>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-base-content/70 -mb-2">Monthly Rent</p>
                            <p class="text-3xl font-semibold">₱{{number_format($rental->listing->rent_cost,2)}}</p>
                        </div>
                        <x-divider class="border border-black/20 my-5"/>
                        <div class="space-y-3">
                            <button class="btn btn-neutral w-full">Message</button>
                            <button class="btn btn-outline btn-error w-full">Kick</button>
                        </div>

                    </div>

                </div>

            </div>
       </div>

   </div>
</x-layout>
