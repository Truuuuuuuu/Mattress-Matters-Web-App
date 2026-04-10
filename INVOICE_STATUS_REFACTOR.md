# Invoice Status Refactor - How It Works

## Summary

The original code:
```php
$nextDue = $tenant->rental?->invoices
    ->where('status', 'unpaid')
    ->sortBy('due_date')
    ->first()
    ?->due_date;
```

Only returned the due date of unpaid invoices. This didn't handle:
- First-time users with no invoices
- Paid invoices
- **Overdue invoices** ⚠️
- Distinguishing between different states

## New Implementation

### Backend (UnitController.php)

```php
$invoiceInfo = [];
if ($tenant->rental?->invoices->count() > 0) {
    $latestInvoice = $tenant->rental->invoices->sortByDesc('created_at')->first();
    
    if ($latestInvoice->status === 'paid') {
        $invoiceInfo = [
            'status' => 'paid',
            'message' => 'Paid',
            'due_date' => null,
        ];
    } elseif ($latestInvoice->status === 'unpaid') {
        // Check if overdue
        $isOverdue = $latestInvoice->due_date < now();
        
        $invoiceInfo = [
            'status' => $isOverdue ? 'overdue' : 'unpaid',
            'message' => $isOverdue 
                ? 'Overdue since ' . $latestInvoice->due_date->format('M d, Y')
                : 'Due: ' . $latestInvoice->due_date->format('M d, Y'),
            'due_date' => $latestInvoice->due_date,
            'invoice' => $latestInvoice,
            'is_overdue' => $isOverdue,
            'days_overdue' => $isOverdue ? $latestInvoice->due_date->diffInDays(now()) : 0,
        ];
    }
} else {
    $invoiceInfo = [
        'status' => 'no_invoice',
        'message' => 'No invoice yet',
        'due_date' => null,
    ];
}

return view('tenant.my-unit', compact('myUnit', 'invoiceInfo'));
```

### Handles All 5 Scenarios

#### 1. **No Invoice (First Time)**
```php
$invoiceInfo = [
    'status' => 'no_invoice',
    'message' => 'No invoice yet',
    'due_date' => null,
];
```
✅ Displays: "No invoice yet" with a Pending badge (blue)

#### 2. **Unpaid Invoice (Due Date in Future)**
```php
$invoiceInfo = [
    'status' => 'unpaid',
    'message' => 'Due: April 30, 2026',
    'due_date' => $latestInvoice->due_date,
    'invoice' => $latestInvoice,
    'is_overdue' => false,
    'days_overdue' => 0,
];
```
✅ Displays: The due date with a "Due" badge (yellow)
✅ Message: "Due: [formatted date]"
✅ No warning

#### 3. **Overdue Invoice** ⚠️ (NEW)
```php
$invoiceInfo = [
    'status' => 'overdue',
    'message' => 'Overdue since March 15, 2026',
    'due_date' => $latestInvoice->due_date,
    'invoice' => $latestInvoice,
    'is_overdue' => true,
    'days_overdue' => 26,  // days past due
];
```
✅ Displays: Date in RED with "Overdue" badge (red)
✅ Message: "Overdue since [date]"
✅ Warning: "⚠️ 26 day(s) overdue"

#### 4. **Paid Invoice**
```php
$invoiceInfo = [
    'status' => 'paid',
    'message' => 'Paid',
    'due_date' => null,
];
```
✅ Displays: "Paid" with a "Paid" badge (green)

#### 5. **New Invoice Generated**
When a new unpaid invoice is generated:
```php
$invoiceInfo = [
    'status' => 'unpaid',  // or 'overdue' if past due
    'message' => 'Due: May 15, 2026',  // ← New due date
    'due_date' => $latestInvoice->due_date,
    'invoice' => $latestInvoice,
];
```
✅ Displays: Updated due date automatically

---

## Frontend (Blade Template)

### Display Logic

```blade
<!-- Status Badge -->
@if($invoiceInfo['status'] === 'paid')
    <span class="badge-success">Paid</span>
@elseif($invoiceInfo['status'] === 'overdue')
    <span class="badge-error">Overdue</span>
@elseif($invoiceInfo['status'] === 'unpaid')
    <span class="badge-warning">Due</span>
@else
    <span class="badge-info">Pending</span>
@endif

<!-- Main Display -->
@if($invoiceInfo['status'] === 'no_invoice')
    No invoice yet
@elseif($invoiceInfo['status'] === 'paid')
    Paid
@elseif($invoiceInfo['status'] === 'overdue')
    <span class="text-error">{{ $invoiceInfo['due_date']?->format('F d, Y') }}</span>
@else
    {{ $invoiceInfo['due_date']?->format('F d, Y') }}
@endif

<!-- Message -->
{{ $invoiceInfo['message'] }}

<!-- Overdue Warning -->
@if($invoiceInfo['status'] === 'overdue')
    <p class="text-error font-semibold">⚠️ {{ $invoiceInfo['days_overdue'] }} day(s) overdue</p>
@endif
```

### Visual Output

| Scenario | Display | Badge | Message | Extra |
|----------|---------|-------|---------|-------|
| No invoice | "No invoice yet" | Pending (blue) | "No invoice yet" | — |
| Unpaid | "April 30, 2026" | Due (yellow) | "Due: April 30, 2026" | — |
| **Overdue** | **April 15, 2026** (red) | **Overdue (red)** | **"Overdue since April 15, 2026"** | **⚠️ 26 day(s) overdue** |
| Paid | "Paid" | Paid (green) | "Paid" | — |
| New invoice | "May 15, 2026" | Due (yellow) | "Due: May 15, 2026" | — |

---

## How Overdue Detection Works

```php
$isOverdue = $latestInvoice->due_date < now();
```

**Examples:**
- Due date: April 15, 2026 | Today: April 16, 2026 → **OVERDUE** ✓
- Due date: April 20, 2026 | Today: April 16, 2026 → **NOT OVERDUE** ✗
- Due date: April 20, 2026 | Today: April 20, 2026 → **NOT OVERDUE** ✗ (same day is OK)

---

## Benefits

✅ **Cleaner Code** - Logic is centralized in controller
✅ **Reusable** - `$invoiceInfo` can be passed to other views
✅ **Scalable** - Easy to add more statuses  
✅ **Better UX** - Clear visual feedback for each state including urgent "overdue" alerts
✅ **Type-Safe** - All keys are predictable
✅ **Days Tracking** - Can track how many days overdue for display/alerts

---

## Available Fields in $invoiceInfo

| Key | Type | Description |
|-----|------|-------------|
| `status` | string | `'no_invoice'`, `'unpaid'`, `'overdue'`, `'paid'` |
| `message` | string | Descriptive message (e.g., "Due: April 30, 2026") |
| `due_date` | Carbon\|null | The due date (null if no invoice or paid) |
| `invoice` | Invoice\|null | Full invoice object (only for unpaid/overdue) |
| `is_overdue` | bool\|null | True if overdue, false if unpaid but not due yet, null otherwise |
| `days_overdue` | int | Number of days overdue (0 if not overdue) |

---

## Testing Overdue Status

### To Test Locally:

```php
// In tinker or seeder, create an invoice with past due date:
$invoice = Invoice::create([
    'rental_id' => 1,
    'amount' => 5000,
    'due_date' => now()->subDays(10),  // 10 days in the past
    'status' => 'unpaid',
]);

// Access tenant dashboard - should show "Overdue" badge
```

### What You'll See:

```
Badge: [Overdue] (red)
Date: April 10, 2026 (shown in red)
Message: Overdue since April 10, 2026
Warning: ⚠️ 10 day(s) overdue
```

---

## Future Enhancements

1. **Email Notification** - Send reminder when invoice becomes overdue
2. **Automated Escalation** - Different levels (1 day, 3 days, 7 days)
3. **Payment Plans** - Allow partial payments for overdue invoices
4. **Late Fees** - Add additional charges for overdue payments
5. **Host Notifications** - Alert host when tenant has overdue invoices
6. **Dashboard Widget** - Show overdue invoices on host dashboard

