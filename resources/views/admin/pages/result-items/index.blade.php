@extends('admin.layouts.master')

@section('title', 'Manage Result Items')

@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>Result Items</h3>
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"> <i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Results Section</li>
                    <li class="breadcrumb-item active">Result Items</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5>Result Items List</h5>
                    <a href="{{ route('admin.result-items.create', ['type' => $type !== 'all' ? $type : 'testimonial']) }}" class="btn btn-primary">Add New Item</a>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs border-tab" id="top-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link {{ $type == 'all' ? 'active' : '' }}" href="{{ route('admin.result-items.index', ['type' => 'all']) }}">All</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $type == 'testimonial' ? 'active' : '' }}" href="{{ route('admin.result-items.index', ['type' => 'testimonial']) }}">Testimonials</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $type == 'stream' ? 'active' : '' }}" href="{{ route('admin.result-items.index', ['type' => 'stream']) }}">Live Streams</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $type == 'proof' ? 'active' : '' }}" href="{{ route('admin.result-items.index', ['type' => 'proof']) }}">Payout Proofs</a>
                        </li>
                    </ul>

                    <div class="tab-content mt-3">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Order</th>
                                        <th>Type</th>
                                        <th>Title</th>
                                        <th>Media</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($items as $item)
                                    <tr>
                                        <td>{{ $item->order }}</td>
                                        <td>
                                            @if($item->type == 'testimonial')
                                                <span class="badge badge-primary">Testimonial</span>
                                            @elseif($item->type == 'stream')
                                                <span class="badge badge-info">Live Stream</span>
                                            @elseif($item->type == 'proof')
                                                <span class="badge badge-success">Payout Proof</span>
                                            @endif
                                        </td>
                                        <td>
                                            <strong>{{ $item->title ?? 'N/A' }}</strong>
                                            @if($item->subtitle)
                                            <br><small class="text-muted">{{ $item->subtitle }}</small>
                                            @endif
                                        </td>
                                        <td>
                                            @if($item->type == 'proof')
                                                <img src="{{ $item->media_url }}" alt="Proof" style="height: 50px; border-radius: 4px;">
                                            @else
                                                <a href="{{ $item->media_url }}" target="_blank" class="btn btn-xs btn-outline-primary">View Video</a>
                                            @endif
                                        </td>
                                        <td>
                                            @if($item->is_active)
                                                <span class="badge badge-light-success">Active</span>
                                            @else
                                                <span class="badge badge-light-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.result-items.edit', $item->id) }}" class="btn btn-xs btn-info" title="Edit"><i class="fa fa-edit"></i></a>
                                            <form action="{{ route('admin.result-items.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-xs btn-danger" title="Delete"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="text-center">No items found.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-3">
                            {{ $items->appends(['type' => $type])->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
