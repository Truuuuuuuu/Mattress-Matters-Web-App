@props(['width' => '72'])

@php
    $classes = "group p-4 bg-white/5 rounded-xl  border border-black/30 hover:border-blue-800 transition-colors duration-300 " ;
@endphp

<div {{$attributes->merge(['class' => $classes])}} style="width: {{ $width * 4 }}px">
    {{$slot}}
</div>
