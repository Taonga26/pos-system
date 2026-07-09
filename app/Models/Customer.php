<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'email',
        'address'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
