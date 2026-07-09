<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use App\Models\Supplier;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Display inventory.
     */
    public function index()
    {
        $ingredients = Ingredient::with('supplier')
            ->orderBy('ingredient_name')
            ->get();

        return view('inventory.index', compact('ingredients'));
    }

    /**
     * Show create form.
     */
    public function create()
    {
        $suppliers = Supplier::all();

        return view('inventory.create', compact('suppliers'));
    }

    /**
     * Store ingredient.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'ingredient_name' => 'required|string|max:255',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'unit' => 'required|string|max:20',
            'stock_quantity' => 'required|numeric|min:0',
            'minimum_stock' => 'required|numeric|min:0',
            'cost_per_unit' => 'required|numeric|min:0',
        ]);

        Ingredient::create($validated);

        return redirect()
            ->route('inventory.index')
            ->with('success', 'Ingredient added successfully.');
    }

    /**
     * Show edit form.
     */
    public function edit(Ingredient $inventory)
    {
        $suppliers = Supplier::all();

        return view('inventory.edit', [
            'ingredient' => $inventory,
            'suppliers' => $suppliers,
        ]);
    }

    /**
     * Update ingredient.
     */
    public function update(Request $request, Ingredient $inventory)
    {
        $validated = $request->validate([
            'ingredient_name' => 'required|string|max:255',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'unit' => 'required|string|max:20',
            'stock_quantity' => 'required|numeric|min:0',
            'minimum_stock' => 'required|numeric|min:0',
            'cost_per_unit' => 'required|numeric|min:0',
        ]);

        $inventory->update($validated);

        return redirect()
            ->route('inventory.index')
            ->with('success', 'Inventory updated successfully.');
    }

    /**
     * Delete ingredient.
     */
    public function destroy(Ingredient $inventory)
    {
        $inventory->delete();

        return redirect()
            ->route('inventory.index')
            ->with('success', 'Ingredient deleted successfully.');
    }
}