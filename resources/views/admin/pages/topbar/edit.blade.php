@extends('admin.layouts.master')
@section('title', 'Edit Topbar')
@section('content')

<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6 col-12">
                <h2>Edit Topbar</h2>
            </div>
            <div class="col-sm-6 col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="iconly-Home icli svg-color"></i></a></li>
                    <li class="breadcrumb-item">Site Management</li>
                    <li class="breadcrumb-item">Topbars</li>
                    <li class="breadcrumb-item active">Edit</li>
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
                    <h5 class="mb-0">Edit Topbar</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.topbars.update', $topbar->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label">Content (HTML allowed)</label>
                            <input type="text" name="content" class="form-control" value="{{ $topbar->content }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Extra Content (HTML allowed)</label>
                            <input type="text" name="extra_content" class="form-control" value="{{ $topbar->extra_content }}">
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="is_active" value="1" id="isActive" {{ $topbar->is_active ? 'checked' : '' }}>
                                <label class="form-check-label" for="isActive">
                                    Set as Active (will deactivate others)
                                </label>
                            </div>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Update Topbar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
