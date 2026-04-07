
setTimeout(() => {
    const toast = document.getElementById('toast-container');
    if (toast) {
    toast.style.transition = 'opacity 0.5s';
    toast.style.opacity = '0';
    setTimeout(() => toast.remove(), 500);
}
}, 3000);

