@extends('admin.layouts.master')
@section('title', 'Terms & Conditions Settings')
@section('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6 col-12">
                <h2>Terms & Conditions Settings</h2>
            </div>
            <div class="col-sm-6 col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="iconly-Home icli svg-color"></i></a></li>
                    <li class="breadcrumb-item">Site Management</li>
                    <li class="breadcrumb-item active">Terms & Conditions</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Manage Terms & Conditions</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.terms-conditions.update') }}" method="POST">
                        @csrf
                        
                        <div class="mb-4">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Page Title</label>
                                    <input type="text" name="page_title" class="form-control" value="{{ $terms->page_title ?? 'Terms & Conditions' }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Last Updated</label>
                                    <input type="text" name="last_updated" class="form-control" value="{{ $terms->last_updated ?? 'November 13, 2025' }}" placeholder="e.g., November 13, 2025">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Details</label>
                                    <textarea name="details" class="form-control summernote" rows="15">{{ $terms->details ?? '' }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="is_active" value="1" id="isActive" {{ ($terms->is_active ?? true) ? 'checked' : '' }}>
                                <label class="form-check-label" for="isActive">
                                    Show Section
                                </label>
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
        height: 400,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline', 'clear']],
            ['fontname', ['fontname']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ]
    });
});
</script>
@endsection
