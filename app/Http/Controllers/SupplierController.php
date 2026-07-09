<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sort = $request->input('sort', 'latest');

        if($sort === 'oldest'){
            $supplierQuery = Supplier::orderByDesc('id');
        }else{
            $supplierQuery = Supplier::orderBy('id');
        }

        $suppliers = $supplierQuery->paginate(10)->appends($request->only('sort'));
        return view('suppliers.index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('suppliers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'supplier_name' => 'required',
                'phone' => 'required',
                'email' => 'required',
                'address' => 'required',

            ]
        );

        Supplier::create($validated);

        return redirect()->route('suppliers.index')->with('success', 'Supplier added successfully');
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
        $suppliers = Supplier::findOrFail($id);
        return view('suppliers.edit', compact('suppliers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate(
            [
                'supplier_name' => 'required',
                'phone' => 'required',
                'email' => 'required',
                'address' => 'required',

            ]
        );
        $suppliers = Supplier::findOrFail($id);
        $suppliers -> update($validated);

        return redirect()->route('suppliers.index')->with('success', 'Update successful');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $suppliers =Supplier::findOrFail($id);
        $suppliers->delete();

        return redirect()->route('suppliers.index')->with('success', 'Supplier deleted successfully');
    }

}
