<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Carbon\Carbon;

class TradingWeek extends Model
{
    protected $fillable = [
        'week_label',
        'start_date',
        'end_date',
        'total_gain',
        'account_size',
        'week_type',
        'display_order',
        'is_active',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'total_gain' => 'decimal:2',
        'account_size' => 'decimal:2',
        'is_active' => 'boolean',
        'display_order' => 'integer',
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        // Before saving, handle week_type changes
        static::saving(function ($week) {
            // If week_type is being changed to 'current'
            if ($week->isDirty('week_type') && $week->week_type === 'current') {
                // Find existing current week and change it to 'last'
                $existingCurrent = static::where('week_type', 'current')
                    ->where('id', '!=', $week->id ?? 0)
                    ->first();
                
                if ($existingCurrent) {
                    $existingCurrent->week_type = 'last';
                    $existingCurrent->week_label = null; // Will be auto-generated
                    $existingCurrent->saveQuietly(); // Use saveQuietly to avoid recursion
                }

                // Find existing last week and change it to 'normal'
                $existingLast = static::where('week_type', 'last')
                    ->where('id', '!=', $week->id ?? 0)
                    ->where('id', '!=', $existingCurrent->id ?? 0)
                    ->first();
                
                if ($existingLast) {
                    $existingLast->week_type = 'normal';
                    $existingLast->week_label = null; // Will be auto-generated
                    $existingLast->saveQuietly();
                }
            }

            // Auto-generate week_label if not set
            if (empty($week->week_label)) {
                $week->week_label = $week->generateWeekLabel();
            }
        });

        // After saving, update week_label for normal weeks
        static::saved(function ($week) {
            if ($week->week_type === 'normal' && empty($week->week_label)) {
                $week->week_label = $week->generateWeekLabel();
                $week->saveQuietly();
            }
        });
    }

    /**
     * Generate week label based on week_type
     */
    public function generateWeekLabel(): string
    {
        if ($this->week_type === 'current') {
            return 'This Week';
        } elseif ($this->week_type === 'last') {
            return 'Last Week';
        } else {
            // For normal weeks, generate "Week 1", "Week 2", etc. based on display_order or count
            // If model is not saved yet, use a temporary count
            if (!$this->exists) {
                $count = static::where('week_type', 'normal')
                    ->where('is_active', true)
                    ->count();
                return 'Week ' . ($count + 1);
            }
            
            // If model exists, find its position among normal weeks
            $normalWeeks = static::where('week_type', 'normal')
                ->where('is_active', true)
                ->orderBy('display_order')
                ->orderBy('start_date', 'desc')
                ->get();
            
            $index = $normalWeeks->search(function ($item) {
                return $item->id === $this->id;
            });
            
            // If found, return position + 1
            if ($index !== false) {
                return 'Week ' . ($index + 1);
            }
            
            // Fallback: count all normal weeks
            $count = static::where('week_type', 'normal')
                ->where('is_active', true)
                ->where('id', '!=', $this->id)
                ->count();
            
            return 'Week ' . ($count + 1);
        }
    }

    /**
     * Get the performance detail for this week
     */
    public function performanceDetail(): HasOne
    {
        return $this->hasOne(WeekPerformanceDetail::class, 'trading_week_id');
    }

    /**
     * Get week label attribute (auto-generated if not set)
     */
    public function getWeekLabelAttribute($value)
    {
        if (empty($value)) {
            return $this->generateWeekLabel();
        }
        return $value;
    }
}
