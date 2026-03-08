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
    window.scrollTo({ top: 0, behavior: 'smooth' });

    // Toggle Next / Submit
    const nextBtn = document.getElementById('nextBtn');
    const submitBtn = document.getElementById('submitBtn');


    if (step === totalSteps) {
        nextBtn.classList.add('hidden');
        submitBtn.classList.remove('hidden');
    } else {
        nextBtn.classList.remove('hidden');
        submitBtn.classList.add('hidden');
    }
}

window.nextStep = function() {

    if (!validateStep(currentStep)) return;
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
    try {
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
        ['gender_rule', 'tenant_rule', 'guest_rule', 'pet_rule', 'curfew_rule', 'smoking_rule'].forEach(name => {
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
            <span class="text-sm font-medium py-1">${selectedRadio.dataset.label}</span>
        `;
                reviewEl.appendChild(tag);
            }
        });
        createIcons({ icons }); // ← moved outside loop, only needs to run once

        // ─── Images review ────────────────────────────────────────
        ['cover', 'photo1', 'photo2'].forEach(zone => {
            const src = document.getElementById('preview-' + zone)?.src;
            const reviewImg = document.getElementById('review-' + zone);
            const reviewEmpty = document.getElementById('review-' + zone + '-empty');

            if (src && src !== window.location.href) { // non-empty src
                reviewImg.src = src;
                reviewImg.classList.remove('hidden');
                reviewEmpty.classList.add('hidden');

                if (zone === 'cover') {
                    document.getElementById('review-cover-badge').classList.remove('hidden');
                }
            } else {
                reviewImg.classList.add('hidden');
                reviewEmpty.classList.remove('hidden');
            }
        });
    } catch(e) {
        console.error('populateReview crashed:', e);
    }

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
    ['gender_rule', 'tenant_rule', 'guest_rule', 'pet_rule', 'curfew_rule', 'smoking_rule'].forEach(name => {
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
        if (el && saved) {
            const maxLength = el.maxLength;
            el.value = maxLength > 0 ? saved.slice(0, maxLength) : saved;
        }
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
    ['gender_rule', 'tenant_rule', 'guest_rule', 'pet_rule', 'curfew_rule', 'smoking_rule'].forEach(name => {
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

    document.querySelector('form[action*="/host-store"]').addEventListener('submit', () => {
        window.onbeforeunload = null; // ← remove guard before submit
        const fields = ['title', 'address', 'description', 'slot', 'rent_cost', 'water_supply_cost', 'electricity_cost', 'amenities', 'step', 'gender_rule', 'tenant_rule', 'guest_rule', 'pet_rule', 'curfew_rule', 'smoking_rule'];
        fields.forEach(id => localStorage.removeItem(wKey(id)));
    });

    /*Confirm modal*/
    document.getElementById('confirmSubmitBtn').addEventListener('click', () => {
        document.getElementById('confirmModal').close();
        window.onbeforeunload = null;
        document.querySelector('form[action*="/host-store"]').requestSubmit();
    });

});

function validateStep(step) {
    function showError(id) {
        const el = document.getElementById('error-' + id);
        if (el) el.classList.remove('hidden');
    }

    function clearErrors() {
        document.querySelectorAll('[id^="error-"]').forEach(el => el.classList.add('hidden'));
    }

    clearErrors();
    let valid = true;

    if (step === 1) {
        const title = document.getElementById('title').value.trim();
        const address = document.getElementById('address').value.trim();
        const description = document.getElementById('description').value.trim();
        const slotInput = document.getElementById('slot');
        const slotValue = Number(slotInput.value);

        if (!title || title.length < 8) { showError('title'); valid = false; }
        if (!address || address.length < 10) { showError('address'); valid = false; }
        if (!description || description.length < 20) { showError('description'); valid = false; }
        if (!slotInput.value ||  isNaN(slotValue) || slotValue < 1 || slotValue > 15) { showError('slot'); valid = false; }
    }

    if (step === 2) {
        const rent_cost = document.getElementById('rent_cost').value.trim();
        const amenities = document.querySelectorAll('input[name="amenities[]"]:checked').length > 0;

        if (!rent_cost) { showError('rent_cost'); valid = false; }
        if (!amenities) { showError('amenities'); valid = false; }
    }

    if (step === 3) {
        return validatePhotoStep(); // already handles cover photo check
    }

    if (step === 4) {
        const rules = ['gender_rule', 'tenant_rule', 'guest_rule', 'pet_rule', 'curfew_rule', 'smoking_rule'];
        rules.forEach(name => {
            const selected = document.querySelector(`input[type="radio"][name="${name}"]:checked`);
            if (!selected) { showError(name); valid = false; }
        });
    }

    return valid;
}

