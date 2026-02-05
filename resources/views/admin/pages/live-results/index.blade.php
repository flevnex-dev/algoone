@extends('admin.layouts.master')
@section('title', 'Live Results Management')

@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6 col-12">
                <h2>Live Results Management</h2>
            </div>
            <div class="col-sm-6 col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="iconly-Home icli svg-color"></i></a></li>
                    <li class="breadcrumb-item">Site Management</li>
                    <li class="breadcrumb-item active">Live Results</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    

    <div class="card">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Live Results List</h5>
            <a href="{{ route('admin.live-results.create') }}" class="btn btn-info btn-sm"> <i class="fa fa-plus"></i> Add New Result</a>
        </div>
        <div class="card-body">
            
            <!-- Filter Tabs -->
            <ul class="nav nav-tabs mb-4">
                <li class="nav-item">
                    <a class="nav-link {{ $status == 'all' ? 'active' : '' }}" href="{{ route('admin.live-results.index', ['status' => 'all']) }}">All</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $status == 'pending' ? 'active' : '' }}" href="{{ route('admin.live-results.index', ['status' => 'pending']) }}">Pending <span class="badge bg-warning text-dark">{{ \App\Models\LiveResult::where('status', 'pending')->count() }}</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $status == 'approved' ? 'active' : '' }}" href="{{ route('admin.live-results.index', ['status' => 'approved']) }}">Approved</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $status == 'rejected' ? 'active' : '' }}" href="{{ route('admin.live-results.index', ['status' => 'rejected']) }}">Rejected</a>
                </li>
            </ul>

            @if($liveResults->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>User</th>
                            <th>Message</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Submitted</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($liveResults as $result)
                        <tr>
                            <td>{{ $result->id }}</td>
                            <td>
                                <div>
                                    <strong>{{ $result->display_name }}</strong>
                                    @if($result->user)
                                        <br><small class="text-muted">{{ $result->user->email }}</small>
                                    @else
                                        <br><span class="badge bg-secondary mb-1">Custom User</span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div style="max-width: 300px; overflow: hidden; text-overflow: ellipsis;">
                                    {{ Str::limit($result->message, 80) }}
                                </div>
                            </td>
                            <td>
                                @if($result->amount)
                                    <span class="badge bg-success">${{ number_format($result->amount, 2) }}</span>
                                @else
                                    <span class="text-muted">N/A</span>
                                @endif
                            </td>
                            <td>
                                @if($result->status == 'approved')
                                    <span class="badge bg-success">Approved</span>
                                @elseif($result->status == 'pending')
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @else
                                    <span class="badge bg-danger">Rejected</span>
                                @endif
                            </td>
                            <td>
                                <small>{{ $result->created_at->format('M d, Y') }}</small><br>
                                <small class="text-muted">{{ $result->created_at->diffForHumans() }}</small>
                            </td>
                            <td class="text-end">
                                <div class="btn-group">
                                    <a href="{{ route('admin.live-results.show', $result->id) }}" class="btn btn-info btn-xs" title="View Details"><i class="fa fa-eye"></i></a>
                                    
                                    @if($result->status == 'pending')
                                        <form action="{{ route('admin.live-results.approve', $result->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-success btn-xs" title="Approve"><i class="fa fa-check"></i></button>
                                        </form>
                                        <form action="{{ route('admin.live-results.reject', $result->id) }}" method="POST" class="d-inline ms-1">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-warning btn-xs" title="Reject"><i class="fa fa-times"></i></button>
                                        </form>
                                    @elseif($result->status == 'rejected')
                                        <form action="{{ route('admin.live-results.approve', $result->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-success btn-xs" title="Approve"><i class="fa fa-check"></i></button>
                                        </form>
                                    @elseif($result->status == 'approved')
                                        <form action="{{ route('admin.live-results.reject', $result->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-warning btn-xs" title="Reject"><i class="fa fa-times"></i></button>
                                        </form>
                                    @endif
                                    
                                    <form action="{{ route('admin.live-results.destroy', $result->id) }}" method="POST" class="d-inline ms-1" onsubmit="return confirm('Are you sure you want to delete this result?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-xs" title="Delete"><i class="fa fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $liveResults->appends(['status' => $status])->links() }}
            </div>
            @else
            <div class="text-center py-5">
                <p class="text-muted">No live results found.</p>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
