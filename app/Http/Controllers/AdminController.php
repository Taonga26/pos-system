<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {

        $users = User::with('employee')->latest()->paginate(10);
        $employees = Employee::count();
        $products = Product::count();
        $orders = Order::count();
        $admins = User::where('role','Admin')->count();
        $managers = User::where('role','Manager')->count();
        $cashiers = User::where('role','Cashier')->count();
        return view('admin.index',compact(
            'users',
            'employees',
            'products' ,
            'orders',
            'admins' ,
            'managers' ,
            'cashiers',
        ));
    }

    public function create()
    {
        $employees = Employee::doesntHave('user')->get(['id','first_name', 'last_name', 'position']);

        return view('admin.create', compact('employees'));
    }
}
