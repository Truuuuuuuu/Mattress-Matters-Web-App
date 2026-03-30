document.addEventListener('DOMContentLoaded', () => {
    const btn = document.getElementById('pay-btn');
    if (!btn) return; // only runs on pages with this button

    btn.addEventListener('click', async () => {

        const errorMsg = document.getElementById('error-msg');

        btn.disabled = true;
        btn.textContent = 'Processing...';
        errorMsg.classList.add('hidden');



        const payload = {
            amount: Number(btn.dataset.amount),
            description: btn.dataset.description,
        };

        if (btn.dataset.amountElectric) {
            payload.amountElectric = Number(btn.dataset.amountElectric);
        }

        if (btn.dataset.amountWater) {
            payload.amountWater = Number(btn.dataset.amountWater);
        }

        try {
            const response = await fetch(btn.dataset.url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'ngrok-skip-browser-warning': 'true',
                },
                body: JSON.stringify(payload)
            });

            const data = await response.json();


            if (!response.ok) throw new Error(data.error || 'Something went wrong.');

            window.location.href = data.checkout_url;

        } catch (err) {
            errorMsg.textContent = err.message;
            errorMsg.classList.remove('hidden');
            btn.disabled = false;
            btn.textContent = 'Pay with GCash';
        }
    });
});
