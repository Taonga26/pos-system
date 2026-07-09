@extends('layouts.default-layout')

@section('maincontent')

<div class="d-flex justify-content-between align-items-center mb-4">

    <h3 class="fw-bold">Inventory</h3>

    <a href="{{ route('inventory.create') }}"
       class="btn btn-success">
       <i class="fas fa-plus me-2"></i>
        Add Ingredient
    </a>

</div>

<div class="col-md-12">
    <div class="card shadow">
        
        <div class="card-body">

            <table id="inventoryTable"
                class="table table-striped table-hover table-responsive">

                <thead>

                    <tr>

                        <th>Name</th>
                        <th>Supplier</th>
                        <th>Stock</th>
                        <th>Unit</th>
                        <th>Cost/Unit</th>
                        <th>Status</th>
                        <th>Actions</th>

                    </tr>

                </thead>

                <tbody>

                @foreach($ingredients as $ingredient)

                    <tr>

                        <td>{{ $ingredient->ingredient_name }}</td>

                        <td>
                            {{ $ingredient->supplier->supplier_name ?? 'N/A' }}
                        </td>

                        <td>{{ $ingredient->stock_quantity }}</td>

                        <td>{{ $ingredient->unit }}</td>


                        <td>
                            K{{ number_format($ingredient->cost_per_unit,2) }}
                        </td>

                        <td>

                            @if($ingredient->stock_quantity <= $ingredient->minimum_stock)

                                <span class="badge bg-danger">
                                    Low Stock
                                </span>

                            @else

                                <span class="badge bg-success">
                                    In Stock
                                </span>

                            @endif

                        </td>

                        <td class="dropdown">
                            <a href="#" class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle"
                            data-bs-toggle="dropdown">
                                <i class="fa-solid fa-ellipsis me-2 fa-1x"></i>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-white text-small shadow">
                                <li>
                                    <a href="{{ route('inventory.edit', $ingredient->id) }}"
                                    class="ms-3 text-decoration-none text-dark">
                                        <i class="fa-solid fa-user-pen"></i> edit
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('inventory.destroy', $ingredient->id) }}"
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
        $('#inventoryTable').DataTable({
            pageLength: 10,
            responsive: true
        });
    });

</script>
@endpush
@endsection