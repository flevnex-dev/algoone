<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WeekPerformanceDetail extends Model
{
    protected $fillable = [
        'trading_week_id',
        'total_gain',
        'trade_accuracy',
        'risk_reward_ratio',
        'largest_drawdown',
        'chart_labels',
        'chart_data',
        'daily_performance',
        'markets_traded',
    ];

    protected $casts = [
        'total_gain' => 'decimal:2',
        'trade_accuracy' => 'decimal:2',
        'risk_reward_ratio' => 'decimal:2',
        'largest_drawdown' => 'decimal:2',
        'chart_labels' => 'array',
        'chart_data' => 'array',
        'daily_performance' => 'array',
        'markets_traded' => 'array',
    ];

    /**
     * Get the trading week that owns this performance detail
     */
    public function tradingWeek(): BelongsTo
    {
        return $this->belongsTo(TradingWeek::class, 'trading_week_id');
    }
}
