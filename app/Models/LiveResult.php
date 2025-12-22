<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LiveResult extends Model
{
    protected $fillable = [
        'user_id',
        'message',
        'amount',
        'status',
        'is_featured',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'is_featured' => 'boolean',
    ];

    /**
     * Get the user that posted this result
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
