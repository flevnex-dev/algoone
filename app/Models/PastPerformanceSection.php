<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PastPerformanceSection extends Model
{
    protected $fillable = [
        'transparency_title',
        'transparency_text',
        'view_reports_text',
        'view_reports_link',
        'overview_title',
        'overview_text',
        'outlook_title',
        'outlook_text',
        'next_update_label',
        'next_update_text',
        'notice_label',
        'notice_text',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
