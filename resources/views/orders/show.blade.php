@extends('layouts.default-layout')

@section('maincontent')

<div class="container-fluid">

    <div class="d-flex flex-column gap-4 mb-3">
        <a href="{{ route('orders.index') }}" class="text-decoration-none text-secondary">
            <i class="fas fa-arrow-left me-2"></i>Back
        </a>
        <div>
            <h3 class="fw-bold">Order Details</h3>
            <p class="text-muted fw-semibold">Order #{{ $order->id }}</p>
        </div>
        
    </div>

    <div class="row mb-4">
        <div class="col-md-4" >
            <div class="card shadow mb-3" style="height: 250px">
                <div class="card-header">Customer</div>
                <div class="card-body d-flex align-items-center">
                    <div class="d-flex align-items-center">
                                <img
                                    src="https://ui-avatars.com/api/?name={{ urlencode($order->customer->first_name . ' ' . $order->customer->last_name) }}&background=0D8ABC&color=fff&rounded=true&size=50"
                                    class="rounded-circle me-2 border-primary"
                                    alt="{{ $order->customer->first_name }} {{ $order->customer->last_name }}">

                    </div>
                    <div>
                        <p class="mb-1">
                            <strong>Name:</strong>
                            {{ $order->customer->first_name ?? 'Walk-in' }}
                            {{ $order->customer->last_name ?? '' }}
                        </p>
                        @if($order->customer)
                            <p class="mb-0"><strong>Phone:</strong> {{ $order->customer->phone ?? 'N/A' }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow mb-3" style="height: 250px">
                <div class="card-header">Order Summary</div>
                <div class="card-body d-flex">
                    <div class="d-flex align-items-center">
                                <img
                                    src="https://ui-avatars.com/api/?name={{ urlencode($order->employee->first_name . ' ' . $order->employee->last_name) }}&background=0D8ABC&color=fff&rounded=true&size=60"
                                    class="rounded-circle me-2 border-primary"
                                    alt="{{ $order->employee->first_name }} {{ $order->employee->last_name }}">

                    </div>
                    <div>
                        <p class="mb-1"><strong>Cashier:</strong> {{ $order->employee->first_name ?? 'N/A' }}</p>
                        <p class="mb-1"><strong>Status:</strong> {{ $order->status }}</p>
                        <p class="mb-1"><strong>Date:</strong> {{ $order->order_date }}</p>
                        <p class="mb-0"><strong>Total:</strong> K{{ number_format($order->total_amount, 2) }}</p>
                    </div>
                    
                </div>
            </div>
        </div>

        <div class="col-md-4" ">
            <div class="card shadow mb-3" style="height: 250px">
                <div class="card-header">Payments</div>
                <div class="card-body">
                    @if($order->payments->isEmpty())
                        <p class="mb-0">No payment records found.</p>
                    @else
                        <ul class="list-group list-group-flush">
                            @foreach($order->payments as $payment)
                                <li class="list-group-item p-2">
                                    <div><strong>Method:</strong> {{ $payment->paymentMethod->method_name ?? 'N/A' }}</div>
                                    <div><strong>Amount:</strong> K{{ number_format($payment->amount_paid, 2) }}</div>
                                    <div><strong>Status:</strong> {{ $payment->payment_status }}</div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow">
        <div class="card-header">Order Items</div>
        <div class="card-body p-0">
            <table class="table table-striped mb-0">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th></th>
                        <th>Qty</th>
                        <th>Unit Price</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($order->orderDetails as $detail)
                        <tr>
                            <td>{{ $detail->product->product_name ?? 'Unknown product' }}</td>
                            <td>
                                @php
                                    $extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                                    $imagePath = null;

                                    foreach ($extensions as $ext) {
                                        $candidate = public_path('images/product_images/' . $detail->product->product_name . '.' . $ext);

                                        if (file_exists($candidate)) {
                                            $imagePath = asset('images/product_images/' . $detail->product->product_name . '.' . $ext);
                                            break;
                                        }
                                    }

                                    if (!$imagePath) {
                                        $imagePath = asset('images/product_images/no-image.png');
                                    }
                                @endphp

                                    <img
                                        src="{{ $imagePath }}"
                                        alt="{{ $detail->product->product_name }}"
                                        loading="lazy"
                                        class="card-img"
                                        style="width: 100px; height: 100px;"
                                    >
                            </td>
                            <td>{{ $detail->quantity }}</td>
                            <td>K{{ number_format($detail->unit_price, 2) }}</td>
                            <td>K{{ number_format($detail->subtotal, 2) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4">No items added to this order.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

@endsection
