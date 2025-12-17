@extends('admin.layouts.master')
@section('title', isset($admin) ? 'Edit Admin' : 'Create Admin')
@section('content')

<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6 col-12">
                <h2>{{ isset($admin) ? 'Edit Admin' : 'Create New Admin' }}</h2>
            </div>
            <div class="col-sm-6 col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="iconly-Home icli svg-color"></i></a></li>
                    <li class="breadcrumb-item">Admin</li>
                    <li class="breadcrumb-item active">{{ isset($admin) ? 'Edit' : 'Create' }}</li>
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
                    <h5 class="mb-0">{{ isset($admin) ? 'Edit Admin' : 'Add New Admin' }}</h5>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ isset($admin) ? route('admin.update', $admin->id) : route('admin.store') }}">
                        @csrf
                        @if(isset($admin))
                            @method('PUT')
                        @endif

                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                   name="name" value="{{ old('name', $admin->name ?? '') }}" required autofocus>
                            @error('name')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                   name="email" value="{{ old('email', $admin->email ?? '') }}" required>
                            @error('email')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">
                                {{ isset($admin) ? 'New Password (leave blank to keep current)' : 'Password' }}
                            </label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                   name="password" {{ isset($admin) ? '' : 'required' }}>
                            @error('password')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </div>

                        @if(!isset($admin))
                        <div class="mb-3">
                            <label for="password-confirm" class="form-label">Confirm Password</label>
                            <input id="password-confirm" type="password" class="form-control"
                                   name="password_confirmation" required>
                        </div>
                        @endif

                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select id="role" name="role" class="form-select @error('role') is-invalid @enderror" required>
                                <option value="">Select Role</option>
                                <option value="admin" {{ old('role', $admin->role ?? '') == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="manager" {{ old('role', $admin->role ?? '') == 'manager' ? 'selected' : '' }}>Manager</option>
                                <option value="staff" {{ old('role', $admin->role ?? '') == 'staff' ? 'selected' : '' }}>Staff</option>
                            </select>
                            @error('role')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">
                                {{ isset($admin) ? 'Update Admin' : 'Create Admin' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
