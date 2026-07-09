@extends('layouts.default-layout')

@section('maincontent')

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Add New Employee</h3>
        <a href="{{ route('employees.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Back
        </a>
    </div>

    <div class="card shadow w-75 mx-auto">
        <div class="card-body ">
            <form action="{{ route('employees.update', $employee->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" name="first_name" id="first_name" class="form-control" value="{{ old('first_name', $employee->first_name) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" name="last_name" id="last_name" class="form-control" value="{{ old('last_name', $employee->last_name) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="position" class="form-label">Position</label>
                        <select name="position" id="position" class="form-select" value="{{ old('position', $employee->position) }}" required>
                            <option value="">Select Position</option>
                            <option value="Manager">Manager</option>
                            <option value="Employee">Cashier</option>
                            <option value="Stock Keeper">Stock Keeper</option>
                            <option value="Cleaner">Cleaner</option>
                            <option value="Security Guard">Security Guard</option>
                            <option value="Sales Associate">Sales Associate</option>
                            <option value="Driver">Driver</option>
                            <option value="Accountant">Accountant</option>
                            <option value="IT Support">IT Support</option>
                            <option value="Baker">Baker</option>
                            <option value="Sales Assistant">Sales Assistant</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="salary" class="form-label">Salary</label>
                        <input type="number" name="salary" id="salary" class="form-control" value="{{ old('salary', $employee->salary) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="hire_date" class="form-label">Hire Date</label>
                        <input type="date" name="hire_date" id="hire_date" class="form-control" value="{{ old('hire_date', $employee->hire_date) }}" required>
                    </div>

                </div>

                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-success">
                        Update
                    </button>
                    <a href="{{ route('employees.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
            @if ($errors->any())

            <ul>
                @foreach ($errors as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            
            @endif
        </div>
    </div>
</div>

@endsection