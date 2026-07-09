<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $sort = $request->input('sort', 'latest');

        if($sort === 'oldest'){
            $employeeQuery = Employee::orderByDesc('id');
        }elseif($sort === 'amount_high'){
            $employeeQuery = Employee::orderByDesc('salary');
        }elseif($sort === 'amount_low'){
            $employeeQuery = Employee::orderBy('salary');
        }else{
            $employeeQuery = Employee::orderBy('id');
        }

        $employees = $employeeQuery->paginate(10)->appends($request->only('sort'));
        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('employees.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'first_name' => 'required',
                'last_name' => 'required',
                'position' => 'required',
                'salary' => 'required',
                'hire_date' => 'required'
            ]
        );

        Employee::create($validated);

        return back()->with('success', 'Employee added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        return view('employees.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate(
            [
                'first_name' => 'required',
                'last_name' => 'required',
                'position' => 'required',
                'salary' => 'required',
                'hire_date' => 'required'
            ]
        );
        $employee = Employee::findOrFail($id);
        $employee -> update($validated);

        return redirect()->route('employees.index')->with('success', 'Update successful');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $employee =Employee::findOrFail($id);
        $employee->delete();

        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully');
    }
}
