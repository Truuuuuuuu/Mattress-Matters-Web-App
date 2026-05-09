
{{-- modal --}}
<dialog id="reservationModal" class="modal">
    <div class="modal-box rounded-3xl">
        <h3 class="font-bold text-lg text-primary">Confirm Reservation</h3>

        <div class="mt-3 space-y-1">
            <p class="text-base-content/70 lg:text-md " >Title</p>
            <p class="line-clamp-1 text-lg -mt-2 font-semibold " title="{{$listing->title}}">
                {{$listing->title}}
            </p>

            <p class="text-base-content/70 lg:text-md">Monthly Rent</p>
            <p class="-mt-2 text-lg font-semibold">₱{{number_format($listing->rent_cost, 2)}}</p>
            {{-- any other listing info --}}

        </div>

        @role('tenant')
        <form action="{{ route('tenant.reservations.store', $listing) }}" method="POST" class="mt-4 ">
            @csrf
            <input type="hidden" name="tenant_id" value="{{ auth()->user()->id}}">
            <input type="hidden" name="listing_id" value="{{ $listing->id }}">

            <div class="space-y-3 w-full">
                <label for="start_date" class="cursor-pointer font-semibold text-base-content/70">Start Date</label>
                <input type="date" id="start_date" name="start_date" class="input input-default rounded-2xl  w-full" >
                @error('start_date')
                <p class="text-red-500 text-sm">Please input start date</p>
                @enderror


            </div>

            <div class="modal-action">
                <button type="button" onclick="reservationModal.close()" class="btn btn-ghost rounded-3xl">Cancel</button>
                <button type="submit" class="btn btn-primary rounded-3xl ">Confirm</button>
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
