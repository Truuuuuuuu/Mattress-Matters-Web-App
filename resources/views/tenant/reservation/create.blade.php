
{{-- modal --}}
<dialog id="reservationModal" class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg">Confirm Reservation</h3>

        <div class="mt-3 space-y-1">
            <p class="text-base-content/50 lg:text-md " >Title</p>
            <p class="line-clamp-1 text-lg -mt-2" title="{{$listing->title}}">
                {{$listing->title}}
            </p>

            <p class="text-base-content/50 lg:text-md">Monthly Rent</p>
            <p class="-mt-2">₱{{number_format($listing->rent_cost, 2)}}</p>
            {{-- any other listing info --}}

        </div>

        @role('tenant')
        <form action="{{ route('tenant.reservations.store', $listing) }}" method="POST" class="mt-4">
            @csrf
            <input type="hidden" name="tenant_id" value="{{ auth()->user()->id}}">
            <input type="hidden" name="listing_id" value="{{ $listing->id }}">

            <div class="space-y-3 w-full">
                <label for="start_date" class="cursor-pointer font-semibold">Start Date</label>
                <input type="date" id="start_date" name="start_date" class="input input-neutral w-full">
                @error('start_date')
                <p class="text-red-500 text-sm">Please input start date</p>
                @enderror

                <label for="end_date" class="cursor-pointer font-semibold">End Date <span class="italic">(Optional)</span></label>
                <input type="date" id="end_date" name="end_date" class="input input-neutral w-full">
                <p class="text-sm font-regular text-base-content/50 -mt-3">Leave the end date blank if your stay is indefinite.</p>

            </div>

            <div class="modal-action">
                <button type="button" onclick="reservationModal.close()" class="btn">Cancel</button>
                <button type="submit" class="btn btn-neutral">Confirm</button>
            </div>
        </form>
        @endrole

    </div>
</dialog>

{{--avoid setting start date to past date and current day--}}
<script>
    const tomorrow = new Date();
    tomorrow.setDate(tomorrow.getDate() + 2);
    document.getElementById('start_date').min = tomorrow.toISOString().split('T')[0];
</script>
