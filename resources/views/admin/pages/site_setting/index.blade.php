@extends('admin.layouts.master')
@section('title', 'Site Settings')
@section('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6 col-12">
                <h2>Site Settings</h2>
            </div>
            <div class="col-sm-6 col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="iconly-Home icli svg-color"></i></a></li>
                    <li class="breadcrumb-item">Site Management</li>
                    <li class="breadcrumb-item active">Global Settings</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Manage Global Settings</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.site-settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Site Title</label>
                                <input type="text" name="site_title" class="form-control" value="{{ $setting->site_title }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Logo</label>
                                <input type="file" name="logo" class="form-control">
                                @if($setting->logo)
                                    <div class="mt-2">
                                        <img src="{{ asset($setting->logo) }}" alt="Logo" style="max-height: 50px;">
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Favicon</label>
                                <input type="file" name="favicon" class="form-control">
                                @if($setting->favicon)
                                    <div class="mt-2">
                                        <img src="{{ asset($setting->favicon) }}" alt="Favicon" style="max-height: 32px;">
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Copyright Text</label>
                            <input type="text" name="copyright_text" class="form-control" value="{{ $setting->copyright_text }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Legal Disclaimer (HTML allowed)</label>
                            <textarea name="legal_disclaimer" class="form-control summernote" rows="5">{{ $setting->legal_disclaimer }}</textarea>
                        </div>

                        <hr class="my-4">
                        <h5 class="mb-3">Email Settings</h5>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email From Address <span class="text-danger">*</span></label>
                                <input type="email" name="email_from_address" class="form-control" value="{{ $setting->email_from_address ?? 'noreply@quantumfundedcapital.com' }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Emails From Name</label>
                                <input type="text" name="email_from_name" class="form-control" value="{{ $setting->email_from_name ?? 'QuantumFunding' }}">
                            </div>
                        </div>

                        <hr class="my-4">
                        <h5 class="mb-3">SMTP Email Settings</h5>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">SMTP Host</label>
                                <input type="text" name="smtp_host" class="form-control" value="{{ $setting->smtp_host ?? 'smtp.mail.ovh.net' }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">SMTP User <span class="text-danger">*</span></label>
                                <input type="text" name="smtp_user" class="form-control" value="{{ $setting->smtp_user ?? 'noreply@quantumfundedcapital.com' }}" required>
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
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">SMTP Port</label>
                                <input type="number" name="smtp_port" class="form-control" value="{{ $setting->smtp_port ?? '587' }}" min="1" max="65535">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">SMTP Security</label>
                                <select name="smtp_security" class="form-control">
                                    <option value="SSL" {{ ($setting->smtp_security ?? 'SSL') == 'SSL' ? 'selected' : '' }}>SSL</option>
                                    <option value="TLS" {{ ($setting->smtp_security ?? 'SSL') == 'TLS' ? 'selected' : '' }}>TLS</option>
                                </select>
                            </div>
                        </div>

                        <hr class="my-4">
                        <h5 class="mb-3">Remember Me Settings</h5>
                        
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember_me_enabled" value="1" id="rememberMeEnabled" {{ ($setting->remember_me_enabled ?? true) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="rememberMeEnabled">
                                        Enable Remember Me Feature
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Remember Me Text</label>
                                <input type="text" name="remember_me_text" class="form-control" value="{{ $setting->remember_me_text ?? 'Remember me' }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Remember Duration (Days)</label>
                                <input type="number" name="remember_me_duration_days" class="form-control" value="{{ $setting->remember_me_duration_days ?? 30 }}" min="1" max="365">
                                <small class="text-muted">How many days to keep user logged in (1-365 days)</small>
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script>
    $(document).ready(function() {
        $('.summernote').summernote({
            height: 200,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['link']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });

        // Toggle password visibility
        $('#togglePassword').on('click', function() {
            const passwordField = $('#smtp_password');
            const toggleIcon = $('#toggleIcon');
            
            if (passwordField.attr('type') === 'password') {
                passwordField.attr('type', 'text');
                toggleIcon.removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                passwordField.attr('type', 'password');
                toggleIcon.removeClass('fa-eye-slash').addClass('fa-eye');
            }
        });
    });
</script>
@endsection
