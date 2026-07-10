<?php

namespace App\Observers;

use App\Models\ActivityLog;
use App\Models\Product;

class ProductObserver
{
    /**
     * Handle the Product "created" event.
     */
    public function created(Product $product): void
    {
        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'Created',
            'module' => 'Product',
            'record_id' => $product->id,
            'descripion' => 'Created {$product->product_name}'
        ]);
    }

    /**
     * Handle the Product "updated" event.
     */
    public function updated(Product $product): void
    {
        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'Updated',
            'module' => 'Product',
            'record_id' => $product->id,
            'descripion' => 'Updated {$product->product_name}'
        ]);
    }

    /**
     * Handle the Product "deleted" event.
     */
    public function deleted(Product $product): void
    {
        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'Deleted',
            'module' => 'Product',
            'record_id' => $product->id,
            'descripion' => 'Deleted {$product->product_name}'
        ]);
    }

    /**
     * Handle the Product "restored" event.
     */
    public function restored(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "force deleted" event.
     */
    public function forceDeleted(Product $product): void
    {
        //
    }
}
