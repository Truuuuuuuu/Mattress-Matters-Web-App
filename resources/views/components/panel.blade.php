
@php
    $classes = "w-full p-2 lg:w-72 group lg:p-4 bg-white/5 rounded-xl  border border-black/30 hover:border-blue-800 transition-colors duration-300 " ;
@endphp

<div {{$attributes->merge(['class' => $classes])}} >
    {{$slot}}
</div>
