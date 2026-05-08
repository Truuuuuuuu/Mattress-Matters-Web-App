<?php

namespace App\Http\Controllers;

use App\Models\MoveOutNotice;
use App\Models\MoveOutReversal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MoveOutReversalController extends Controller
{
    /**
     * Tenant submits a reversal request for a move-out notice
     * that is past the 24-hour direct-cancellation window.
     */
    public function store(Request $request, MoveOutNotice $notice)
    {
        // 1. Authorize: Only the tenant of this rental can request a reversal
        abort_if($notice->rental->tenant_id !== $request->user()->tenant->id, 403, 'Unauthorized action.');

        // 2. Validate
        $validated = $request->validate([
            'reason' => ['required', 'string', 'max:1000'],
        ], [
            'reason.required' => 'Please provide a reason for requesting a move-out reversal.',
        ]);

        // 3. Check Domain Logic
        if (! $notice->canRequestReversal()) {
            return back()->with('error', $this->reversalBlockReason($notice));
        }

        // 4. Execute
        $notice->reversals()->create([
            'reason' => $validated['reason'],
            'status' => 'pending',
        ]);

        return back()->with('success', 'Your request to stay has been submitted to the host.');
    }

    /**
     * Host approves the reversal → move-out notice is cancelled.
     */
    public function approve(Request $request, MoveOutReversal $reversal)
    {
        // 1. Authorize: Only the host who owns the listing can approve
        abort_if($reversal->moveOutNotice->rental->listing->host_id !== $request->user()->id, 403, 'Unauthorized action.');

        // 2. Validate
        $validated = $request->validate([
            'host_notes' => ['nullable', 'string', 'max:1000'],
        ]);

        if (! $reversal->isPending()) {
            return back()->with('error', 'Only pending reversals can be approved.');
        }

        // 3. Execute
        DB::transaction(function () use ($reversal, $validated) {
            $reversal->update([
                'status'              => 'approved',
                'reviewed_by_host_id' => auth()->id(),
                'host_notes'          => $validated['host_notes'] ?? null,
                'reviewed_at'         => now(),
            ]);

            $reversal->moveOutNotice->update([
                'status'       => 'cancelled',
                'cancelled_at' => now(),
            ]);
        });

        return back()->with('success', 'Move-out reversal approved. The notice is now cancelled.');
    }

    /**
     * Host rejects the reversal → move-out notice remains active.
     */
    public function reject(Request $request, MoveOutReversal $reversal)
    {
        // 1. Authorize: Only the host who owns the listing can reject
        abort_if($reversal->moveOutNotice->rental->listing->host_id !== $request->user()->id, 403, 'Unauthorized action.');

        // 2. Validate
        $validated = $request->validate([
            'host_notes' => ['nullable', 'string', 'max:1000'],
        ]);

        if (! $reversal->isPending()) {
            return back()->with('error', 'Only pending reversals can be rejected.');
        }

        // 3. Execute
        $reversal->update([
            'status'              => 'rejected',
            'reviewed_by_host_id' => auth()->id(),
            'host_notes'          => $validated['host_notes'] ?? null,
            'reviewed_at'         => now(),
        ]);

        return back()->with('success', 'Move-out reversal rejected.');
    }


    private function reversalBlockReason(MoveOutNotice $notice): string
    {
        if ($notice->isCancelled()) {
            return 'This move-out notice is already cancelled.';
        }

        if ($notice->isCancellable()) {
            $hours = $notice->hoursUntilCanCancel();
            return "You can still cancel this notice directly. The free-cancel window closes in {$hours} hour(s).";
        }

        if ($notice->hasPendingReversal()) {
            return 'A reversal request is already pending for this notice.';
        }

        $latest = $notice->latestReversal;
        if ($latest && $latest->isApproved()) {
            return 'This move-out notice has already been reversed.';
        }

        return 'A reversal cannot be requested for this notice at this time.';
    }
}
