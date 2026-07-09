@extends('layouts.default-layout')

@section('maincontent')

<div class="container-fluid">
    <h3 class="mb-4 fw-bold">Analytics</h3>

    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted">Revenue</h6>
                    <h2 class="mb-0">K{{ number_format($totalRevenue, 2) }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted">Orders</h6>
                    <h2 class="mb-0">{{ $totalOrders }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted">Avg Order</h6>
                    <h2 class="mb-0">K{{ number_format($averageOrder, 2) }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted">Customers</h6>
                    <h2 class="mb-0">{{ $totalCustomers }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header">Sales Trend</div>
                <div class="card-body">
                    <canvas id="salesChart" height="220"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm">
                <div class="card-header">Top Products</div>
                <div class="card-body">
                    @forelse($topProducts as $product)
                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-1">
                                <strong>{{ $product->product_name }}</strong>
                                <span>{{ $product->sold }}</span>
                            </div>
                            <div class="progress">
                                <div class="progress-bar bg-success" role="progressbar" style="width: {{ round(($product->sold / $maxTopProductSold) * 100) }}%">
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted mb-0">No product sales yet.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mt-1">
        <div class="col-lg-4">
            <div class="card shadow-sm">
                <div class="card-header">Revenue by Category</div>
                <div class="card-body">
                    <canvas id="categoryChart" height="220"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm">
                <div class="card-header">Payment Methods</div>
                <div class="card-body">
                    <canvas id="paymentChart" height="220"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm">
                <div class="card-header">Weekly Orders</div>
                <div class="card-body">
                    <canvas id="weeklyChart" height="220"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mt-1">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header">Low Stock Report</div>
                <div class="card-body">
                    @forelse($lowStockProducts as $product)
                        <div class="d-flex justify-content-between border-bottom py-2">
                            <span>{{ $product->product_name }}</span>
                            <span class="badge bg-danger">{{ $product->stock_quantity }} left</span>
                        </div>
                    @empty
                        <p class="text-muted mb-0">No low stock items.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    const salesChart = document.getElementById('salesChart');
    if (salesChart) {
        new Chart(salesChart, {
            type: 'line',
            data: {
                labels: [
                    @foreach($monthlySales as $sale)
                        '{{ date("M", mktime(0,0,0,$sale->month,1)) }}',
                    @endforeach
                ],
                datasets: [{
                    label: 'Revenue',
                    data: [
                        @foreach($monthlySales as $sale)
                            {{ $sale->revenue }},
                        @endforeach
                    ],
                    borderColor: '#0d6efd',
                    backgroundColor: 'rgba(13,110,253,0.2)',
                    fill: true,
                    borderWidth: 2,
                    tension: 0.3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    }

    const categoryChart = document.getElementById('categoryChart');
    if (categoryChart) {
        new Chart(categoryChart, {
            type: 'pie',
            data: {
                labels: [
                    @foreach($revenueByCategory as $item)
                        '{{ $item->name }}',
                    @endforeach
                ],
                datasets: [{
                    data: [
                        @foreach($revenueByCategory as $item)
                            {{ $item->revenue }},
                        @endforeach
                    ],
                    backgroundColor: ['#0d6efd', '#198754', '#dc3545', '#ffc107', '#6f42c1']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    }

    const paymentChart = document.getElementById('paymentChart');
    if (paymentChart) {
        new Chart(paymentChart, {
            type: 'doughnut',
            data: {
                labels: [
                    @foreach($paymentMethods as $method)
                        '{{ $method->name }}',
                    @endforeach
                ],
                datasets: [{
                    data: [
                        @foreach($paymentMethods as $method)
                            {{ $method->total }},
                        @endforeach
                    ],
                    backgroundColor: ['#0d6efd', '#198754', '#ffc107', '#dc3545']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    }

    const weeklyChart = document.getElementById('weeklyChart');
    if (weeklyChart) {
        new Chart(weeklyChart, {
            type: 'bar',
            data: {
                labels: [
                    @foreach($weeklyOrders as $order)
                        '{{ $order->day }}',
                    @endforeach
                ],
                datasets: [{
                    label: 'Orders',
                    data: [
                        @foreach($weeklyOrders as $order)
                            {{ $order->orders }},
                        @endforeach
                    ],
                    backgroundColor: '#198754'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    }
</script>
@endpush

@endsection