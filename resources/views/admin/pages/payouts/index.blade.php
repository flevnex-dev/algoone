@extends('admin.layouts.master')
@section('title', 'Payouts Management')

@push('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6 col-12">
                <h2>Payouts Management</h2>
            </div>
            <div class="col-sm-6 col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="iconly-Home icli svg-color"></i></a></li>
                    <li class="breadcrumb-item">Site Management</li>
                    <li class="breadcrumb-item active">Payouts</li>
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

    <!-- Add New Payout Form -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Add New Payout</h5>
        </div>
        <div class="card-body">
            <form id="addPayoutForm" action="{{ route('admin.payouts.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Trader User <span class="text-danger">*</span></label>
                        <select name="user_id" id="traderSelect" class="form-select" required>
                            <option value="">Select Trader</option>
                            @foreach($traders as $trader)
                                <option value="{{ $trader->id }}" 
                                    data-name="{{ $trader->name }}" 
                                    data-country="{{ $trader->country ?? '' }}">
                                    {{ $trader->name }} ({{ $trader->email }})
                                </option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Amount ($) <span class="text-danger">*</span></label>
                        <input type="number" name="amount" class="form-control" step="0.01" min="0.01" required>
                        @error('amount')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Display Name</label>
                        <input type="text" name="name" id="displayName" class="form-control" placeholder="e.g., John D.">
                        <small class="text-muted">Leave empty to auto-generate from user name</small>
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Country</label>
                        <input type="text" name="country" id="countryInput" class="form-control" placeholder="e.g., US, UK">
                        <small class="text-muted">Leave empty to use user's country</small>
                        @error('country')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Payout Date <span class="text-danger">*</span></label>
                        <input type="text" name="payout_date" id="payoutDate" class="form-control" value="{{ date('Y-m-d') }}" required>
                        @error('payout_date')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-select" required>
                            <option value="completed" selected>Completed</option>
                            <option value="pending">Pending</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                        @error('status')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="form-check mt-4">
                            <input class="form-check-input" type="checkbox" name="is_public" value="1" id="isPublic" checked>
                            <label class="form-check-label" for="isPublic">
                                Show on Public Payout Page
                            </label>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Notes</label>
                        <textarea name="notes" class="form-control" rows="2"></textarea>
                        @error('notes')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Add Payout</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Payouts List -->
    <div class="card">
        <div class="card-header bg-secondary text-white">
            <h5 class="mb-0">All Payouts</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="payoutsTable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Trader</th>
                            <th>Display Name</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th>Country</th>
                            <th>Status</th>
                            <th>Public</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Edit Modal - Outside Table Container -->
    <div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Payout</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editPayoutForm">
                @csrf
                @method('PUT')
                <input type="hidden" name="payout_id" id="editPayoutId">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Trader User <span class="text-danger">*</span></label>
                        <select name="user_id" id="editUserId" class="form-select edit-trader-select" required>
                            <option value="">Select Trader</option>
                            @foreach($traders as $trader)
                                <option value="{{ $trader->id }}" 
                                    data-name="{{ $trader->name }}" 
                                    data-country="{{ $trader->country ?? '' }}">
                                    {{ $trader->name }} ({{ $trader->email }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Amount ($) <span class="text-danger">*</span></label>
                        <input type="number" name="amount" id="editAmount" class="form-control" step="0.01" min="0.01" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Display Name</label>
                        <input type="text" name="name" id="editName" class="form-control edit-display-name">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Country</label>
                        <input type="text" name="country" id="editCountry" class="form-control edit-country">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Payout Date <span class="text-danger">*</span></label>
                        <input type="text" name="payout_date" id="editPayoutDate" class="form-control edit-payout-date" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status <span class="text-danger">*</span></label>
                        <select name="status" id="editStatus" class="form-select" required>
                            <option value="completed">Completed</option>
                            <option value="pending">Pending</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="is_public" value="1" id="editIsPublic">
                            <label class="form-check-label" for="editIsPublic">
                                Show on Public Payout Page
                            </label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Notes</label>
                        <textarea name="notes" id="editNotes" class="form-control" rows="2"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Payout</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
@endsection

@section('js')
<script src="{{ url('/admin/assets') }}/js/sweetalert/sweetalert2.min.js"></script>
<script>
    let payoutTable;
    let editDatePicker;
    
    // Setup AJAX to include CSRF token in all requests
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'X-Requested-With': 'XMLHttpRequest'
        }
    });
    
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize date picker for main form
        if (document.getElementById('payoutDate')) {
            flatpickr("#payoutDate", {
                dateFormat: "Y-m-d",
                defaultDate: "{{ date('Y-m-d') }}",
                maxDate: "today"
            });
        }
        
        // Initialize DataTable with server-side processing
        payoutTable = $('#payoutsTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('admin.payouts.datatable') }}",
                type: 'GET'
            },
            columns: [
                { data: 'id', name: 'id' },
                { data: 'trader', name: 'trader' },
                { data: 'display_name', name: 'display_name' },
                { 
                    data: 'amount', 
                    name: 'amount',
                    render: function(data) {
                        return '$' + data;
                    }
                },
                { data: 'date', name: 'date' },
                { data: 'country', name: 'country' },
                { 
                    data: 'status', 
                    name: 'status',
                    render: function(data) {
                        const badgeClass = data === 'completed' ? 'success' : (data === 'pending' ? 'warning' : 'danger');
                        return '<span class="badge bg-' + badgeClass + '">' + data.charAt(0).toUpperCase() + data.slice(1) + '</span>';
                    }
                },
                { 
                    data: 'is_public', 
                    name: 'is_public',
                    render: function(data) {
                        return data ? '<span class="badge bg-info">Yes</span>' : '<span class="badge bg-secondary">No</span>';
                    }
                },
                { 
                    data: 'id', 
                    name: 'actions',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return '<button type="button" class="btn btn-sm btn-warning edit-payout-btn" data-id="' + data + '">Edit</button> ' +
                               '<button type="button" class="btn btn-sm btn-danger delete-payout-btn" data-id="' + data + '">Delete</button>';
                    }
                }
            ],
            order: [[0, 'desc']],
            pageLength: 10,
            language: {
                processing: "Loading..."
            }
        });
        
        // Initialize date picker for edit modal
        document.addEventListener('shown.bs.modal', function(event) {
            if (event.target.id === 'editModal') {
                const dateInput = document.getElementById('editPayoutDate');
                if (dateInput && !editDatePicker) {
                    editDatePicker = flatpickr("#editPayoutDate", {
                        dateFormat: "Y-m-d",
                        maxDate: "today"
                    });
                }
            }
        });
        
        // Reset date picker when modal is hidden
        document.addEventListener('hidden.bs.modal', function(event) {
            if (event.target.id === 'editModal' && editDatePicker) {
                editDatePicker.destroy();
                editDatePicker = null;
            }
        });
        
        // Function to generate display name from user name
        function generateDisplayName(userName) {
            if (!userName) return '';
            const nameParts = userName.split(' ');
            if (nameParts.length > 1) {
                // Format: FirstName LastInitial (e.g., "John Doe" -> "John D.")
                return nameParts[0] + ' ' + nameParts[nameParts.length - 1].charAt(0) + '.';
            }
            return userName;
        }
        
        // Function to handle trader selection
        function handleTraderSelect(selectElement, nameInput, countryInput) {
            selectElement.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                
                if (selectedOption.value) {
                    const userName = selectedOption.getAttribute('data-name');
                    const userCountry = selectedOption.getAttribute('data-country');
                    
                    // Auto-generate display name from user name (only if field is empty)
                    if (userName && !nameInput.value.trim()) {
                        nameInput.value = generateDisplayName(userName);
                    }
                    
                    // Auto-fill country if available and empty
                    if (userCountry && !countryInput.value.trim()) {
                        countryInput.value = userCountry;
                    }
                }
            });
        }
        
        // Handle main form
        const traderSelect = document.getElementById('traderSelect');
        const displayNameInput = document.getElementById('displayName');
        const countryInput = document.getElementById('countryInput');
        
        if (traderSelect && displayNameInput && countryInput) {
            handleTraderSelect(traderSelect, displayNameInput, countryInput);
        }
        
        // Handle edit modal trader select
        $(document).on('change', '.edit-trader-select', function() {
            const selectedOption = this.options[this.selectedIndex];
            const nameInput = document.getElementById('editName');
            const countryInput = document.getElementById('editCountry');
            
            if (selectedOption.value && nameInput && countryInput) {
                const userName = selectedOption.getAttribute('data-name');
                const userCountry = selectedOption.getAttribute('data-country');
                
                // Auto-generate display name (only if field is empty)
                if (userName && !nameInput.value.trim()) {
                    nameInput.value = generateDisplayName(userName);
                }
                
                // Auto-fill country if available and empty
                if (userCountry && !countryInput.value.trim()) {
                    countryInput.value = userCountry;
                }
            }
        });
        
        // Handle Edit button click
        $(document).on('click', '.edit-payout-btn', function() {
            const payoutId = $(this).data('id');
            
            // Fetch payout data via AJAX
            $.ajax({
                url: "{{ route('admin.payouts.index') }}/" + payoutId,
                type: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                success: function(response) {
                    if (response.success) {
                        const data = response.data;
                        $('#editPayoutId').val(data.id);
                        $('#editUserId').val(data.user_id);
                        $('#editAmount').val(data.amount);
                        $('#editName').val(data.name);
                        $('#editCountry').val(data.country);
                        $('#editPayoutDate').val(data.payout_date);
                        $('#editStatus').val(data.status);
                        $('#editIsPublic').prop('checked', data.is_public);
                        $('#editNotes').val(data.notes);
                        
                        // Initialize date picker
                        if (!editDatePicker) {
                            editDatePicker = flatpickr("#editPayoutDate", {
                                dateFormat: "Y-m-d",
                                maxDate: "today"
                            });
                        }
                        
                        $('#editModal').modal('show');
                    }
                },
                error: function(xhr) {
                    let errorMsg = 'Error loading payout data';
                    if (xhr.status === 404) {
                        errorMsg = 'Payout not found';
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
        
        // Handle Edit form submission
        $('#editPayoutForm').on('submit', function(e) {
            e.preventDefault();
            const payoutId = $('#editPayoutId').val();
            const formData = $(this).serialize();
            
            $.ajax({
                url: "{{ route('admin.payouts.index') }}/" + payoutId,
                type: 'POST',
                data: formData + '&_method=PUT',
                headers: {
                    'Accept': 'application/json'
                },
                success: function(response) {
                    if (response.success) {
                        $('#editModal').modal('hide');
                        payoutTable.ajax.reload();
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'Payout updated successfully',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }
                },
                error: function(xhr) {
                    let errorMsg = 'Error updating payout';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMsg = xhr.responseJSON.message;
                    } else if (xhr.responseJSON && xhr.responseJSON.errors) {
                        let errors = '';
                        $.each(xhr.responseJSON.errors, function(key, value) {
                            errors += value[0] + '<br>';
                        });
                        errorMsg = errors;
                    } else if (xhr.status === 419) {
                        errorMsg = 'CSRF token mismatch. Please refresh the page.';
                        // Refresh CSRF token
                        location.reload();
                    }
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        html: errorMsg
                    });
                }
            });
        });
        
        // Handle Delete button click
        $(document).on('click', '.delete-payout-btn', function() {
            const payoutId = $(this).data('id');
            const btn = $(this);
            
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    btn.prop('disabled', true).text('Deleting...');
                    
                    // Build delete URL
                    const deleteUrl = "{{ url('admin/payouts') }}/" + payoutId;
                    
                    $.ajax({
                        url: deleteUrl,
                        type: 'POST',
                        headers: {
                            'Accept': 'application/json'
                        },
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            _method: 'DELETE'
                        },
                        success: function(response) {
                            if (response.success) {
                                payoutTable.ajax.reload();
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Deleted!',
                                    text: 'Payout deleted successfully',
                                    timer: 2000,
                                    showConfirmButton: false
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    text: response.message || 'Failed to delete payout'
                                });
                                btn.prop('disabled', false).text('Delete');
                            }
                        },
                        error: function(xhr) {
                            let errorMsg = 'Error deleting payout';
                            if (xhr.responseJSON) {
                                if (xhr.responseJSON.message) {
                                    errorMsg = xhr.responseJSON.message;
                                } else if (xhr.responseJSON.error) {
                                    errorMsg = xhr.responseJSON.error;
                                }
                            } else if (xhr.status === 404) {
                                errorMsg = 'Payout not found';
                            } else if (xhr.status === 403) {
                                errorMsg = 'Permission denied';
                    } else if (xhr.status === 419) {
                        errorMsg = 'CSRF token mismatch. Please refresh the page.';
                        Swal.fire({
                            icon: 'error',
                            title: 'Session Expired!',
                            text: errorMsg,
                            confirmButtonText: 'Refresh Page'
                        }).then(() => {
                            location.reload();
                        });
                        return;
                    } else if (xhr.status === 500) {
                        errorMsg = 'Server error occurred';
                    }
                    console.error('Delete error:', xhr);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: errorMsg
                    });
                    btn.prop('disabled', false).text('Delete');
                }
                    });
                }
            });
        });
        
        // Handle Add Payout form submission with AJAX
        $('#addPayoutForm').on('submit', function(e) {
            e.preventDefault();
            const formData = $(this).serialize();
            
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: formData,
                headers: {
                    'Accept': 'application/json'
                },
                success: function(response) {
                    if (response.success) {
                        $('#addPayoutForm')[0].reset();
                        payoutTable.ajax.reload();
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'Payout created successfully',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }
                },
                error: function(xhr) {
                    let errorMsg = 'Error creating payout';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMsg = xhr.responseJSON.message;
                    } else if (xhr.responseJSON && xhr.responseJSON.errors) {
                        let errors = '';
                        $.each(xhr.responseJSON.errors, function(key, value) {
                            errors += value[0] + '<br>';
                        });
                        errorMsg = errors;
                    } else if (xhr.status === 419) {
                        errorMsg = 'CSRF token mismatch. Please refresh the page.';
                        Swal.fire({
                            icon: 'error',
                            title: 'Session Expired!',
                            text: errorMsg,
                            confirmButtonText: 'Refresh Page'
                        }).then(() => {
                            location.reload();
                        });
                        return;
                    }
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        html: errorMsg
                    });
                }
            });
        });
    });
</script>
@endsection

