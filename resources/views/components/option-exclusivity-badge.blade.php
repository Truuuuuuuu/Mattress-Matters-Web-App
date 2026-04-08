@props(['value', 'type', 'name', 'label' => '', 'checked' => false])

<label class="rounded-lg bg-base-200 shadow-sm p-2 cursor-pointer border-1 transition hover:bg-base-300">
    <input type="{{ $type }}" name="{{ $name }}" value="{{ $value }}"
           data-label="{{ $label }}"
           @checked($checked)
           class="hidden option-input "/>

    <div class="flex items-center gap-3 text-sm justify-center text-center ">
        {{ $slot }}
    </div>
</label>

@once
    <script>
        function updateLabel(input) {
            const label = input.closest('label');
            label.classList.toggle('border-primary', input.checked);
            label.classList.toggle('text-primary', input.checked);
            label.classList.toggle('border-gray-300', !input.checked);
            label.classList.toggle('text-base-content', !input.checked);
        }

        function updateGroup(changedInput) {
            // If radio — update all inputs with the same name
            if (changedInput.type === 'radio') {
                document.querySelectorAll(`.option-input[name="${changedInput.name}"]`)
                    .forEach(input => updateLabel(input));
            } else {
                updateLabel(changedInput);
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.option-input').forEach(input => {
                updateLabel(input);
                input.addEventListener('change', () => updateGroup(input));
            });
        });
    </script>
@endonce
