<?php

namespace App\Services;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Models\SiteSetting;

class EmailService
{
    protected $mailer;
    protected $settings;

    public function __construct()
    {
        $this->settings = SiteSetting::first();
        $this->mailer = new PHPMailer(true);
        $this->configureMailer();
    }

    protected function configureMailer()
    {
        if (!$this->settings) {
            \Log::warning('EmailService: No site settings found');
            return;
        }

        try {
            // Server settings
            $this->mailer->isSMTP();
            $this->mailer->Host = $this->settings->smtp_host ?? 'smtp.mail.ovh.net';
            $this->mailer->SMTPAuth = true;
            $this->mailer->Username = $this->settings->smtp_user ?? '';
            $this->mailer->Password = $this->settings->smtp_password ?? '';
            
            // Log password status (without showing actual password)
            \Log::info('EmailService: SMTP Auth - User: ' . $this->mailer->Username . ', Password set: ' . (!empty($this->mailer->Password) ? 'Yes' : 'No'));
            
            // Set SMTP security based on port and setting
            $port = $this->settings->smtp_port ?? 587;
            $security = strtolower($this->settings->smtp_security ?? 'ssl');
            
            // For port 587, use TLS; for 465, use SSL
            if ($port == 587) {
                $this->mailer->SMTPSecure = 'tls';
            } elseif ($port == 465) {
                $this->mailer->SMTPSecure = 'ssl';
            } else {
                // Use setting value
                if ($security === 'tls') {
                    $this->mailer->SMTPSecure = 'tls';
                } else {
                    $this->mailer->SMTPSecure = 'ssl';
                }
            }
            
            $this->mailer->Port = $port;
            $this->mailer->CharSet = 'UTF-8';
            
            // Additional settings for better compatibility
            $this->mailer->SMTPOptions = [
                'ssl' => [
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                ]
            ];

            // Sender info
            $this->mailer->setFrom(
                $this->settings->email_from_address ?? 'noreply@quantumfundedcapital.com',
                $this->settings->email_from_name ?? 'QuantumFunding'
            );
            
            \Log::info('EmailService: SMTP configured. Host: ' . $this->mailer->Host . ', Port: ' . $this->mailer->Port . ', User: ' . $this->mailer->Username);
        } catch (Exception $e) {
            \Log::error('Email configuration error: ' . $e->getMessage());
        }
    }

    /**
     * Send email
     *
     * @param string $to
     * @param string $subject
     * @param string $body
     * @param bool $isHTML
     * @return bool
     */
    public function send($to, $subject, $body, $isHTML = true)
    {
        try {
            if (!$this->settings) {
                \Log::error('EmailService: Site settings not found');
                return false;
            }

            if (!$this->settings->smtp_host || !$this->settings->smtp_user) {
                \Log::error('EmailService: SMTP settings not configured. Host: ' . ($this->settings->smtp_host ?? 'null') . ', User: ' . ($this->settings->smtp_user ?? 'null'));
                return false;
            }

            // Reconfigure mailer to ensure fresh settings
            $this->mailer = new PHPMailer(true);
            $this->configureMailer();

            $this->mailer->clearAddresses();
            $this->mailer->clearAttachments();
            
            $this->mailer->addAddress($to);
            $this->mailer->isHTML($isHTML);
            $this->mailer->Subject = $subject;
            $this->mailer->Body = $body;

            // Enable verbose error output for debugging
            $this->mailer->SMTPDebug = 0; // Set to 2 for verbose debugging
            $this->mailer->Debugoutput = function($str, $level) {
                \Log::info("PHPMailer Debug (Level $level): $str");
            };

            $result = $this->mailer->send();
            
            if ($result) {
                \Log::info("Email sent successfully to: $to");
                return true;
            } else {
                \Log::error('EmailService: Failed to send email. Error: ' . $this->mailer->ErrorInfo);
                return false;
            }
        } catch (Exception $e) {
            \Log::error('EmailService Exception: ' . $e->getMessage());
            \Log::error('PHPMailer Error Info: ' . ($this->mailer->ErrorInfo ?? 'No error info'));
            return false;
        }
    }

    /**
     * Send welcome email to new user
     *
     * @param \App\Models\User $user
     * @return bool
     */
    public function sendWelcomeEmail($user)
    {
        $subject = 'Welcome to ' . ($this->settings->site_title ?? 'AlgoOne');
        
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
                    <h1>Welcome to ' . htmlspecialchars($this->settings->site_title ?? 'AlgoOne') . '!</h1>
                </div>
                <div class="content">
                    <h2>Hello ' . htmlspecialchars($user->name) . ',</h2>
                    <p>Thank you for creating an account with us. We are excited to have you on board!</p>
                    <p>Your account has been successfully created with the following details:</p>
                    <ul>
                        <li><strong>Name:</strong> ' . htmlspecialchars($user->name) . '</li>
                        <li><strong>Email:</strong> ' . htmlspecialchars($user->email) . '</li>
                    </ul>
                    <p>You can now log in to your account and start your journey with us.</p>
                    <a href="' . route('frontend.sign-in') . '" style="color: white;" class="button">Sign In Now</a>
                    <p style="margin-top: 30px;">If you have any questions, feel free to contact our support team.</p>
                    <p>Best regards,<br>The ' . htmlspecialchars($this->settings->site_title ?? 'AlgoOne') . ' Team</p>
                </div>
                <div class="footer">
                    <p>&copy; ' . date('Y') . ' ' . htmlspecialchars($this->settings->site_title ?? 'AlgoOne') . '. All rights reserved.</p>
                </div>
            </div>
        </body>
        </html>
        ';

        return $this->send($user->email, $subject, $body);
    }
}
