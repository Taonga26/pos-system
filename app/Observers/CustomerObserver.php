<?php

namespace App\Observers;

use App\Models\ActivityLog;
use App\Models\Customer;

class CustomerObserver
{
    /**
     * Handle the Customer "created" event.
     */
    public function created(Customer $customer): void
    {
        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'Created',
            'module' => 'Customer',
            'record_id' => $customer->id,
            'descripion' => 'Created {$customer->first_name} {$customer->last_name}'
        ]);
    }

    /**
     * Handle the Customer "updated" event.
     */
    public function updated(Customer $customer): void
    {
        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'Updated',
            'module' => 'Customer',
            'record_id' => $customer->id,
            'descripion' => 'Updated {$customer->first_name} {$customer->last_name}'
        ]);
    }

    /**
     * Handle the Customer "deleted" event.
     */
    public function deleted(Customer $customer): void
    {
        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'Deleted',
            'module' => 'Customer',
            'record_id' => $customer->id,
            'descripion' => 'Deleted {$customer->first_name} {$customer->last_name}'
        ]);
    }

    /**
     * Handle the Customer "restored" event.
     */
    public function restored(Customer $customer): void
    {
        //
    }

    /**
     * Handle the Customer "force deleted" event.
     */
    public function forceDeleted(Customer $customer): void
    {
        //
    }
}
