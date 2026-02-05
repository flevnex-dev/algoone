@extends('admin.layouts.master')

@section('title', 'Add Result Item')

@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>Add Result Item</h3>
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"> <i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.result-items.index') }}">Result Items</a></li>
                    <li class="breadcrumb-item active">Add New</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Create New Item</h5>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('admin.result-items.store') }}" method="POST" class="row g-3" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="col-md-12 mb-3">
                            <label class="form-label" for="type">Item Type</label>
                            <select class="form-select" id="type" name="type" required onchange="toggleFields()">
                                <option value="testimonial" {{ old('type', $type) == 'testimonial' ? 'selected' : '' }}>Video Testimonial</option>
                                <option value="stream" {{ old('type', $type) == 'stream' ? 'selected' : '' }}>Live Stream Recording</option>
                                <option value="proof" {{ old('type', $type) == 'proof' ? 'selected' : '' }}>Payout Proof</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3" id="titleGroup">
                            <label class="form-label" for="title">Title (Name)</label>
                            <input class="form-control" id="title" type="text" name="title" value="{{ old('title') }}" placeholder="e.g. John Doe">
                        </div>

                        <div class="col-md-6 mb-3" id="subtitleGroup">
                            <label class="form-label" for="subtitle">Subtitle / Quote</label>
                            <input class="form-control" id="subtitle" type="text" name="subtitle" value="{{ old('subtitle') }}" placeholder="e.g. Best experience ever!">
                        </div>

                        <!-- URL Input (For Videos) -->
                        <div class="col-md-12 mb-3" id="urlGroup">
                            <label class="form-label" id="mediaLabel" for="media_url">Media URL</label>
                            <input class="form-control" id="media_url" type="text" name="media_url" value="{{ old('media_url') }}" placeholder="https://youtube.com/embed/...">
                            <small class="text-muted" id="mediaHelp">For Videos, use the Embed URL (e.g., https://www.youtube.com/embed/VIDEO_ID).</small>
                        </div>

                        <!-- File Input (For Images/Proofs) -->
                        <div class="col-md-12 mb-3" id="fileGroup" style="display: none;">
                            <label class="form-label">Upload Image</label>
                            <input class="form-control" type="file" name="media_file" accept="image/*">
                            <small class="text-muted">Upload an image for the payout proof.</small>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="order">Sort Order</label>
                            <input class="form-control" id="order" type="number" name="order" value="{{ old('order', 0) }}">
                        </div>

                        <div class="col-md-6 mb-3 d-flex align-items-end">
                            <div class="form-check form-switch">
                                <input class="form-check-input" id="is_active" type="checkbox" name="is_active" value="1" checked>
                                <label class="form-check-label" for="is_active">Active</label>
                            </div>
                        </div>

                        <div class="col-12">
                            <button class="btn btn-primary" type="submit">Create Item</button>
                            <a href="{{ route('admin.result-items.index') }}" class="btn btn-secondary">Cancel</a>
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
    function toggleFields() {
        const type = document.getElementById('type').value;
        const titleGroup = document.getElementById('titleGroup');
        const subtitleGroup = document.getElementById('subtitleGroup');
        
        const urlGroup = document.getElementById('urlGroup');
        const fileGroup = document.getElementById('fileGroup');
        const mediaUrlInput = document.getElementById('media_url');

        if (type === 'proof') {
            titleGroup.style.display = 'none'; // Optional for proofs
            subtitleGroup.style.display = 'none';
            
            // Show File Upload, Hide URL Input
            urlGroup.style.display = 'none';
            fileGroup.style.display = 'block';
            mediaUrlInput.removeAttribute('required'); // URL not required if uploading file

        } else if (type === 'stream') {
            titleGroup.style.display = 'none';
            subtitleGroup.style.display = 'none';
            
            // Show URL Input, Hide File Upload
            urlGroup.style.display = 'block';
            fileGroup.style.display = 'none';
            
            document.getElementById('mediaLabel').innerText = "Video Embed URL";
            document.getElementById('mediaHelp').innerText = "Use the YouTube Embed URL (e.g., https://www.youtube.com/embed/...)";
            mediaUrlInput.setAttribute('required', 'required');

        } else {
            // Testimonial
            titleGroup.style.display = 'block';
            subtitleGroup.style.display = 'block';
            
            // Show URL Input, Hide File Upload
            urlGroup.style.display = 'block';
            fileGroup.style.display = 'none';

            document.getElementById('mediaLabel').innerText = "Video Embed URL";
            document.getElementById('mediaHelp').innerText = "Use the YouTube Embed URL (e.g., https://www.youtube.com/embed/...)";
            mediaUrlInput.setAttribute('required', 'required');
        }
    }

    // Run on load
    document.addEventListener('DOMContentLoaded', toggleFields);
</script>
@endsection
