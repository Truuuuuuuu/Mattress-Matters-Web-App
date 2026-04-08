document.addEventListener('DOMContentLoaded', () => {
    // Update hidden inputs when price range changes
    const minRange = document.getElementById('minRange');
    const maxRange = document.getElementById('maxRange');

    function updatePriceFilters() {
        const filterMinInput = document.getElementById('filter_min_price');
        const filterMaxInput = document.getElementById('filter_max_price');
        if (filterMinInput && filterMaxInput && minRange && maxRange) {
            filterMinInput.value = minRange.value;
            filterMaxInput.value = maxRange.value;
        }
    }

    if (minRange && maxRange) {
        minRange.addEventListener('input', updatePriceFilters);
        maxRange.addEventListener('input', updatePriceFilters);
        updatePriceFilters();
    }

    // Sync all values before form submission
    const filterForm = document.getElementById('filter_form');
    if (filterForm) {
        filterForm.addEventListener('submit', (e) => {
            // Sync price values
            if (minRange && maxRange) {
                updatePriceFilters();
            }
            
            // Sync amenities
            const amenitiesContainer = document.getElementById('filter_amenities_mirror');
            if (amenitiesContainer) {
                amenitiesContainer.innerHTML = '';
                document.querySelectorAll('input[name="amenities[]"]:checked').forEach(checked => {
                    const hidden = document.createElement('input');
                    hidden.type = 'hidden';
                    hidden.name = 'amenities[]';
                    hidden.value = checked.value;
                    amenitiesContainer.appendChild(hidden);
                });
            }
            
            // Sync rules
            const exclusivityContainer = document.getElementById('filter_exclusivity_mirror');
            if (exclusivityContainer) {
                exclusivityContainer.innerHTML = '';
                document.querySelectorAll('input[name="rules[]"]:checked').forEach(checked => {
                    const hidden = document.createElement('input');
                    hidden.type = 'hidden';
                    hidden.name = 'rules[]';
                    hidden.value = checked.value;
                    exclusivityContainer.appendChild(hidden);
                });
            }
        });
    }
});

