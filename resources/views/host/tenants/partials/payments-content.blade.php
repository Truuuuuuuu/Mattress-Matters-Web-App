{{-- Cards View --}}
<div x-show="activeView === 'cards'" x-transition class="grid md:grid-cols-2 lg:grid-cols-3 gap-4 mt-7" >
    <form method="GET" class="col-span-full">
        <input type="hidden" name="tab" value="{{ request('tab') }}">
        <div class=" flex flex-wrap items-end justify-start gap-3 ">

            {{-- Month --}}
            <div class="form-control">
                <label class="label py-1">
                    <span class="label-text text-sm">Month</span>
                </label>

                <select name="invoice_month"
                        class="select select-bordered select-primary rounded-2xl select-sm w-full max-w-40">
                    <option value="">All Months</option>

                    @foreach($invoiceMonths as $month)
                        <option value="{{ $month }}"
                            {{ request('invoice_month') == $month ? 'selected' : '' }}>
                            {{ \Carbon\Carbon::createFromFormat('Y-m', $month)->format('M Y') }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Status --}}
            <div class="form-control">
                <label class="label py-1">
                    <span class="label-text text-sm">Status</span>
                </label>

                <select name="invoice_status"
                        class="select select-bordered select-primary rounded-2xl select-sm w-full max-w-36">
                    <option value="">All Status</option>
                    <option value="unpaid"  {{ request('invoice_status') == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                    <option value="paid"    {{ request('invoice_status') == 'paid' ? 'selected' : '' }}>Paid</option>
                    <option value="overdue" {{ request('invoice_status') == 'overdue' ? 'selected' : '' }}>Overdue</option>
                </select>
            </div>

            {{-- Actions --}}
            <div class="flex gap-2">
                <button type="submit"
                        class="btn btn-primary btn-sm rounded-2xl px-5">
                    Filter
                </button>

                <a href="{{ url()->current() }}?tab={{ request('tab') }}" class="btn btn-ghost btn-sm rounded-2xl">
                    Reset
                </a>
            </div>

        </div>
    </form>

    {{-- Payments Table --}}
    @forelse($allInvoices as $invoice)
        <x-tenant-invoice-card :$invoice/>
    @empty
        <div class="col-span-full flex flex-col items-center mx-auto  text-base-content/70 italic ">
            <img src="{{asset('images/payments.svg')}}" alt="Move-out" class="w-52 lg:w-64">
            <p class="text-base-content/70 text-center italic -mt-5">None at the moment</p>
        </div>
    @endforelse

    {{ $allInvoices->links() }}

</div>

{{-- List View --}}
<div x-show="activeView === 'lists'" x-transition>
    <form method="GET" class="col-span-full">
        <input type="hidden" name="tab" value="{{ request('tab') }}">
        <div class=" flex flex-wrap items-end justify-start gap-3 ">

            {{-- Month --}}
            <div class="form-control">
                <label class="label py-1">
                    <span class="label-text text-sm">Month</span>
                </label>

                <select name="invoice_month"
                        class="select select-bordered select-primary rounded-2xl select-sm w-full max-w-40">
                    <option value="">All Months</option>

                    @foreach($invoiceMonths as $month)
                        <option value="{{ $month }}"
                            {{ request('invoice_month') == $month ? 'selected' : '' }}>
                            {{ \Carbon\Carbon::createFromFormat('Y-m', $month)->format('M Y') }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Status --}}
            <div class="form-control">
                <label class="label py-1">
                    <span class="label-text text-sm">Status</span>
                </label>

                <select name="invoice_status"
                        class="select select-bordered select-primary rounded-2xl select-sm w-full max-w-36">
                    <option value="">All Status</option>
                    <option value="unpaid"  {{ request('invoice_status') == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                    <option value="paid"    {{ request('invoice_status') == 'paid' ? 'selected' : '' }}>Paid</option>
                    <option value="overdue" {{ request('invoice_status') == 'overdue' ? 'selected' : '' }}>Overdue</option>
                </select>
            </div>

            {{-- Actions --}}
            <div class="flex gap-2">
                <button type="submit"
                        class="btn btn-primary btn-sm rounded-2xl px-5">
                    Filter
                </button>

                <a href="{{ url()->current() }}?tab={{ request('tab') }}" class="btn btn-ghost btn-sm rounded-2xl">
                    Reset
                </a>
            </div>

        </div>
    </form>
    <div class="overflow-x-auto">
        <table class="table">
            <!-- head -->
            <thead>
            <tr>
                <th class="md:hidden">Invoice list</th>
                <th class="hidden md:table-cell">Tenant</th>
                <th class="hidden md:table-cell">Due Date</th>
                <th class="hidden md:table-cell">Monthly Rent</th>
                <th class="hidden md:table-cell">Status</th>
            </tr>
            </thead>
            <tbody>
            @forelse($allInvoices as $invoice)
                <x-tenant-invoice-list :$invoice/>

            @empty
                <tr>
                    <td colspan="4" class=" text-center text-base-content/70 italic">
                        <img src="{{asset('images/payments.svg')}}" alt="Payments" class="w-52 lg:w-64 mx-auto ">
                        <p class="mt-5">None at the moment</p>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

{{ $myTenants->links() }}
