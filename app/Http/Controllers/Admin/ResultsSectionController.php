<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ResultsSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;

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
            
            'acc1_name' => 'nullable|string',
            'acc1_subtext' => 'nullable|string',
            'acc1_chart_labels' => 'nullable|string',
            'acc1_chart_data' => 'nullable|string',
            'acc1_total_gain' => 'nullable|string',
            'acc1_balance' => 'nullable|string',
            'acc1_daily' => 'nullable|string',
            'acc1_monthly' => 'nullable|string',
            'acc1_drawdown' => 'nullable|string',
            'acc1_profit' => 'nullable|string',
            'acc1_deposits' => 'nullable|string',
            'acc1_platform' => 'nullable|string',

            'acc2_name' => 'nullable|string',
            'acc2_subtext' => 'nullable|string',
            'acc2_chart_labels' => 'nullable|string',
            'acc2_chart_data' => 'nullable|string',
            'acc2_total_gain' => 'nullable|string',
            'acc2_balance' => 'nullable|string',
            'acc2_daily' => 'nullable|string',
            'acc2_monthly' => 'nullable|string',
            'acc2_drawdown' => 'nullable|string',
            'acc2_profit' => 'nullable|string',
            'acc2_deposits' => 'nullable|string',
            'acc2_platform' => 'nullable|string',

            'acc3_name' => 'nullable|string',
            'acc3_subtext' => 'nullable|string',
            'acc3_chart_labels' => 'nullable|string',
            'acc3_chart_data' => 'nullable|string',
            'acc3_total_gain' => 'nullable|string',
            'acc3_balance' => 'nullable|string',
            'acc3_daily' => 'nullable|string',
            'acc3_monthly' => 'nullable|string',
            'acc3_drawdown' => 'nullable|string',
            'acc3_profit' => 'nullable|string',
            'acc3_deposits' => 'nullable|string',
            'acc3_platform' => 'nullable|string',

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

        // Parse chart labels and data from comma-separated strings to arrays
        for ($i = 1; $i <= 3; $i++) {
            // Parse chart labels
            if (!empty($validated["acc{$i}_chart_labels"])) {
                $labels = array_map('trim', explode(',', $validated["acc{$i}_chart_labels"]));
                $validated["acc{$i}_chart_labels"] = array_filter($labels); // Remove empty values
            } else {
                $validated["acc{$i}_chart_labels"] = null;
            }
            
            // Parse chart data
            if (!empty($validated["acc{$i}_chart_data"])) {
                $data = array_map(function($val) {
                    return floatval(trim($val));
                }, explode(',', $validated["acc{$i}_chart_data"]));
                $validated["acc{$i}_chart_data"] = array_filter($data, function($val) {
                    return $val !== null && $val !== false;
                }); // Remove empty/invalid values
                
                // Recalculate auto-calculated fields if chart data exists
                if (!empty($validated["acc{$i}_chart_data"])) {
                    $chartData = array_values($validated["acc{$i}_chart_data"]);
                    $chartLabels = $validated["acc{$i}_chart_labels"] ?? [];
                    
                    $validated["acc{$i}_total_gain"] = $this->calculateTotalGain($chartData);
                    $validated["acc{$i}_monthly"] = $this->calculateMonthly($chartData, $chartLabels);
                    $validated["acc{$i}_drawdown"] = $this->calculateDrawdown($chartData);
                    $validated["acc{$i}_balance"] = $this->calculateBalance($chartData);
                }
            } else {
                $validated["acc{$i}_chart_data"] = null;
            }
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
        $extension = $file->getClientOriginalExtension();

        try {
            if ($extension === 'csv') {
                $this->importCsv($file);
            } else {
                $this->importExcel($file);
            }

            return redirect()->route('admin.results.index')
                ->with('success', 'Accounts imported successfully!');
        } catch (\Exception $e) {
            return redirect()->route('admin.results.index')
                ->with('error', 'Error importing file: ' . $e->getMessage());
        }
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
            
            $rowCount = 0;
            while (($row = fgetcsv($handle)) !== false && $rowCount < 3) {
                if (count($row) >= 5 && !empty(trim($row[0] ?? ''))) {
                    $accounts[] = $row;
                    $rowCount++;
                }
            }
            fclose($handle);
            
            // Process accounts (max 3)
            for ($i = 0; $i < min(3, count($accounts)); $i++) {
                $row = $accounts[$i];
                $accNum = $i + 1;
                
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
                
                // Update account data
                // Column order: Account Name, Subtext, Risk Label, Chart Labels, Chart Data, Daily %, Drawdown, Profit, Deposits, Platform
                $results->{"acc{$accNum}_name"} = trim($row[0] ?? '');
                $results->{"acc{$accNum}_subtext"} = trim($row[1] ?? 'Verified');
                // Risk Label is column 2 but we don't store it separately, it's just for reference
                $results->{"acc{$accNum}_total_gain"} = $totalGain;
                $results->{"acc{$accNum}_balance"} = $balance;
                $results->{"acc{$accNum}_monthly"} = $monthly;
                $results->{"acc{$accNum}_drawdown"} = $drawdown;
                $results->{"acc{$accNum}_chart_labels"} = $chartLabels;
                $results->{"acc{$accNum}_chart_data"} = $chartData;
                
                // Optional fields (columns 5, 7-9)
                if (isset($row[5]) && !empty(trim($row[5]))) {
                    $results->{"acc{$accNum}_daily"} = trim($row[5]);
                }
                if (isset($row[7]) && !empty(trim($row[7]))) {
                    $results->{"acc{$accNum}_profit"} = trim($row[7]);
                }
                if (isset($row[8]) && !empty(trim($row[8]))) {
                    $results->{"acc{$accNum}_deposits"} = trim($row[8]);
                }
                if (isset($row[9]) && !empty(trim($row[9]))) {
                    $results->{"acc{$accNum}_platform"} = trim($row[9]);
                }
            }
            
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
        try {
            $spreadsheet = IOFactory::load($file->getPathname());
            $worksheet = $spreadsheet->getActiveSheet();
            $rows = $worksheet->toArray();
            
            DB::beginTransaction();
            try {
                $results = ResultsSection::first() ?? new ResultsSection();
                
                // Skip header row
                array_shift($rows);
                
                // Process accounts (max 3)
                $rowCount = 0;
                foreach ($rows as $row) {
                    if ($rowCount >= 3) {
                        break; // Stop after 3 accounts
                    }
                    
                    $row = array_map(function($cell) {
                        return is_null($cell) ? '' : trim((string)$cell);
                    }, $row);
                    
                    if (count($row) >= 5 && !empty($row[0])) {
                        $accNum = $rowCount + 1;
                        
                        // Parse chart labels and data
                        $chartLabels = !empty($row[3] ?? '') 
                            ? array_map('trim', explode(',', $row[3])) 
                            : null;
                        
                        $chartData = !empty($row[4] ?? '') 
                            ? array_map(function($val) {
                                return floatval(trim($val));
                            }, explode(',', $row[4])) 
                            : null;
                        
                        // Calculate values
                        $totalGain = $this->calculateTotalGain($chartData);
                        $monthly = $this->calculateMonthly($chartData, $chartLabels);
                        $balance = $this->calculateBalance($chartData);
                        
                        // Drawdown: Use from Excel if provided (column 6), otherwise calculate
                        $drawdown = null;
                        if (isset($row[6]) && !empty($row[6])) {
                            $drawdown = trim($row[6]);
                        } else {
                            $drawdown = $this->calculateDrawdown($chartData);
                        }
                        
                        // Update account data
                        // Column order: Account Name, Subtext, Risk Label, Chart Labels, Chart Data, Daily %, Drawdown, Profit, Deposits, Platform
                        $results->{"acc{$accNum}_name"} = $row[0] ?? '';
                        $results->{"acc{$accNum}_subtext"} = $row[1] ?? 'Verified';
                        // Risk Label is column 2 but we don't store it separately
                        $results->{"acc{$accNum}_total_gain"} = $totalGain;
                        $results->{"acc{$accNum}_balance"} = $balance;
                        $results->{"acc{$accNum}_monthly"} = $monthly;
                        $results->{"acc{$accNum}_drawdown"} = $drawdown;
                        $results->{"acc{$accNum}_chart_labels"} = $chartLabels;
                        $results->{"acc{$accNum}_chart_data"} = $chartData;
                        
                        // Optional fields (columns 5, 7-9)
                        if (isset($row[5]) && !empty($row[5])) {
                            $results->{"acc{$accNum}_daily"} = $row[5];
                        }
                        if (isset($row[7]) && !empty($row[7])) {
                            $results->{"acc{$accNum}_profit"} = $row[7];
                        }
                        if (isset($row[8]) && !empty($row[8])) {
                            $results->{"acc{$accNum}_deposits"} = $row[8];
                        }
                        if (isset($row[9]) && !empty($row[9])) {
                            $results->{"acc{$accNum}_platform"} = $row[9];
                        }
                        
                        $rowCount++;
                    }
                }
                
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
