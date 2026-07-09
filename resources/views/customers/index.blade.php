@extends('layouts.default-layout')

@section('maincontent')

<div class="d-flex justify-content-between mb-3">

    <h3 class="fw-bold">Customers</h3>
    <a href="{{ route('customers.create') }}" class="btn btn-success">
        <i class="fas fa-user-plus me-2"></i>
        New Customer
    </a>

</div>

<div class="search-bar mb-2">
    <form action="{{ route('customers.index') }}" method="GET" class="d-flex justify-content-end align-items-center gap-2" id="SearchForm">
        <div class="d-flex align-items-center">
            <label for="sortSelect" class="me-2">
                <i class="fas fa-sort" style="cursor:pointer;"></i>
            </label>

            <select name="sort" id="sortSelect" class="form-select" style="max-width: 180px;">
                <option value="latest" {{ request('sort', 'latest') === 'latest' ? 'selected' : '' }}>Oldest First</option>
                <option value="oldest" {{ request('sort') === 'oldest' ? 'selected' : '' }}>Newest First</option>
            </select>
        </div>
    </form>
</div>

<div class="col-md-12">
    <div class="card shadow">
        <div class="card-header">
            Customer List
        </div>
        <div class="card-body">
            <table id="customersTable" class="table table-striped table-hover table-responsive">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Address</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customers as $customer)
                    <tr>
                        <td class="align-middle">
                            <div class="d-flex align-items-center">
                                <img
                                    src="https://ui-avatars.com/api/?name={{ urlencode($customer->first_name . ' ' . $customer->last_name) }}&background=0D8ABC&color=fff&rounded=true&size=40"
                                    class="rounded-circle me-2 border-primary"
                                    alt="{{ $customer->first_name }} {{ $customer->last_name }}">

                            </div>
                        </td>
                        <td>{{ $customer -> first_name }}</td>
                        <td>{{ $customer -> last_name }}</td>
                        <td>{{ $customer -> phone }}</td>
                        <td>{{ $customer -> email }}</td>
                        <td>{{ $customer -> address }}</td>
                        <td class="dropdown">
                            <a href="#" class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle"
                            data-bs-toggle="dropdown">
                                <i class="fa-solid fa-ellipsis me-2 fa-1x"></i>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-white text-small shadow">
                               
                                <li>
                                    <form action="{{ route('customers.destroy', $customer->id) }}"
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
                {{ $customers->links() }}
            </div>
        </div>

    </div>
</div>

@push('scripts')
<script src="{{ asset('js/filter.js') }}">

</script>
@endpush

@endsection