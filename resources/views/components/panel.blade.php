@php
    $classes = "group p-4 bg-white/5 rounded-xl  border border-black/30 hover:border-blue-800 transition-colors duration-300";
@endphp

<div {{$attributes(['class' => $classes])}}>
    {{$slot}}
</div>
