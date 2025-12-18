@extends('admin.layouts.master')
@section('title', 'Create Topbar')
@section('content')

<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6 col-12">
                <h2>Create New Topbar</h2>
            </div>
            <div class="col-sm-6 col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="iconly-Home icli svg-color"></i></a></li>
                    <li class="breadcrumb-item">Site Management</li>
                    <li class="breadcrumb-item">Topbars</li>
                    <li class="breadcrumb-item active">Create</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Add New Topbar</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.topbars.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Content (HTML allowed)</label>
                            <input type="text" name="content" class="form-control" placeholder="e.g. LIMITED TIME..." required>
                            <small class="text-muted">Main text shown in the banner.</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Extra Content (HTML allowed)</label>
                            <input type="text" name="extra_content" class="form-control" placeholder="e.g. + Most prop firms...">
                            <small class="text-muted">Extra text hidden on mobile.</small>
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="is_active" value="1" id="isActive" checked>
                                <label class="form-check-label" for="isActive">
                                    Set as Active (will deactivate others)
                                </label>
                            </div>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Create Topbar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
