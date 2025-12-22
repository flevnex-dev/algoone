@extends('admin.layouts.master')
@section('title', 'Create Trading Week')

@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6 col-12">
                <h2>Create Trading Week</h2>
            </div>
            <div class="col-sm-6 col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="iconly-Home icli svg-color"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.trading-weeks.index') }}">Trading Weeks</a></li>
                    <li class="breadcrumb-item active">Create</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <form action="{{ route('admin.trading-weeks.store') }}" method="POST">
        @csrf
        
        <div class="row">
            <div class="col-md-8">
                <!-- Basic Week Information -->
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Trading Week Details</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered align-middle mb-0">
                                <tbody>
                                    <tr>
                                        <th style="width: 220px;">Week Type <span class="text-danger">*</span></th>
                                        <td>
                                            <select name="week_type" class="form-select" required>
                                                <option value="normal" {{ old('week_type') == 'normal' ? 'selected' : '' }}>Normal</option>
                                                <option value="current" {{ old('week_type') == 'current' ? 'selected' : '' }}>Current (This Week)</option>
                                                <option value="last" {{ old('week_type') == 'last' ? 'selected' : '' }}>Last Week</option>
                                            </select>
                                            <small class="text-muted">Choosing "Current" auto-moves previous current to "Last Week"</small>
                                            @error('week_type')
                                                <div class="text-danger small">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                    <th>Start Date <span class="text-danger">*</span></th>
                                        <td>
                                            <input type="text" name="start_date" id="start_date" class="form-control" value="{{ old('start_date') }}" placeholder="Select start date" required>
                                            @error('start_date')
                                                <div class="text-danger small">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>End Date <span class="text-danger">*</span></th>
                                        <td>
                                            <input type="text" name="end_date" id="end_date" class="form-control" value="{{ old('end_date') }}" placeholder="Select end date" required>
                                            @error('end_date')
                                                <div class="text-danger small">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Total Gain (%) <span class="text-danger">*</span></th>
                                        <td>
                                            <input type="number" name="total_gain" class="form-control" step="0.01" value="{{ old('total_gain') }}" required>
                                            <small class="text-muted">e.g., 2.98 for +2.98%</small>
                                            @error('total_gain')
                                                <div class="text-danger small">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Account Size ($) <span class="text-danger">*</span></th>
                                        <td>
                                            <input type="number" name="account_size" class="form-control" step="0.01" value="{{ old('account_size', 100000) }}" required>
                                            @error('account_size')
                                                <div class="text-danger small">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Display Order</th>
                                        <td>
                                            <input type="number" name="display_order" class="form-control" value="{{ old('display_order', 0) }}" min="0">
                                            <small class="text-muted">Lower number shows first</small>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Active?</th>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="is_active">Active</label>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0">Actions</h5>
                    </div>
                    <div class="card-body">
                        <button type="submit" class="btn btn-primary w-100 mb-2">
                            <i class="fas fa-save me-1"></i> Create Week
                        </button>
                        <a href="{{ route('admin.trading-weeks.index') }}" class="btn btn-secondary w-100">
                            <i class="fas fa-times me-1"></i> Cancel
                        </a>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-header bg-warning text-dark">
                        <h5 class="mb-0">Note</h5>
                    </div>
                    <div class="card-body">
                        <p class="small mb-0">
                            <strong>Week Label:</strong> Will be automatically generated based on week type:
                            <ul class="small mb-0">
                                <li>"This Week" for Current</li>
                                <li>"Last Week" for Last</li>
                                <li>"Week 1", "Week 2", etc. for Normal</li>
                            </ul>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let endDatePicker;
        
        // Initialize date picker for start date
        const startDatePicker = flatpickr("#start_date", {
            dateFormat: "Y-m-d",
            defaultDate: "{{ old('start_date') ?: date('Y-m-d') }}",
            onChange: function(selectedDates, dateStr, instance) {
                // Update end date min date to be start date
                if (endDatePicker) {
                    endDatePicker.set('minDate', dateStr);
                }
            }
        });

        // Initialize date picker for end date
        endDatePicker = flatpickr("#end_date", {
            dateFormat: "Y-m-d",
            defaultDate: "{{ old('end_date') ?: date('Y-m-d') }}",
            minDate: document.getElementById('start_date').value || "today"
        });
    });
</script>
@endsection
