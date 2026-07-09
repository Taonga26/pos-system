@extends('layouts.default-layout')

@section('maincontent')

<div class="d-flex justify-content-between mb-3">

    <h3 class="fw-bold">Suppliers</h3>
    <a href="{{ route('suppliers.create') }}" class="btn btn-success">
        <i class="fas fa-user-plus me-2"></i>
        New Supplier
    </a>


</div>

<div class="search-bar mb-2">
    <form action="{{ route('suppliers.index') }}" method="GET" class="d-flex justify-content-end align-items-center gap-2" id="SearchForm">
        <div class="d-flex align-items-center">
            <label for="sortSelect" class="me-2">
                <i class="fas fa-sort" style="cursor:pointer;"></i>
            </label>

            <select name="sort" id="sortSelect" class="form-select" style="max-width: 180px;">
                <option value="oldest" {{ request('sort') === 'oldest' ? 'selected' : '' }}>Oldest First</option>
                <option value="latest" {{ request('sort', 'latest') === 'latest' ? 'selected' : '' }}>Newest First</option>
            </select>
        </div>
    </form>
</div>

<div class="col-md-12">
    <div class="card shadow">
        <div class="card-header">
            Supplier List
        </div>
        <div class="card-body">

            <table class="table table-striped table-hover table-responsive">
                <thead>
                    <tr>
                        <th>Supplier Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($suppliers as $supplier)
                    <tr>
                        <td>{{ $supplier -> supplier_name }}</td>
                        <td>{{ $supplier -> phone}}</td>
                        <td>{{ $supplier -> email }}</td>
                        <td>{{ $supplier -> address }}</td>

                        <td class="dropdown">
                            <a href="#" class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle"
                            data-bs-toggle="dropdown">
                                <i class="fa-solid fa-ellipsis me-2 fa-1x"></i>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-white text-small shadow">
                                
                                <li>
                                    <form action="{{ route('suppliers.destroy', $supplier->id) }}"
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
                {{ $suppliers->links() }}
            </div>
        </div>

    </div>

</div>

@push('scripts')
<script src="{{ asset('js/filter.js') }}">

</script>
@endpush

@endsection