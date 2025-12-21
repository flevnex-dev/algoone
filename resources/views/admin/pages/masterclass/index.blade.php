@extends('admin.layouts.master')
@section('title', 'Masterclass Section Settings')
@section('content')

<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6 col-12">
                <h2>Masterclass Section Settings</h2>
            </div>
            <div class="col-sm-6 col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="iconly-Home icli svg-color"></i></a></li>
                    <li class="breadcrumb-item">Site Management</li>
                    <li class="breadcrumb-item active">Masterclass Section</li>
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
                    <h5 class="mb-0">Manage Masterclass Section</h5>
                </div>
                <div class="card-body">
                    
                    <form action="{{ route('admin.masterclass.update') }}" method="POST">
                        @csrf
                        
                        <div class="mb-4">
                            <h5 class="mb-3">Course Header</h5>
                            <div class="mb-3">
                                <label class="form-label">Course Title</label>
                                <input type="text" name="course_title" class="form-control" value="{{ $masterclass->course_title ?? 'Masterclass Trading Course' }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Course Subtitle</label>
                                <textarea name="course_subtitle" class="form-control" rows="2">{{ $masterclass->course_subtitle ?? 'People would pay thousands for this. At AlgoOne we are changing the game.' }}</textarea>
                            </div>
                        </div>

                        <div class="mb-4">
                            <h5 class="mb-3">Call to Action Button</h5>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Button Text</label>
                                    <input type="text" name="cta_button_text" class="form-control" value="{{ $masterclass->cta_button_text ?? 'Invest in More Funding to Manage' }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Button Link</label>
                                    <input type="text" name="cta_button_link" class="form-control" value="{{ $masterclass->cta_button_link ?? '' }}">
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="mb-0">Course Modules</h5>
                                <button type="button" class="btn btn-success btn-sm" id="addModuleBtn">
                                    <i class="fas fa-plus"></i> Add Module
                                </button>
                            </div>
                            <div class="row" id="modulesContainer">
                                @php
                                    $modules = $masterclass->modules ?? [];
                                    // If no modules, add one default
                                    if (empty($modules)) {
                                        $modules = [['title' => 'Module 1', 'video_url' => 'https://www.youtube.com/embed/nR32hc8qcpA', 'status' => 'pending']];
                                    }
                                @endphp
                                @foreach($modules as $index => $module)
                                <div class="col-md-6 mb-3 module-row" data-module-index="{{ $index }}">
                                    <div class="card">
                                        <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                            <h6 class="mb-0">Module {{ $index + 1 }}</h6>
                                            <button type="button" class="btn btn-danger btn-sm remove-module-btn">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <label class="form-label">Module Title</label>
                                                <input type="text" name="modules[{{ $index }}][title]" class="form-control module-title" value="{{ $module['title'] ?? 'Module ' . ($index + 1) }}">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">YouTube Video URL (Embed)</label>
                                                <input type="text" name="modules[{{ $index }}][video_url]" class="form-control" value="{{ $module['video_url'] ?? '' }}" placeholder="https://www.youtube.com/embed/VIDEO_ID">
                                                <small class="text-muted">Use embed URL format: https://www.youtube.com/embed/VIDEO_ID</small>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Status</label>
                                                <select name="modules[{{ $index }}][status]" class="form-control">
                                                    <option value="pending" {{ ($module['status'] ?? 'pending') == 'pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="completed" {{ ($module['status'] ?? 'pending') == 'completed' ? 'selected' : '' }}>Completed</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="is_active" value="1" id="isActive" {{ ($masterclass->is_active ?? true) ? 'checked' : '' }}>
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    let moduleIndex = {{ count($masterclass->modules ?? []) }};
    const modulesContainer = document.getElementById('modulesContainer');
    const addModuleBtn = document.getElementById('addModuleBtn');

    // Add new module
    addModuleBtn.addEventListener('click', function() {
        const moduleNumber = modulesContainer.children.length + 1;
        const newModuleHtml = `
            <div class="col-md-6 mb-3 module-row" data-module-index="${moduleIndex}">
                <div class="card">
                    <div class="card-header bg-light d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">Module ${moduleNumber}</h6>
                        <button type="button" class="btn btn-danger btn-sm remove-module-btn">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Module Title</label>
                            <input type="text" name="modules[${moduleIndex}][title]" class="form-control module-title" value="Module ${moduleNumber}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">YouTube Video URL (Embed)</label>
                            <input type="text" name="modules[${moduleIndex}][video_url]" class="form-control" value="" placeholder="https://www.youtube.com/embed/VIDEO_ID">
                            <small class="text-muted">Use embed URL format: https://www.youtube.com/embed/VIDEO_ID</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="modules[${moduleIndex}][status]" class="form-control">
                                <option value="pending" selected>Pending</option>
                                <option value="completed">Completed</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        `;
        modulesContainer.insertAdjacentHTML('beforeend', newModuleHtml);
        moduleIndex++;
        updateModuleNumbers();
    });

    // Remove module
    modulesContainer.addEventListener('click', function(e) {
        if (e.target.closest('.remove-module-btn')) {
            const moduleRow = e.target.closest('.module-row');
            if (modulesContainer.children.length > 1) {
                moduleRow.remove();
                updateModuleNumbers();
            } else {
                alert('You must have at least one module.');
            }
        }
    });

    // Update module numbers
    function updateModuleNumbers() {
        const moduleRows = modulesContainer.querySelectorAll('.module-row');
        moduleRows.forEach((row, index) => {
            const header = row.querySelector('.card-header h6');
            if (header) {
                header.textContent = `Module ${index + 1}`;
            }
        });
    }
});
</script>
@endsection
