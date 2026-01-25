@extends('admin.layouts.master')
@section('title','Dashboard')
@section('content')

<div class="container-fluid">
    <div class="page-title mb-4">
        <div class="row">
            <div class="col-12 d-flex justify-content-between align-items-center">
                <h2 class="mb-0">Dashboard</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="iconly-Home icli svg-color"></i></a></li>
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
                    <h6 class="text-muted">Total Traders</h6>
                    <h3 class="fw-bold text-primary">{{ $data['totalTraders'] }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h6 class="text-muted">Total Payouts</h6>
                    <h3 class="fw-bold text-success">৳{{ number_format($data['totalPayouts'], 2) }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h6 class="text-muted">Active Trading Weeks</h6>
                    <h3 class="fw-bold text-warning">{{ $data['activeTradingWeeks'] }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h6 class="text-muted">Approved Live Results</h6>
                    <h3 class="fw-bold text-info">{{ $data['approvedLiveResults'] }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Second Row Stats -->
    <div class="row g-3 mt-2">
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h6 class="text-muted">Active Myfxbook Accounts</h6>
                    <h3 class="fw-bold text-success">{{ $data['activeMyfxbookAccounts'] }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h6 class="text-muted">Referral Conversions</h6>
                    <h3 class="fw-bold text-warning">{{ $data['totalReferralConversions'] }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h6 class="text-muted">Pending Payouts</h6>
                    <h3 class="fw-bold text-danger">{{ $data['pendingPayouts'] }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h6 class="text-muted">Total Users</h6>
                    <h3 class="fw-bold text-info">{{ $data['totalUsers'] }}</h3>
                </div>
            </div>
        </div>
    </div>

  
</div>
@endsection

@section('js')

@endsection

