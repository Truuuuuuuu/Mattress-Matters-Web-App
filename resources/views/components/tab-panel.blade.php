@props(['name'])

<div x-show="activeTab === '{{ $name }}'" x-transition>
    {{ $slot }}
</div>
