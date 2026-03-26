@props(['myTenant'])

<div class="card bg-base-100  shadow-sm">
    <div  class="px-10 pt-10">
        <div class="rounded-xl bg-purple-700 w-full h-32 flex justify-center items-center mask mask-squircle">
            <p class="text-5xl font-bold ">{{$myTenant->tenant->user->name[0]}}</p>
        </div>
    </div>
    <div class="card-body items-center text-center">
        <h2 class="card-title font-bold -mb-3">{{$myTenant->tenant->user->name}}</h2>
        <p class="text-xs text-base-content/60  line-clamp-1 w-full  text-center"
           title="{{$myTenant->tenant->user->email}}">{{$myTenant->tenant->user->email}}</p>
        <div class="card-actions w-full">
            <button class="btn btn-primary btn-sm w-full">Details</button>
        </div>
    </div>
</div>
