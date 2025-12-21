<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = [
        'site_title',
        'logo',
        'favicon',
        'copyright_text',
        'legal_disclaimer',
        'email_from_address',
        'email_from_name',
        'smtp_host',
        'smtp_user',
        'smtp_password',
        'smtp_port',
        'smtp_security',
        'remember_me_enabled',
        'remember_me_text',
        'remember_me_duration_days',
    ];

    protected $casts = [
        'remember_me_enabled' => 'boolean',
        'remember_me_duration_days' => 'integer',
    ];
}
