<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $totalRevenue = Payment::sum('amount_paid');
        $totalOrders = Order::Where('status', '=', 'Pending')->count();
        $totalCustomers = Customer::count();
        $totalProducts = Product::count();

        $lowStock = Product::where('stock_quantity', '<', 20)->get();

        $recentOrders =Order::with('customer')->latest()->take(5)->get();
        $recentPayments = Payment::with([
            'order.customer',
            'paymentMethod'
        ])->latest()->take(5)->get();

        $topProducts = DB::table('order_details')->join(
            'products', 'products.id', '=', 'order_details.product_id'
        )->select(
            'products.id',
            'products.product_name',
            'products.price',
            DB::raw('SUM(order_details.quantity) as sold')
        )->groupBy(
            'products.id',
            'products.product_name',
            'products.price',
        )->orderByDesc('sold')->take(6)->get();

        return view('dashboard.index', compact(
            'totalRevenue',
            'totalOrders',
            'totalCustomers',
            'lowStock',
            'totalProducts',
            'recentOrders',
            'recentPayments',
            'topProducts'
        ));
    }
}
