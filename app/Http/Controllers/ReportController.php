<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        $totalRevenue = Payment::sum('amount_paid');
        $totalOrders = Order::count();
        $averageOrder = Order::avg('total_amount');
        $totalCustomers = Customer::count();

        $monthlySales = Order::selectRaw('MONTH(order_date) as month, SUM(total_amount) as revenue')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $topProducts = DB::table('order_details')
            ->join('products', 'products.id', '=', 'order_details.product_id')
            ->select(
                'products.product_name',
                DB::raw('SUM(order_details.quantity) as sold')
            )
            ->groupBy('products.product_name')
            ->orderByDesc('sold')
            ->limit(5)
            ->get();

        $maxTopProductSold = $topProducts->max('sold') ?? 1;

        $revenueByCategory = DB::table('order_details')
            ->join('products', 'products.id', '=', 'order_details.product_id')
            ->join('categories', 'categories.id', '=', 'products.category_id')
            ->select(
                'categories.category_name as name',
                DB::raw('SUM(order_details.subtotal) as revenue')
            )
            ->groupBy('categories.category_name')
            ->orderByDesc('revenue')
            ->get();

        $paymentMethods = DB::table('payments')
            ->join('payment_methods', 'payment_methods.id', '=', 'payments.payment_method_id')
            ->select(
                'payment_methods.method_name as name',
                DB::raw('SUM(payments.amount_paid) as total')
            )
            ->groupBy('payment_methods.method_name')
            ->orderByDesc('total')
            ->get();

        $weeklyOrders = Order::selectRaw("DATE_FORMAT(order_date, '%Y-%m-%d') as day, COUNT(*) as orders")
            ->whereBetween('order_date', [now()->subDays(6)->startOfDay(), now()->endOfDay()])
            ->groupBy('day')
            ->orderBy('day')
            ->get();

        $lowStockProducts = Product::where('stock_quantity', '<=', 10)
            ->orderBy('stock_quantity', 'asc')
            ->get();

        return view('analytics.index', compact(
            'totalRevenue',
            'totalOrders',
            'averageOrder',
            'totalCustomers',
            'monthlySales',
            'topProducts',
            'maxTopProductSold',
            'revenueByCategory',
            'paymentMethods',
            'weeklyOrders',
            'lowStockProducts'
        ));
    }
}