

    const radios = document.querySelectorAll('.theme-controller');
    const serverTheme = '{{ auth()->user()->theme ?? "light" }}';

    // Set initial checked state from server
    radios.forEach(r => {
    if (r.value === serverTheme) r.checked = true;
});

    // On change: update DB via fetch
    radios.forEach(r => {
    r.addEventListener('change', () => {
        fetch('/settings/theme', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ theme: r.value })
        });
    });
});
