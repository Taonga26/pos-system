<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
    {
        $ingredients = Ingredient::all();
        return view('inventory.index', compact('ingredients'));
    }

    public function store(Request $request)
    {
        Ingredient::create($request->all());
        return back();
    }
}
