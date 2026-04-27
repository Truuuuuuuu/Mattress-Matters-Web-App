
@php
    $classes = "w-full p-2 md:p-4 lg:w-72 group lg:p-4 bg-white/5 rounded-2xl md:rounded-3xl border border-primary/20 hover:border-blue-800 transition-colors duration-300 box-border";
@endphp

<div {{$attributes->merge(['class' => $classes])}} >
    {{$slot}}
</div>
