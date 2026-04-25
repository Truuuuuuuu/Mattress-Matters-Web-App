@props(['myTenant'])

<div class="bg-base-100 shadow-sm rounded-2xl p-5 gap-5 flex flex-col ">
    <div class="flex gap-3">
        <div class="avatar">
            <div class="mask mask-squircle h-12 w-12 bg-purple-700 flex items-center justify-center">
                <p class="text-center text-xl font-bold">{{$myTenant->tenant->user->name[0]}}</p>
            </div>
        </div>
        <div>
            <h1 class="text-xl font-semibold">{{$myTenant->tenant->user->name}}</h1>
            <p class="text-sm font-semibold text-base-content/70">{{$myTenant->tenant->getOccupation()}}</p>
        </div>
    </div>
    <div class="space-y-2">
        <div class="flex gap-2">
            <div class="rounded-xl bg-base-300 p-3">
                <x-lucide-building class="w-5 h-5"/>
            </div>
            <div>
                <p class="text-xs font-semibold text-base-content/70">PROPERTY</p>
                <p class="text-md font-semibold line-clamp-1"
                   title="{{$myTenant->listing->title}}">{{$myTenant->listing->title}}</p>
            </div>
        </div>
        <div class="flex gap-2">
            <div class="rounded-xl bg-base-300 p-3">
                <x-lucide-calendar-1 class="w-5 h-5"/>
            </div>
            <div>
                <p class="text-xs font-semibold text-base-content/70">TENANT SINCE</p>
                <p class="text-md font-semibold line-clamp-1">{{$myTenant->lease_start_date->format('M d, Y')}}</p>
            </div>
        </div>
    </div>
    <div class="flex">
        <div class="flex-1 ">
            <p class="text-xs font-semibold text-base-content/70">MONTHLY RENT</p>
            <h1 class="text-2xl font-bold">₱{{$myTenant->totalAmountDue()}}</h1>
        </div>
        <a href="{{route('host.tenants.show', $myTenant->tenant)}}" class="bg-base-300 rounded-2xl p-3">
            <x-lucide-chevron-right class="w-7 h-5"/>
        </a>

    </div>

</div>
