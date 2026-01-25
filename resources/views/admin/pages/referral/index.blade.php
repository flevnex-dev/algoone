@extends('admin.layouts.master')
@section('title', 'Referral Section Settings')

@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6 col-12">
                <h2>Referral Section Settings</h2>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Manage Referral Section</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.referral.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- Header Section -->
                        <h5 class="mb-3 text-primary">Header Information</h5>
                        <div class="row mb-4">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Title</label>
                                <input type="text" name="title" class="form-control" value="{{ $referral->title }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Subtitle</label>
                                <input type="text" name="subtitle" class="form-control" value="{{ $referral->subtitle }}">
                            </div>
                        </div>

                        <hr>

                        <!-- Button Section -->
                        <h5 class="mb-3 text-primary">Action Button</h5>
                        <div class="row mb-4">
                             <div class="col-md-6 mb-3">
                                <label class="form-label">Button Text</label>
                                <input type="text" name="button_text" class="form-control" value="{{ $referral->button_text }}">
                            </div>
                             <div class="col-md-6 mb-3">
                                <label class="form-label">Button Link</label>
                                <input type="text" name="button_link" class="form-control" value="{{ $referral->button_link }}">
                            </div>
                        </div>

                        <hr>

                        <!-- Tiers Section -->
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="text-primary mb-0">Tiers & Benefits</h5>
                            <button type="button" class="btn btn-success btn-sm" id="add-tier-btn">+ Add Tier</button>
                        </div>
                        
                        <div id="tiers-container">
                            <!-- Tiers will be injected here via JS -->
                        </div>

                        <hr>

                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="is_active" value="1" id="isActive" {{ $referral->is_active ? 'checked' : '' }}>
                                <label class="form-check-label" for="isActive">
                                    Show Referral Section
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

<!-- Template for Tier -->
<template id="tier-template">
    <div class="card shadow-sm border mb-4 tier-card" data-tier-index="{tierIndex}">
        <div class="card-header bg-light d-flex justify-content-between align-items-center">
            <h6 class="mb-0">Tier <span class="tier-number"></span></h6>
            <button type="button" class="btn btn-danger btn-sm remove-tier-btn">Remove Tier</button>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="tiers[{tierIndex}][name]" class="form-control tier-name">
                </div>
                 <div class="col-md-4 mb-3">
                    <label class="form-label">Referral Range</label>
                    <input type="text" name="tiers[{tierIndex}][range]" class="form-control tier-range">
                </div>
                <div class="col-md-4 mb-3">
                     <label class="form-label">Icon</label>
                     <input type="file" name="tiers[{tierIndex}][icon]" class="form-control">
                     <input type="hidden" name="tiers[{tierIndex}][existing_icon]" class="tier-existing-icon">
                     <div class="mt-2 tier-icon-preview" style="display:none;">
                         <img src="" alt="icon" style="height: 30px;">
                     </div>
                </div>
            </div>
            
            <div class="row bg-light p-2 rounded mb-3">
                 <div class="col-md-4">
                    <label class="form-label">Badge Text (e.g. POPULAR)</label>
                    <input type="text" name="tiers[{tierIndex}][badge_text]" class="form-control tier-badge-text">
                </div>
                 <div class="col-md-4">
                    <label class="form-label">Badge Icon</label>
                    <input type="file" name="tiers[{tierIndex}][badge_icon]" class="form-control">
                    <input type="hidden" name="tiers[{tierIndex}][existing_badge_icon]" class="tier-existing-badge-icon">
                     <div class="mt-2 tier-badge-icon-preview" style="display:none;">
                         <img src="" alt="icon" style="height: 30px;">
                     </div>
                </div>
            </div>

            <h6 class="text-secondary mt-3">Benefits</h6>
            <div class="benefits-container">
                <!-- Benefits injected here -->
            </div>
            <button type="button" class="btn btn-info btn-xs mt-2 add-benefit-btn">+ Add Benefit</button>
        </div>
    </div>
</template>

<!-- Template for Benefit -->
<template id="benefit-template">
    <div class="row align-items-end mb-2 benefit-row border-bottom pb-2">
        <div class="col-md-5">
            <label class="form-label small">Text (HTML allowed)</label>
            <textarea name="tiers[{tierIndex}][benefits][{benefitIndex}][text]" class="form-control summernote benefit-text"></textarea>
        </div>
        <div class="col-md-5">
             <label class="form-label small">Icon</label>
             <input type="file" name="tiers[{tierIndex}][benefits][{benefitIndex}][icon]" class="form-control">
             <input type="hidden" name="tiers[{tierIndex}][benefits][{benefitIndex}][existing_icon]" class="benefit-existing-icon">
             <div class="mt-1 benefit-icon-preview" style="display:none;">
                 <img src="" alt="icon" style="height: 20px;">
             </div>
        </div>
        <div class="col-md-2">
            <button type="button" class="btn btn-danger btn-xs remove-benefit-btn">X</button>
        </div>
    </div>
</template>

@endsection

@section('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tiersContainer = document.getElementById('tiers-container');
        const addTierBtn = document.getElementById('add-tier-btn');
        const tierTemplate = document.getElementById('tier-template').innerHTML;
        const benefitTemplate = document.getElementById('benefit-template').innerHTML;

        // Summernote Config
        const summernoteConfig = {
            height: 100,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['view', ['codeview', 'help']]
            ]
        };

        // Unique ID counters
        let tierCounter = 1000; 
        
        // Existing Data from Server
        const existingData = @json($referral->tiers ?? []);

        // Initial Render
        existingData.forEach((tier, index) => {
            addTierToDOM(tier, index); 
            if(index >= tierCounter) tierCounter = index + 1;
        });

        // Add Tier Button Click
        addTierBtn.addEventListener('click', function() {
            addTierToDOM({}, tierCounter++);
        });

        // Add Tier Function
        function addTierToDOM(data, index) {
            let html = tierTemplate.replace(/{tierIndex}/g, index);
            const wrapper = document.createElement('div');
            wrapper.innerHTML = html;
            const card = wrapper.firstElementChild;

            // Populate Tier Data
            if(data.name) card.querySelector('.tier-name').value = data.name;
            if(data.range) card.querySelector('.tier-range').value = data.range;
            if(data.badge_text) card.querySelector('.tier-badge-text').value = data.badge_text;
            
            // Icons
            if(data.icon) {
                card.querySelector('.tier-existing-icon').value = data.icon;
                const iconPreview = card.querySelector('.tier-icon-preview');
                iconPreview.querySelector('img').src = "{{ asset('') }}" + data.icon;
                iconPreview.style.display = 'block';
            }
            if(data.badge_icon) {
                card.querySelector('.tier-existing-badge-icon').value = data.badge_icon;
                const badgePreview = card.querySelector('.tier-badge-icon-preview');
                badgePreview.querySelector('img').src = "{{ asset('') }}" + data.badge_icon;
                badgePreview.style.display = 'block';
            }

            card.querySelector('.tier-number').textContent = index + 1;

            // Handle Benefits
            const benefitsContainer = card.querySelector('.benefits-container');
            const addBenefitBtn = card.querySelector('.add-benefit-btn');
            
            let benefitCounter = 1000;

            if (data.benefits && Array.isArray(data.benefits)) {
                data.benefits.forEach((benefit, bIndex) => {
                    addBenefitToDOM(benefitsContainer, index, bIndex, benefit);
                    if(bIndex >= benefitCounter) benefitCounter = bIndex + 1;
                });
            }

            addBenefitBtn.addEventListener('click', () => {
                addBenefitToDOM(benefitsContainer, index, benefitCounter++, {});
            });

            // Remove Tier
            card.querySelector('.remove-tier-btn').addEventListener('click', function() {
                if(confirm('Delete this tier?')) {
                    card.remove();
                }
            });

            tiersContainer.appendChild(card);
        }

        // Add Benefit Function
        function addBenefitToDOM(container, tierIndex, benefitIndex, data) {
            let html = benefitTemplate.replace(/{tierIndex}/g, tierIndex).replace(/{benefitIndex}/g, benefitIndex);
            const wrapper = document.createElement('div');
            wrapper.innerHTML = html;
            const row = wrapper.firstElementChild;

            // Find textarea and set content
            const textarea = row.querySelector('.benefit-text');
            if(data.text) textarea.value = data.text;

            // Icon handling
            if(data.icon) {
                row.querySelector('.benefit-existing-icon').value = data.icon;
                const preview = row.querySelector('.benefit-icon-preview');
                preview.querySelector('img').src = "{{ asset('') }}" + data.icon;
                preview.style.display = 'block';
            }

            row.querySelector('.remove-benefit-btn').addEventListener('click', function() {
               row.remove();
            });

            container.appendChild(row);

            // Initialize Summernote on the new textarea
            $(textarea).summernote(summernoteConfig);
        }
    });
</script>
@endsection
