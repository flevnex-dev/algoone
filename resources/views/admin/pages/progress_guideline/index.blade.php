@extends('admin.layouts.master')
@section('title', 'Progress Guidelines')
@section('content')

<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6 col-12">
                <h2>Progress Guidelines</h2>
            </div>
            <div class="col-sm-6 col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="iconly-Home icli svg-color"></i></a></li>
                    <li class="breadcrumb-item">Site Management</li>
                    <li class="breadcrumb-item active">Progress Guidelines</li>
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
                    <h5 class="mb-0">Manage Progress Guidelines Section</h5>
                </div>
                <div class="card-body">

                    <form action="{{ route('admin.progress-guidelines.update') }}" method="POST">
                        @csrf
                        
                        <div class="mb-4">
                            <h5 class="mb-3">Section Header</h5>
                            <div class="mb-3">
                                <label class="form-label">Title</label>
                                <input type="text" name="title" class="form-control" value="{{ $guideline->title ?? 'Important Information' }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Subtitle</label>
                                <input type="text" name="subtitle" class="form-control" value="{{ $guideline->subtitle ?? 'Please read carefully' }}">
                            </div>
                        </div>

                        <div class="mb-4">
                            <h5 class="mb-3">Warning Box</h5>
                            <div class="mb-3">
                                <label class="form-label">Warning Text</label>
                                <textarea name="warning_text" class="form-control" rows="2">{{ $guideline->warning_text ?? 'YOU NEVER DO A SINGLE THING - WE DO ALL THE TRADING FOR YOU.' }}</textarea>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="mb-0">Guidelines</h5>
                                <button type="button" class="btn btn-success btn-sm" id="add-guideline-btn">+ Add Guideline</button>
                            </div>
                            
                            <div id="guidelines-container">
                                <!-- Guidelines injected via JS -->
                            </div>
                        </div>

                        <!-- Template for Guideline -->
                        <template id="guideline-template">
                            <div class="card mb-3 guideline-card" data-index="{index}">
                                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                    <h6 class="mb-0">Guideline <span class="guideline-number"></span></h6>
                                    <button type="button" class="btn btn-danger btn-sm remove-guideline-btn">Remove</button>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label">Title</label>
                                        <input type="text" name="guidelines[{index}][title]" class="form-control guideline-title">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Description</label>
                                        <textarea name="guidelines[{index}][text]" class="form-control guideline-text" rows="2"></textarea>
                                    </div>
                                </div>
                            </div>
                        </template>

                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="is_active" value="1" id="isActive" {{ ($guideline->is_active ?? true) ? 'checked' : '' }}>
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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('guidelines-container');
        const addBtn = document.getElementById('add-guideline-btn');
        const template = document.getElementById('guideline-template').innerHTML;
        
        let counter = 1000;
        const existingData = @json($guideline->guidelines ?? []);

        // Initial Render
        if (Array.isArray(existingData)) {
            existingData.forEach((item, index) => {
                addToDOM(item, index);
                if(index >= counter) counter = index + 1;
            });
        }

        // Add Button
        addBtn.addEventListener('click', function() {
            addToDOM({}, counter++);
        });

        function addToDOM(data, index) {
            let html = template.replace(/{index}/g, index);
            const wrapper = document.createElement('div');
            wrapper.innerHTML = html;
            const card = wrapper.firstElementChild;

            // Populate Data
            if(data.title) card.querySelector('.guideline-title').value = data.title;
            if(data.text) card.querySelector('.guideline-text').value = data.text;
            
            card.querySelector('.guideline-number').textContent = index + 1;

            // Remove Button
            card.querySelector('.remove-guideline-btn').addEventListener('click', function() {
                if(confirm('Remove this guideline?')) {
                    card.remove();
                    updateNumbers();
                }
            });

            container.appendChild(card);
            updateNumbers();
        }

        function updateNumbers() {
            const cards = container.querySelectorAll('.guideline-card');
            cards.forEach((card, i) => {
                card.querySelector('.guideline-number').textContent = i + 1;
            });
        }
    });
</script>
@endsection
