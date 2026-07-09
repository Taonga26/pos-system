<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $fillable = [
        'category_id',
        'product_name',
        'price',
        'stock_quantity'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function ingredients()
    {
        return $this->belongsToMany(
            Ingredient::class,
            'ingredient_product'
        )
        ->withPivot('quantity_required')
        ->withTimestamps();
    }
}
