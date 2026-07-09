@extends('layouts.default-layout')

@section('maincontent')

<div class="d-flex justify-content-between mb-3">

    <h3 class="fw-bold">Product List</h3>

    <a href="{{ route('products.create') }}" class="btn btn-success">
        <i class="fas fa-plus me-2"></i>
        Add Product
    </a>

</div>

<div class="col-md-12">
    <div class="card shadow">
        
        <div class="card-body">

            <table id="productsTable" class="table table-striped table-hover table-responsive">

                <thead>

                    <tr>
                        <th>ID</th>
                        <th>Product Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>

                </thead>

                <tbody>

                    @foreach($products as $product)

                    <tr>

                        <td>{{ $product->id }}</td>

                        <td>{{ $product->product_name }}</td>

                        <td>{{ $product->category->category_name ?? 'N/A' }}</td>

                        <td>K{{ number_format($product->price,2) }}</td>

                        <td>{{ $product->stock_quantity }}</td>

                        <td>

                            @if($product->stock_quantity > 10)

                                <span class="badge bg-success">In Stock</span>

                            @elseif($product->stock_quantity > 0)

                                <span class="badge bg-warning">Low Stock</span>

                            @else

                                <span class="badge bg-danger">Out of Stock</span>

                            @endif

                        </td>
                        <td class="dropdown">
                            <a href="#" class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle"
                            data-bs-toggle="dropdown">
                                <i class="fa-solid fa-ellipsis me-2 fa-1x"></i>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-white text-small shadow">
                                <li>
                                    <a href="{{ route('products.edit', $product->id) }}"
                                    class="ms-3 text-decoration-none text-dark">
                                        <i class="fa-solid fa-user-pen"></i> edit
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('products.destroy', $product->id) }}"
                                        method="POST"
                                        style="display:inline-block;">

                                        @csrf
                                        @method('DELETE')

                                        <button class="dropdown-item"
                                                onclick="return confirm('Are you sure you want to delete?')">
                                                <i class="fa-solid fa-trash fa-1x"></i> Delete
                                        </button>

                                    </form> 
                                </li>
                            </ul>
                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>
</div>    
    

@push('scripts')
<script>
$(document).ready(function () {
    $('#productsTable').DataTable({
        responsive: true,
        pageLength: 10,
    });
});
</script>
@endpush
@endsection