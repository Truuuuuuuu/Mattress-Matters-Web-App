@props(['label', 'name', 'value' => null])

<x-forms.field :$label :$name>
    <textarea
        name="{{ $name }}"
        id="{{ $name }}"
        rows="7"
        maxlength="2000"

        {{ $attributes->class(['w-full border border-black/50 shadow-md py-2 resize-none overflow-y-auto']) }}
    >{{ old($name, $value) }}</textarea>
</x-forms.field>
