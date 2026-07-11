@extends('layouts.default-layout')

@section('maincontent')

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">Add New user</h3>
        <a href="#" class="btn btn-outline-secondary" onclick="history.back()">
            <i class="fas fa-arrow-left me-2"></i>Back
        </a>
    </div>

    <div class="card shadow w-75 mx-auto">
        <div class="card-body ">
            <form action="/register" method="POST">
                @csrf

                <div class="row g-3">

                    <div class="col-md-6">
                        <label for="position" class="form-label">Employee ID</label>
                            <select name="employee_id" id="employee_id" class="form-select" required>
                                <option value="">Select ID</option>
                                @foreach ($employees as $employee)
                                <option value="{{$employee->id }}">{{ $employee->id }} : {{ $employee->first_name }} {{ $employee->last_name }} {{ $employee->position }}</option>
                                @endforeach
                            </select>
                    </div>
                                
                    <div class="col-md-6">
                        <label for="role" class="form-label">Role</label>
                        <select name="role" id="role" class="form-select" required>
                            <option value="">Select Role</option>
                            <option value="Manager">Manager</option>
                            <option value="Cashier">Cashier</option>
                            <option value="Admin">Admin</option>

                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>

                </div>

                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-success">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection