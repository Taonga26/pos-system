<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Employee;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        $activeUserIds =DB::table('sessions')
        ->whereNotNull('user_id')
        ->where('last_activity', '>=', now()->subMinutes(5)->timestamp)
        ->pluck('user_id');

        $onlineUsers =User::with('employee')->whereIn('id', $activeUserIds)->get();

        $logs =ActivityLog::with('user.employee')->latest()->take(8)->get();
        
        return view('admin.index',compact(
            'users',
            'employees',
            'products' ,
            'orders',
            'admins' ,
            'managers' ,
            'cashiers',
            'onlineUsers',
            'logs',
        ));
    }

    public function create()
    {
        $employees = Employee::doesntHave('user')->get(['id','first_name', 'last_name', 'position']);

        return view('admin.create', compact('employees'));
    }

    public function show()
    {
        //
    }
}
