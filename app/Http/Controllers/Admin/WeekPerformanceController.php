<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TradingWeek;
use App\Models\WeekPerformanceDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Carbon\Carbon;

class WeekPerformanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $weeks = TradingWeek::orderBy('display_order')
            ->orderBy('start_date', 'desc')
            ->with('performanceDetail')
            ->get();
        
        return view('admin.pages.week-performance.index', compact('weeks'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $week = TradingWeek::with('performanceDetail')->findOrFail($id);
        return view('admin.pages.week-performance.edit', compact('week'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $week = TradingWeek::findOrFail($id);

        $validated = $request->validate([
            'trade_accuracy' => 'nullable|numeric|min:0|max:100',
            'risk_reward_ratio' => 'nullable|numeric|min:0',
            'largest_drawdown' => 'nullable|numeric',
            'chart_labels' => 'nullable|array',
            'chart_labels.*' => 'nullable|string',
            'chart_data' => 'nullable|array',
            'chart_data.*' => 'nullable|numeric',
            'daily_performance' => 'nullable|array',
            'daily_performance.*.day' => 'nullable|string',
            'daily_performance.*.change' => 'nullable|string',
            'daily_performance.*.equity' => 'nullable|string',
            'markets_traded' => 'nullable|array',
            'markets_traded.*.market' => 'nullable|string',
            'markets_traded.*.volume_percentage' => 'nullable|numeric',
        ]);

        try {
            DB::beginTransaction();

            $performanceData = [
                'trading_week_id' => $week->id,
                'total_gain' => $week->total_gain,
            ];

            if (isset($validated['trade_accuracy'])) {
                $performanceData['trade_accuracy'] = $validated['trade_accuracy'];
            }
            if (isset($validated['risk_reward_ratio'])) {
                $performanceData['risk_reward_ratio'] = $validated['risk_reward_ratio'];
            }
            if (isset($validated['largest_drawdown'])) {
                $performanceData['largest_drawdown'] = $validated['largest_drawdown'];
            }

            // Chart labels/data - filter out empty values
            if (!empty($validated['chart_labels'])) {
                $chartLabels = array_filter(array_map('trim', $validated['chart_labels']), function($val) {
                    return !empty($val);
                });
                if (!empty($chartLabels)) {
                    $performanceData['chart_labels'] = array_values($chartLabels);
                }
            }
            if (!empty($validated['chart_data'])) {
                $chartData = array_filter(array_map(function($val) {
                    return $val !== null && $val !== '' ? floatval($val) : null;
                }, $validated['chart_data']), function($val) {
                    return $val !== null;
                });
                if (!empty($chartData)) {
                    $performanceData['chart_data'] = array_values($chartData);
                }
            }

            // Daily performance - filter out empty rows
            if (!empty($validated['daily_performance'])) {
                $dailyPerf = array_filter($validated['daily_performance'], function($day) {
                    return !empty($day['day']) || !empty($day['change']) || !empty($day['equity']);
                });
                if (!empty($dailyPerf)) {
                    $performanceData['daily_performance'] = array_values($dailyPerf);
                }
            }

            // Markets traded - filter out empty rows
            if (!empty($validated['markets_traded'])) {
                $markets = array_filter($validated['markets_traded'], function($market) {
                    return !empty($market['market']) && !empty($market['volume_percentage']);
                });
                if (!empty($markets)) {
                    $performanceData['markets_traded'] = array_values($markets);
                }
            }

            // Update or create performance detail
            if ($week->performanceDetail) {
                $week->performanceDetail->update($performanceData);
            } else {
                WeekPerformanceDetail::create($performanceData);
            }

            DB::commit();

            return redirect()->route('admin.week-performance.index')
                ->with('success', 'Performance data updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Error updating performance data: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Import performance data from Excel/CSV
     */
    public function import(Request $request)
    {
        $request->validate([
            'excel_file' => [
                'required',
                'file',
                'max:10240',
                'mimetypes:text/plain,text/csv,text/comma-separated-values,application/csv,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            ],
        ]);

        $file = $request->file('excel_file');
        $extension = strtolower($file->getClientOriginalExtension());

        $errors = [];
        $successCount = 0;

        try {
            DB::beginTransaction();

            if ($extension === 'csv') {
                list($successCount, $errors) = $this->importCsv($file);
            } else {
                list($successCount, $errors) = $this->importExcel($file);
            }

            DB::commit();

            $message = "Successfully imported {$successCount} performance record(s).";
            if (!empty($errors)) {
                $message .= " Errors: " . implode('; ', array_slice($errors, 0, 5));
                if (count($errors) > 5) {
                    $message .= " and " . (count($errors) - 5) . " more.";
                }
            }

            return redirect()->route('admin.week-performance.index')
                ->with($successCount > 0 ? 'success' : 'error', $message);
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Week Performance Import Error: ' . $e->getMessage(), [
                'file' => $file->getClientOriginalName(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->route('admin.week-performance.index')
                ->with('error', 'Error importing file: ' . $e->getMessage() . ' (Line: ' . $e->getLine() . ')');
        }
    }

    /**
     * Import CSV file
     */
    private function importCsv($file)
    {
        $handle = fopen($file->getRealPath(), 'r');
        if (!$handle) {
            throw new \Exception('Unable to read CSV file.');
        }

        $errors = [];
        $successCount = 0;
        $rowNumber = 1;

        // Skip header
        fgetcsv($handle);
        $rowNumber++;

        while (($row = fgetcsv($handle)) !== false) {
            // Skip completely empty rows
            if (empty(array_filter($row))) {
                $rowNumber++;
                continue;
            }
            
            if (count($row) < 5) {
                $errors[] = "Row {$rowNumber}: Insufficient columns (need at least 5)";
                $rowNumber++;
                continue;
            }

            // Skip if Trading Week ID is empty
            if (empty(trim($row[0] ?? ''))) {
                $errors[] = "Row {$rowNumber}: Trading Week ID is empty. Skipping row.";
                $rowNumber++;
                continue;
            }

            try {
                $this->createPerformanceFromRow($row);
                $successCount++;
            } catch (\Exception $e) {
                $errors[] = "Row {$rowNumber}: " . $e->getMessage();
            }
            $rowNumber++;
        }

        fclose($handle);

        return [$successCount, $errors];
    }

    /**
     * Import Excel file
     */
    private function importExcel($file)
    {
        $spreadsheet = IOFactory::load($file->getRealPath());
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray(null, true, true, true);

        $errors = [];
        $successCount = 0;
        $rowNumber = 1;

        // Remove header
        array_shift($rows);
        $rowNumber++;

        foreach ($rows as $row) {
            $rowValues = array_values($row);
            
            // Skip completely empty rows
            if (empty(array_filter($rowValues))) {
                $rowNumber++;
                continue;
            }
            
            if (count($rowValues) < 5) {
                $errors[] = "Row {$rowNumber}: Insufficient columns (need at least 5)";
                $rowNumber++;
                continue;
            }

            // Skip if Trading Week ID is empty
            if (empty(trim($rowValues[0] ?? ''))) {
                $errors[] = "Row {$rowNumber}: Trading Week ID is empty. Skipping row.";
                $rowNumber++;
                continue;
            }

            try {
                $this->createPerformanceFromRow($rowValues);
                $successCount++;
            } catch (\Exception $e) {
                $errors[] = "Row {$rowNumber}: " . $e->getMessage();
            }
            $rowNumber++;
        }

        return [$successCount, $errors];
    }

    /**
     * Create performance from array row
     */
    private function createPerformanceFromRow(array $row)
    {
        $row = array_pad($row, 33, null);

        // Get and validate Trading Week ID
        $weekIdValue = trim($row[0] ?? '');
        
        if (empty($weekIdValue)) {
            throw new \Exception("Trading Week ID is empty or missing. Please provide a valid Trading Week ID from the Trading Weeks table.");
        }
        
        $weekId = intval($weekIdValue);
        
        if ($weekId <= 0) {
            throw new \Exception("Invalid Trading Week ID: '{$weekIdValue}'. ID must be a positive number. Available IDs: " . $this->getAvailableWeekIds());
        }
        
        $week = TradingWeek::find($weekId);
        
        if (!$week) {
            throw new \Exception("Trading Week ID {$weekId} not found in database. Available IDs: " . $this->getAvailableWeekIds());
        }

        $performanceData = [
            'trading_week_id' => $week->id,
            'total_gain' => $week->total_gain,
            'trade_accuracy' => $this->cleanNumber($row[1] ?? null),
            'risk_reward_ratio' => $this->cleanNumber($row[2] ?? null),
            'largest_drawdown' => $this->cleanNumber($row[3] ?? null),
        ];

        // Chart labels/data
        if (!empty($row[4])) {
            $performanceData['chart_labels'] = $this->parseCommaSeparated($row[4]);
        }
        if (!empty($row[5])) {
            $performanceData['chart_data'] = $this->parseCommaSeparatedNumbers($row[5]);
        }

        // Daily performance from separate columns
        $dailyPerformance = [];
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
        $dayIndex = 6;
        
        foreach ($days as $day) {
            $dayName = trim($row[$dayIndex] ?? $day);
            $change = trim($row[$dayIndex + 1] ?? '');
            $equity = trim($row[$dayIndex + 2] ?? '');
            
            if (!empty($change) || !empty($equity)) {
                $dailyPerformance[] = [
                    'day' => $dayName,
                    'change' => $change,
                    'equity' => $equity,
                ];
            }
            $dayIndex += 3;
        }
        
        if (!empty($dailyPerformance)) {
            $performanceData['daily_performance'] = $dailyPerformance;
        }

        // Markets traded from separate columns
        $marketsTraded = [];
        $marketIndex = 21;
        
        for ($i = 1; $i <= 3; $i++) {
            $market = trim($row[$marketIndex] ?? '');
            $volume = isset($row[$marketIndex + 1]) ? $this->cleanNumber($row[$marketIndex + 1]) : 0;
            
            if (!empty($market) && $volume > 0) {
                $marketsTraded[] = [
                    'market' => $market,
                    'volume_percentage' => $volume,
                ];
            }
            $marketIndex += 2;
        }
        
        if (!empty($marketsTraded)) {
            $performanceData['markets_traded'] = $marketsTraded;
        }

        // Update or create
        if ($week->performanceDetail) {
            $week->performanceDetail->update($performanceData);
        } else {
            WeekPerformanceDetail::create($performanceData);
        }
    }

    /**
     * Clean number from formatting characters
     */
    private function cleanNumber($value)
    {
        if ($value === null || $value === '') {
            return null;
        }
        $cleaned = str_replace([',', '%', '$', ' '], '', (string)$value);
        return $cleaned !== '' ? floatval($cleaned) : null;
    }

    /**
     * Parse comma-separated string into array
     */
    private function parseCommaSeparated($string)
    {
        if (empty($string)) {
            return [];
        }
        return array_map('trim', explode(',', $string));
    }

    /**
     * Parse comma-separated numbers into array
     */
    private function parseCommaSeparatedNumbers($string)
    {
        if (empty($string)) {
            return [];
        }
        return array_map(function($val) {
            return floatval(trim($val));
        }, explode(',', $string));
    }

    /**
     * Get available Trading Week IDs for error messages
     */
    private function getAvailableWeekIds()
    {
        $weeks = TradingWeek::where('is_active', true)
            ->orderBy('id')
            ->get(['id', 'week_label', 'start_date', 'end_date']);
        
        if ($weeks->isEmpty()) {
            return "No active trading weeks found. Please create a trading week first.";
        }
        
        $ids = $weeks->map(function($week) {
            return "ID {$week->id} ({$week->week_label} - {$week->start_date->format('M d')} to {$week->end_date->format('M d, Y')})";
        })->implode(', ');
        
        return $ids;
    }
}
