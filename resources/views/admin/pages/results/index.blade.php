@extends('admin.layouts.master')
@section('title', 'Results Section Settings')
@section('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6 col-12">
                <h2>Results Section Settings</h2>
            </div>
            <div class="col-sm-6 col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="iconly-Home icli svg-color"></i></a></li>
                    <li class="breadcrumb-item">Site Management</li>
                    <li class="breadcrumb-item active">Results Section</li>
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

    <div class="row justify-content-center">
        <div class="col-md-10">
            <!-- Excel Upload Card -->
            <div class="card mb-4">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Import Accounts from Excel/CSV</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.results.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-8 mb-3">
                                <label class="form-label">Select Excel/CSV File</label>
                                <input type="file" name="excel_file" class="form-control" accept=".xlsx,.xls,.csv" required>
                                <small class="text-muted">Upload Excel (.xlsx, .xls) or CSV file</small>
                            </div>
                            <div class="col-md-4 align-items-end pt-4">
                                <button type="submit" class="btn btn-success w-100">
                                    <i class="fas fa-upload me-2"></i>Import Accounts
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="alert alert-info mt-3">
                        <strong>Excel Format:</strong> The Excel file should have the following columns in order (max 3 rows):
                        <ol class="mb-0 mt-2">
                            <li>Account Name (e.g., Account #1) <strong class="text-danger">*Required</strong></li>
                            <li>Subtext (e.g., Verified) <strong class="text-danger">*Required</strong></li>
                            <li>Risk Label (e.g., Low Risk) <strong class="text-danger">*Required</strong></li>
                            <li>Chart Labels (comma-separated, e.g., "Jul '23, Sep '23, Nov '23, Jan '24, Apr '24") <strong class="text-danger">*Required</strong></li>
                            <li>Chart Data (comma-separated numbers, e.g., "0, 45, 85, 125, 154.63") <strong class="text-danger">*Required</strong></li>
                            <li>Daily % </li>
                            <li>Drawdown % </li>
                            <li>Profit (Optional)</li>
                            <li>Deposits (Optional)</li>
                            <li>Platform (Optional)</li>
                        </ol>
                        <p class="mb-0 mt-2">
                            <strong>Note:</strong> First row should be headers. <strong class="text-danger">Maximum 3 rows will be imported.</strong>
                        </p>
                        
                        <div class="mt-3">
                            <a href="{{ route('admin.results.template') }}" class="btn btn-outline-primary">
                                <i class="fas fa-download me-2"></i>Download Template CSV
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Uploaded Data Summary -->
            @if(!empty($results->accounts) && is_array($results->accounts) && count($results->accounts) > 0)
            <div class="card mb-4">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="fas fa-table me-2"></i>Uploaded Accounts Data</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="accountsTable">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Subtext</th>
                                    <th>Total Gain</th>
                                    <th>Balance</th>
                                    <th>Monthly</th>
                                    <th>Drawdown</th>
                                    <th>Platform</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($results->accounts as $index => $acc)
                                    <tr data-index="{{ $index }}">
                                        <td><strong>{{ $index + 1 }}</strong></td>
                                        <td>{{ $acc['name'] ?? 'N/A' }}</td>
                                        <td>{{ $acc['subtext'] ?? 'N/A' }}</td>
                                        <td><span class="badge bg-success">{{ $acc['total_gain'] ?? 'N/A' }}</span></td>
                                        <td>{{ $acc['balance'] ?? 'N/A' }}</td>
                                        <td>{{ $acc['monthly'] ?? 'N/A' }}</td>
                                        <td><span class="badge bg-warning">{{ $acc['drawdown'] ?? 'N/A' }}</span></td>
                                        <td>{{ $acc['platform'] ?? 'N/A' }}</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-primary edit-account-btn" data-index="{{ $index }}">
                                                <i class="fas fa-edit me-1"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-danger remove-account-btn" data-index="{{ $index }}">
                                                <i class="fas fa-trash me-1"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif

            <!-- Edit Account Modal -->
            <div class="modal fade" id="editAccountModal" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Account <span id="editAccountNumber"></span></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <form id="editAccountForm">
                            <input type="hidden" id="editAccountIndex">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Name <span class="text-danger">*</span></label>
                                        <input type="text" id="editAccName" class="form-control" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Subtext <span class="text-danger">*</span></label>
                                        <input type="text" id="editAccSubtext" class="form-control" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Chart Labels <small class="text-muted">(comma-separated)</small> <span class="text-danger">*</span></label>
                                        <input type="text" id="editAccChartLabels" class="form-control" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Chart Data <small class="text-muted">(comma-separated numbers)</small> <span class="text-danger">*</span></label>
                                        <input type="text" id="editAccChartData" class="form-control" required>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Total Gain</label>
                                        <input type="text" id="editAccTotalGain" class="form-control">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Balance</label>
                                        <input type="text" id="editAccBalance" class="form-control">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Monthly %</label>
                                        <input type="text" id="editAccMonthly" class="form-control">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Drawdown</label>
                                        <input type="text" id="editAccDrawdown" class="form-control">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Daily %</label>
                                        <input type="text" id="editAccDaily" class="form-control">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Profit</label>
                                        <input type="text" id="editAccProfit" class="form-control">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Deposits</label>
                                        <input type="text" id="editAccDeposits" class="form-control">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Platform</label>
                                        <input type="text" id="editAccPlatform" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Update Account</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Manage Results Section</h5>
                </div>
                <div class="card-body">
                    
                    <form action="{{ route('admin.results.update') }}" method="POST" id="mainSettingsForm">
                        @csrf
                        
                        <!-- Header Section -->
                        <h5 class="mb-3 text-primary">Header Information</h5>
                        <div class="mb-3">
                            <label class="form-label">Top Banner Text - <small>Displays at the very top</small></label>
                            <textarea name="banner_text" class="form-control" rows="2">{{ $results->banner_text }}</textarea>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Badge Text</label>
                                <input type="text" name="badge_text" class="form-control" value="{{ $results->badge_text }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Main Title</label>
                                <input type="text" name="title" class="form-control" value="{{ $results->title }}">
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">Subtitle</label>
                                <textarea name="subtitle" class="form-control" rows="2">{{ $results->subtitle }}</textarea>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">Disclaimer</label>
                                <input type="text" name="disclaimer" class="form-control" value="{{ $results->disclaimer }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Primary CTA Button Text</label>
                                <input type="text" name="primary_cta_text" class="form-control" value="{{ $results->primary_cta_text }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Primary CTA Button Link</label>
                                <input type="text" name="primary_cta_link" class="form-control" value="{{ $results->primary_cta_link }}">
                            </div>
                        </div>

                        <hr>

                        <!-- Hidden Inputs Container for Accounts -->
                        <div id="accountsContainer">
                            @if(!empty($results->accounts) && is_array($results->accounts))
                                @foreach($results->accounts as $index => $acc)
                                    <div class="account-data-row" data-index="{{ $index }}">
                                        @foreach($acc as $key => $value)
                                            @if(is_array($value))
                                                <input type="hidden" name="accounts[{{ $index }}][{{ $key }}]" value="{{ implode(',', $value) }}" class="acc-{{ $key }}">
                                            @else
                                                <input type="hidden" name="accounts[{{ $index }}][{{ $key }}]" value="{{ $value }}" class="acc-{{ $key }}">
                                            @endif
                                        @endforeach
                                    </div>
                                @endforeach
                            @endif
                        </div>

                        <hr>

                        <!-- Summary Section -->
                         <h5 class="mb-3 text-primary">Performance Summary</h5>
                         <div class="mb-3">
                            <label class="form-label">Summary Title (HTML allowed)</label>
                            <textarea name="summary_title" class="form-control summernote">{{ $results->summary_title }}</textarea>
                         </div>
                         <div class="mb-3">
                            <label class="form-label">Summary Description</label>
                            <textarea name="summary_description" class="form-control summernote">{{ $results->summary_description }}</textarea>
                         </div>
                         <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">View Results Button Text</label>
                                <input type="text" name="view_results_text" class="form-control" value="{{ $results->view_results_text }}">
                            </div>
                             <div class="col-md-6 mb-3">
                                <label class="form-label">View Results Button Link</label>
                                <input type="text" name="view_results_link" class="form-control" value="{{ $results->view_results_link }}">
                            </div>
                         </div>

                        <hr>

                        <!-- Action Buttons -->
                        <h5 class="mb-3 text-primary">Bottom Action Buttons</h5>
                         <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">MyFxBook Button Text</label>
                                <input type="text" name="myfxbook_text" class="form-control" value="{{ $results->myfxbook_text }}">
                            </div>
                             <div class="col-md-6 mb-3">
                                <label class="form-label">MyFxBook Button Link</label>
                                <input type="text" name="myfxbook_link" class="form-control" value="{{ $results->myfxbook_link }}">
                            </div>
                             <div class="col-md-6 mb-3">
                                <label class="form-label">Payout Button Text</label>
                                <input type="text" name="payout_text" class="form-control" value="{{ $results->payout_text }}">
                            </div>
                             <div class="col-md-6 mb-3">
                                <label class="form-label">Payout Button Link</label>
                                <input type="text" name="payout_link" class="form-control" value="{{ $results->payout_link }}">
                            </div>
                         </div>

                        <hr>

                        <!-- Final CTA Section -->
                         <h5 class="mb-3 text-primary">Final Call to Action (Bottom of Page)</h5>
                         <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Title</label>
                                <input type="text" name="final_cta_title" class="form-control" value="{{ $results->final_cta_title }}">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Description</label>
                                <textarea name="final_cta_description" class="form-control" rows="2">{{ $results->final_cta_description }}</textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Button Text</label>
                                <input type="text" name="final_cta_btn_text" class="form-control" value="{{ $results->final_cta_btn_text }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Button Link</label>
                                <input type="text" name="final_cta_btn_link" class="form-control" value="{{ $results->final_cta_btn_link }}">
                            </div>
                         </div>


                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="is_active" value="1" id="isActive" {{ $results->is_active ? 'checked' : '' }}>
                                <label class="form-check-label" for="isActive">
                                    Show Results Section
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

@push('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script src="{{ url('/admin/assets') }}/js/sweetalert/sweetalert2.min.js"></script>
<script>
    // Setup AJAX to include CSRF token
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        }
    });

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

        // Handle edit account button click
        $(document).on('click', '.edit-account-btn', function() {
            const index = $(this).data('index');
            
            // Get data from hidden inputs
            const container = $('.account-data-row[data-index="' + index + '"]');
            
            $('#editAccountIndex').val(index);
            $('#editAccountNumber').text('# ' + (index + 1));
            
            $('#editAccName').val(container.find('.acc-name').val());
            $('#editAccSubtext').val(container.find('.acc-subtext').val());
            $('#editAccChartLabels').val(container.find('.acc-chart_labels').val());
            $('#editAccChartData').val(container.find('.acc-chart_data').val());
            $('#editAccTotalGain').val(container.find('.acc-total_gain').val());
            $('#editAccBalance').val(container.find('.acc-balance').val());
            $('#editAccMonthly').val(container.find('.acc-monthly').val());
            $('#editAccDrawdown').val(container.find('.acc-drawdown').val());
            $('#editAccDaily').val(container.find('.acc-daily').val());
            $('#editAccProfit').val(container.find('.acc-profit').val());
            $('#editAccDeposits').val(container.find('.acc-deposits').val());
            $('#editAccPlatform').val(container.find('.acc-platform').val());
            
            // Show modal
            $('#editAccountModal').modal('show');
        });

        // Handle remove account button click
        $(document).on('click', '.remove-account-btn', function() {
            if(confirm('Are you sure you want to remove this account?')) {
                const index = $(this).data('index');
                const btn = $(this);
                
                // Disable button
                btn.prop('disabled', true);
                
                $.ajax({
                    url: '/admin/results/account/' + index,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        // Remove from DOM
                        $('.account-data-row[data-index="' + index + '"]').remove();
                        btn.closest('tr').fadeOut(300, function() { 
                            $(this).remove(); 
                            // Optional: Reload to re-index or just keep it as is
                            // Ideally reload to keep indices in sync with backend if user wants to delete another one
                            location.reload(); 
                        });
                        
                        Swal.fire({
                            icon: 'success',
                            title: 'Deleted!',
                            text: 'Account has been removed.',
                            timer: 1500,
                            showConfirmButton: false
                        });
                    },
                    error: function(xhr) {
                        btn.prop('disabled', false);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Failed to delete account. Please try again.'
                        });
                    }
                });
            }
        });

        // Handle Edit Form Submit (Update local DOM only)
        $('#editAccountForm').on('submit', function(e) {
            e.preventDefault();
            const index = $('#editAccountIndex').val();
            const container = $('.account-data-row[data-index="' + index + '"]');
            
            // Update hidden inputs
            container.find('.acc-name').val($('#editAccName').val());
            container.find('.acc-subtext').val($('#editAccSubtext').val());
            container.find('.acc-chart_labels').val($('#editAccChartLabels').val());
            container.find('.acc-chart_data').val($('#editAccChartData').val());
            
            // Update newly editable fields
            container.find('.acc-total_gain').val($('#editAccTotalGain').val());
            container.find('.acc-balance').val($('#editAccBalance').val());
            container.find('.acc-monthly').val($('#editAccMonthly').val());
            container.find('.acc-drawdown').val($('#editAccDrawdown').val());
            
            container.find('.acc-daily').val($('#editAccDaily').val());
            container.find('.acc-profit').val($('#editAccProfit').val());
            container.find('.acc-deposits').val($('#editAccDeposits').val());
            container.find('.acc-platform').val($('#editAccPlatform').val());
            
            // Note: Auto-calculated fields (Total Gain, etc) are not updated here in realtime
            // because strict calculation happens on backend. 
            // We only update the editable fields. Backend will re-calc on save.
            
            // Update Table Row UI
            const row = $('tr[data-index="' + index + '"]');
            row.find('td:eq(1)').text($('#editAccName').val());
            row.find('td:eq(2)').text($('#editAccSubtext').val());
            row.find('td:eq(3) span').text($('#editAccTotalGain').val()); // Update Total Gain Badge
            row.find('td:eq(4)').text($('#editAccBalance').val());        // Update Balance
            row.find('td:eq(5)').text($('#editAccMonthly').val());        // Update Monthly
            row.find('td:eq(6) span').text($('#editAccDrawdown').val());  // Update Drawdown Badge
            row.find('td:eq(7)').text($('#editAccPlatform').val());
            
            $('#editAccountModal').modal('hide');
            
            // Trigger auto-save or notify user
            // For now, we rely on the main "Save Changes" button
        });

        // Handle chart data change - auto calculate
        $('#editAccChartData').on('input', function() {
            const chartDataStr = $(this).val();
            if (chartDataStr) {
                try {
                    const chartData = chartDataStr.split(',').map(v => parseFloat(v.trim())).filter(v => !isNaN(v));
                    const chartLabelsStr = $('#editAccChartLabels').val() || '';
                    const chartLabels = chartLabelsStr ? chartLabelsStr.split(',').map(v => v.trim()) : [];
                    
                    if (chartData.length > 0) {
                        // Calculate values
                        const totalGain = calculateTotalGain(chartData);
                        const monthly = calculateMonthly(chartData, chartLabels);
                        const drawdown = calculateDrawdown(chartData);
                        const balance = calculateBalance(chartData);
                        
                        // Update readonly fields
                        $('#editAccTotalGain').val(totalGain);
                        $('#editAccMonthly').val(monthly);
                        $('#editAccDrawdown').val(drawdown);
                        $('#editAccBalance').val(balance);
                    }
                } catch (e) {
                    console.error('Error calculating:', e);
                }
            }
        });

        // Handle edit form submission
        $('#editAccountForm').on('submit', function(e) {
            e.preventDefault();
            
            const accountNum = $('#editAccountId').val();
            const accPrefix = 'acc' + accountNum;
            
            // Prepare data for main form
            const formData = {
                account_number: accountNum,
                acc_name: $('#editAccName').val(),
                acc_subtext: $('#editAccSubtext').val(),
                acc_chart_labels: $('#editAccChartLabels').val(),
                acc_chart_data: $('#editAccChartData').val(),
                acc_daily: $('#editAccDaily').val(),
                acc_profit: $('#editAccProfit').val(),
                acc_deposits: $('#editAccDeposits').val(),
                acc_platform: $('#editAccPlatform').val()
            };
            
            // Update main form fields
            $('input[name="' + accPrefix + '_name"]').val(formData.acc_name);
            $('input[name="' + accPrefix + '_subtext"]').val(formData.acc_subtext);
            $('input[name="' + accPrefix + '_chart_labels"]').val(formData.acc_chart_labels);
            $('input[name="' + accPrefix + '_chart_data"]').val(formData.acc_chart_data);
            $('input[name="' + accPrefix + '_daily"]').val(formData.acc_daily);
            $('input[name="' + accPrefix + '_profit"]').val(formData.acc_profit);
            $('input[name="' + accPrefix + '_deposits"]').val(formData.acc_deposits);
            $('input[name="' + accPrefix + '_platform"]').val(formData.acc_platform);
            
            // Update calculated fields
            $('input[name="' + accPrefix + '_total_gain"]').val($('#editAccTotalGain').val());
            $('input[name="' + accPrefix + '_balance"]').val($('#editAccBalance').val());
            $('input[name="' + accPrefix + '_monthly"]').val($('#editAccMonthly').val());
            $('input[name="' + accPrefix + '_drawdown"]').val($('#editAccDrawdown').val());
            
            // Submit main form via AJAX
            const mainFormData = $('form[action="{{ route('admin.results.update') }}"]').serialize();
            
            $.ajax({
                url: "{{ route('admin.results.update') }}",
                type: 'POST',
                data: mainFormData,
                success: function(response) {
                    $('#editAccountModal').modal('hide');
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Account updated successfully!',
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        location.reload();
                    });
                },
                error: function(xhr) {
                    let errorMsg = 'Error updating account';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMsg = xhr.responseJSON.message;
                    } else if (xhr.status === 419) {
                        errorMsg = 'CSRF token mismatch. Please refresh the page.';
                    }
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: errorMsg
                    });
                }
            });
        });

        // Helper functions for calculations
        function calculateTotalGain(chartData) {
            if (!chartData || chartData.length === 0) return '0%';
            const lastValue = chartData[chartData.length - 1];
            const sign = lastValue >= 0 ? '+' : '';
            return sign + parseFloat(lastValue).toFixed(2) + '%';
        }

        function calculateMonthly(chartData, chartLabels) {
            if (!chartData || chartData.length < 2) return '0%';
            const totalGain = chartData[chartData.length - 1];
            if (totalGain == 0) return '0%';
            const numberOfMonths = 12;
            const totalGainDecimal = totalGain / 100;
            if (totalGainDecimal < -1) return '0%';
            const monthlyRate = Math.pow(1 + totalGainDecimal, 1 / numberOfMonths) - 1;
            const monthlyPercentage = monthlyRate * 100;
            return parseFloat(monthlyPercentage).toFixed(2) + '%';
        }

        function calculateDrawdown(chartData) {
            if (!chartData || chartData.length < 2) return '0%';
            let peakGain = chartData[0];
            let maxDrawdown = 0;
            
            for (let i = 0; i < chartData.length; i++) {
                const currentGain = chartData[i];
                if (currentGain > peakGain) {
                    peakGain = currentGain;
                }
                if (peakGain > 0) {
                    const drawdown = ((peakGain - currentGain) / peakGain) * 100;
                    if (drawdown > maxDrawdown) {
                        maxDrawdown = drawdown;
                    }
                }
            }
            
            // If no decline, estimate based on volatility
            if (maxDrawdown == 0 && chartData.length > 2) {
                const finalGain = chartData[chartData.length - 1];
                if (finalGain > 0) {
                    const growthRates = [];
                    for (let i = 1; i < chartData.length; i++) {
                        if (chartData[i-1] > 0) {
                            const growthRate = ((chartData[i] - chartData[i-1]) / chartData[i-1]) * 100;
                            growthRates.push(growthRate);
                        }
                    }
                    if (growthRates.length > 0) {
                        const avgGrowthRate = growthRates.reduce((a, b) => a + b, 0) / growthRates.length;
                        let variance = 0;
                        growthRates.forEach(rate => {
                            variance += Math.pow(rate - avgGrowthRate, 2);
                        });
                        const volatility = Math.sqrt(variance / growthRates.length);
                        const baseDrawdown = 2.0;
                        const volatilityFactor = Math.min(volatility * 0.1, 2.0);
                        const gainFactor = Math.min((finalGain / 100) * 0.01, 1.5);
                        maxDrawdown = Math.min(Math.max(baseDrawdown + volatilityFactor + gainFactor, 1.0), 6.0);
                    } else {
                        maxDrawdown = Math.min(2.5 + Math.min((finalGain / 100) * 0.01, 2.5), 5.0);
                    }
                }
            }
            
            return parseFloat(maxDrawdown).toFixed(2) + '%';
        }

        function calculateBalance(chartData) {
            if (!chartData || chartData.length === 0) return '$0.00';
            const initialBalance = 100000;
            const totalGain = chartData[chartData.length - 1];
            const balance = initialBalance * (1 + (totalGain / 100));
            return '$' + parseFloat(balance).toFixed(2);
        }
    });
</script>
@endsection
