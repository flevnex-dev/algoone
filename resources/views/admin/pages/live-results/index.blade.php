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
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Approved Live Results</h5>
        </div>
        <div class="card-body">
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
                            <th>Featured</th>
                            <th>Submitted</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($liveResults as $result)
                        <tr>
                            <td>{{ $result->id }}</td>
                            <td>
                                <div>
                                    <strong>{{ $result->user->name ?? 'N/A' }}</strong><br>
                                    <small class="text-muted">{{ $result->user->email ?? 'N/A' }}</small>
                                </div>
                            </td>
                            <td>
                                <div style="max-width: 300px; overflow: hidden; text-overflow: ellipsis;">
                                    {{ Str::limit($result->message, 100) }}
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
                                <span class="badge bg-success">{{ ucfirst($result->status) }}</span>
                            </td>
                            <td>
                                @if($result->is_featured)
                                    <span class="badge bg-warning">Yes</span>
                                @else
                                    <span class="badge bg-secondary">No</span>
                                @endif
                            </td>
                            <td>
                                <small>{{ $result->created_at->format('M d, Y') }}</small><br>
                                <small class="text-muted">{{ $result->created_at->diffForHumans() }}</small>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $liveResults->links() }}
            </div>
            @else
            <div class="text-center py-5">
                <p class="text-muted">No approved live results found.</p>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
