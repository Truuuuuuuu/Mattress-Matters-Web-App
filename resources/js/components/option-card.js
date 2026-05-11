function updateLabel(input) {
    const label = input.closest('label');
    label.classList.toggle('border-primary', input.checked);
    label.classList.toggle('text-primary', input.checked);
    label.classList.toggle('border-gray-300', !input.checked);
    label.classList.toggle('text-base-content', !input.checked);
}

function updateGroup(changedInput) {
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
