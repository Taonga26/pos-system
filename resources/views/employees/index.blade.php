@extends('layouts.default-layout')

@section('maincontent')

<div class="d-flex justify-content-between mb-3">

    <h3 class="fw-bold">Employees</h3>

    <a href="{{ route('employees.create') }}" class="btn btn-success">
        <i class="fas fa-user-plus me-2"></i>
        New Employee
    </a>

</div>


<div class="search-bar mb-2">
    <form action="{{ route('employees.index') }}" method="GET" class="d-flex justify-content-end align-items-center gap-2" id="SearchForm">
        <div class="d-flex align-items-center">
            <label for="sortSelect" class="me-2">
                <i class="fas fa-sort" style="cursor:pointer;"></i>
            </label>

            <select name="sort" id="sortSelect" class="form-select" style="max-width: 180px;">
                <option value="latest" {{ request('sort', 'latest') === 'latest' ? 'selected' : '' }}>Oldest First</option>
                <option value="oldest" {{ request('sort') === 'oldest' ? 'selected' : '' }}>Newest First</option>
                <option value="amount_high" {{ request('sort') === 'amount_high' ? 'selected' : '' }}>Highest Amount</option>
                <option value="amount_low" {{ request('sort') === 'amount_low' ? 'selected' : '' }}>Lowest Amount</option>

            </select>
        </div>
    </form>
</div>

<div class="col-md-12">
    <div class="card shadow">
        <div class="card-header">
            Employee List
        </div>
        <div class="card-body">
            <table id="employeesTable" class="table table-striped table-hover table-responsive">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Position</th>
                        <th>Salary</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employees as $employee)
                    <tr>
                    <td class="align-middle">
                            <div class="d-flex align-items-center">
                                <img
                                    src="https://ui-avatars.com/api/?name={{ urlencode($employee->first_name . ' ' . $employee->last_name) }}&background=0D8ABC&color=fff&rounded=true&size=40"
                                    class="rounded-circle me-2"
                                    alt="{{ $employee->first_name }} {{ $employee->last_name }}">
                            </div>
                        </td>
                        <td>{{ $employee->first_name }}</td>
                        <td>{{ $employee->last_name }}</td>
                        <td>{{ $employee->position }}</td>
                        <td>{{ $employee->salary }}</td>
                        <td class="dropdown">
                            <a href="#" class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle"
                            data-bs-toggle="dropdown">
                                <i class="fa-solid fa-ellipsis me-2 fa-1x"></i>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-white text-small shadow">
                                <li>
                                    <a href="{{ route('employees.edit', $employee->id) }}"
                                    class="ms-3 text-decoration-none text-dark">
                                        <i class="fa-solid fa-user-pen"></i> edit
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('employees.destroy', $employee->id) }}"
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
            <div class="mt-3">
                {{ $employees->links() }}
            </div>
        </div>

    </div>

</div>

@push('scripts')
<script src="{{ asset('js/filter.js') }}">

</script>
@endpush

@endsection