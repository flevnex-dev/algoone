<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ResultsSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResultsSectionController extends Controller
{
    public function index()
    {
        $results = ResultsSection::first() ?? new ResultsSection();
        return view('admin.pages.results.index', compact('results'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'badge_text' => 'nullable|string',
            'title' => 'nullable|string',
            'subtitle' => 'nullable|string',
            'disclaimer' => 'nullable|string',
            
            'accounts' => 'nullable|array',
            'accounts.*.name' => 'nullable|string',
            'accounts.*.subtext' => 'nullable|string',
            'accounts.*.chart_labels' => 'nullable', // string or array
            'accounts.*.chart_data' => 'nullable', // string or array
            'accounts.*.total_gain' => 'nullable|string',
            'accounts.*.balance' => 'nullable|string',
            'accounts.*.daily' => 'nullable|string',
            'accounts.*.monthly' => 'nullable|string',
            'accounts.*.drawdown' => 'nullable|string',
            'accounts.*.profit' => 'nullable|string',
            'accounts.*.deposits' => 'nullable|string',
            'accounts.*.platform' => 'nullable|string',

            'summary_title' => 'nullable|string',
            'summary_description' => 'nullable|string',
            'view_results_text' => 'nullable|string',
            'view_results_link' => 'nullable|string',

            'myfxbook_text' => 'nullable|string',
            'myfxbook_link' => 'nullable|string',
            'payout_text' => 'nullable|string',
            'payout_link' => 'nullable|string',

            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');
        
        // Process accounts data
        if (isset($validated['accounts']) && is_array($validated['accounts'])) {
            $processedAccounts = [];
            foreach ($validated['accounts'] as $acc) {
                // Parse chart labels
                $chartLabels = null;
                if (!empty($acc['chart_labels'])) {
                    if (is_array($acc['chart_labels'])) {
                        $labels = $acc['chart_labels'];
                    } else {
                        $labels = array_map('trim', explode(',', $acc['chart_labels']));
                    }
                    $chartLabels = array_values(array_filter($labels)); // Remove empty values
                }
                
                // Parse chart data
                $chartData = null;
                if (!empty($acc['chart_data'])) {
                    if (is_array($acc['chart_data'])) {
                        $data = $acc['chart_data'];
                    } else {
                         $data = array_map(function($val) {
                            return floatval(trim($val));
                        }, explode(',', $acc['chart_data']));
                    }
                    $chartData = array_values(array_filter($data, function($val) {
                        return $val !== null && $val !== false;
                    }));
                }

                // Recalculate auto-calculated fields if chart data exists AND manual input is empty
                if ($chartData) {
                    if (!isset($acc['total_gain']) || $acc['total_gain'] === '') {
                        $acc['total_gain'] = $this->calculateTotalGain($chartData);
                    }
                    if (!isset($acc['monthly']) || $acc['monthly'] === '') {
                        $acc['monthly'] = $this->calculateMonthly($chartData, $chartLabels);
                    }
                    if (!isset($acc['drawdown']) || $acc['drawdown'] === '') {
                        $acc['drawdown'] = $this->calculateDrawdown($chartData);
                    }
                    if (!isset($acc['balance']) || $acc['balance'] === '') {
                        $acc['balance'] = $this->calculateBalance($chartData);
                    }
                }

                $acc['chart_labels'] = $chartLabels;
                $acc['chart_data'] = $chartData;
                $processedAccounts[] = $acc;
            }
            $validated['accounts'] = $processedAccounts; // Save as sequential array
        } else {
            $validated['accounts'] = [];
        }

        $results = ResultsSection::first();
        if ($results) {
            $results->update($validated);
        } else {
            ResultsSection::create($validated);
        }

        return redirect()->route('admin.results.index')->with('success', 'Results section updated successfully');
    }

    public function import(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|mimes:xlsx,xls,csv|max:10240',
        ]);

        $file = $request->file('excel_file');
        $extension = strtolower($file->getClientOriginalExtension());

        try {
            if ($extension === 'csv') {
                $this->importCsv($file);
            } else {
                $this->importExcel($file);
            }

            return redirect()->route('admin.results.index')
                ->with('success', 'Accounts imported successfully!');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Import Error: ' . $e->getMessage());
            return redirect()->route('admin.results.index')
                ->with('error', 'Error importing file: ' . $e->getMessage());
        }
    }

    public function deleteAccount($index)
    {
        try {
            $results = ResultsSection::first();
            if (!$results || empty($results->accounts)) {
                return response()->json(['message' => 'No accounts found'], 404);
            }

            $accounts = $results->accounts;
            
            // Validate index
            if (!isset($accounts[$index])) {
                return response()->json(['message' => 'Account not found'], 404);
            }

            // Remove account and re-index
            unset($accounts[$index]);
            $results->accounts = array_values($accounts);
            $results->save();

            return response()->json(['message' => 'Account deleted successfully']);

        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Delete Account Error: ' . $e->getMessage());
            return response()->json(['message' => 'Error deleting account: ' . $e->getMessage()], 500);
        }
    }

    public function downloadTemplate()
    {
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="results_accounts_template.csv"',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        $columns = [
            'Account Name', 'Subtext', 'Risk Label', 'Chart Labels (comma-separated)', 
            'Chart Data (comma-separated)', 'Daily %', 'Drawdown %', 'Profit', 'Deposits', 'Platform'
        ];

        $callback = function() use ($columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            
            // Example row
            fputcsv($file, [
                'Account #1', 'Verified', 'Low Risk', 
                "Jul '23, Sep '23, Nov '23, Jan '24, Apr '24", 
                "0, 45, 85, 125, 154.63",
                '0.45', '5.2', '12450', '50000', 'MT4'
            ]);
            
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    private function importCsv($file)
    {
        $handle = fopen($file->getPathname(), 'r');
        if ($handle === false) {
            throw new \Exception('Could not open CSV file');
        }
        
        $header = fgetcsv($handle); // Skip header row
        
        DB::beginTransaction();
        try {
            $results = ResultsSection::first() ?? new ResultsSection();
            $accounts = [];
            
            while (($row = fgetcsv($handle)) !== false) {
                if (count($row) >= 5 && !empty(trim($row[0] ?? ''))) {
                    $accounts[] = $this->processRow($row);
                }
            }
            fclose($handle);
            
            // Save accounts array to JSON column
            $results->accounts = $accounts;
            $results->save();
            DB::commit();
        } catch (\Exception $e) {
            if (DB::transactionLevel() > 0) {
                DB::rollBack();
            }
            if (is_resource($handle)) {
                fclose($handle);
            }
            throw $e;
        }
    }

    private function importExcel($file)
    {
        if (!class_exists(\PhpOffice\PhpSpreadsheet\IOFactory::class)) {
            throw new \Exception('PhpSpreadsheet library is not installed. Please use CSV format or install the library.');
        }

        try {
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file->getPathname());
            $worksheet = $spreadsheet->getActiveSheet();
            $rows = $worksheet->toArray();
            
            DB::beginTransaction();
            try {
                $results = ResultsSection::first() ?? new ResultsSection();
                $accounts = [];

                // Skip header row
                array_shift($rows);
                
                foreach ($rows as $row) {
                    // Normalize row data
                    $row = array_map(function($cell) {
                         return is_null($cell) ? '' : trim((string)$cell);
                    }, $row);

                    if (count($row) >= 5 && !empty($row[0])) {
                        $accounts[] = $this->processRow($row);
                    }
                }
                
                $results->accounts = $accounts;
                $results->save();
                DB::commit();
            } catch (\Exception $e) {
                if (DB::transactionLevel() > 0) {
                    DB::rollBack();
                }
                throw $e;
            }
        } catch (\Exception $e) {
            throw new \Exception('Error reading Excel file: ' . $e->getMessage());
        }
    }

    private function processRow($row)
    {
        // Parse chart labels and data
        $chartLabels = !empty(trim($row[3] ?? '')) 
            ? array_map('trim', explode(',', trim($row[3]))) 
            : null;
        
        $chartData = !empty(trim($row[4] ?? '')) 
            ? array_map(function($val) {
                return floatval(trim($val));
            }, explode(',', trim($row[4]))) 
            : null;
        
        // Calculate values from chart data
        $totalGain = $this->calculateTotalGain($chartData);
        $monthly = $this->calculateMonthly($chartData, $chartLabels);
        $balance = $this->calculateBalance($chartData);
        
        // Drawdown: Use from Excel if provided (column 6), otherwise calculate
        $drawdown = null;
        if (isset($row[6]) && !empty(trim($row[6]))) {
            $drawdown = trim($row[6]);
        } else {
            $drawdown = $this->calculateDrawdown($chartData);
        }

        // Construct account object
        return [
            'name' => trim($row[0] ?? ''),
            'subtext' => trim($row[1] ?? 'Verified'),
            'total_gain' => $totalGain,
            'balance' => $balance,
            'monthly' => $monthly,
            'drawdown' => $drawdown,
            'daily' => trim($row[5] ?? ''),
            'profit' => trim($row[7] ?? ''),
            'deposits' => trim($row[8] ?? ''),
            'platform' => trim($row[9] ?? ''),
            'chart_labels' => $chartLabels,
            'chart_data' => $chartData,
        ];
    }

    private function calculateTotalGain($chartData)
    {
        if (empty($chartData) || !is_array($chartData)) {
            return '0%';
        }
        $lastValue = end($chartData);
        $sign = $lastValue >= 0 ? '+' : '';
        return $sign . number_format($lastValue, 2) . '%';
    }

    private function calculateMonthly($chartData, $chartLabels)
    {
        if (empty($chartData) || !is_array($chartData) || count($chartData) < 2) {
            return '0%';
        }
        
        $totalGain = end($chartData);
        if ($totalGain == 0) {
            return '0%';
        }
        
        $numberOfMonths = 12;
        $totalGainDecimal = $totalGain / 100;
        
        if ($totalGainDecimal < -1) {
            return '0%';
        }
        
        $monthlyRate = pow(1 + $totalGainDecimal, 1 / $numberOfMonths) - 1;
        $monthlyPercentage = $monthlyRate * 100;
        
        return number_format($monthlyPercentage, 2) . '%';
    }

    private function calculateDrawdown($chartData)
    {
        if (empty($chartData) || !is_array($chartData) || count($chartData) < 2) {
            return '0%';
        }
        
        $peakGain = $chartData[0]; // Start with first value as peak
        $maxDrawdown = 0;
        $hasDecline = false;
        
        foreach ($chartData as $index => $currentGain) {
            // Update peak if current gain is higher than previous peak
            if ($currentGain > $peakGain) {
                $peakGain = $currentGain;
            }
            
            // Calculate drawdown from current peak (Growth Drawdown method)
            // Only calculate if peak is greater than 0 (to avoid division by zero)
            if ($peakGain > 0) {
                $drawdown = (($peakGain - $currentGain) / $peakGain) * 100;
                // Only consider positive drawdown (decline from peak)
                if ($drawdown > $maxDrawdown) {
                    $maxDrawdown = $drawdown;
                }
                // Check if there's any decline from peak
                if ($currentGain < $peakGain) {
                    $hasDecline = true;
                }
            }
        }
        
        // If no decline found in data points, estimate drawdown dynamically based on growth pattern
        // This handles cases where chart data points don't show intermediate dips
        if ($maxDrawdown == 0 && count($chartData) > 2) {
            $finalGain = end($chartData);
            
            if ($finalGain > 0) {
                // Calculate growth rates between consecutive points
                $growthRates = [];
                $previousGain = $chartData[0];
                
                for ($i = 1; $i < count($chartData); $i++) {
                    $currentGain = $chartData[$i];
                    if ($previousGain > 0) {
                        $growthRate = (($currentGain - $previousGain) / $previousGain) * 100;
                        $growthRates[] = $growthRate;
                    }
                    $previousGain = $currentGain;
                }
                
                if (!empty($growthRates)) {
                    // Calculate average growth rate
                    $avgGrowthRate = array_sum($growthRates) / count($growthRates);
                    
                    // Calculate volatility (standard deviation of growth rates)
                    $variance = 0;
                    foreach ($growthRates as $rate) {
                        $variance += pow($rate - $avgGrowthRate, 2);
                    }
                    $volatility = sqrt($variance / count($growthRates));
                    
                    // Estimate drawdown based on volatility and total gain
                    $baseDrawdown = 2.0;
                    $volatilityFactor = min($volatility * 0.1, 2.0); // Cap volatility factor at 2%
                    $gainFactor = min(($finalGain / 100) * 0.01, 1.5); // Cap gain factor at 1.5%
                    
                    $estimatedDrawdown = $baseDrawdown + $volatilityFactor + $gainFactor;
                    $estimatedDrawdown = min($estimatedDrawdown, 6.0); // Cap at 6%
                    $estimatedDrawdown = max($estimatedDrawdown, 1.0); // Minimum 1%
                    
                    $maxDrawdown = $estimatedDrawdown;
                } else {
                    // Fallback: estimate based on total gain only
                    $estimatedDrawdown = 2.5 + min(($finalGain / 100) * 0.01, 2.5);
                    $maxDrawdown = min($estimatedDrawdown, 5.0);
                }
            }
        }
        
        return number_format($maxDrawdown, 2) . '%';
    }

    private function calculateBalance($chartData)
    {
        if (empty($chartData) || !is_array($chartData)) {
            return '$0.00';
        }
        
        $initialBalance = 100000;
        $totalGain = end($chartData);
        $balance = $initialBalance * (1 + ($totalGain / 100));
        
        return '$' . number_format($balance, 2);
    }
}
