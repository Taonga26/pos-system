@extends('layouts.default-layout')

@section('maincontent')

<div class="container-fluid">

    <h3 class="mb-4 fw-bold">
        <i class="bi bi-shield-lock"></i>
        Admin Panel
    </h3>

    <div class="row g-3">

        <div class="col-md-3">
            <div class="card text-bg-primary shadow">
                <div class="card-body">
                    <h6>Employees</h6>
                    <h2>{{ $employees }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-bg-success shadow">
                <div class="card-body">
                    <h6>Products</h6>
                    <h2>{{ $products }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-bg-warning shadow">
                <div class="card-body">
                    <h6>Orders</h6>
                    <h2>{{ $orders }}</h2>
                </div>
            </div>
        </div>

    </div>

    <div class="mt-4 d-flex gap-2">

        <a href="{{ route('employees.create') }}" class="btn btn-primary">

            <i class="bi bi-person-plus"></i>

            Add Employee

        </a>

        <a href="{{ route('admin.create') }}" class="btn btn-success">

            <i class="bi bi-person-badge"></i>

            Create Login

        </a>

        <a href="{{ route('products.create') }}" class="btn btn-warning">

            <i class="bi bi-box-seam"></i>

            Add Product

        </a>

    </div>

    <div class="card shadow mt-4">

        <div class="card-header">

            User Accounts

        </div>

        <div class="card-body">

            <table class="table table-hover">

                <thead>

                    <tr>

                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($users as $user)

                    <tr>

                        <td>
                            {{ $user->employee->first_name }}
                            {{ $user->employee->last_name }}
                        </td>

                        <td>{{ $user->email }}</td>

                        <td>

                            <span class="badge bg-primary">

                                {{ $user->role }}

                            </span>

                        </td>

                        <td>
                           
                            <span class="badge bg-success">

                                Active

                            </span>

                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

            {{ $users->links() }}

        </div>

    </div>

</div>

@endsection