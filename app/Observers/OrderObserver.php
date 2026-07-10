<?php

namespace App\Observers;

use App\Models\ActivityLog;
use App\Models\Order;

class OrderObserver
{
    /**
     * Handle the Order "created" event.
     */
    public function created(Order $order): void
    {
        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'Created',
            'module' => 'Order',
            'record_id' => $order->id,
            'descripion' => 'Created {$order->order_name}'
        ]);
    }

    /**
     * Handle the Order "updated" event.
     */
    public function updated(Order $order): void
    {
        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'Updated',
            'module' => 'Order',
            'record_id' => $order->id,
            'descripion' => 'Updated {$order->order_name}'
        ]);
    }

    /**
     * Handle the Order "deleted" event.
     */
    public function deleted(Order $order): void
    {
        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'Deleted',
            'module' => 'order',
            'record_id' => $order->id,
            'descripion' => 'Deleted {$order->order_name}'
        ]);
    }

    /**
     * Handle the Order "restored" event.
     */
    public function restored(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "force deleted" event.
     */
    public function forceDeleted(Order $order): void
    {
        //
    }
}
