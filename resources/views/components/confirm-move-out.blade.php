<dialog id="move_out_modal" class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg">Move Out</h3>
        <p class="py-2 text-sm text-gray-500">
            Your landlord will be notified and your rental will end on your selected date.
        </p>
        <form method="POST" action="{{ route('tenant.moveOutNotice.store', $rental) }}">
            @csrf
            <div class="mt-2">
                <label  class="label">Move Out Date</label>
                <input id="move_out_date" type="date" name="move_out_date" class="input input-bordered w-full" required>
            </div>

            <div class="mt-2">
                <label class="label">Reason (optional)</label>
                <textarea name="reason" class="textarea textarea-bordered w-full"></textarea>
            </div>
            <div class="modal-action">
                <button type="button" class="btn" onclick="move_out_modal.close()">Cancel</button>
                <button type="submit" class="btn btn-error">Confirm Move Out</button>
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
