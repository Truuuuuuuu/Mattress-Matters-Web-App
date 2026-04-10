
document.addEventListener('DOMContentLoaded', () => {
    const listingsIndex = document.getElementById('listings-index');
    if (!listingsIndex) return; // only runs on listings.index page

    document.getElementById('clear_filters_btn').addEventListener('click', () => {


        const modal = document.getElementById('feature_modal');

        modal.querySelectorAll('input[type="checkbox"]').forEach(cb => {
            cb.checked = false;
            cb.dispatchEvent(new Event('change')); // ← triggers updateLabel()
        });

        modal.querySelectorAll('input[type="range"]').forEach(range => {
            range.value = range.defaultValue;
            range.dispatchEvent(new Event('input'));
        });

        modal.querySelectorAll('input[type="number"], input[type="text"]').forEach(input => {
            input.value = input.defaultValue;
            input.dispatchEvent(new Event('input'));
        });
    });
});

