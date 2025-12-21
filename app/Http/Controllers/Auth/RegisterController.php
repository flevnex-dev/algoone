<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    
    /**
     * Determine where to redirect users after registration
     */
    protected function redirectTo()
    {
        return '/home';
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'trader', // Default role for frontend registrations
            'status' => 'active',
        ]);
        
        // Track referral conversion if user came from referral link
        if (session()->has('referrer_id')) {
            $referrerId = session()->get('referrer_id');
            $referralStat = \App\Models\ReferralStat::where('user_id', $referrerId)->first();
            
            if ($referralStat) {
                // Increment conversions and referral count
                $referralStat->increment('conversions');
                $referralStat->increment('referral_count');
                
                // Calculate conversion rate
                if ($referralStat->unique_visitors > 0) {
                    $referralStat->conversion_rate = ($referralStat->conversions / $referralStat->unique_visitors) * 100;
                    $referralStat->save();
                }
            }
            
            // Clear referrer from session
            session()->forget('referrer_id');
        }
        
        // Send welcome email
        try {
            $emailService = new \App\Services\EmailService();
            $emailService->sendWelcomeEmail($user);
        } catch (\Exception $e) {
            // Log error but don't fail registration
            \Log::error('Failed to send welcome email: ' . $e->getMessage());
        }
        
        return $user;
    }
}
