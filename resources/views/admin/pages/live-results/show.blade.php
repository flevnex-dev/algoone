@extends('admin.layouts.master')
@section('title', 'View Live Result')

@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6 col-12">
                <h2>View Live Result Details</h2>
            </div>
            <div class="col-sm-6 col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="iconly-Home icli svg-color"></i></a></li>
                    <li class="breadcrumb-item">Site Management</li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.live-results.index') }}">Live Results</a></li>
                    <li class="breadcrumb-item active">View Detail</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Result Details #{{ $result->id }}</h5>
                    <div>
                        <a href="{{ route('admin.live-results.index') }}" class="btn btn-light btn-sm"> <i class="fa fa-arrow-left"></i> Back to List</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6>User Information</h6>
                            <hr class="mt-1 mb-3">
                            <p><strong>Name:</strong> {{ $result->display_name }}</p>
                            @if($result->user)
                                <p><strong>Email:</strong> {{ $result->user->email }}</p>
                                <p><strong>Joined:</strong> {{ $result->user->created_at->format('M d, Y') }}</p>
                            @else
                                <p><strong>Type:</strong> <span class="badge bg-secondary">Custom / Fake User</span></p>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <h6>Submission Status</h6>
                            <hr class="mt-1 mb-3">
                            <p><strong>Submitted:</strong> {{ $result->created_at->format('M d, Y h:i A') }} ({{ $result->created_at->diffForHumans() }})</p>
                            <p><strong>Status:</strong> 
                                @if($result->status == 'approved')
                                    <span class="badge bg-success">Approved</span>
                                @elseif($result->status == 'pending')
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @else
                                    <span class="badge bg-danger">Rejected</span>
                                @endif
                            </p>
                            <p><strong>Payout Amount:</strong> 
                                @if($result->amount)
                                    <span class="text-success fw-bold">${{ number_format($result->amount, 2) }}</span>
                                @else
                                    <span class="text-muted">N/A</span>
                                @endif
                            </p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <h6>Full Message</h6>
                            <hr class="mt-1 mb-3">
                            <div class="bg-ash p-4 rounded border">
                                <p class="lead" style="white-space: pre-wrap;">{{ $result->message }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-5">
                        <div class="col-12 text-end">
                            <div class="btn-group">
                                @if($result->status == 'pending' || $result->status == 'rejected')
                                    <form action="{{ route('admin.live-results.approve', $result->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Approve</button>
                                    </form>
                                @endif
                                
                                @if($result->status == 'pending' || $result->status == 'approved')
                                    <form action="{{ route('admin.live-results.reject', $result->id) }}" method="POST" class="d-inline ms-2">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-warning"><i class="fa fa-times"></i> Reject</button>
                                    </form>
                                @endif

                                <form action="{{ route('admin.live-results.destroy', $result->id) }}" method="POST" class="d-inline ms-2" onsubmit="return confirm('Are you sure you want to delete this result?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
