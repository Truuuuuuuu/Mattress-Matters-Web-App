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
                        ₱{{ number_format($rental->listing->rent_cost, 2) }} / month
                    </p>
                </div>
            </div>

            {{-- Invoice Table --}}
            <div class="bg-white rounded-lg border overflow-hidden">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                    <tr>
                        <th class="px-4 py-3 text-left">Period</th>
                        <th class="px-4 py-3 text-left">Due Date</th>
                        <th class="px-4 py-3 text-left">Amount</th>
                        <th class="px-4 py-3 text-left">Status</th>
                        <th class="px-4 py-3"></th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                    @forelse($invoices as $invoice)
                        <tr>
                            <td class="px-4 py-3 font-medium">
                                {{ \Carbon\Carbon::parse($invoice->period_month)->format('F Y') }}
                            </td>
                            <td class="px-4 py-3 text-gray-500">
                                {{ \Carbon\Carbon::parse($invoice->due_date)->format('M d, Y') }}
                            </td>
                            <td class="px-4 py-3">
                                ₱{{ number_format($invoice->amount_due, 2) }}
                            </td>
                            <td class="px-4 py-3">
                                @php $status = $invoice->computed_status @endphp
                                @if($status === 'paid')
                                    <span class="text-green-600 font-semibold">✓ Paid</span>
                                @elseif($status === 'overdue')
                                    <span class="text-red-500 font-semibold">⚠ Overdue</span>
                                @else
                                    <span class="text-yellow-500 font-semibold">⏳ Unpaid</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-right">
                                @if($invoice->computed_status !== 'paid')
                                    <button type="button"
                                            onclick="payInvoice({{ $invoice->id }})"
                                            class="bg-blue-600 text-white text-xs px-3 py-1.5 rounded hover:bg-blue-700 cursor-pointer">
                                        Pay Now
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-8 text-center text-gray-400">
                                No invoices yet.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

        @endif
    </div>
</x-layout>
