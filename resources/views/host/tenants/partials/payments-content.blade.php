{{-- Cards View --}}
<div x-show="activeView === 'cards'" x-transition class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 mt-7" >
    <form method="GET">
        {{-- Month Filter --}}
        <select name="invoice_month">
            <option value="">All Months</option>
            @foreach($invoiceMonths as $month)
                <option value="{{ $month }}" {{ request('invoice_month') == $month ? 'selected' : '' }}>
                    {{ \Carbon\Carbon::createFromFormat('Y-m', $month)->format('M Y') }}
                    {{-- Outputs: Jan 2025, Feb 2025, etc. --}}
                </option>
            @endforeach
        </select>

        {{-- Status Filter --}}
        <select name="invoice_status">
            <option value="">All Status</option>
            <option value="unpaid"  {{ request('invoice_status') == 'unpaid'  ? 'selected' : '' }}>Unpaid</option>
            <option value="paid"    {{ request('invoice_status') == 'paid'    ? 'selected' : '' }}>Paid</option>
            <option value="overdue" {{ request('invoice_status') == 'overdue' ? 'selected' : '' }}>Overdue</option>
        </select>

        <button type="submit">Filter</button>
    </form>

    {{-- Payments Table --}}
    @foreach($allInvoices as $invoice)
        <tr>
            <td>{{ $invoice->rental->tenant->user->name }}</td>
            <td>{{ $invoice->rental->listing->title }}</td>
            <td>{{ $invoice->due_date->format('M d, Y') }}</td>
            <td>₱{{ number_format($invoice->amount, 2) }}</td>
            <td>
            <span class="badge badge-{{ $invoice->status }}">
                {{ ucfirst($invoice->status) }}
            </span>
            </td>
        </tr>
    @endforeach

    {{ $allInvoices->links() }}

    @forelse($myTenants as $myTenant)
        <x-tenant-card :$myTenant/>

    @empty
        <div class="col-span-full flex flex-col items-center  mx-auto  text-base-content/70 italic ">
            <img src="{{asset('images/payments.svg')}}" alt="Payments" class="w-52 lg:w-64">
            <p class="text-base-content/70 text-center italic mt-5">None at the moment</p>
        </div>
    @endforelse
</div>

{{-- List View --}}
<div x-show="activeView === 'lists'" x-transition>
    <div class="overflow-x-auto">
        <table class="table">
            <!-- head -->
            <thead>
            <tr>
                <th class="md:hidden">Tenant list</th>
                <th class="hidden md:table-cell">Name</th>
                <th class="hidden md:table-cell">Listing</th>
                <th class="hidden md:table-cell">Monthly Rent</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @forelse($myTenants as $myTenant)
                <x-tenant-list :$myTenant/>

            @empty
                <tr>
                    <td colspan="4" class=" text-center text-base-content/70 italic">
                        <img src="{{asset('images/payments.svg')}}" alt="Payments" class="w-52 lg:w-64 mx-auto ">
                        <p class="mt-5">No available tenants</p>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

{{ $myTenants->links() }}
