@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">Admin Dashboard</h2>
        <div class="row">
            <div class="col-md-3 mb-3">
                <a href="{{ route('products.index') }}" class="btn btn-outline-primary w-100">Products</a>
            </div>
            <div class="col-md-3 mb-3">
                <a href="{{ route('customers.index') }}" class="btn btn-outline-primary w-100">Customers</a>
            </div>
            <div class="col-md-3 mb-3">
                <a href="{{ route('orders.index') }}" class="btn btn-outline-primary w-100">Orders</a>
            </div>
            <div class="col-md-3 mb-3">
                <a href="{{ route('inventory.index') }}" class="btn btn-outline-primary w-100">Inventory</a>
            </div>
            <div class="col-md-3 mb-3">
                <a href="{{ route('warranty_tickets.index') }}" class="btn btn-outline-primary w-100">Warranty Tickets</a>
            </div>
            <div class="col-md-3 mb-3">
                <a href="{{ route('kpi_definitions.index') }}" class="btn btn-outline-primary w-100">KPIs</a>
            </div>
            <!-- thêm các module khác tương tự -->
        </div>
    </div>
@endsection
