
let currentStep = 1;
const totalSteps = 5;

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
    }
}

window.prevStep = function() {
    if (currentStep > 1) {
        currentStep--;
        showStep(currentStep);
    }
}

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
