@props(['invoice'])

<div class="  rounded-4xl p-5 gap-5 flex flex-col  bg-base-100  backdrop-blur-lg
            border border-white/20 shadow-xs">
    <div class="flex justify-between items-start ">
        <div class="flex gap-3">
            <x-avatar-squircle :user="$invoice->rental->tenant->user"/>
            <div>
                <h1 class="text-xl font-semibold {{ $invoice->status !== 'overdue' ? 'text-base-content' : 'text-red-600' }}">{{$invoice->rental->tenant->user->name}}</h1>
                <p class="text-xs text-base-content/70 font-semibold line-clamp-1">{{$invoice->rental->listing->title}}</p>
            </div>
        </div>
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
    </div>
    <div class="flex justify-between ">

        <div class="hidden md:flex gap-2">
            <div >
                <p class="text-xs font-semibold text-base-content/70">DUE DATE</p>
                <p class="text-md font-semibold line-clamp-1">{{$invoice->due_date->format('M d, Y') ?? 'Awaiting check-in'}}</p>
            </div>
        </div>
        <div class="hidden md:flex  items-center">
            <div class="flex-1 ">
                <p class="text-xs font-semibold text-base-content/70">MONTHLY RENT</p>
                <h1 class="text-2xl font-bold">₱{{number_format($invoice->amount_due,2)}}</h1>
            </div>
        </div>
    </div>


</div>
