<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payout extends Model
{
    protected $fillable = [
        'user_id',
        'admin_id',
        'amount',
        'name',
        'country',
        'payout_date',
        'status',
        'is_public',
        'notes',
    ];

    protected $casts = [
        'payout_date' => 'date',
        'amount' => 'decimal:2',
        'is_public' => 'boolean',
    ];

    /**
     * Get the trader user that received the payout
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the admin user who processed the payout
     */
    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
