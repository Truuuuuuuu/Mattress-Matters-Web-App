<x-layout>
    <x-slot:heading>Statement of Account</x-slot:heading>

    <div id="soa-page"  class="max-w-4xl mx-auto px-4 py-8">

        @if(!$rental)
            <p class="text-gray-500 text-center">You don't have an active rental yet.</p>
        @else

            {{-- Next Due Banner --}}
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-5 mb-6 flex justify-between items-center">
                <div>
                    <p class="text-sm text-blue-500">Next Due Date</p>
                    <p class="text-2xl font-bold text-blue-800">{{ $nextDue->format('F d, Y') }}</p>
                    <p class="text-sm text-blue-500 mt-1">
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
</x-layout>
