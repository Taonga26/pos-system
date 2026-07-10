<?php

namespace App\Observers;

use App\Models\ActivityLog;
use App\Models\Ingredient;

class InventoryObserver
{
    /**
     * Handle the Ingredient "created" event.
     */
    public function created(Ingredient $ingredient): void
    {
        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'Created',
            'module' => 'Ingredient',
            'record_id' => $ingredient->id,
            'descripion' => 'Created {$ingredient->ingredient_name}'
        ]);
    }

    /**
     * Handle the Ingredient "updated" event.
     */
    public function updated(Ingredient $ingredient): void
    {
         ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'Upgated',
            'module' => 'Ingredient',
            'record_id' => $ingredient->id,
            'descripion' => 'Updated {$ingredient->ingredient_name'
        ]);
    }

    /**
     * Handle the Ingredient "deleted" event.
     */
    public function deleted(Ingredient $ingredient): void
    {
        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'Deleted',
            'module' => 'Ingredient',
            'record_id' => $ingredient->id,
            'descripion' => 'Deleted {$ingredient->ingredient_name}'
        ]);
    }

    /**
     * Handle the Ingredient "restored" event.
     */
    public function restored(Ingredient $ingredient): void
    {
    
    }

    /**
     * Handle the Ingredient "force deleted" event.
     */
    public function forceDeleted(Ingredient $ingredient): void
    {
        //
    }
}
