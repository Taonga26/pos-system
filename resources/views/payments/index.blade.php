@extends('layouts.default-layout')

@section('maincontent')

<div class="d-flex justify-content-between mb-3">

    <h3>Payment History</h3>


</div>
<div class="search-bar mb-2">
    <form action="{{ route('payments.index') }}" method="GET" class="d-flex justify-content-between align-items-center gap-2" id="SearchForm">
        <div class="position-relative w-50">
            <i class="fa-solid fa-magnifying-glass position-absolute top-50 translate-middle-y ms-3 text-muted"></i>
            <input type="text" name="search" id="Search" class="form-control ps-5 rounded-pill" placeholder="Search by ID or customer name" value="{{ request('search') }}">
        </div>
        

        <button type="submit" class="btn btn-primary">Search</button>
        <div class="d-flex align-items-center">
            <label for="sortSelect" class="me-2">
                <i class="fas fa-sort" style="cursor:pointer;"></i>
            </label>

            <select name="sort" id="sortSelect" class="form-select" style="max-width: 180px;">
                <option value="latest" {{ request('sort', 'latest') === 'latest' ? 'selected' : '' }}>Newest First</option>
                <option value="oldest" {{ request('sort') === 'oldest' ? 'selected' : '' }}>Oldest First</option>
                <option value="amount_high" {{ request('sort') === 'amount_high' ? 'selected' : '' }}>Highest Amount</option>
                <option value="amount_low" {{ request('sort') === 'amount_low' ? 'selected' : '' }}>Lowest Amount</option>
            </select>
        </div>
    </form>
</div>

<div class="col-md-12">
    <div class="card shadow">
        <div class="card-header">
            Payments
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Customer</th>
                        <th>Method</th>
                        <th>Amount</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($payments as $payment)
                    <tr>
                        <td>{{ $payment->id }}</td>
                        <td>{{ optional($payment->order->customer)->first_name ?? 'N/A' }}</td>
                        <td>{{ optional($payment->paymentMethod)->method_name ?? 'N/A' }}</td>
                        <td>{{ number_format(optional($payment)->amount_paid, 2) }}</td>
                        <td>{{ optional($payment)->payment_date ?? 'N/A' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-3">
                {{ $payments->links() }}
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="{{ asset('js/filter.js') }}">
</script>
@endpush

@endsection