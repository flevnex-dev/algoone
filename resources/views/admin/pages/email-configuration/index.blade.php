@extends('admin.layouts.master')
@section('title', 'Email Configuration')

@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6 col-12">
                <h2>Email Configuration</h2>
            </div>
            <div class="col-sm-6 col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="iconly-Home icli svg-color"></i></a></li>
                    <li class="breadcrumb-item active">Email Configuration</li>
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

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Email Configuration Settings</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.email-configuration.update') }}" method="POST">
                        @csrf
                        
                        <h5 class="mb-3">Email Settings</h5>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email From Address <span class="text-danger">*</span></label>
                                <input type="email" name="email_from_address" class="form-control" value="{{ $setting->email_from_address ?? 'noreply@quantumfundedcapital.com' }}" required>
                                @error('email_from_address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Emails From Name</label>
                                <input type="text" name="email_from_name" class="form-control" value="{{ $setting->email_from_name ?? 'QuantumFunding' }}">
                                @error('email_from_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <hr class="my-4">
                        <h5 class="mb-3">SMTP Email Settings</h5>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">SMTP Host</label>
                                <input type="text" name="smtp_host" class="form-control" value="{{ $setting->smtp_host ?? 'smtp.mail.ovh.net' }}">
                                @error('smtp_host')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">SMTP User <span class="text-danger">*</span></label>
                                <input type="text" name="smtp_user" class="form-control" value="{{ $setting->smtp_user ?? 'noreply@quantumfundedcapital.com' }}" required>
                                @error('smtp_user')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">SMTP Password</label>
                                <div class="input-group">
                                    <input type="password" name="smtp_password" id="smtp_password" class="form-control" value="" placeholder="Leave blank to keep current password">
                                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                        <i class="fas fa-eye" id="toggleIcon"></i>
                                    </button>
                                </div>
                                <small class="text-muted">Leave blank if you don't want to change the password</small>
                                @error('smtp_password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">SMTP Port</label>
                                <input type="number" name="smtp_port" class="form-control" value="{{ $setting->smtp_port ?? '587' }}" min="1" max="65535">
                                @error('smtp_port')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">SMTP Security</label>
                                <select name="smtp_security" class="form-control">
                                    <option value="SSL" {{ ($setting->smtp_security ?? 'SSL') == 'SSL' ? 'selected' : '' }}>SSL</option>
                                    <option value="TLS" {{ ($setting->smtp_security ?? 'SSL') == 'TLS' ? 'selected' : '' }}>TLS</option>
                                </select>
                                @error('smtp_security')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Save Email Configuration</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle password visibility
        const togglePassword = document.getElementById('togglePassword');
        if (togglePassword) {
            togglePassword.addEventListener('click', function() {
                const passwordField = document.getElementById('smtp_password');
                const toggleIcon = document.getElementById('toggleIcon');
                
                if (passwordField.type === 'password') {
                    passwordField.type = 'text';
                    toggleIcon.classList.remove('fa-eye');
                    toggleIcon.classList.add('fa-eye-slash');
                } else {
                    passwordField.type = 'password';
                    toggleIcon.classList.remove('fa-eye-slash');
                    toggleIcon.classList.add('fa-eye');
                }
            });
        }
    });
</script>
@endsection
