import { createIcons, icons } from 'lucide';

let currentStep = 1;
const totalSteps = 5;

// ─── Step Navigation ───────────────────────────────────────
window.showStep = function(step) {
    for (let i = 1; i <= totalSteps; i++) {
        document.getElementById(`step-${i}`).classList.add('hidden');
    }
    document.getElementById(`step-${step}`).classList.remove('hidden');
    updateStepsIndicator(step);
}

window.nextStep = function() {
    if (currentStep < totalSteps) {
        currentStep++;
        showStep(currentStep);
        localStorage.setItem('wizard_step', currentStep); // ← save step
    }
    if (currentStep === 5) {
        populateReview();
    }
}

window.prevStep = function() {
    if (currentStep > 1) {
        currentStep--;
        showStep(currentStep);
        localStorage.setItem('wizard_step', currentStep); // ← save step
    }
}

// ─── Steps Indicator ───────────────────────────────────────
function updateStepsIndicator(step) {
    const steps = document.querySelectorAll('.step');
    steps.forEach((el, index) => {
        if (index < step) {
            el.classList.add('step-neutral');
        } else {
            el.classList.remove('step-neutral');
        }
    });
}

// ─── Review ────────────────────────────────────────────────
function populateReview() {
    const get = (id) => document.getElementById(id);

    const setText = (targetId, sourceId, fallback = '—') => {
        const target = get(targetId);
        const source = get(sourceId);
        if (!target) return console.warn(`Review element not found: #${targetId}`);
        if (!source) return console.warn(`Input not found: #${sourceId}`);

        const hasValue = source.value.trim() !== '';
        target.value = hasValue ? source.value : fallback; // ← all use .value
        target.classList.toggle('text-stone-400', !hasValue);
        target.classList.toggle('text-stone-700', hasValue);
    };

    setText('review_title',       'title');
    setText('review_address',     'address');
    setText('review_description', 'description');
    setText('review_slot', 'slot');
    setText('review_rent_cost', 'rent_cost');
    setText('review_water_supply_cost', 'water_supply_cost');
    setText('review_electricity_cost', 'electricity_cost');

    const checked = document.querySelectorAll('input[name="amenities[]"]:checked');
    const reviewAmenities = document.getElementById('review_amenities');

    reviewAmenities.innerHTML = '';

    if (checked.length === 0) {
        reviewAmenities.innerHTML = '<span class="text-stone-400 text-sm">—</span>';
    } else {

        checked.forEach(cb => {
            const tag = document.createElement('div');
            tag.className = 'card bg-base-200 border border-gray-500 px-4 py-3 flex flex-row items-center gap-3';
            tag.innerHTML = `
        <i data-lucide="${cb.dataset.icon}" class="w-5 h-5"></i>
        <span class="text-sm font-medium">${cb.dataset.label}</span>
    `;
            reviewAmenities.appendChild(tag);
        });

        createIcons({ icons });
    }

}

// ─── localStorage ──────────────────────────────────────────
function saveToLocalStorage() {
    const fields = ['title', 'address', 'description', 'slot', 'rent_cost', 'water_supply_cost', 'electricity_cost'];
    fields.forEach(id => {
        const el = document.getElementById(id);
        if (el) el.addEventListener('input', () => {
            localStorage.setItem('wizard_' + id, el.value);
        });
    });

    // ─── Checkboxes (amenities) ───────────────────────────
    document.querySelectorAll('input[name="amenities[]"]').forEach(checkbox => {
        checkbox.addEventListener('change', () => {
            // Save all checked values as a JSON array
            const checked = Array.from(document.querySelectorAll('input[name="amenities[]"]:checked'))
                .map(cb => cb.value);
            localStorage.setItem('wizard_amenities', JSON.stringify(checked));
        });
    });
}

function restoreFromLocalStorage() {
    const fields = ['title', 'address', 'description', 'slot', 'rent_cost', 'water_supply_cost', 'electricity_cost', 'amenities[]'];
    fields.forEach(id => {
        const saved = localStorage.getItem('wizard_' + id);
        const el = document.getElementById(id);
        if (el && saved) el.value = saved;
    });

    // ─── Checkboxes (amenities) ───────────────────────────
    const savedAmenities = localStorage.getItem('wizard_amenities');
    if (savedAmenities) {
        const checked = JSON.parse(savedAmenities);
        document.querySelectorAll('input[name="amenities[]"]').forEach(checkbox => {
            checkbox.checked = checked.includes(checkbox.value);
        });
    }

    // Restore last active step
    const savedStep = localStorage.getItem('wizard_step');
    if (savedStep) {
        currentStep = parseInt(savedStep);
        showStep(currentStep);
    }
}

// ─── Init ──────────────────────────────────────────────────
document.addEventListener('DOMContentLoaded', () => {
    restoreFromLocalStorage();
    saveToLocalStorage();

    document.querySelector('form').addEventListener('submit', () => {
        const fields = ['title', 'address', 'description', 'slot', 'rent_cost', 'water_supply_cost', 'electricity_cost', 'amenities[]'];
        fields.forEach(id => localStorage.removeItem('wizard_' + id));
        localStorage.removeItem('wizard_amenities');
        localStorage.removeItem('wizard_step');
    });
});
