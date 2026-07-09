@extends('layouts.default-layout')


@section('maincontent')
@auth
<div class="d-flex justify-content-between mb-3">

    <h3 class="fw-bold">Dashboard</h3>
    <a href="{{ route('orders.create') }}" class="btn btn-success">
        <i class="fas fa-cart-plus me-2"></i>
        New Order
    </a>

</div>

<div class="search-bar mb-3">
    <form action="{{ route('orders.index') }}" method="GET" class="d-flex align-items-center gap-2" id="SearchForm">
        <div class="position-relative w-50">
            <i class="fa-solid fa-magnifying-glass position-absolute top-50 translate-middle-y ms-3 text-muted"></i>
            <input type="text" name="search" id="Search" class="form-control ps-5 rounded-pill" placeholder="Search by order ID or customer name" value="{{ request('search') }}">
        </div>
        <button type="submit" class="btn btn-primary">Search</button>
        
    </form>
</div>

<div class="main-area">
    <div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card text-bg-success shadow">
            <div class="card-body d-flex align-items gap-4" >
                <i class="fas fa-chart-line me-2 fa-2x"></i>
                <div>
                    <h6 class="fw-semibold">Total Revenue</h6>
                    <h3>K{{ number_format($totalRevenue,2) }}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card shadow">
            <a href="{{ route('orders.index') }}" class="text-decoration-none text-white">
                <div  class="card-body d-flex align-items-center gap-4">
                    <i class="fa-solid fa-basket-shopping me-2 fa-2x text-primary"></i>
                    <div class="text text-dark ">
                        <h6 class="fw-semibold">Orders</h6>
                        <h3>{{ $totalOrders }}</h3>
                    </div>
                </div>
            </a>            
        </div>
    </div>
    <div class="col-md-2">
        <div class="card shadow">
            <div class="card-body d-flex align-items-center gap-4">
                <i class="fa-solid fa-bag-shopping me-2 fa-2x text-primary"></i>
                <div class="text-dark">
                    <h6 class="fw-semibold">Products</h6>
                    <h3>{{ $totalProducts }}</h3>
                </div>
                
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card shadow">
            <div class="card-body d-flex align-items-center gap-4">
                <i class="fa-solid fa-people-group fa-2x text-primary"></i>
                <div class="text-dark">
                    <h6 class="fw-semibold">Total Customers</h6>
                    <h3>{{ $totalCustomers }}</h3>
                </div>
            </div>
        </div>
    </div>            
</div>
<div class="row mb-4">
    <div class="col-md-6 mt-3">
        <div class="card shadow">
            <div class="card-header">
                Recent Orders
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Order</th>
                            <th>Customer</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($recentOrders as $order)
                        <tr>
                            <td>{{ $order -> id }}</td>
                            <td>{{ $order -> customer -> first_name }}</td>
                            <td>{{ number_format($order -> total_amount,2) }}</td>
                        </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6 mt-3">
        <div class="card shadow">
            <div class="card-header">
                Low Stock Products
            </div>
            <div class="card-body">
                @foreach ($lowStock as $ingredient)
                
                <div class="alert alert-danger">
                    {{ $ingredient -> product_name}}
                    ({{ $ingredient -> stock_quantity }}remaining)
                </div>
                @endforeach
            </div>
        </div>
    </div>
    
</div>

<div class="card shadow col-12 mt-4 mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="fw-semibold">Top Selling Products</h5>
        <a href="{{ route('orders.create') }}" class="btn btn-sm btn-primary">
            View all
        </a>
    </div>
    <div class="card-body">
        <div id="topProductsCarousel" class="carousel slide carousel-dark" data-bs-ride="carousel">
            <div class="row mb-2 carousel-inner">
                @foreach ($topProducts->chunk(3) as $key=> $chunk)

                <div class="carousel-item {{ $key==0 ? 'active' : '' }}">
                    
                    <div class="row">
                        @foreach ($chunk as $product)

                        <div class="col-md-4">
                            <a href="{{ route('orders.create', ['product_id' => $product->id]) }}" class="text-decoration-none text-dark">
                                <div class="card shadow-sm product-card" style="height: 200px">

                                    @php
                                    $extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                                    $imagePath = null;

                                    foreach ($extensions as $ext) {
                                        $candidate = public_path('images/product_images/' . $product->product_name . '.' . $ext);

                                        if (file_exists($candidate)) {
                                            $imagePath = asset('images/product_images/' . $product->product_name . '.' . $ext);
                                            break;
                                        }
                                    }

                                    if (!$imagePath) {
                                        $imagePath = asset('images/product_images/no-image.png');
                                    }
                                    @endphp

                                    <img
                                        src="{{ $imagePath }}"
                                        alt="{{ $product->product_name }}"
                                        loading="lazy"
                                        class="card-img"
                                    >

                                    <div class="card-img-overlay d-flex flex-column justify-content-end">
                                        <h6 class="mb-1 fw-bold">
                                            {{ $product->product_name }}
                                        </h6>
                                        <small class="text-muted">
                                            Sold: {{ $product->sold }}
                                        </small>
                                        <div class="mt-2 fw-bold">
                                            {{ number_format($product-> price,2) }}
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="d-flex justify-content-center mt-2">
            <i class="fa-solid fa-chevron-left p-2 me-2" type="button" data-bs-target="#topProductsCarousel" data-bs-slide="prev"></i>
            <i class="fa-solid fa-chevron-right p-2 ms-2" type="button" data-bs-target="#topProductsCarousel" data-bs-slide="next"></i>
        </div>
    </div>
    </div>
</div>


<div class="col-md-12">
    <div class="card shadow">
        <div class="card-header">
            Recent Payments
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Customer</th>
                        <th>Method</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($recentPayments as $payment)
                    <tr>
                        <td>{{ $payment ->order->customer->first_name }}</td>
                        <td>{{ $payment ->paymentMethod->method_name }}</td>
                        <td>{{ number_format($payment->amount_paid,2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
@else
    @include('home')
@endauth
@push('scripts')
    <script src="{{ asset('js/cart.js') }}"></script>
@endpush
@endsection