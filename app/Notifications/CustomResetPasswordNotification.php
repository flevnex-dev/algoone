<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Password;
use App\Services\EmailService;

class CustomResetPasswordNotification extends Notification
{
    use Queueable;

    /**
     * The password reset token.
     *
     * @var string
     */
    public $token;

    /**
     * Create a new notification instance.
     *
     * @param  string  $token
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        // Return empty array to prevent Laravel from sending default email
        // Email is sent directly in User model's sendPasswordResetNotification method
        return [];
    }

    /**
     * This method won't be called since via() returns empty array
     * Email is sent directly in User model
     *
     * @param  mixed  $notifiable
     * @return void
     */
    public function toMail($notifiable)
    {
        $setting = \App\Models\SiteSetting::first();
        $resetUrl = url(route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));

        $emailService = new EmailService();
        
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
                    <h2>Hello ' . htmlspecialchars($notifiable->name) . ',</h2>
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
        $result = $emailService->send($notifiable->getEmailForPasswordReset(), $subject, $body);
        
        if (!$result) {
            \Log::error('Failed to send password reset email to: ' . $notifiable->getEmailForPasswordReset());
        }
    }
}
