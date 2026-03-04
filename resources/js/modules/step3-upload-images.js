
    // Init Lucide icons
    lucide.createIcons();

    const uploaded = { cover: false, photo1: false, photo2: false };

    function handleFileSelect(input, zone) {
    const file = input.files[0];
    if (file) setPreview(zone, file);
}

    function handleDragOver(e, zone) {
    e.preventDefault();
    document.getElementById('zone-' + zone).classList.add('border-amber-400', 'bg-amber-50', 'scale-[1.01]');
}

    function handleDragLeave(e, zone) {
    document.getElementById('zone-' + zone).classList.remove('border-amber-400', 'bg-amber-50', 'scale-[1.01]');
}

    function handleDrop(e, zone) {
    e.preventDefault();
    handleDragLeave(e, zone);
    const file = e.dataTransfer.files[0];
    if (file && file.type.startsWith('image/')) {
    // Assign dropped file to the actual input
    const input = document.getElementById('input-' + zone);
    const dt = new DataTransfer();
    dt.items.add(file);
    input.files = dt.files;
    setPreview(zone, file);
}
}

    function setPreview(zone, file) {
    const reader = new FileReader();
    reader.onload = (e) => {
    document.getElementById('empty-' + zone).classList.add('hidden');
    document.getElementById('preview-' + zone).src = e.target.result;
    document.getElementById('preview-' + zone).classList.remove('hidden');
    document.getElementById('actions-' + zone).classList.remove('hidden');

    // Show cover badge only for cover zone
    if (zone === 'cover') {
    document.getElementById('badge-cover').classList.remove('hidden');
    // Re-init lucide for the badge icon
    lucide.createIcons();
}

    // Remove dashed border styling since image is now shown
    const zoneEl = document.getElementById('zone-' + zone);
    zoneEl.classList.remove('border-dashed', 'border-stone-300', 'bg-stone-50');
    zoneEl.classList.add('border-transparent');

    uploaded[zone] = true;
    updateUI();
};
    reader.readAsDataURL(file);
}

    function clearImage(zone) {
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

    function updateUI() {
    const count = Object.values(uploaded).filter(Boolean).length;
    const hasCover = uploaded.cover;

    // Update counter text
    const hint = document.getElementById('photoCount');
    hint.textContent = count + ' / 3 photos added' + (!hasCover ? ' · Cover photo is required' : '');

    // Toggle continue button
    const btn = document.getElementById('continueBtn');
    if (hasCover) {
    btn.disabled = false;
    btn.classList.remove('bg-stone-100', 'text-stone-300', 'cursor-not-allowed');
    btn.classList.add('bg-amber-400', 'hover:bg-amber-500', 'text-white', 'shadow-md', 'shadow-amber-200');
} else {
    btn.disabled = true;
    btn.classList.add('bg-stone-100', 'text-stone-300', 'cursor-not-allowed');
    btn.classList.remove('bg-amber-400', 'hover:bg-amber-500', 'text-white', 'shadow-md', 'shadow-amber-200');
}
}
