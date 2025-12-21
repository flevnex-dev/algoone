@extends('admin.layouts.master')
@section('title', 'Myfxbook Accounts Management')

@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6 col-12">
                <h2>Myfxbook Accounts Management</h2>
            </div>
            <div class="col-sm-6 col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="iconly-Home icli svg-color"></i></a></li>
                    <li class="breadcrumb-item">Site Management</li>
                    <li class="breadcrumb-item active">Myfxbook Accounts</li>
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

    <!-- Excel Upload Section -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Upload Excel/CSV File</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.myfxbook-accounts.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row d-flex">
                    <div class="col-md-8 mb-3">
                        <label class="form-label">Select Excel/CSV File</label>
                        <input type="file" name="excel_file" class="form-control" accept=".xlsx,.xls,.csv" required>
                        <small class="form-text text-muted">Supported formats: .xlsx, .xls, .csv (Max: 10MB)</small>
                    </div>
                    <div class="col-md-4  align-items-end">
                        <button type="submit" class="btn btn-primary w-100">Upload & Import</button>
                    </div>
                </div>
            </form>
            <div class="alert alert-info mt-3">
                <strong>Excel Format:</strong> The Excel file should have the following columns in order:
                <ol class="mb-0 mt-2">
                    <li>Account Number (e.g., Account #1) <strong class="text-danger">*Required</strong></li>
                    <li>Account Name (e.g., ICMarkets MT4) <strong class="text-danger">*Required</strong></li>
                    <li>Risk Label (e.g., Low Risk - High Reward) <strong class="text-danger">*Required</strong></li>
                    <li>Chart Labels (comma-separated, e.g., "Jul '23, Sep '23, Nov '23, Jan '24, Apr '24") <strong class="text-danger">*Required</strong></li>
                    <li>Chart Data (comma-separated numbers, e.g., "0, 45, 85, 125, 161.12") <strong class="text-danger">*Required</strong></li>
                    <li>Description (Optional)</li>
                    <li>Myfxbook Link (Optional)</li>
                </ol>
                <p class="mb-0 mt-2">
                    <strong>Note:</strong> First row should be headers. Uploading a new file will replace all existing accounts.
                </p>
                <p class="mb-0 mt-2">
                    <strong>Auto Calculation:</strong> Total Gain, Monthly, Drawdown, and Balance will be automatically calculated from Chart Data using Myfxbook formulas:
                </p>
                <ul class="mb-0 mt-2">
                    <li><strong>Total Gain:</strong> Last value from Chart Data</li>
                    <li><strong>Monthly:</strong> Compound monthly percentage needed to achieve Total Gain</li>
                    <li><strong>Drawdown:</strong> Maximum decline from peak in Chart Data</li>
                    <li><strong>Balance:</strong> Calculated from initial balance ($100,000) and Total Gain</li>
                </ul>
                <div class="mt-3">
                    <a href="{{ asset('myfxbook_accounts_template.csv') }}" download class="btn btn-primary">
                        Download Template CSV File
                    </a>
                    <small class="text-muted ms-2">Click to download the template CSV file with sample data</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Accounts List -->
    <div class="card">
        <div class="card-header bg-secondary text-white">
            <h5 class="mb-0">Accounts List ({{ $accounts->count() }} accounts)</h5>
        </div>
        <div class="card-body">
            @if($accounts->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Account Number</th>
                            <th>Account Name</th>
                            <th>Risk Label</th>
                            <th>Total Gain</th>
                            <th>Balance</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($accounts as $account)
                        <tr>
                            <td>{{ $account->account_number ?? 'N/A' }}</td>
                            <td>{{ $account->account_name ?? 'N/A' }}</td>
                            <td>{{ $account->risk_label ?? 'N/A' }}</td>
                            <td>{{ $account->total_gain ?? 'N/A' }}</td>
                            <td>{{ $account->balance ?? 'N/A' }}</td>
                            <td>
                                @if($account->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editModal{{ $account->id }}">
                                     Edit
                                </button>
                                <form action="{{ route('admin.myfxbook-accounts.destroy', $account->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this account?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                         Delete
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="editModal{{ $account->id }}" tabindex="-1">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Account</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <form action="{{ route('admin.myfxbook-accounts.update', $account->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Account Number</label>
                                                    <input type="text" name="account_number" class="form-control" value="{{ $account->account_number }}">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Account Name</label>
                                                    <input type="text" name="account_name" class="form-control" value="{{ $account->account_name }}">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Risk Label</label>
                                                    <input type="text" name="risk_label" class="form-control" value="{{ $account->risk_label }}">
                                                </div>
                                                <div class="col-12 mb-3">
                                                    <label class="form-label">Description</label>
                                                    <textarea name="description" class="form-control" rows="3">{{ $account->description }}</textarea>
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <label class="form-label">Total Gain <small class="text-muted">(Auto-calculated)</small></label>
                                                    <input type="text" class="form-control" value="{{ $account->total_gain }}" readonly style="background-color: #f8f9fa;">
                                                    <small class="form-text text-muted">Calculated from last Chart Data value</small>
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <label class="form-label">Monthly <small class="text-muted">(Auto-calculated)</small></label>
                                                    <input type="text" class="form-control" value="{{ $account->monthly }}" readonly style="background-color: #f8f9fa;">
                                                    <small class="form-text text-muted">Compound monthly percentage</small>
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <label class="form-label">Drawdown <small class="text-muted">(Auto-calculated)</small></label>
                                                    <input type="text" class="form-control" value="{{ $account->drawdown }}" readonly style="background-color: #f8f9fa;">
                                                    <small class="form-text text-muted">Max decline from peak</small>
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <label class="form-label">Balance <small class="text-muted">(Auto-calculated)</small></label>
                                                    <input type="text" class="form-control" value="{{ $account->balance }}" readonly style="background-color: #f8f9fa;">
                                                    <small class="form-text text-muted">Based on initial $100,000</small>
                                                </div>
                                                <div class="col-12 mb-3">
                                                    <label class="form-label">Myfxbook Link</label>
                                                    <input type="text" name="myfxbook_link" class="form-control" value="{{ $account->myfxbook_link }}">
                                                </div>
                                                <div class="col-12 mb-3">
                                                    <label class="form-label">Chart Labels (comma-separated)</label>
                                                    <input type="text" name="chart_labels" class="form-control" value="{{ is_array($account->chart_labels) ? implode(', ', $account->chart_labels) : '' }}" placeholder="Jul '23, Sep '23, Nov '23, Jan '24, Apr '24">
                                                    <small class="form-text text-muted">Enter chart labels separated by commas</small>
                                                </div>
                                                <div class="col-12 mb-3">
                                                    <label class="form-label">Chart Data (comma-separated numbers)</label>
                                                    <input type="text" name="chart_data" class="form-control" value="{{ is_array($account->chart_data) ? implode(', ', $account->chart_data) : '' }}" placeholder="0, 45, 85, 125, 161.12">
                                                    <small class="form-text text-muted">Enter chart data values separated by commas (must match number of labels)</small>
                                                </div>
                                                <div class="col-12 mb-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="is_active" value="1" id="isActive{{ $account->id }}" {{ $account->is_active ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="isActive{{ $account->id }}">
                                                            Active
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="alert alert-warning">
                No accounts found. Please upload an Excel/CSV file to import accounts.
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
