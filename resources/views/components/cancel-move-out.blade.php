<dialog id="cancel_move_out_modal" class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg">Cancel Move Out Notice</h3>
        <p class="py-2 text-sm text-gray-500">
            Are you sure you want to cancel your move out notice? Your landlord will be notified.
        </p>
        <form method="POST" action="{{ route('tenant.moveOutNotice.update', $rental) }}">
            @csrf
            @method('PATCH')
            <div class="modal-action">
                <button type="button" class="btn" onclick="cancel_move_out_modal.close()">Cancel</button>
                <button type="submit" class="btn btn-error">Confirm Move Out</button>
            </div>
        </form>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>


