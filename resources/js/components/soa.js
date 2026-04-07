document.addEventListener('DOMContentLoaded', () => {
    const soaPage = document.getElementById('soa-page');
    if (!soaPage) return; // only runs on SOA page

    window.payInvoice = async function(invoiceId) {
        const btn = event.target;
        btn.disabled = true;
        btn.textContent = 'Processing...';

        try {
            const response = await fetch(`/tenant/rent/pay/${invoiceId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
            });

            const data = await response.json();

            if (data.checkout_url) {
                window.location.href = data.checkout_url;
            } else {
                alert(data.error ?? 'Something went wrong.');
                btn.disabled = false;
                btn.textContent = 'Pay Now';
            }
        } catch (err) {
            alert('Something went wrong.');
            btn.disabled = false;
            btn.textContent = 'Pay Now';
        }
    };
});
