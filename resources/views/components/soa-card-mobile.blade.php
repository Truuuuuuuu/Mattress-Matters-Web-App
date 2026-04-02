@props(['invoice'])

<div class="w-full border rounded-xl p-3 mb-3">
    <div class="flex justify-between">
        <p class="text-md font-semibold">{{ \Carbon\Carbon::parse($invoice->period_month)->format('F Y') }}</p>
        @php $status = $invoice->computed_status @endphp
        @if($status === 'paid')
            <div class="badge badge-success badge-soft gap-1 " >
                <span class="size-2 rounded-full bg-success"></span>
                <p class="text-xs font-semibold">Paid</p>
            </div>
        @elseif($status === 'overdue')
            <div class="badge badge-error badge-soft gap-1 " >
                <span class="size-2 rounded-full bg-error"></span>
                <p class="text-xs font-semibold">Overdue</p>
            </div>
        @else
            <div class="badge badge-warning badge-soft gap-1 " >
                <span class="size-2 rounded-full bg-warning"></span>
                <p class="text-xs font-semibold">Unpaid</p>
            </div>
        @endif
    </div>

    <x-divider class="border border-base-content/10 my-2 "/>

    <div class="flex">
        <div class="flex-auto space-y-1">
            <div>
                <p class="text-xs -mb-1 text-base-content/60">DUE DATE</p>
                <p class="text-sm font-semibold">{{$invoice->due_date->format('M d, Y')}}</p>
            </div>

            <div>
                <p class="text-xs -mb-1 text-base-content/60">AMOUNT DUE</p>
                <p class="text-lg font-bold">₱{{ number_format($invoice->amount_due, 2) }}</p>
            </div>
        </div>
        <div class="flex-1 flex items-end  justify-end ">
            @if($invoice->computed_status !== 'paid')
                <button type="button"
                        onclick="payInvoice({{ $invoice->id }})"
                        class="btn btn-default btn-wide btn-lg text-blue-900 font-semibold text-xs lg:text-lg px-3 py-1.5  hover:bg-blue-700 hover:text-white cursor-pointer">
                        <img src="{{asset('images/Gcash-logo.svg')}}" alt="Gcash" class="w-8">
                        Pay with GCash
                </button>
            @endif
        </div>
    </div>

</div>
