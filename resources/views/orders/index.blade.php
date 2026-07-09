@extends('layouts.default-layout')

@section('maincontent')

<div class="d-flex justify-content-between mb-3">

    <h3 class="fw-bold">Orders History</h3>

    <a href="{{ route('orders.create') }}" class="btn btn-success">
        <i class="fas fa-cart-plus me-2"></i>
        New Order
    </a>

</div>

<div class="search-bar mb-2">
    <form action="{{ route('orders.index') }}" method="GET" class="d-flex justify-content-between align-items-center gap-2" id="SearchForm">
        <div class="d-flex align-items-center col-md-8 gap-3">
            <div class="position-relative w-75">
                <i class="fa-solid fa-magnifying-glass position-absolute top-50 translate-middle-y ms-3 text-muted"></i>
                <input type="text" name="search" id="Search" class="form-control ps-5 rounded-pill" placeholder="Search by order ID or customer name" value="{{ request('search') }}">
            </div> 

            <button type="submit" class="btn btn-primary">Search</button>
        </div>
        
        <div class="d-flex justify-content-end align-items-center col-md-4">
            <label for="sortSelect" class="me-2">
                <i class="fas fa-sort" style="cursor:pointer;"></i>
            </label>

            <select name="sort" id="sortSelect" class="form-select" style="max-width: 170px;">
                <option value="pending" {{ request('sort') === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="oldest" {{ request('sort') === 'oldest' ? 'selected' : '' }}>Oldest First</option>
                <option value="latest" {{ request('sort', 'latest') === 'latest' ? 'selected' : '' }}>Newest First</option>
                <option value="amount_high" {{ request('sort') === 'amount_high' ? 'selected' : '' }}>Highest Amount</option>
                <option value="amount_low" {{ request('sort') === 'amount_low' ? 'selected' : '' }}>Lowest Amount</option>
                <option value="completed" {{ request('sort') === 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="cancelled" {{ request('sort') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>



            </select>
        </div>
    </form>
</div>
<div class="col-md-12">
    <div class="card shadow">
        <div class="card-header">
            Orders
        </div>
        <div class="card-body">

            <table id="ordersTable" class="table table-striped table-hover">

                <thead>

                    <tr>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Cashier</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>

                </thead>

                <tbody>

                    @foreach($orders as $order)

                    <tr>

                        <td>#{{ $order->id }}</td>

                        <td>
                            {{ $order->customer->first_name ?? 'Walk-in' }}
                            {{ $order->customer->last_name ?? '' }}
                        </td>

                        <td>
                            {{ $order->employee->first_name ?? 'N/A' }}
                        </td>

                        <td>
                            K{{ number_format($order->total_amount,2) }}
                        </td>

                        <td >

                            <form action="{{ route('orders.update', $order->id) }}"
                                        method="POST">

                                        @csrf
                                        @method('PATCH')

                                        <select
                                            name="status"
                                            class="form-select form-select-sm order-status">

                                            @foreach([
                                                'Pending',
                                                'Completed',
                                                'Cancelled'
                                            ] as $status)

                                                <option
                                                    value="{{ $status }}"
                                                    {{ $order->status == $status ? 'selected' : '' }}>

                                                    {{ $status }}

                                                </option>

                                            @endforeach

                                        </select>

                                    </form>

                        </td>

                        <td>
                            {{ $order->order_date}}
                        </td>

                        
                        <td class="dropdown">
                            <a href="#" class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle"
                            data-bs-toggle="dropdown">
                                <i class="fa-solid fa-ellipsis me-2 fa-1x"></i>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-white text-small shadow">
                                
                                <li>
                                    <a href="{{ route('orders.show', $order->id) }}"
                                    class="text-decoration-none text-dark ms-2">
                                        View
                                    </a>
                                </li>
                                <li><hr class="dropdown-divder"></li>
                                <li>
                                    <form action="{{ route('orders.destroy', $order->id) }}"
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
            <div class="mt-2">
                {{ $orders->links() }}
            </div>

        </div>
    </div>
</div>

@push('scripts')
<script src="{{ asset('js/filter.js') }}">
</script>
<script src="{{ asset('js/order_status.js') }}"></script>
@endpush

@endsection