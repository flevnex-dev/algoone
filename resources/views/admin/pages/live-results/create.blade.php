@extends('admin.layouts.master')
@section('title', 'Add Live Result')

@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6 col-12">
                <h2>Add Live Result</h2>
            </div>
            <div class="col-sm-6 col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="iconly-Home icli svg-color"></i></a></li>
                    <li class="breadcrumb-item">Site Management</li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.live-results.index') }}">Live Results</a></li>
                    <li class="breadcrumb-item active">Add New</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Add New Live Result</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.live-results.store') }}" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-12 mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="useCustomUser" name="use_custom_user" {{ old('custom_name') ? 'checked' : '' }}>
                            <label class="form-check-label" for="useCustomUser">Use Custom/Fake User Name</label>
                        </div>
                    </div>

                    <div class="col-md-6" id="existingUserDiv">
                        <label for="user_id" class="form-label">User <span class="text-danger">*</span></label>
                        <select class="form-select @error('user_id') is-invalid @enderror" id="user_id" name="user_id">
                            <option value="" selected disabled>Select User</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }} ({{ $user->email }})
                                </option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 d-none" id="customUserDiv">
                        <label for="custom_name" class="form-label">Custom Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('custom_name') is-invalid @enderror" id="custom_name" name="custom_name" value="{{ old('custom_name') }}" placeholder="e.g. John Doe">
                        @error('custom_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="amount" class="form-label">Payout Amount ($)</label>
                        <input type="number" step="0.01" class="form-control @error('amount') is-invalid @enderror" id="amount" name="amount" value="{{ old('amount') }}" placeholder="Enter payout amount if applicable">
                        @error('amount')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label for="message" class="form-label">Message <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" rows="4" required placeholder="Enter success story message" minlength="5" maxlength="1000">{{ old('message') }}</textarea>
                        @error('message')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                            <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="approved" {{ old('status', 'approved') == 'approved' ? 'selected' : '' }}>Approved</option>
                            <option value="rejected" {{ old('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 mt-4">
                        <button type="submit" class="btn btn-primary">Save Result</button>
                        <a href="{{ route('admin.live-results.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggle = document.getElementById('useCustomUser');
        const existingDiv = document.getElementById('existingUserDiv');
        const customDiv = document.getElementById('customUserDiv');
        const userSelect = document.getElementById('user_id');
        const customInput = document.getElementById('custom_name');

        function updateVisibility() {
            if (toggle.checked) {
                existingDiv.classList.add('d-none');
                customDiv.classList.remove('d-none');
                userSelect.required = false;
                customInput.required = true;
                userSelect.value = ""; // Clear selection
            } else {
                existingDiv.classList.remove('d-none');
                customDiv.classList.add('d-none');
                userSelect.required = true;
                customInput.required = false;
                customInput.value = ""; // Clear input
            }
        }

        toggle.addEventListener('change', updateVisibility);
        
        // Initial run
        updateVisibility();
    });
</script>
@endsection
