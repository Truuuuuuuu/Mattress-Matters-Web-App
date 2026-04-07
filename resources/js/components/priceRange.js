const minRange = document.getElementById('minRange');
const maxRange = document.getElementById('maxRange');
const minLabel = document.getElementById('minLabel');
const maxLabel = document.getElementById('maxLabel');
const trackFill = document.getElementById('trackFill');

function update() {
    let minVal = parseInt(minRange.value);
    let maxVal = parseInt(maxRange.value);

    if (minVal > maxVal - 10) {
        if (this === minRange) minRange.value = maxVal - 10;
        else maxRange.value = minVal + 10;
        minVal = parseInt(minRange.value);
        maxVal = parseInt(maxRange.value);
    }

    const total = parseInt(minRange.max) - parseInt(minRange.min);
    const leftPct = ((minVal - parseInt(minRange.min)) / total) * 100;
    const rightPct = ((maxVal - parseInt(minRange.min)) / total) * 100;

    trackFill.style.left = leftPct + '%';
    trackFill.style.width = (rightPct - leftPct) + '%';

    minLabel.textContent = '₱' + minVal.toLocaleString();
    maxLabel.textContent = '₱' + maxVal.toLocaleString();
}

minRange.addEventListener('input', update);
maxRange.addEventListener('input', update);
update();
