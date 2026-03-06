import { createIcons, icons } from 'lucide';

let currentStep = 1;
const totalSteps = 5;

// ─── Get current user ID from meta tag ────────────────────
const userId = document.querySelector('meta[name="user-id"]')?.content || 'guest';
const wKey = (id) => `wizard_${userId}_${id}`;

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
        localStorage.setItem(wKey('step'), currentStep);
    }
    if (currentStep === 5) {
        populateReview();
    }
}

window.prevStep = function() {
    if (currentStep > 1) {
        currentStep--;
        showStep(currentStep);
        localStorage.setItem(wKey('step'), currentStep);
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
        target.value = hasValue ? source.value : fallback;
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

    //Checkboxes in amenities ────────────────────────────────────────
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

    // ─── Radio buttons rules & restriction ────────────────────────────────────────
    ['gender_rule', 'guest_rule', 'pet_rule', 'curfew_rule', 'smoking_rule'].forEach(name => {
        const selectedRadio = document.querySelector(`input[type="radio"][name="${name}"]:checked`);
        const reviewEl = document.getElementById(`review_${name}`);
        if (!reviewEl) return;

        reviewEl.innerHTML = '';

        if (!selectedRadio) {
            reviewEl.innerHTML = '<span class="text-stone-400 text-sm">—</span>';
        } else {
            const tag = document.createElement('div');
            tag.className = 'card bg-base-200 border border-gray-500 px-4 py-3 flex flex-row items-center gap-3';
            tag.innerHTML = `
            <i data-lucide="${selectedRadio.dataset.icon}" class="w-5 h-5"></i>
            <span class="text-sm font-medium">${selectedRadio.dataset.label}</span>
        `;
            reviewEl.appendChild(tag);
        }
    });
    createIcons({ icons }); // ← moved outside loop, only needs to run once

}

// ─── localStorage ──────────────────────────────────────────
function saveToLocalStorage() {
    const fields = ['title', 'address', 'description', 'slot', 'rent_cost', 'water_supply_cost', 'electricity_cost'];
    fields.forEach(id => {
        const el = document.getElementById(id);
        if (el) el.addEventListener('input', () => {
            localStorage.setItem(wKey(id), el.value);
        });
    });
    // ─── Checkboxes amenities ────────────────────────────────────────
    document.querySelectorAll('input[name="amenities[]"]').forEach(checkbox => {
        checkbox.addEventListener('change', () => {
            const checked = Array.from(document.querySelectorAll('input[name="amenities[]"]:checked'))
                .map(cb => cb.value);
            localStorage.setItem(wKey('amenities'), JSON.stringify(checked));
        });
    });

    // ─── Radio buttons rules & restriction ────────────────────────────────────────
    ['gender_rule', 'guest_rule', 'pet_rule', 'curfew_rule', 'smoking_rule'].forEach(name => {
        document.querySelectorAll(`input[type="radio"][name="${name}"]`).forEach(radio => {
            radio.addEventListener('change', () => {
                localStorage.setItem(wKey(name), radio.value);
            });
        });
    });
}

function restoreFromLocalStorage() {
    const fields = ['title', 'address', 'description', 'slot', 'rent_cost', 'water_supply_cost', 'electricity_cost'];
    fields.forEach(id => {
        const saved = localStorage.getItem(wKey(id));
        const el = document.getElementById(id);
        if (el && saved) el.value = saved;
    });

    // ─── Checkboxes amenities ────────────────────────────────────────
    const savedAmenities = localStorage.getItem(wKey('amenities'));
    if (savedAmenities) {
        const checked = JSON.parse(savedAmenities);
        document.querySelectorAll('input[name="amenities[]"]').forEach(checkbox => {
            checkbox.checked = checked.includes(checkbox.value);
        });
    }

    // ─── Radio buttons rules & restriction ────────────────────────────────────────
    ['gender_rule', 'guest_rule', 'pet_rule', 'curfew_rule', 'smoking_rule'].forEach(name => {
        const saved = localStorage.getItem(wKey(name));
        if (saved) {
            const radio = document.querySelector(`input[type="radio"][name="${name}"][value="${saved}"]`);
            if (radio) radio.checked = true;
        }
    });

    const savedStep = localStorage.getItem(wKey('step'));
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
        const fields = ['title', 'address', 'description', 'slot', 'rent_cost', 'water_supply_cost', 'electricity_cost', 'amenities', 'step', 'gender_rule', 'guest_rule', 'pet_rule', 'curfew_rule', 'smoking_rule'];
        fields.forEach(id => localStorage.removeItem(wKey(id)));
    });
});
