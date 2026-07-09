@extends('layouts.default-layout')

@section('maincontent')

<div class="container-fluid">
    

        <a href="#" class="text-secondary text-decoration-none" onclick="history.back()">
            <i class="fas fa-arrow-left me-2"></i>Back
        </a>
        <br>
        <br>    
        <h3 class="mb-4 fw-bold">New Order</h3>

    <div class="row">

        <div class="col-lg-8">

            <div class="card shadow">

                <div class="card-header">
                    <div class="d-flex flex-wrap gap-2" id="categoryFilter">

                        <button
                            class="btn btn-primary category-btn active"
                            data-category="all">

                            All

                        </button>

                        @foreach($categories as $category)

                            <button
                                class="btn btn-outline-primary category-btn"
                                data-category="{{ $category->id }}">

                                {{ $category->category_name }}

                            </button>

                        @endforeach

                    </div>
                </div>

                <div class="card-body">

                    <div class="row">

                        @foreach($products as $product)

                        <div class="col-md-4 mb-3 product-item" data-category="{{ $product->category_id }}">

                            <div class="card h-100 product-card shadow">
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

                                    <h5 class="product-name fw-700">{{ $product->product_name }}</h5>

                                    <p class="text-white product-price fw-bold">
                                        K{{ number_format($product->price,2) }}
                                    </p>

                                    <button
                                        class="btn btn-primary w-100 add-product"
                                        data-id="{{ $product->id }}"
                                        data-name="{{ $product->product_name }}"
                                        data-price="{{ $product->price }}">

                                        Add

                                    </button>

                                </div>

                            </div>

                        </div>

                        @endforeach

                    </div>

                </div>

            </div>

        </div>

        <div class="col-lg-4">

            <div class="card shadow">

                <div class="card-header">
                    <i class="fa-solid fa-cart-arrow-down me-3"></i>
                    Current Order
                </div>

                <div class="card-body">

                    <form action="{{ route('orders.store') }}" method="POST">

                        @csrf

                        <div class="mb-3">

                            <label>Customer</label>

                            <select name="customer_id" class="form-select">

                                <option value="">Walk-in Customer</option>

                                @foreach($customers as $customer)

                                    <option value="{{ $customer->id }}">
                                        {{ $customer->first_name }}
                                        {{ $customer->last_name }}
                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <div class="mb-3">

                            <label>Payment Method</label>

                            <select name="payment_method_id" class="form-select">

                                @foreach($paymentMethods as $method)

                                    <option value="{{ $method->id }}">
                                        {{ $method->method_name }}
                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <table class="table">

                            <thead>

                                <tr>

                                    <th>Product</th>
                                    <th>Qty</th>
                                    <th>Total</th>

                                </tr>

                            </thead>

                            <tbody id="cartTable">

                            </tbody>

                        </table>

                        <h4 class="text-end fs-6">

                            Total:
                            <span id="grandTotal" class="fw-semibold">
                                K0.00
                            </span>

                        </h4>

                        <button class="btn btn-success w-100">

                            Complete Sale

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@push('scripts')
<script src="{{ asset('js/cart.js') }}"></script>
<script src="{{ asset('js/category-filter.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        @if($selectedProduct)
            addProductToCart({{ $selectedProduct->id }}, @json($selectedProduct->product_name), {{ $selectedProduct->price }});
        @endif
    });
</script>
@endpush


@endsection