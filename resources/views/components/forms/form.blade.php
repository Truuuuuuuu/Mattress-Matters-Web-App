@php
    $method = strtoupper($attributes->get('method', 'GET'));
    $spoofed = in_array($method, ['PUT', 'PATCH', 'DELETE']);
    $formMethod = $spoofed ? 'POST' : $method;
@endphp

<form {{ $attributes->except('method')->merge(['class' => 'max-w-3xl mx-auto space-y-6', 'method' => $formMethod, 'enctype' => 'multipart/form-data']) }}>
    @if($formMethod !== 'GET')
        @csrf
    @endif
    @if($spoofed)
        @method($method)
    @endif

    {{ $slot }}
</form>
