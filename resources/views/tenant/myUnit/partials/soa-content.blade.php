

    <div id="soa-page"  class="max-w-4xl mx-auto px-4 py-8 ">

        @if(!$rental)
            <p class="text-gray-500 text-center">You don't have an active rental yet.</p>
        @else

            {{-- Next Due Banner --}}
            <div class="bg-primary/10 border border-primary rounded-3xl p-5 mb-6 flex justify-between items-center">
                <div>
                    <p class="text-sm text-base-content/70 font-semibold">Due Date</p>
                    <p class="text-2xl font-bold text-primary">{{ $nextDue?->format('F d, Y') ?? 'Wait for next month\'s invoice'}}</p>
                    <p class="text-lg text-base-content font-semibold mt-1">
                        ₱{{ number_format($rental->totalAmountDue()) }} / month
                    </p>
                </div>
            </div>

            @forelse($invoices as $invoice)
                <x-soa-card-mobile :$invoice/>
            @empty
                <div class="px-4 py-8 text-center text-gray-400">
                    No invoices yet.
                </div>
            @endforelse

        @endif
    </div>
