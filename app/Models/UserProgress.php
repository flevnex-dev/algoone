<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserProgress extends Model
{
    protected $fillable = [
        'user_id',
        'progress_percentage',
        'phase1_completed',
        'phase2_completed',
        'live_phase_completed',
        'live_phase_in_progress',
    ];

    protected $casts = [
        'phase1_completed' => 'boolean',
        'phase2_completed' => 'boolean',
        'live_phase_completed' => 'boolean',
        'live_phase_in_progress' => 'boolean',
    ];

    /**
     * Get the user that owns the progress
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
