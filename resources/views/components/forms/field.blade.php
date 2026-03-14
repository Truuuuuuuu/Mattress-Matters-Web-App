@props(['label', 'name'])

<div class="w-full">
    <label class="floating-label w-full">
        {{ $slot }}
        @if ($label)
            <span>{{ $label }}</span>
        @endif
    </label>

    <x-forms.error :error="$errors->first($name)" />
</div>
