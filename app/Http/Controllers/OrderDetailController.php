<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderDetailController extends Controller
{
    /**
     * Display the order details for a specific order.
     */
    public function index($orderId)
    {
        $order = Order::with('orderDetails.product')->findOrFail($orderId);

        return view('order_details.index', compact('order'));
    }

    /**
     * Show the form for creating a new order detail.
     */
    public function create($orderId)
    {
        $order = Order::findOrFail($orderId);
        $products = Product::all();

        return view('order_details.create', compact('order', 'products'));
    }

    /**
     * Store a newly created order detail.
     */
    public function store(Request $request, $orderId)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);

        OrderDetail::create([
            'order_id' => $orderId,
            'product_id' => $product->id,
            'quantity' => $request->quantity,
            'unit_price' => $product->price,
            'subtotal' => $product->price * $request->quantity,
        ]);

        return redirect()
            ->route('orders.show', $orderId)
            ->with('success', 'Product added to order successfully.');
    }

    /**
     * Show the form for editing an order detail.
     */
    public function edit(OrderDetail $orderDetail)
    {
        $products = Product::all();

        return view('order_details.edit', compact('orderDetail', 'products'));
    }

    /**
     * Update the specified order detail.
     */
    public function update(Request $request, OrderDetail $orderDetail)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);

        $orderDetail->update([
            'product_id' => $product->id,
            'quantity' => $request->quantity,
            'unit_price' => $product->price,
            'subtotal' => $product->price * $request->quantity,
        ]);

        return redirect()
            ->route('orders.show', $orderDetail->order_id)
            ->with('success', 'Order item updated successfully.');
    }

    /**
     * Remove the specified order detail.
     */
    public function destroy(OrderDetail $orderDetail)
    {
        $orderId = $orderDetail->order_id;

        $orderDetail->delete();

        return redirect()
            ->route('orders.show', $orderId)
            ->with('success', 'Product removed from order.');
    }
}