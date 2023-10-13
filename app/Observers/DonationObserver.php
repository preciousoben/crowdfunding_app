<?php

namespace App\Observers;

use App\Models\Donation;

class DonationObserver
{
    /**
     * Handle the Donation "updated" event.
     */

    public function updated(Donation $donation): void
     {
         // Check if the total amount raised equals or exceeds the target amount
         if ($donation->totalAmountRaised >= $donation->target_amount) {
             // Update the is_complete field to mark the donation as complete
             $donation->update(['is_complete' => true]);
         }
     }
    public function created(Donation $donation): void
    {
        //
    }

    /**
     * Handle the Donation "deleted" event.
     */
    public function deleted(Donation $donation): void
    {
        //
    }

    /**
     * Handle the Donation "restored" event.
     */
    public function restored(Donation $donation): void
    {
        //
    }

    /**
     * Handle the Donation "force deleted" event.
     */
    public function forceDeleted(Donation $donation): void
    {
        //
    }
}
