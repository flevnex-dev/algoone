@extends('admin.layouts.master')
@section('title', 'Past Performance Section Settings')

@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6 col-12">
                <h2>Past Performance Section Settings</h2>
            </div>
            <div class="col-sm-6 col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="iconly-Home icli svg-color"></i></a></li>
                    <li class="breadcrumb-item">Site Management</li>
                    <li class="breadcrumb-item active">Past Performance</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <form action="{{ route('admin.past-performance.update') }}" method="POST">
                @csrf
                
                <!-- Section 1: Transparency in Trading -->
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Section 1: Transparency in Trading</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" name="transparency_title" class="form-control" value="{{ $section->transparency_title ?? 'Transparency in Trading' }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Text</label>
                            <textarea name="transparency_text" class="form-control" rows="4">{{ $section->transparency_text ?? '' }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">View Reports Link Text</label>
                            <input type="text" name="view_reports_text" class="form-control" value="{{ $section->view_reports_text ?? 'View detailed MyFxBook reports' }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">View Reports Link URL</label>
                            <input type="text" name="view_reports_link" class="form-control" value="{{ $section->view_reports_link ?? '' }}" placeholder="https://example.com">
                        </div>
                    </div>
                </div>

                <!-- Section 2: Week Overview -->
                <div class="card mb-4">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0">Section 2: Week Overview</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" name="overview_title" class="form-control" value="{{ $section->overview_title ?? 'Week Overview' }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Text</label>
                            <textarea name="overview_text" class="form-control" rows="4">{{ $section->overview_text ?? '' }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Section 3: Outlook for Next Week -->
                <div class="card mb-4">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0">Section 3: Outlook for Next Week</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Outlook Title</label>
                            <input type="text" name="outlook_title" class="form-control" value="{{ $section->outlook_title ?? 'Outlook for Next Week' }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Outlook Text</label>
                            <textarea name="outlook_text" class="form-control" rows="4">{{ $section->outlook_text ?? '' }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Next Update Label</label>
                            <input type="text" name="next_update_label" class="form-control" value="{{ $section->next_update_label ?? 'Next Weekly Update:' }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Next Update Text</label>
                            <textarea name="next_update_text" class="form-control" rows="3">{{ $section->next_update_text ?? '' }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Notice Label</label>
                            <input type="text" name="notice_label" class="form-control" value="{{ $section->notice_label ?? 'Note:' }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Notice Text</label>
                            <textarea name="notice_text" class="form-control" rows="3">{{ $section->notice_text ?? '' }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Active Status -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="is_active" value="1" id="isActive" {{ ($section->is_active ?? true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="isActive">
                                Show Past Performance Sections
                            </label>
                        </div>
                    </div>
                </div>

                <div class="text-end mb-4">
                    <button type="submit" class="btn btn-primary btn-lg">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
