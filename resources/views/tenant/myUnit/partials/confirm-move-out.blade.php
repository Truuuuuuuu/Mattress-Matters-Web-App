<dialog id="confirm_move_out_modal" class="modal">
    <div class="modal-box rounded-3xl">
        <h3 class="font-bold text-lg">Move Out</h3>
        <p class="py-2 text-sm text-gray-500">
            You can submit your move-out notice starting <strong>7 days </strong>from today, up to <strong>30 days </strong> in advance.
            The host will be notified and your rental will end on your selected date.
        </p>
        <form method="POST" action="{{ route('tenant.moveOutNotice.store', $rental) }}">
            @csrf
            <div class="mt-2">
                <label  class="label text-sm font-semibold">Move Out Date</label>
                <input id="move_out_date" type="date" name="move_out_date" class="input input-outline rounded-3xl focus:input-primary bg-base-100 w-full" required>
            </div>

            <div class="mt-2">
                <label class="label text-sm font-semibold">Reason (optional)</label>
                <textarea name="reason" class="textarea textarea-bordered rounded-3xl focus:textarea-primary min-h-24  resize-none max-h-24 w-full"></textarea>
            </div>
            <div class="modal-action">
                <button type="button" class="btn btn-ghost rounded-3xl" onclick="confirm_move_out_modal.close()">Cancel</button>
                <button type="submit" class="btn text-white  bg-red-600 rounded-3xl">Confirm Move Out</button>
            </div>
        </form>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>


<script>
    const minDate = new Date();
    const maxDate = new Date();
    minDate.setDate(minDate.getDate() + 7);
    maxDate.setDate(maxDate.getDate() + 30);

    const input = document.getElementById('move_out_date');
    input.min = minDate.toISOString().split('T')[0];
    input.max = maxDate.toISOString().split('T')[0];
</script>
