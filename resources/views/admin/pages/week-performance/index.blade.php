@extends('admin.layouts.master')
@section('title', 'Week Performance Data')

@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6 col-12">
                <h2>Week Performance Data</h2>
            </div>
            <div class="col-sm-6 col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="iconly-Home icli svg-color"></i></a></li>
                    <li class="breadcrumb-item active">Week Performance</li>
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

    <!-- Performance Data List -->
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Performance Breakdown & Chart Data</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Week Label</th>
                            <th>Week Type</th>
                            <th>Dates</th>
                            <th>Trade Accuracy</th>
                            <th>Risk-Reward</th>
                            <th>Drawdown</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($weeks as $week)
                            <tr>
                                <td>{{ $week->week_label }}</td>
                                <td>
                                    <span class="badge bg-{{ $week->week_type == 'current' ? 'success' : ($week->week_type == 'last' ? 'warning' : 'secondary') }}">
                                        {{ ucfirst($week->week_type) }}
                                    </span>
                                </td>
                                <td>{{ $week->start_date->format('M d') }} - {{ $week->end_date->format('M d, Y') }}</td>
                                <td>{{ $week->performanceDetail->trade_accuracy ?? '-' }}%</td>
                                <td>{{ $week->performanceDetail->risk_reward_ratio ?? '-' }}</td>
                                <td>{{ $week->performanceDetail->largest_drawdown ?? '-' }}%</td>
                                <td>
                                    <a href="{{ route('admin.week-performance.edit', $week->id) }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-edit"></i> Edit Performance
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No trading weeks found. Create a week first.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
