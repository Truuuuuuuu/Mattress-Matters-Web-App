@props(['invoice'])

<!-- row  -->
<tr>
    <td>
        <div class="flex items-center gap-3">
            <x-avatar-squircle :user="$invoice->rental->tenant->user"/>
            {{--Name--}}
            <div>
                <p class="font-bold {{ $invoice->status !== 'overdue' ? 'text-base-content' : 'text-red-600' }}">{{$invoice->rental->tenant->user->name}}</p>
                <p class="text-sm opacity-50 line-clamp-1">{{$invoice->rental->listing->title}}</p>
            </div>
        </div>
    </td>
    {{--Listing title--}}
    <td class="hidden md:table-cell">
        {{$invoice->due_date->format('M d, Y')}}
    </td>
    {{--listing rent cost--}}
    <td class="hidden md:table-cell">₱{{number_format($invoice->rental->totalAmountDue(),2)}}</td>
    @php
        $statusConfig = match($invoice->status) {
            'unpaid'  => ['class' => 'badge-warning',    'label' => 'Unpaid'],
            'paid' => ['class' => 'badge-success',  'label' => 'Paid'],
            'overdue' => ['class' => 'badge-error', 'label' => 'Overdue'],
            default     => ['class' => 'badge-ghost',    'label' => ucfirst($invoice->status)],
        };
    @endphp

    <td>
        <div class="badge badge-soft {{ $statusConfig['class'] }} mt-2 font-semibold rounded-2xl f">
            {{ $statusConfig['label'] }}
        </div>
    </td>
</tr>

