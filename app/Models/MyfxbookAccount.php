<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MyfxbookAccount extends Model
{
    protected $fillable = [
        'account_number',
        'account_name',
        'risk_label',
        'description',
        'total_gain',
        'monthly',
        'drawdown',
        'balance',
        'myfxbook_link',
        'chart_labels',
        'chart_data',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'chart_labels' => 'array',
        'chart_data' => 'array',
    ];
}
