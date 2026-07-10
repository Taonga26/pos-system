<div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark"
     style="width: 250px; min-height: 100vh;">

    <a href="{{ route('dashboard') }}"
       class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <i class="fas fa-store me-2"></i>
        <span class="fs-4">Bakery POS</span>
    </a>

    <hr>

    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link text-white {{ request()->routeIs('dashboard') ? 'active bg-primary' : '' }}">
                <i class="fas fa-home me-2"></i>
                Dashboard
            </a>
        </li>

        <li>
            <a href="#orderMenu" class="nav-link dropdown-toggle text-white" data-bs-toggle="collapse" data-bs-auto-close="false" aria-expanded="{{ request()->routeIs('orders.*') ? 'true' : 'false' }}">
                <i class="fas fa-shopping-cart me-2"></i>
                Orders
            </a>
            <div class="collapse {{ request()->routeIs('orders.*') ? 'show' : '' }}" id="orderMenu">
                <ul class="nav flex-column ms-3">
                    <li>
                        <a href="{{ route('orders.index') }}" class="nav-link text-white {{ request()->routeIs('orders.index') ? 'active bg-primary' : '' }}">
                            <i class="fas fa-list me-2"></i>
                            All orders
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('orders.create') }}" class="nav-link text-white {{ request()->routeIs('orders.create') ? 'active bg-primary' : '' }}">
                            <i class="fas fa-plus-circle me-2"></i>
                            New order
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        <li>
            <a href="#inventoryMenu" class="nav-link dropdown-toggle text-white" data-bs-toggle="collapse" data-bs-auto-close="false" aria-expanded="{{ request()->routeIs(['inventory.*', 'products.*']) ? 'true' : 'false' }}">
                <i class="fas fa-boxes me-2"></i>
                Inventory
            </a>
            <div class="collapse {{ request()->routeIs(['products.*', 'inventory.*']) ? 'show' : '' }}" id="inventoryMenu">
                <ul class="nav flex-column ms-3">
                    <li>
                        <a href="{{ route('products.index') }}" class="nav-link text-white {{ request()->routeIs('products.index') ? 'active bg-primary' : '' }}">
                            <i class="fas fa-box me-2"></i>
                            Products
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('inventory.index') }}" class="nav-link text-white {{ request()->routeIs('inventory.index') ? 'active bg-primary' : '' }}">
                            <i class="fas fa-carrot me-2"></i>
                            Stock Ingredients
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        <hr>

        <li>
            <a href="{{ route('customers.index') }}" class="nav-link text-white {{ request()->routeIs('customers.index') ? 'active bg-primary' : '' }}">
                <i class="fas fa-users me-2"></i>
                Customers
            </a>
        </li>

        <li>
            <a href="{{ route('employees.index') }}" class="nav-link text-white {{ request()->routeIs('employees.index') ? 'active bg-primary' : '' }}">
                <i class="fas fa-user-tie me-2"></i>
                Employees
            </a>
        </li>

        <li>
            <a href="{{ route('suppliers.index') }}" class="nav-link text-white {{ request()->routeIs('suppliers.index') ? 'active bg-primary' : '' }}">
                <i class="fas fa-truck me-2"></i>
                Suppliers
            </a>
        </li>

        <li>
            <a href="#analyticsMenu" class="nav-link dropdown-toggle text-white" data-bs-toggle="collapse" data-bs-auto-close="false" aria-expanded="{{ request()->routeIs(['analytics.*', 'payments.*']) ? 'true' : 'false' }}">
                <i class="fas fa-chart-pie me-2"></i>
                Analytics
            </a>
            <div class="collapse {{ request()->routeIs(['payments.*', 'analytics.*']) ? 'show' : '' }}" id="analyticsMenu">
                <ul class="nav flex-column ms-3">
                    <li>
                        <a href="{{ route('payments.index') }}" class="nav-link text-white {{ request()->routeIs('payments.index') ? 'active bg-primary' : '' }}">
                            <i class="fas fa-credit-card me-2"></i>
                            Payments
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('analytics.index') }}" class="nav-link text-white {{ request()->routeIs('analytics.index') ? 'active bg-primary' : '' }}">
                            <i class="fas fa-chart-bar me-2"></i>
                            Sales Summary
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <hr>
        <li>
            <a href="#adminMenu" class="nav-link dropdown-toggle text-white" data-bs-toggle="collapse" data-bs-auto-close="false" aria-expanded="{{ request()->routeIs(['analytics.*', 'payments.*']) ? 'true' : 'false' }}">
                <i class="fas fa-chart-line me-2"></i>
                Admin
            </a>
            <div class="collapse {{ request()->routeIs(['admin.*', 'activity.*']) ? 'show' : '' }}" id="adminMenu">
                <ul class="nav flex-column ms-3">
                    <li>
                        <a href="{{ route('admin.index') }}" class="nav-link text-white {{ request()->routeIs('admin.index') ? 'active bg-primary' : '' }}">
                            <i class="fas fa-chart-line me-2"></i>
                            Admin Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('activity.index') }}" class="nav-link text-white {{ request()->routeIs('activity.index') ? 'active bg-primary' : '' }}">
                            <i class="fas fa-history me-2"></i>
                            Activity Logs
                        </a>
                    </li>
                    <li>
                        <a href="" class="nav-link text-white">
                            <i class="fas fa-chart-bar me-2"></i>
                            User Accounts
                        </a>
                    </li>
                </ul>
            </div>
        </li>
    </ul>

    <hr>

    <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
           data-bs-toggle="dropdown">
            <i class="fas fa-user-circle me-2"></i>
            <strong>{{ auth()->user()->employee->first_name ?? 'User' }}</strong>
        </a>

        <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
            <li>
                <a class="dropdown-item" href="#">Profile</a>
            </li>
            <li><hr class="dropdown-divider"></li>
            <li>
                <form method="POST" action="/logout">
                    @csrf
                    <button class="dropdown-item">Logout</button>
                </form>
            </li>
        </ul>
    </div>
</div>