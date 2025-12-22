@extends('admin.layouts.master')
@section('title', 'Edit Week Performance')

@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6 col-12">
                <h2>Edit Performance Data - {{ $week->week_label }}</h2>
            </div>
            <div class="col-sm-6 col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="iconly-Home icli svg-color"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.week-performance.index') }}">Week Performance</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <form action="{{ route('admin.week-performance.update', $week->id) }}" method="POST" id="performanceForm">
        @csrf
        @method('PUT')
        
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Performance Breakdown & Chart Data - {{ $week->week_label }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered align-middle mb-0">
                                <tbody>
                                    <!-- Performance Breakdown -->
                                    <tr>
                                        <th style="width: 220px;">Trading Week</th>
                                        <td>
                                            <input type="text" class="form-control" value="{{ $week->week_label }} ({{ $week->start_date->format('M d') }} - {{ $week->end_date->format('M d, Y') }})" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Trade Accuracy (%)</th>
                                        <td>
                                            <input type="number" name="trade_accuracy" class="form-control" step="0.01" min="0" max="100" value="{{ old('trade_accuracy', $week->performanceDetail->trade_accuracy ?? '') }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Risk-Reward Ratio</th>
                                        <td>
                                            <input type="number" name="risk_reward_ratio" class="form-control" step="0.01" min="0" value="{{ old('risk_reward_ratio', $week->performanceDetail->risk_reward_ratio ?? '') }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Largest Drawdown (%)</th>
                                        <td>
                                            <input type="number" name="largest_drawdown" class="form-control" step="0.01" value="{{ old('largest_drawdown', $week->performanceDetail->largest_drawdown ?? '') }}">
                                            <small class="text-muted">Use negative value (e.g., -1.4)</small>
                                        </td>
                                    </tr>

                                    <!-- Chart Data -->
                                    <tr>
                                        <th colspan="2" class="bg-light">
                                            <strong>Chart Data</strong>
                                        </th>
                                    </tr>
                                    @php
                                        $chartLabels = old('chart_labels', $week->performanceDetail && $week->performanceDetail->chart_labels ? $week->performanceDetail->chart_labels : ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday']);
                                        $chartData = old('chart_data', $week->performanceDetail && $week->performanceDetail->chart_data ? $week->performanceDetail->chart_data : [0, 0.7, 1.2, 2.3, 2.98]);
                                        $chartCount = max(count($chartLabels), count($chartData));
                                    @endphp
                                    @for($i = 0; $i < $chartCount; $i++)
                                        <tr class="chart-row">
                                            <th>
                                                @if($i === 0)
                                                    Chart Label & Value
                                                @endif
                                            </th>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-6 mb-2">
                                                        <input type="text" name="chart_labels[]" class="form-control" value="{{ $chartLabels[$i] ?? '' }}" placeholder="Chart Label (e.g., Monday)">
                                                    </div>
                                                    <div class="col-md-5 mb-2">
                                                        <input type="number" name="chart_data[]" class="form-control" step="0.01" value="{{ $chartData[$i] ?? '' }}" placeholder="Chart Value (e.g., 0.7)">
                                                    </div>
                                                    <div class="col-md-1 mb-2">
                                                        @if($i > 0)
                                                            <button type="button" class="btn btn-sm btn-danger remove-chart-row">
                                                                <i class="fas fa-times"></i>
                                                            </button>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endfor
                                    <tr>
                                        <th></th>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-success" id="addChartRow">
                                                <i class="fas fa-plus me-1"></i> Add More
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Primary Markets Traded -->
                                    <tr>
                                        <th colspan="2" class="bg-light">
                                            <strong>Primary Markets Traded</strong>
                                        </th>
                                    </tr>
                                    @php
                                        $markets = old('markets_traded', $week->performanceDetail && $week->performanceDetail->markets_traded ? $week->performanceDetail->markets_traded : []);
                                        if (empty($markets)) {
                                            $markets = [['market' => '', 'volume_percentage' => '']];
                                        }
                                    @endphp
                                    @foreach($markets as $index => $market)
                                        <tr class="market-row">
                                            <th>
                                                @if($index === 0)
                                                    Market & Volume %
                                                @endif
                                            </th>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-6 mb-2">
                                                        <input type="text" name="markets_traded[{{ $index }}][market]" class="form-control" value="{{ $market['market'] ?? '' }}" placeholder="Market (e.g., XAUUSD)">
                                                    </div>
                                                    <div class="col-md-5 mb-2">
                                                        <input type="number" name="markets_traded[{{ $index }}][volume_percentage]" class="form-control" step="0.01" value="{{ $market['volume_percentage'] ?? '' }}" placeholder="Volume % (e.g., 55)">
                                                    </div>
                                                    <div class="col-md-1 mb-2">
                                                        @if($index > 0)
                                                            <button type="button" class="btn btn-sm btn-danger remove-market-row">
                                                                <i class="fas fa-times"></i>
                                                            </button>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <th></th>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-success" id="addMarketRow">
                                                <i class="fas fa-plus me-1"></i> Add More
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Daily Performance Summary -->
                                    <tr>
                                        <th colspan="2" class="bg-light">
                                            <strong>Daily Performance Summary</strong>
                                        </th>
                                    </tr>
                                    @php
                                        $dailyPerf = old('daily_performance', $week->performanceDetail && $week->performanceDetail->daily_performance ? $week->performanceDetail->daily_performance : []);
                                        if (empty($dailyPerf)) {
                                            $dailyPerf = [['day' => '', 'change' => '', 'equity' => '']];
                                        }
                                    @endphp
                                    @foreach($dailyPerf as $index => $day)
                                        <tr class="daily-row">
                                            <th>
                                                @if($index === 0)
                                                    Title, Daily Change & Equity
                                                @endif
                                            </th>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-3 mb-2">
                                                        <input type="text" name="daily_performance[{{ $index }}][day]" class="form-control" value="{{ $day['day'] ?? '' }}" placeholder="Title (e.g., Monday)">
                                                    </div>
                                                    <div class="col-md-4 mb-2">
                                                        <input type="text" name="daily_performance[{{ $index }}][change]" class="form-control" value="{{ $day['change'] ?? '' }}" placeholder="Daily Change (e.g., +1.13%)">
                                                    </div>
                                                    <div class="col-md-4 mb-2">
                                                        <input type="text" name="daily_performance[{{ $index }}][equity]" class="form-control" value="{{ $day['equity'] ?? '' }}" placeholder="Equity Balance (e.g., $101,130)">
                                                    </div>
                                                    <div class="col-md-1 mb-2">
                                                        @if($index > 0)
                                                            <button type="button" class="btn btn-sm btn-danger remove-daily-row">
                                                                <i class="fas fa-times"></i>
                                                            </button>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <th></th>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-success" id="addDailyRow">
                                                <i class="fas fa-plus me-1"></i> Add More
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Update Performance
                        </button>
                        <a href="{{ route('admin.week-performance.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times me-1"></i> Cancel
                        </a>
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
        let chartRowIndex = {{ count($chartLabels) }};
        let marketRowIndex = {{ count($markets) }};
        let dailyRowIndex = {{ count($dailyPerf) }};

        // Add Chart Row
        document.getElementById('addChartRow').addEventListener('click', function() {
            const tbody = document.querySelector('table tbody');
            const addRow = this.closest('tr');
            const newRow = document.createElement('tr');
            newRow.className = 'chart-row';
            newRow.innerHTML = `
                <th></th>
                <td>
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <input type="text" name="chart_labels[]" class="form-control" placeholder="Chart Label (e.g., Monday)">
                        </div>
                        <div class="col-md-5 mb-2">
                            <input type="number" name="chart_data[]" class="form-control" step="0.01" placeholder="Chart Value (e.g., 0.7)">
                        </div>
                        <div class="col-md-1 mb-2">
                            <button type="button" class="btn btn-sm btn-danger remove-chart-row">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </td>
            `;
            tbody.insertBefore(newRow, addRow);
            attachRemoveChartListener(newRow);
        });

        // Remove Chart Row
        function attachRemoveChartListener(row) {
            const removeBtn = row.querySelector('.remove-chart-row');
            if (removeBtn) {
                removeBtn.addEventListener('click', function() {
                    row.remove();
                });
            }
        }
        document.querySelectorAll('.remove-chart-row').forEach(btn => {
            btn.addEventListener('click', function() {
                this.closest('tr').remove();
            });
        });

        // Add Market Row
        document.getElementById('addMarketRow').addEventListener('click', function() {
            const tbody = document.querySelector('table tbody');
            const addRow = this.closest('tr');
            const newRow = document.createElement('tr');
            newRow.className = 'market-row';
            newRow.innerHTML = `
                <th></th>
                <td>
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <input type="text" name="markets_traded[${marketRowIndex}][market]" class="form-control" placeholder="Market (e.g., XAUUSD)">
                        </div>
                        <div class="col-md-5 mb-2">
                            <input type="number" name="markets_traded[${marketRowIndex}][volume_percentage]" class="form-control" step="0.01" placeholder="Volume % (e.g., 55)">
                        </div>
                        <div class="col-md-1 mb-2">
                            <button type="button" class="btn btn-sm btn-danger remove-market-row">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </td>
            `;
            tbody.insertBefore(newRow, addRow);
            marketRowIndex++;
            attachRemoveMarketListener(newRow);
        });

        // Remove Market Row
        function attachRemoveMarketListener(row) {
            const removeBtn = row.querySelector('.remove-market-row');
            if (removeBtn) {
                removeBtn.addEventListener('click', function() {
                    row.remove();
                });
            }
        }
        document.querySelectorAll('.remove-market-row').forEach(btn => {
            btn.addEventListener('click', function() {
                this.closest('tr').remove();
            });
        });

        // Add Daily Performance Row
        document.getElementById('addDailyRow').addEventListener('click', function() {
            const tbody = document.querySelector('table tbody');
            const addRow = this.closest('tr');
            const newRow = document.createElement('tr');
            newRow.className = 'daily-row';
            newRow.innerHTML = `
                <th></th>
                <td>
                    <div class="row">
                        <div class="col-md-3 mb-2">
                            <input type="text" name="daily_performance[${dailyRowIndex}][day]" class="form-control" placeholder="Title (e.g., Monday)">
                        </div>
                        <div class="col-md-4 mb-2">
                            <input type="text" name="daily_performance[${dailyRowIndex}][change]" class="form-control" placeholder="Daily Change (e.g., +1.13%)">
                        </div>
                        <div class="col-md-4 mb-2">
                            <input type="text" name="daily_performance[${dailyRowIndex}][equity]" class="form-control" placeholder="Equity Balance (e.g., $101,130)">
                        </div>
                        <div class="col-md-1 mb-2">
                            <button type="button" class="btn btn-sm btn-danger remove-daily-row">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </td>
            `;
            tbody.insertBefore(newRow, addRow);
            dailyRowIndex++;
            attachRemoveDailyListener(newRow);
        });

        // Remove Daily Performance Row
        function attachRemoveDailyListener(row) {
            const removeBtn = row.querySelector('.remove-daily-row');
            if (removeBtn) {
                removeBtn.addEventListener('click', function() {
                    row.remove();
                });
            }
        }
        document.querySelectorAll('.remove-daily-row').forEach(btn => {
            btn.addEventListener('click', function() {
                this.closest('tr').remove();
            });
        });
    });
</script>
@endsection
