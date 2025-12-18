@extends('admin.layouts.master')
@section('title', 'Signals Section Settings')
@section('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
@endsection

@section('content')

<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6 col-12">
                <h2>Signals Section Settings</h2>
            </div>
            <div class="col-sm-6 col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="iconly-Home icli svg-color"></i></a></li>
                    <li class="breadcrumb-item">Site Management</li>
                    <li class="breadcrumb-item active">Signals Section</li>
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
                    <h5 class="mb-0">Manage Signals Section</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.signals.update') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label class="form-label">Badge Text</label>
                            <input type="text" name="badge_text" class="form-control" value="{{ $signal->badge_text }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Title (HTML allowed)</label>
                            <textarea name="title" class="form-control summernote" rows="3">{{ $signal->title }}</textarea>
                            <small class="text-muted">Use &lt;span&gt; tags with classes for styling.</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control summernote" rows="3">{{ $signal->description }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Win Rate</label>
                                <input type="text" name="win_rate" class="form-control" value="{{ $signal->win_rate }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Risk Reward Ratio</label>
                                <input type="text" name="risk_reward" class="form-control" value="{{ $signal->risk_reward }}">
                            </div>
                             <div class="col-md-4 mb-3">
                                <label class="form-label">Primary Market</label>
                                <input type="text" name="primary_market" class="form-control" value="{{ $signal->primary_market }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">"Why Different" Title</label>
                            <input type="text" name="why_different_title" class="form-control" value="{{ $signal->why_different_title }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">"Why Different" Text</label>
                            <textarea name="why_different_text" class="form-control summernote" rows="5">{{ $signal->why_different_text }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Join Button Text</label>
                                <input type="text" name="join_button_text" class="form-control" value="{{ $signal->join_button_text }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Join Button Link</label>
                                <input type="text" name="join_button_link" class="form-control" value="{{ $signal->join_button_link }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="is_active" value="1" id="isActive" {{ $signal->is_active ? 'checked' : '' }}>
                                <label class="form-check-label" for="isActive">
                                    Show Signals Section
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
            height: 150,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear', 'strikethrough', 'superscript', 'subscript']],
                ['fontname', ['fontname']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video', 'hr']],
                ['view', ['fullscreen', 'codeview', 'help', 'undo', 'redo']]
            ]
        });
    });
</script>
@endsection
