@extends('admin.layouts.master')
@section('title', 'Trading Weeks Management')

@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6 col-12">
                <h2>Trading Weeks Management</h2>
            </div>
            <div class="col-sm-6 col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="iconly-Home icli svg-color"></i></a></li>
                    <li class="breadcrumb-item">Site Management</li>
                    <li class="breadcrumb-item active">Trading Weeks</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">All Trading Weeks</h5>
            <a href="{{ route('admin.trading-weeks.create') }}" class="btn btn-light btn-sm text-black">
                <i class="fas fa-plus me-1"></i> Add New Week
            </a>
        </div>
        <div class="card-body">
            @if($weeks->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Week Label</th>
                            <th>Date Range</th>
                            <th>Total Gain</th>
                            <th>Account Size</th>
                            <th>Week Type</th>
                            <th>Display Order</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($weeks as $week)
                        <tr>
                            <td>{{ $week->id }}</td>
                            <td>
                                <strong>{{ $week->week_label }}</strong>
                            </td>
                            <td>
                                {{ $week->start_date->format('M d, Y') }} - {{ $week->end_date->format('M d, Y') }}
                            </td>
                            <td>
                                <span class="badge {{ $week->total_gain >= 0 ? 'bg-success' : 'bg-danger' }}">
                                    {{ $week->total_gain >= 0 ? '+' : '' }}{{ number_format($week->total_gain, 2) }}%
                                </span>
                            </td>
                            <td>${{ number_format($week->account_size, 2) }}</td>
                            <td>
                                @if($week->week_type === 'current')
                                    <span class="badge bg-primary">Current</span>
                                @elseif($week->week_type === 'last')
                                    <span class="badge bg-info">Last Week</span>
                                @else
                                    <span class="badge bg-secondary">Normal</span>
                                @endif
                            </td>
                            <td>{{ $week->display_order }}</td>
                            <td>
                                @if($week->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.trading-weeks.edit', $week->id) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.trading-weeks.destroy', $week->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this week? This will also delete all performance details.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="text-center py-5">
                <p class="text-muted">No trading weeks found.</p>
                <a href="{{ route('admin.trading-weeks.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i> Create First Week
                </a>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
