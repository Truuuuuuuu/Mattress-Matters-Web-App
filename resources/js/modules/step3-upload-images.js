const uploaded = { cover: false, photo1: false, photo2: false };

// ─── Guard against refresh/close on ANY step once photos are uploaded ─────────
function updateBeforeUnloadGuard() {
    const hasAnyPhoto = Object.values(uploaded).some(Boolean);
    if (hasAnyPhoto) {
        window.onbeforeunload = (e) => {
            e.preventDefault();
            e.returnValue = 'sdsd';
        };
    } else {
        window.onbeforeunload = null;
    }
}

// ─── File Select & Drag/Drop ──────────────────────────────
window.handleFileSelect = function(input, zone) {
    const file = input.files[0];
    if (file) setPreview(zone, file);
}

window.handleDragOver = function(e, zone) {
    e.preventDefault();
    document.getElementById('zone-' + zone).classList.add('border-amber-400', 'bg-amber-50', 'scale-[1.01]');
}

window.handleDragLeave = function(e, zone) {
    document.getElementById('zone-' + zone).classList.remove('border-amber-400', 'bg-amber-50', 'scale-[1.01]');
}

window.handleDrop = function(e, zone) {
    e.preventDefault();
    window.handleDragLeave(e, zone);
    const file = e.dataTransfer.files[0];
    if (file && file.type.startsWith('image/')) {
        const input = document.getElementById('input-' + zone);
        const dt = new DataTransfer();
        dt.items.add(file);
        input.files = dt.files;
        setPreview(zone, file);
    }
}

window.clearImage = function(zone) {
    document.getElementById('input-' + zone).value = '';
    document.getElementById('preview-' + zone).src = '';
    document.getElementById('preview-' + zone).classList.add('hidden');
    document.getElementById('actions-' + zone).classList.add('hidden');
    document.getElementById('empty-' + zone).classList.remove('hidden');

    if (zone === 'cover') {
        document.getElementById('badge-cover').classList.add('hidden');
    }

    const zoneEl = document.getElementById('zone-' + zone);
    zoneEl.classList.add('border-dashed', 'border-stone-300', 'bg-stone-50');
    zoneEl.classList.remove('border-transparent');

    uploaded[zone] = false;
    updateUI();
}

window.validatePhotoStep = function() {
    if (!uploaded.cover) {
        const hint = document.getElementById('photoCount');
        hint.classList.add('text-red-500');
        hint.textContent = '⚠ Cover photo is required before continuing.';
        return false;
    }
    return true;
}

function setPreview(zone, file) {
    const reader = new FileReader();
    reader.onload = (e) => {
        document.getElementById('empty-' + zone).classList.add('hidden');
        document.getElementById('preview-' + zone).src = e.target.result;
        document.getElementById('preview-' + zone).classList.remove('hidden');
        document.getElementById('actions-' + zone).classList.remove('hidden');

        if (zone === 'cover') {
            document.getElementById('badge-cover').classList.remove('hidden');
        }

        const zoneEl = document.getElementById('zone-' + zone);
        zoneEl.classList.remove('border-dashed', 'border-stone-300', 'bg-stone-50');
        zoneEl.classList.add('border-transparent');

        uploaded[zone] = true;
        updateUI();
    };
    reader.readAsDataURL(file);
}

function updateUI() {
    const count = Object.values(uploaded).filter(Boolean).length;
    const hasCover = uploaded.cover;

    const hint = document.getElementById('photoCount');
    if (hint) {
        hint.classList.remove('text-red-500');
        hint.textContent = count + ' / 3 photos added' + (!hasCover ? ' · Cover photo is required' : '');
    }

    // Keep guard in sync whenever upload state changes
    updateBeforeUnloadGuard();
}
