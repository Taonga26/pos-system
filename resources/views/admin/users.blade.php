@extends('layouts.default-layout')

@section('maincontent')


<div class="container-fluid">
    <div class="d-flex justify-content-between mb-3">

    <h3 class="fw-bold">Users</h3>
    <a href="{{ route('admin.create') }}" class="btn btn-success">
        <i class="fas fa-user-plus me-2"></i>
        New user
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
                        <th>Action</th>

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
                        @foreach ($onlineUsers as $onlineUser)
                            <td>
                           @if ($onlineUser == $user)
                                <span class="badge bg-success">

                                    Active

                                </span>
                            @else
                                <span class="badge bg-dark">

                                    Not Active

                                </span>                        
                           @endif

                            </td>
                        @endforeach
                        <td class="dropdown">
                            <a href="#" class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle"
                            data-bs-toggle="dropdown">
                                <i class="fa-solid fa-ellipsis me-2 fa-1x"></i>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-white text-small shadow">
                                <li>
                                    <a href=""
                                    class="ms-3 text-decoration-none text-dark">
                                        <i class="fa-solid fa-power-off"></i> log out
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action=""
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
                {{ $users->links() }}
            </div>

        </div>

    </div>
</div>

@endsection