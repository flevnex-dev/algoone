<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title data-admin="pageTitle">Reset Password - {{ $setting->site_title ?? 'AlgoOne' }}</title>
    @if(isset($setting) && $setting->favicon)
        <link rel="icon" href="{{ asset($setting->favicon) }}" type="image/x-icon">
    @else
        <link rel="icon" href="{{ asset('assets/image/favicon.png') }}" type="image/x-icon">
    @endif
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="{{ asset('assets/js/tailwind.config.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background: linear-gradient(135deg, #000000 0%, #0f172a 50%, #000000 100%);
            min-height: 100vh;
        }
        .login-card {
            background: linear-gradient(145deg, rgba(15, 23, 42, 0.95) 0%, rgba(0, 0, 0, 0.95) 100%);
            backdrop-filter: blur(20px);
            border: 2px solid rgba(11, 100, 244, 0.3);
            box-shadow: 0 20px 60px rgba(11, 100, 244, 0.2);
        }
        .input-field {
            background: rgba(15, 23, 42, 0.8);
            border: 2px solid rgba(11, 100, 244, 0.2);
        }
        .input-field:focus {
            border-color: rgba(11, 100, 244, 0.6);
            box-shadow: 0 0 0 3px rgba(11, 100, 244, 0.1);
        }
    </style>
</head>

<body>
    <!-- Animated Background Elements -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-20 right-10 w-72 h-72 bg-blue-600/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-20 left-10 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl"></div>
    </div>

    <!-- Main Content -->
    <main class="min-h-screen flex items-center justify-center px-4 py-12 relative z-10">
        <div class="w-full max-w-lg">
            <!-- Logo and Company Name - Vertical Layout -->
            <div class="text-center mb-12">
                <div class="inline-flex items-center justify-center gap-4 mb-6">
                    <div class="w-8 h-8 rounded-3xl flex items-center justify-center shadow-2xl ">
                        <img src="{{ isset($setting) && $setting->logo ? asset($setting->logo) : asset('assets/image/logo.png') }}"/>
                    </div>
                </div>
                <h2 class="text-lg md:text-xl lg:text-2xl font-semibold md:font-bold text-white mb-2" >{{ $setting->site_title ?? 'AlgoOne' }}</h2>
                <p class="text-blue-400/80 font-medium">Create a new password</p>
            </div>

            <!-- Reset Password Card -->
            <div class="login-card rounded-3xl p-10 shadow-2xl">
                <!-- Header Section -->
                <div class="text-center mb-8 pb-8 border-b border-blue-500/20">
                    <div class="inline-flex items-center gap-2 bg-blue-600/20 border border-blue-500/40 rounded-full px-4 py-2 mb-4">
                        <i class="fas fa-lock text-blue-400"></i>
                        <span class="text-blue-400 text-sm font-semibold">RESET PASSWORD</span>
                    </div>
                    <h1 class="text-4xl md:text-5xl font-extrabold text-white mb-3" data-admin="pageTitle">Reset Password</h1>
                    <p class="text-blue-300/70 text-lg" data-admin="pageSubtitle">Enter your new password below</p>
                </div>

                <!-- Reset Password Form -->
                <form method="POST" action="{{ route('password.update') }}" class="space-y-6">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">

                    @if($errors->any())
                        <div class="bg-red-500/20 border border-red-500/50 rounded-xl p-4 mb-4">
                            <ul class="text-red-300 text-sm">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <!-- Email Field -->
                    <div>
                        <label for="email" class="block text-blue-300/90 font-semibold mb-3 text-sm uppercase tracking-wide" data-admin="emailLabel">
                            <i class="fas fa-envelope mr-2 text-blue-400"></i>Email Address
                        </label>
                        <input type="email" id="email" name="email" value="{{ $email ?? old('email') }}" placeholder="you@example.com"
                            class="input-field w-full px-5 py-4 rounded-xl text-white placeholder-blue-400/40 focus:outline-none transition-all @error('email') border-red-500/50 @enderror"
                            required autocomplete="email" autofocus data-admin="emailInput" />
                        @error('email')
                            <span class="text-red-400 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Password Field -->
                    <div>
                        <label for="password" class="block text-blue-300/90 font-semibold mb-3 text-sm uppercase tracking-wide" data-admin="passwordLabel">
                            <i class="fas fa-lock mr-2 text-blue-400"></i>New Password
                        </label>
                        <input type="password" id="password" name="password" placeholder="Enter your new password"
                            class="input-field w-full px-5 py-4 rounded-xl text-white placeholder-blue-400/40 focus:outline-none transition-all @error('password') border-red-500/50 @enderror"
                            required autocomplete="new-password" data-admin="passwordInput" />
                        @error('password')
                            <span class="text-red-400 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Confirm Password Field -->
                    <div>
                        <label for="password-confirm" class="block text-blue-300/90 font-semibold mb-3 text-sm uppercase tracking-wide" data-admin="passwordConfirmLabel">
                            <i class="fas fa-lock mr-2 text-blue-400"></i>Confirm Password
                        </label>
                        <input type="password" id="password-confirm" name="password_confirmation" placeholder="Confirm your new password"
                            class="input-field w-full px-5 py-4 rounded-xl text-white placeholder-blue-400/40 focus:outline-none transition-all"
                            required autocomplete="new-password" data-admin="passwordConfirmInput" />
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                        class="w-full bg-gradient-to-r from-blue-600 to-blue-500 text-white px-6 py-4 rounded-xl font-bold text-lg hover:shadow-2xl hover:shadow-blue-500/50 transition-all shadow-lg hover:scale-[1.02] flex items-center justify-center gap-3 mt-8"
                        data-admin="resetPasswordButton">
                        <span>Reset Password</span>
                        <i class="fas fa-check"></i>
                    </button>
                </form>

                <!-- Back to Sign In Link -->
                <div class="mt-8 text-center pt-8 border-t border-blue-500/20">
                    <p class="text-blue-300/70 text-sm" data-admin="signInPrompt">
                        Remember your password?
                        <a href="{{ route('frontend.sign-in') }}" class="text-blue-400 hover:text-blue-300 font-bold transition-colors ml-2" data-admin="signInLink">
                            Sign in <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </p>
                </div>
            </div>

            <!-- Back to Home Link -->
            <div class="mt-8 text-center">
                <a href="{{ route('frontend.index') }}" class="text-blue-400/80 hover:text-blue-300 text-sm transition-colors inline-flex items-center gap-2 font-medium" data-admin="backLink">
                    <i class="fas fa-arrow-left"></i>
                    <span>Back to home</span>
                </a>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-black/50 backdrop-blur-sm border-t border-blue-500/20 py-6 mt-12 relative z-10">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                <p class="text-xs md:text-sm text-blue-300/60" >{{ $setting->copyright_text ?? '© 2025 AlgoOne. All rights reserved.' }}</p>
                <div class="flex items-center gap-6 text-sm text-blue-300/60">
                    <a href="{{ route('frontend.privacy') }}" class="hover:text-blue-400 transition">Privacy Policy</a>
                    <a href="{{ route('frontend.terms-conditions') }}" class="hover:text-blue-400 transition">Terms & Conditions</a>
                </div>
            </div>
        </div>
    </footer>

    {{--  <script src="{{ asset('assets/js/admin-config.js') }}"></script>  --}}
</body>

</html>
