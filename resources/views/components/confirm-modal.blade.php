{{-- Reusable Confirmation Modal --}}
<dialog id="confirm_modal" class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg" id="modal_title"></h3>
        <p class="py-4 text-sm text-gray-500" id="modal_message"></p>
        <div class="modal-action">
            {{-- Close without action --}}
            <form method="dialog" >
                <button id="modal_close_btn" class="btn "></button>
            </form>

            {{-- Confirm action --}}
            <form method="POST" id="modal_form">
                @csrf
                <input type="hidden" name="_method" value="PATCH">
                <button type="submit" class="btn btn-error" id="modal_confirm_btn"></button>
            </form>
        </div>
    </div>

    {{-- Click outside to close --}}
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>

<script>
    function confirmAction(action, title, message, confirmLabel, closeLabel , method = 'PATCH') {
        document.getElementById('modal_title').textContent = title;
        document.getElementById('modal_message').textContent = message;
        document.getElementById('modal_form').action = action;
        document.getElementById('modal_confirm_btn').textContent = confirmLabel;
        document.getElementById('modal_close_btn').textContent = closeLabel;
        document.querySelector('#modal_form input[name="_method"]').value = method;
        document.getElementById('confirm_modal').showModal();
    }
</script>
