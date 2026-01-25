<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'status',
        'referral_code',
        'country',
        'phone',
        'address',
        'city',
        'state',
        'zip',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Generate a unique referral code for the user
     */
    public function generateReferralCode(): string
    {
        if ($this->referral_code) {
            return $this->referral_code;
        }

        do {
            $code = strtoupper(substr(md5($this->id . $this->email . time()), 0, 8));
        } while (self::where('referral_code', $code)->exists());

        $this->referral_code = $code;
        $this->save();

        return $code;
    }

    /**
     * Get the user's referral stats
     */
    public function referralStat()
    {
        return $this->hasOne(ReferralStat::class);
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        // Send email directly using EmailService
        $setting = \App\Models\SiteSetting::first();
        $resetUrl = url(route('password.reset', [
            'token' => $token,
            'email' => $this->getEmailForPasswordReset(),
        ], false));

        $emailService = new \App\Services\EmailService();
        
        $subject = 'Reset Password - ' . ($setting->site_title ?? 'AlgoOne');
        
        $body = '
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
                .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                .header { background: linear-gradient(135deg, #0B64F4 0%, #2563EB 100%); color: white; padding: 30px; text-align: center; }
                .content { padding: 30px; background: #f9f9f9; }
                .button { display: inline-block; padding: 12px 30px; background: #0B64F4; color: white; text-decoration: none; border-radius: 5px; margin-top: 20px; }
                .footer { text-align: center; padding: 20px; color: #666; font-size: 12px; }
            </style>
        </head>
        <body>
            <div class="container">
                <div class="header">
                    <h1>Reset Your Password</h1>
                </div>
                <div class="content">
                    <h2>Hello ' . htmlspecialchars($this->name) . ',</h2>
                    <p>You are receiving this email because we received a password reset request for your account.</p>
                    <p>Click the button below to reset your password:</p>
                    <a href="' . $resetUrl . '" class="button" style="color: white;">Reset Password</a>
                    <p style="margin-top: 30px;">This password reset link will expire in 60 minutes.</p>
                    <p>If you did not request a password reset, no further action is required.</p>
                    <p style="margin-top: 30px;">Best regards,<br>The ' . htmlspecialchars($setting->site_title ?? 'AlgoOne') . ' Team</p>
                </div>
                <div class="footer">
                    <p>&copy; ' . date('Y') . ' ' . htmlspecialchars($setting->site_title ?? 'AlgoOne') . '. All rights reserved.</p>
                </div>
            </div>
        </body>
        </html>
        ';

        // Send email using EmailService
        $result = $emailService->send($this->getEmailForPasswordReset(), $subject, $body);
        
        if (!$result) {
            \Log::error('Failed to send password reset email to: ' . $this->getEmailForPasswordReset());
        }
    }
}
