@extends('admin.layouts.master')
@section('title', 'Buy Funding Section Settings')
@section('content')

<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6 col-12">
                <h2>Buy Funding Section Settings</h2>
            </div>
            <div class="col-sm-6 col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="iconly-Home icli svg-color"></i></a></li>
                    <li class="breadcrumb-item">Site Management</li>
                    <li class="breadcrumb-item active">Buy Funding Section</li>
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
                    <h5 class="mb-0">Manage Buy Funding Section</h5>
                </div>
                <div class="card-body">
                    
                    <form action="{{ route('admin.buy-funding.update') }}" method="POST">
                        @csrf
                        
                        <!-- Main Title Section -->
                        <div class="mb-4">
                            <h5 class="mb-3">Main Header</h5>
                            <div class="mb-3">
                                <label class="form-label">Main Title</label>
                                <input type="text" name="main_title" class="form-control" value="{{ $buyFunding->main_title ?? 'More Funding = More Profits' }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Main Subtitle</label>
                                <textarea name="main_subtitle" class="form-control" rows="2">{{ $buyFunding->main_subtitle ?? 'Scale your trading and multiply your earnings with increased account sizes' }}</textarea>
                            </div>
                        </div>

                        <!-- Comparison Card 1 -->
                        <div class="mb-4">
                            <h5 class="mb-3">Comparison Card 1 (Small vs Medium)</h5>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Small Account Title</label>
                                    <input type="text" name="comparison1_small_account_title" class="form-control" value="{{ $buyFunding->comparison1_small_account_title ?? '$5,000 Account' }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Small Account Profit</label>
                                    <input type="text" name="comparison1_small_account_profit" class="form-control" value="{{ $buyFunding->comparison1_small_account_profit ?? '$250' }}">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Small Account Label</label>
                                    <input type="text" name="comparison1_small_account_label" class="form-control" value="{{ $buyFunding->comparison1_small_account_label ?? 'Profit per 5% gain' }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Medium Account Title</label>
                                    <input type="text" name="comparison1_medium_account_title" class="form-control" value="{{ $buyFunding->comparison1_medium_account_title ?? '$100,000 Account' }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Medium Account Profit</label>
                                    <input type="text" name="comparison1_medium_account_profit" class="form-control" value="{{ $buyFunding->comparison1_medium_account_profit ?? '$5,000' }}">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Medium Account Label</label>
                                    <input type="text" name="comparison1_medium_account_label" class="form-control" value="{{ $buyFunding->comparison1_medium_account_label ?? 'Profit per 5% gain' }}">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Button Text</label>
                                    <input type="text" name="comparison1_button_text" class="form-control" value="{{ $buyFunding->comparison1_button_text ?? '20x More Profit!' }}">
                                </div>
                            </div>
                        </div>

                        <!-- Comparison Card 2 -->
                        <div class="mb-4">
                            <h5 class="mb-3">Comparison Card 2 (Medium vs Large)</h5>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Medium Account Title</label>
                                    <input type="text" name="comparison2_medium_account_title" class="form-control" value="{{ $buyFunding->comparison2_medium_account_title ?? '$100,000 Account' }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Medium Account Profit</label>
                                    <input type="text" name="comparison2_medium_account_profit" class="form-control" value="{{ $buyFunding->comparison2_medium_account_profit ?? '$5,000' }}">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Medium Account Label</label>
                                    <input type="text" name="comparison2_medium_account_label" class="form-control" value="{{ $buyFunding->comparison2_medium_account_label ?? 'Profit per 5% gain' }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Large Account Title</label>
                                    <input type="text" name="comparison2_large_account_title" class="form-control" value="{{ $buyFunding->comparison2_large_account_title ?? '$400,000 Account' }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Large Account Profit</label>
                                    <input type="text" name="comparison2_large_account_profit" class="form-control" value="{{ $buyFunding->comparison2_large_account_profit ?? '$20,000' }}">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Large Account Label</label>
                                    <input type="text" name="comparison2_large_account_label" class="form-control" value="{{ $buyFunding->comparison2_large_account_label ?? 'Profit per 5% gain' }}">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Button Text</label>
                                    <input type="text" name="comparison2_button_text" class="form-control" value="{{ $buyFunding->comparison2_button_text ?? '4x More Profit!' }}">
                                </div>
                            </div>
                        </div>

                        <!-- Chart Section -->
                        <div class="mb-4">
                            <h5 class="mb-3">Chart Section</h5>
                            <div class="mb-3">
                                <label class="form-label">Chart Title</label>
                                <input type="text" name="chart_title" class="form-control" value="{{ $buyFunding->chart_title ?? 'Account Size vs Profit Potential' }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Chart Subtitle</label>
                                <textarea name="chart_subtitle" class="form-control" rows="2">{{ $buyFunding->chart_subtitle ?? '5% monthly gain comparison across account sizes' }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Chart Conclusion</label>
                                <textarea name="chart_conclusion" class="form-control" rows="2">{{ $buyFunding->chart_conclusion ?? 'With just 5% monthly gains, larger accounts generate exponentially more profit' }}</textarea>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Chart Data</label>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="chartDataTable">
                                        <thead>
                                            <tr>
                                                <th>Label</th>
                                                <th>Data Value</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $chartLabels = $buyFunding->chart_data['labels'] ?? ['$5k', '$10k', '$25k', '$50k', '$100k', '$200k', '$300k', '$400k'];
                                                $chartData = $buyFunding->chart_data['data'] ?? [250, 500, 1250, 2500, 5000, 10000, 15000, 20000];
                                            @endphp
                                            @foreach($chartLabels as $index => $label)
                                            <tr>
                                                <td>
                                                    <input type="text" name="chart_labels[]" class="form-control" value="{{ $label }}" required>
                                                </td>
                                                <td>
                                                    <input type="number" name="chart_data[]" class="form-control" value="{{ $chartData[$index] ?? 0 }}" required>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-danger btn-sm remove-chart-row">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <button type="button" class="btn btn-success btn-sm mt-2" id="addChartRow">
                                    <i class="fas fa-plus"></i> Add Chart Data Point
                                </button>
                            </div>
                        </div>

                        <!-- CTA Section -->
                        <div class="mb-4">
                            <h5 class="mb-3">Call to Action Section</h5>
                            <div class="mb-3">
                                <label class="form-label">CTA Title</label>
                                <input type="text" name="cta_title" class="form-control" value="{{ $buyFunding->cta_title ?? 'Ready to Scale Up?' }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">CTA Subtitle</label>
                                <textarea name="cta_subtitle" class="form-control" rows="2">{{ $buyFunding->cta_subtitle ?? 'Increase your funding and multiply your profits' }}</textarea>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Button 1 Text</label>
                                    <input type="text" name="cta_button1_text" class="form-control" value="{{ $buyFunding->cta_button1_text ?? 'Limited Spots Available' }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Button 2 Text</label>
                                    <input type="text" name="cta_button2_text" class="form-control" value="{{ $buyFunding->cta_button2_text ?? 'Message Us To Get More Funding' }}">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Button 2 Link</label>
                                    <input type="text" name="cta_button2_link" class="form-control" value="{{ $buyFunding->cta_button2_link ?? '' }}">
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="is_active" value="1" id="isActive" {{ ($buyFunding->is_active ?? true) ? 'checked' : '' }}>
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
    const chartDataTable = document.getElementById('chartDataTable');
    const addChartRowBtn = document.getElementById('addChartRow');
    
    // Add new chart data row
    addChartRowBtn.addEventListener('click', function() {
        const tbody = chartDataTable.querySelector('tbody');
        const newRow = document.createElement('tr');
        newRow.innerHTML = `
            <td>
                <input type="text" name="chart_labels[]" class="form-control" value="" required>
            </td>
            <td>
                <input type="number" name="chart_data[]" class="form-control" value="0" required>
            </td>
            <td>
                <button type="button" class="btn btn-danger btn-sm remove-chart-row">
                    <i class="fas fa-trash"></i>
                </button>
            </td>
        `;
        tbody.appendChild(newRow);
    });
    
    // Remove chart data row
    chartDataTable.addEventListener('click', function(e) {
        if (e.target.closest('.remove-chart-row')) {
            const row = e.target.closest('tr');
            const tbody = chartDataTable.querySelector('tbody');
            if (tbody.children.length > 1) {
                row.remove();
            } else {
                alert('You must have at least one chart data point.');
            }
        }
    });
});
</script>
@endsection
