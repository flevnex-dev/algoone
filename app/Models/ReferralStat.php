<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReferralStat extends Model
{
    protected $fillable = [
        'user_id',
        'total_clicks',
        'unique_visitors',
        'conversions',
        'conversion_rate',
        'referral_count',
    ];

    protected $casts = [
        'conversion_rate' => 'decimal:2',
    ];

    /**
     * Get the user that owns the referral stats
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
