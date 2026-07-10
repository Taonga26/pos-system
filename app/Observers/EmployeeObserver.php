<?php

namespace App\Observers;

use App\Models\ActivityLog;
use App\Models\Employee;

class EmployeeObserver
{
    /**
     * Handle the Employee "created" event.
     */
    public function created(Employee $employee): void
    {
        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'Created',
            'module' => 'Employee',
            'record_id' => $employee->id,
            'descripion' => 'Created {$employee->first_name} {$employee->last_name}'
        ]);
    }

    /**
     * Handle the Employee "updated" event.
     */
    public function updated(Employee $employee): void
    {
        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'Updated',
            'module' => 'Employee',
            'record_id' => $employee->id,
            'descripion' => 'Updated {$employee->first_name} {$employee->last_name}'
        ]);
    }

    /**
     * Handle the Employee "deleted" event.
     */
    public function deleted(Employee $employee): void
    {
        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'Deleted',
            'module' => 'Employee',
            'record_id' => $employee->id,
            'descripion' => 'Deleted {$employee->first_name} {$employee->last_name}'
        ]);
    }

    /**
     * Handle the Employee "restored" event.
     */
    public function restored(Employee $employee): void
    {
        //
    }

    /**
     * Handle the Employee "force deleted" event.
     */
    public function forceDeleted(Employee $employee): void
    {
        //
    }
}
