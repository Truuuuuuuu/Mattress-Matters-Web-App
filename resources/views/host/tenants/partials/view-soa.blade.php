<x-layout>
    <x-slot:heading>Tenant SOA</x-slot:heading>
    <div class="min-h-screen bg-base-200 py-8 px-4 md:px-8">

        {{-- Page Header --}}
        <div class="mb-6 flex flex-col gap-1 sm:flex-row sm:items-center sm:justify-between w-full ">
            <div class="w-full">
                <a href="{{ route('host.tenants.index')}}"
                   class="inline-flex items-center gap-1.5 text-sm text-base-content/60 hover:text-primary transition-colors mb-2">
                    <x-lucide-chevron-left class="w-4 h-4"/>
                    Back
                </a>
                <div class="flex justify-between w-full ">
                    <div>
                        <h1 class="text-2xl font-bold text-primary ">Statement of Account</h1>
                        <p class="text-sm text-base-content/50 mt-0.5">Full billing history for this tenant</p>
                    </div>
                    <div class="hidden md:flex gap-2  items-center">
                        <x-avatar-squircle :user="$tenant->user"/>
                        <div><p class="font-semibold">{{ $tenant->user->name }}</p>
                            <p class="text-xs text-base-content/70">
                                Since {{$rental->lease_start_date->format('M, Y')}}</p>
                        </div>
                    </div>
                </div>

            </div>

        </div>



        {{-- Invoice Table --}}
        <div class="card bg-base-100 shadow-sm border border-base-300 rounded-2xl">
            <div class="card-body p-5 md:p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="font-bold text-base">Invoice History</h2>
                    @if($invoices->isNotEmpty())
                        <span class="badge badge-primary badge-sm rounded-lg">
                        {{ $invoices->count() }} {{ Str::plural('record', $invoices->count()) }}
                    </span>
                    @endif
                </div>

                @if($invoices->isEmpty())
                    <div class="flex flex-col items-center justify-center py-16 text-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-base-content/20" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <p class="text-sm text-base-content/40">No invoices on record for this tenant.</p>
                    </div>
                @else
                    <div class="overflow-x-auto -mx-1">
                        <table class="table table-sm w-full">
                            <thead>
                            <tr class="text-xs uppercase tracking-wider text-base-content/40 border-b border-base-200">
                                <th class="py-3 pl-1">Invoice #</th>
                                <th class="py-3">Amount</th>
                                <th class="py-3">Due Date</th>
                                <th class="py-3">Paid On</th>
                                <th class="py-3">Status</th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-base-200">
                            @foreach($invoices as $invoice)
                                <tr class="hover:bg-base-200/40 transition-colors">

                                    {{-- Invoice # --}}
                                    <td class="py-3.5 pl-1 font-mono text-xs text-base-content/60">
                                        {{ $loop->iteration }}
                                    </td>



                                    {{-- Amount --}}
                                    <td class="py-3.5 font-semibold text-sm">
                                        ₱{{ number_format($invoice->amount_due, 2) }}
                                    </td>

                                    {{-- Due Date --}}
                                    <td class="py-3.5 text-sm text-base-content/70">
                                        {{ \Carbon\Carbon::parse($invoice->due_date)->format('M d, Y') }}
                                    </td>

                                    {{-- Paid On --}}
                                    <td class="py-3.5 text-sm text-base-content/70">
                                            {{ $invoice->payment?->updated_at->format('M d, Y') ?? '—' }}
                                    </td>

                                    {{-- Status Badge --}}
                                    <td class="py-3.5">
                                        @php
                                            $statusConfig = match($invoice->status) {
                                                'unpaid'  => ['class' => 'badge-warning',    'label' => 'Unpaid'],
                                                'paid' => ['class' => 'badge-success',  'label' => 'Paid'],
                                                'overdue' => ['class' => 'badge-error', 'label' => 'Overdue'],
                                                default     => ['class' => 'badge-ghost',    'label' => ucfirst($invoice->status)],
                                            };
                                        @endphp
                                        <div class="badge badge-soft {{ $statusConfig['class'] }} mt-2 font-semibold rounded-2xl f">
                                            {{ $statusConfig['label'] }}
                                        </div>
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>


                @endif
            </div>
        </div>

    </div>
</x-layout>
