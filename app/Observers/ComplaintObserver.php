<?php

namespace App\Observers;

use App\Models\Complaint;
use App\Mail\ComplaintStatusChanged;
use Illuminate\Support\Facades\Mail;

class ComplaintObserver
{
    /**
     * Handle the Complaint "created" event.
     */
    public function created(Complaint $complaint): void
    {
        // Optionally notify on creation
    }

    /**
     * Handle the Complaint "updated" event.
     */
    public function updated(Complaint $complaint): void
    {
        // Check if status changed
        if ($complaint->wasChanged('status')) {
            $oldStatus = $complaint->getOriginal('status');
            $newStatus = $complaint->status;
            
            // Only send email if status actually changed and user exists
            if ($oldStatus !== $newStatus && $complaint->user && $complaint->user->email) {
                try {
                    Mail::to($complaint->user->email)->send(
                        new \App\Mail\ComplaintStatusChanged($complaint, $oldStatus, $newStatus)
                    );
                } catch (\Exception $e) {
                    // Log error but don't fail the update
                    \Log::error('Failed to send status change email: ' . $e->getMessage());
                }
            }
        }
    }

    /**
     * Handle the Complaint "deleted" event.
     */
    public function deleted(Complaint $complaint): void
    {
        //
    }

    /**
     * Handle the Complaint "restored" event.
     */
    public function restored(Complaint $complaint): void
    {
        //
    }

    /**
     * Handle the Complaint "force deleted" event.
     */
    public function forceDeleted(Complaint $complaint): void
    {
        //
    }
}

