

<div class="flex flex-col md:flex-row">
    <div class="w-full max-w-124  p-5 space-y-3">
        {{--<div class="w-full h-64 ">
            <img src="{{ asset('storage/' . $rental->reservation->listing->listingImages->first()->image_path) }}"
                 alt="Cover Photo"
                 class="w-full h-full object-cover rounded-3xl ">
        </div>--}}
        <div class="flex justify-center">
            <x-avatar-squircle :user="$rental->tenant->user" class="w-24 h-24"/>
        </div>
        <div class="flex flex-col items-center">
            <h1 class="text-lg font-semibold text-base-content">{{$rental->tenant->user->name}}</h1>
            <div class="flex justify-center items-center gap-2">
                <p class="text-xs font-semibold text-base-content/70">{{$rental->tenant->getGender()}}</p>
                <div class="bg-base-content/30 rounded-full size-1"></div>
                <p class="text-xs font-semibold text-base-content/70">{{$rental->tenant->getOccupation()}}</p>
            </div>
        </div>
        @if($rental->status === 'active')
            <a href="{{ route('messages.show', $rental->tenant->user) }}" class="btn btn-primary btn-primary  w-full rounded-2xl">Message</a>
        @elseif($rental->status === 'ended')
            <a href="{{ route('profile.show', $rental->tenant->user) }}" class="btn btn-primary btn-primary  w-full rounded-2xl">Profile</a>
        @endif

        <p class="text-xs font-semibold text-primary">CONTACT INFORMATION</p>
        <div class="flex gap-3 justify-start items-center">
            <div class="bg-primary/10 rounded-full p-2">
                <x-lucide-at-sign class="w-5 h-5 text-primary  "/>
            </div>
            <div>
                <p class="text-xs font-semibold text-base-content/70">EMAIL</p>
                <p class="text-xs font-semibold ">{{$rental->tenant->user->email}}</p>
            </div>
        </div>
        <div class="flex gap-3 justify-start items-center">
            <div class="bg-primary/10 rounded-full p-2">
                <x-lucide-smartphone class="w-5 h-5 text-primary  "/>
            </div>
            <div>
                <p class="text-xs font-semibold text-base-content/70">PHONE</p>
                <p class="text-sm font-semibold ">09123456789</p>
            </div>
        </div>
       {{-- @if($rental->status === 'active')
            <div class="hidden md:flex flex-col rounded-2xl bg-error/20 p-3 border border-error/50">
                <p class="text-sm font-semibold text-error-content">DANGER ZONE</p>
                <p class="text-xs ">Permanent action. This will terminate the legal agreement.</p>
                <a href="#" class="btn bg-red-700 rounded-2xl w-full my-2 text-base-100">Kick Out</a>
            </div>
        @endif--}}

    </div>
    <div class="w-full  p-5 bg-base-200 flex flex-col justify-between">
        <div>
            <div class="mb-5">
                <h1 class="text-2xl font-semibold">Rental Overview</h1>
                <p class="text-xs font-semibold text-base-content/70">Summary of the tenant’s profile and rental
                    details.</p>
            </div>

            <h1 class="text-base-content text-md font-semibold">Rental Information</h1>
            <div class="bg-base-100 border-base-300 rounded-3xl p-5 flex flex-col justify-between gap-3 my-3">
                <div class="flex flex-col justify-center items-start">
                    <p class="text-xs font-semibold text-base-content/70">PROPERTY</p>
                    <h2 class="text-md font-semibold text-primary">{{$rental->listing->title}}</h2>
                </div>
                <div class="flex flex-col justify-center items-start">
                    <p class="text-xs font-semibold text-base-content/70">MONTHLY RENTAL</p>
                    <h2 class="text-md font-semibold text-base-content">
                        ₱{{number_format($rental->listing->rent_cost,2)}}</h2>
                </div>
                <div class="flex flex-col">
                    <p class="text-xs font-semibold text-base-content/70">RENTAL PERIOD</p>
                    <div class="flex justify-between items-center">
                        <P class="text-md font-semibold text-base-content">{{$rental->lease_start_date?->format('M d, Y') ?? 'Awaiting...' }}  </p>
                        <x-lucide-move-right class="w-4 h-4"/>
                        <p>N/A</p>
                    </div>
                </div>
            </div>
            <h1 class="text-base-content text-md font-semibold">Documents</h1>
            <div class="flex ">
                <div class=" flex items-center gap-3 rounded-2xl p-3 bg-base-100">
                    <div class="flex justify-center items-center p-2 rounded-xl bg-primary/10">
                        <x-lucide-file-text class="h-4 w-4 text-primary"/>
                    </div>
                    <div>
                        <p class="text-sm font-semibold">Contract Agreement</p>
                        <p class="text-xs font-semibold text-base-content/70">PDF • 2.4 MB</p>
                    </div>
                    <div>
                        <x-lucide-chevron-right class="w-5 h-5 text-primary"/>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex justify-between gap-3 mt-5">
            <a href="#" class="btn btn-primary btn-outline  w-full border-primary rounded-2xl">Statement of Account</a>
        </div>
        {{--@if($rental->status === 'active')
            <div class="md:hidden my-8 flex-col rounded-2xl bg-error/20 p-3 border border-error/50">
                <p class="text-sm font-semibold text-error-content">DANGER ZONE</p>
                <p class="text-xs ">Permanent action. This will terminate the legal agreement.</p>
                <a href="#" class="btn bg-red-700 rounded-2xl w-full my-2 text-base-100">Kick Out</a>
            </div>
        @endif--}}
    </div>
</div>
