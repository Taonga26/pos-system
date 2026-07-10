@extends('layouts.default-layout')

@section('maincontent')

<div class="container-fluid">
    <h4 class="mb-4 fw-bold">
                
     Activity logs
    </h4>
    <div>
            <form method="get" class="row g-2 mb-3">
                <div class="col-md-3">
                    <select name="module" id="module" class="form-select">
                        <option value="">All Modules</option>
                        <option value="Products">Products</option>
                        <option value="Orders">Orders</option>
                        <option value="Authentication">Authentication</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="action" id="action" class="form-select">
                        <option value="">All Actions</option>
                        <option value="Created">Created</option>
                        <option value="Updated">Updated</option>
                        <option value="Deleted">Deleted</option>
                        <option value="Login">Login</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button class="btn tn-primary">
                        Filter
                    </button>
                </div>
            </form>
        </div>
    <div class="card shadow">
        
        <div class="card-body">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>User</th>
                        <th>Action</th>
                        <th>Module</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($logs as $log)
                        <tr>
                            <td>
                                {{ $log->created_at->format('d M Y H:i') }}
                            </td>
                            <td>
                                @if($log->user)
                                    {{ $log->user->employee->first_name }}
                                    {{ $log->user->employee->last_name }}
                                @else
                                    <span class="text-muted">
                                        Deleted user
                                    </span>
                                @endif    
                            </td>
                            <td>
                                  
                                <span>
                                    {{ $log->action }}
                                </span>

                            </td>
                            <td>
                                {{ $log->module }}
                            </td>
                            <td>
                                {{ $log->description }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">
                                No Activity Found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $logs->links() }}
        </div>

    </div>
</div>
@endsection