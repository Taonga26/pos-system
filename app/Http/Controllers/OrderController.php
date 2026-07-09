<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Order;
use App\Models\PaymentMethod;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index(Request $request)
    {
        $search = trim($request->input('search'));
        $sort = $request->input('sort', 'latest');

        $ordersQuery = Order::with([
        'customer',
        'employee'
    ]);

        if ($search) {
        $ordersQuery->Where('id', 'like', "%{$search}%")
        ->orwhereHas('customer', function ($q) use ($search) {
            $q->where('first_name', 'like', "%{$search}%")
              ->orWhere('last_name', 'like', "%{$search}%");
        })
        ->orWhereHas('employee', function ($q) use ($search) {
            $q->where('first_name', 'like', "%{$search}%");
        });
    
    }

        if ($sort === 'oldest') {
            $ordersQuery->oldest('order_date');
        } elseif ($sort === 'amount_high') {
            $ordersQuery->orderByDesc('total_amount');
        } elseif ($sort === 'amount_low') {
            $ordersQuery->orderBy('total_amount');
        }elseif($sort === 'pending' ){
            $ordersQuery->where('status', 'like', "%{$sort}%");
        }elseif($sort === 'completed' ){
            $ordersQuery->where('status', 'like', "%{$sort}%");
        }elseif($sort === 'cancelled' ){
            $ordersQuery->where('status', 'like', "%{$sort}%");
        }else {
            $ordersQuery->latest('order_date');
        }

        $orders=$ordersQuery
        ->paginate(10)
        ->appends($request->only(['search', 'sort']));
        return view('orders.index', compact('orders'));
    }

    
    public function create(Request $request)
    {
        $products = Product::with('category')
            ->where('stock_quantity', '>', 0)
            ->get();

        $categories = Category::orderBy('category_name')->get();
        $customers = Customer::all();
        $paymentMethods = PaymentMethod::all();

        $selectedProduct = null;

        if ($request->filled('product_id')) {
            $selectedProduct = Product::where('id', $request->product_id)
                ->where('stock_quantity', '>', 0)
                ->first();
        }

        return view('orders.create', compact(
            'products',
            'categories',
            'customers',
            'paymentMethods',
            'selectedProduct'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'nullable|exists:customers,id',
            'order_date' => 'required|date',
            'total_amount' => 'required|numeric|min:0',
            'status' => 'required|in:Pending,Completed,Cancelled'
        ]);

        $validated['employee_id'] = auth()->id();

        $order = Order::create($validated);

        return redirect()->route('orders.show', $order->id)
                        ->with('success', 'Order created successfully.');
    }

    public function show(Order $order)
    {
        $order->load('orderDetails.product', 'payments.paymentMethod');
        return view('orders.show', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:Pending,Completed,Cancelled'
        ]);

        $order->update([
            'status' => $request->status
        ]);

        return redirect()
            ->route('orders.index')
            ->with('success', 'Order status updated successfully.');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return back();
    }
}
