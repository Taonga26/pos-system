<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    //
    protected $fillable = [
        'supplier_id',
        'ingredient_name',
        'unit',
        'stock_quantity'
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function products()
    {
        return $this->belongsToMany(
            Product::class,
            'ingredient_product'
        )
        ->withPivot('quantity_required')
        ->withTimestamps();
    }

    
}
