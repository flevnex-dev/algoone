@extends('admin.layouts.master')
@section('title', 'How It Works Settings')
@section('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6 col-12">
                <h2>How It Works Settings</h2>
            </div>
            <div class="col-sm-6 col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="iconly-Home icli svg-color"></i></a></li>
                    <li class="breadcrumb-item">Site Management</li>
                    <li class="breadcrumb-item active">How It Works</li>
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
                    <h5 class="mb-0">Manage How It Works Section</h5>
                </div>
                <div class="card-body">

                    <form action="{{ route('admin.how-it-works.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mb-4">
                            <label class="form-label">Main Title</label>
                            <input type="text" name="title" class="form-control" value="{{ $howItWorks->title }}">
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Subtitle</label>
                            <input type="text" name="subtitle" class="form-control" value="{{ $howItWorks->subtitle }}">
                        </div>

                        <hr>

                        <!-- Step 1 -->
                        <h5 class="mb-3">Step 1</h5>
                        <div class="row mb-4">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Step 1 Title</label>
                                <input type="text" name="step1_title" class="form-control" value="{{ $howItWorks->step1_title }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Step 1 Image</label>
                                <input type="file" name="step1_image" class="form-control">
                                @if($howItWorks->step1_image)
                                    <div class="mt-2">
                                        <img src="{{ asset($howItWorks->step1_image) }}" alt="Step 1" style="height: 50px;">
                                    </div>
                                @endif
                            </div>
                            <div class="col-12">
                                <label class="form-label">Step 1 Description</label>
                                <textarea name="step1_description" class="form-control summernote">{{ $howItWorks->step1_description }}</textarea>
                            </div>
                        </div>

                        <hr>

                        <!-- Step 2 -->
                        <h5 class="mb-3">Step 2</h5>
                        <div class="row mb-4">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Step 2 Title</label>
                                <input type="text" name="step2_title" class="form-control" value="{{ $howItWorks->step2_title }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Step 2 Image</label>
                                <input type="file" name="step2_image" class="form-control">
                                @if($howItWorks->step2_image)
                                    <div class="mt-2">
                                        <img src="{{ asset($howItWorks->step2_image) }}" alt="Step 2" style="height: 50px;">
                                    </div>
                                @endif
                            </div>
                            <div class="col-12">
                                <label class="form-label">Step 2 Description</label>
                                <textarea name="step2_description" class="form-control summernote">{{ $howItWorks->step2_description }}</textarea>
                            </div>
                        </div>

                        <hr>

                        <!-- Step 3 -->
                        <h5 class="mb-3">Step 3</h5>
                        <div class="row mb-4">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Step 3 Title</label>
                                <input type="text" name="step3_title" class="form-control" value="{{ $howItWorks->step3_title }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Step 3 Image</label>
                                <input type="file" name="step3_image" class="form-control">
                                @if($howItWorks->step3_image)
                                    <div class="mt-2">
                                        <img src="{{ asset($howItWorks->step3_image) }}" alt="Step 3" style="height: 50px;">
                                    </div>
                                @endif
                            </div>
                            <div class="col-12">
                                <label class="form-label">Step 3 Description</label>
                                <textarea name="step3_description" class="form-control summernote">{{ $howItWorks->step3_description }}</textarea>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="is_active" value="1" id="isActive" {{ $howItWorks->is_active ? 'checked' : '' }}>
                                <label class="form-check-label" for="isActive">
                                    Show How It Works Section
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
            height: 100,
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
