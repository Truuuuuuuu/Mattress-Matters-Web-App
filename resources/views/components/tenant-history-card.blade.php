@props(['history'])

<div class="bg-base-100 shadow-sm rounded-2xl p-5 gap-5 flex flex-col ">
    <div class="flex gap-3">
        <div class="avatar">
            <div class="mask mask-squircle h-12 w-12 bg-purple-700 flex items-center justify-center">
                <p class="text-center text-xl font-bold">{{$history->tenant->user->name[0]}}</p>
            </div>
        </div>
        <div>
            <h1 class="text-xl font-semibold">{{$history->tenant->user->name}}</h1>
            <p class="text-sm font-semibold text-base-content/70">{{$history->tenant->getOccupation()}}</p>
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
                   title="{{$history->listing->title}}">{{$history->listing->title}}</p>
            </div>
        </div>
    </div>
    <div class="flex  gap-3 items-center">
        <div class="flex-1 ">
            <p class="text-xs font-semibold text-base-content/70">RENT PERIOD</p>
            <h1 class="text-lg font-semibold">{{$history->lease_start_date->format('M, Y') }} - {{$history->updated_at->format('M, Y')}}</h1>
        </div>
        <a href="{{route('host.tenants.show', $history->tenant)}}" class="bg-base-300 rounded-2xl flex justify-center items-center p-3 w-13 h-13">
            <x-lucide-chevron-right class="w-7 h-5"/>
        </a>

    </div>

</div>
