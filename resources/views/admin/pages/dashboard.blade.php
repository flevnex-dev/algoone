@extends('admin.layouts.master')
@section('title','Dashboard')
@section('content')

<div class="container-fluid">
    <div class="page-title mb-4">
        <div class="row">
            <div class="col-12 d-flex justify-content-between align-items-center">
                <h2 class="mb-0">Dashboard</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="iconly-Home icli svg-color"></i></a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
        </div>
    </div>

    <!-- Welcome -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="alert alert-primary rounded-3 shadow-sm">
                <h4 class="mb-1">Welcome back, {{ auth()->user()->name ?? 'User' }}!</h4>
                <p class="mb-0">Here’s your summary and recent activity overview.</p>
            </div>
        </div>
    </div>

    <!-- Stat Cards -->
    <div class="row g-3">
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h6 class="text-muted">Total Employees</h6>
                    <h3 class="fw-bold text-primary">{{ $data['totalEmployees'] }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h6 class="text-muted">Total Clients</h6>
                    <h3 class="fw-bold text-success">{{ $data['totalClients'] }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h6 class="text-muted">Total Products</h6>
                    <h3 class="fw-bold text-warning">{{ $data['totalProducts'] }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h6 class="text-muted">Total Sales</h6>
                    <h3 class="fw-bold text-info">{{ $data['totalSales'] }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Second Row Stats -->
    <div class="row g-3 mt-2">
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h6 class="text-muted">Total Revenue</h6>
                    <h3 class="fw-bold text-success">৳{{ number_format($data['totalRevenue'], 2) }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h6 class="text-muted">Pending Deliveries</h6>
                    <h3 class="fw-bold text-warning">{{ $data['pendingDeliveries'] }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h6 class="text-muted">Low Stock Products</h6>
                    <h3 class="fw-bold text-danger">{{ $data['lowStockProducts'] }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h6 class="text-muted">Overdue Payments</h6>
                    <h3 class="fw-bold text-danger">৳{{ number_format($data['overduePayments'], 2) }}</h3>
                </div>
            </div>
        </div>
    </div>

  
</div>
@endsection

@section('js')

@endsection

