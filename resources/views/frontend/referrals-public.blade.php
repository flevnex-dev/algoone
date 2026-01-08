<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title data-admin="pageTitle">{{ ($referral->title ?? 'Referral Program') }} - {{ $setting->site_title ?? 'AlgoOne' }}</title>
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
        .tier-card {
            background: linear-gradient(145deg, rgba(15, 23, 42, 0.95) 0%, rgba(0, 0, 0, 0.95) 100%);
            border: 2px solid rgba(11, 100, 244, 0.3);
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }
        .tier-card:hover {
            transform: translateY(-8px) scale(1.02);
            border-color: rgba(11, 100, 244, 0.6);
            box-shadow: 0 20px 40px rgba(11, 100, 244, 0.3);
        }
        .tier-card.featured {
            border-color: rgba(11, 100, 244, 0.6);
            box-shadow: 0 25px 50px rgba(11, 100, 244, 0.4);
            background: linear-gradient(145deg, rgba(11, 100, 244, 0.1) 0%, rgba(15, 23, 42, 0.95) 100%);
        }
    </style>
</head>

<body>
    <!-- Animated Background -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-0 left-0 w-96 h-96 bg-blue-600/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl"></div>
    </div>

    <!-- Header -->
    <header class="bg-black/80 backdrop-blur-xl shadow-xl sticky top-0 z-50 border-b border-blue-500/20">
        <nav class="container mx-auto px-4 py-4 flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <a href="{{ route('frontend.index') }}" class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-600 to-blue-500 rounded-xl flex items-center justify-center shadow-lg border border-blue-500/30">
                        <img src="{{ asset($setting->logo ?? 'assets/image/logo.png') }}" alt="Logo" class="w-10 h-10 object-contain" />
                    </div>
                    <span class="text-2xl font-bold text-white" >{{ $setting->site_title ?? 'AlgoOne' }}</span>
                </a>
            </div>
            <div class="hidden md:flex items-center space-x-4">
                <a href="{{ route('frontend.sign-in') }}" class="text-blue-300 hover:text-blue-100 text-sm font-medium px-4 py-2 rounded-lg hover:bg-blue-600/10 transition-all border border-blue-500/30" data-admin="signInButton">
                    <i class="fas fa-sign-in-alt mr-2"></i>Sign In
                </a>
                <button class="bg-gradient-to-r from-blue-600 to-blue-500 text-white px-6 py-2.5 rounded-lg text-sm font-semibold hover:shadow-xl hover:shadow-blue-500/50 transition-all shadow-lg flex items-center gap-2" data-admin="getStartedButton">
                    <span>Get Started</span>
                    <i class="fas fa-arrow-right"></i>
                </button>
            </div>
            <button class="md:hidden text-white">
                <i class="fas fa-bars text-2xl"></i>
            </button>
        </nav>
    </header>

    <!-- Main Content -->
    <section class="relative py-24 overflow-hidden">
        <div class="container mx-auto px-4 relative z-10">
            <!-- Hero Section -->
            <div class="max-w-4xl mx-auto text-center mb-20">
                <div class="inline-flex items-center gap-2 bg-blue-600/20 border border-blue-500/40 rounded-full px-6 py-3 mb-6">
                    <i class="fas fa-users text-blue-400"></i>
                    <span class="text-blue-400 text-sm font-semibold uppercase tracking-wide">REFERRAL PROGRAM</span>
                </div>
                <h2 class="text-5xl md:text-7xl font-extrabold text-white mb-6" data-admin="pageTitle">{{ $referral->title ?? 'Earn While You Refer' }}</h2>
                @if($referral->subtitle ?? null)
                <p class="text-xl md:text-2xl text-blue-200/80 max-w-2xl mx-auto" data-admin="pageSubtitle">{{ $referral->subtitle }}</p>
                @endif
            </div>

            <!-- Tier Cards - Vertical Stack Layout -->
            @if(isset($referral) && $referral && !empty($referral->tiers))
            <div class="max-w-5xl mx-auto space-y-8">
                @foreach($referral->tiers as $tierIndex => $tier)
                @php
                    $isFeatured = ($tierIndex == 1); // Second tier (Premium) is featured
                    $isElite = ($tierIndex == 2); // Third tier (Platinum) is elite
                    $isPremiumOrPlatinum = ($isFeatured || $isElite);
                @endphp
                <article class="tier-card {{ $isFeatured ? 'featured' : '' }} rounded-3xl shadow-2xl px-10 py-12 relative overflow-hidden {{ $isElite ? 'border-2 border-amber-400/30' : '' }}">
                    @if($tier['badge_text'] ?? null)
                    <div class="absolute -top-[0px] -right-4 bg-gradient-to-r {{ $isElite ? 'from-amber-400 to-orange-500 text-amber-900' : 'from-blue-600 to-blue-500 text-white' }} px-6 py-2 text-sm font-bold rounded-bl-2xl shadow-xl flex items-center gap-2" data-admin="tier{{ $tierIndex + 1 }}Badge">
                        @if($tier['badge_icon'] ?? null)
                        <img src="{{ asset($tier['badge_icon']) }}" alt="" class="w-4 h-4">
                        @elseif($isElite)
                        <img src="{{ asset('assets/image/diamond.png') }}" alt="" class="w-4 h-4">
                        @elseif($isFeatured)
                        <i class="fas fa-star"></i>
                        @endif
                        <span>{{ $tier['badge_text'] }}</span>
                    </div>
                    @endif
                    <div class="absolute top-0 right-0 {{ $isElite ? 'w-40 h-40 bg-amber-500/10' : ($isFeatured ? 'w-40 h-40 bg-blue-600/20' : 'w-32 h-32 bg-blue-600/10') }} rounded-full blur-{{ $isElite || $isFeatured ? '3xl' : '2xl' }}"></div>
                    <div class="relative">
                        <div class="flex flex-col md:flex-row items-start md:items-center gap-6 mb-8">
                            <div class="w-20 h-20 rounded-2xl {{ $isPremiumOrPlatinum ? 'bg-gradient-to-br from-amber-400 to-orange-500 border-2 border-amber-400/50 shadow-lg' : 'bg-blue-600/20 border-2 border-blue-500/30' }} flex items-center justify-center">
                                @if($tier['icon'] ?? null)
                                <img src="{{ asset($tier['icon']) }}" alt="" class="w-12 h-12">
                                @elseif($isElite)
                                <img src="{{ asset('assets/image/flash (1).png') }}" alt="" class="w-12 h-12">
                                @elseif($isFeatured)
                                <img src="{{ asset('assets/image/crown (1).png') }}" alt="" class="w-12 h-12">
                                @else
                                <img src="{{ asset('assets/image/group.png') }}" alt="" class="w-12 h-12">
                                @endif
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center gap-3 mb-2">
                                    <h3 class="text-3xl font-bold text-white" data-admin="tier{{ $tierIndex + 1 }}Name">{{ $tier['name'] ?? 'Tier ' . ($tierIndex + 1) }}</h3>
                                    @if($tier['range'] ?? null)
                                    <span class="{{ $isPremiumOrPlatinum ? 'bg-amber-500/20 border-amber-400/40 text-amber-300' : 'bg-blue-600/20 border-blue-500/40 text-blue-400' }} border text-xs font-bold px-3 py-1 rounded-full">{{ $tier['range'] }}</span>
                                    @endif
                                </div>
                                @if($tier['description'] ?? null)
                                <p class="text-blue-300/70 text-sm" data-admin="tier{{ $tierIndex + 1 }}Range">{{ $tier['description'] }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="grid md:grid-cols-2 gap-6 mb-6">
                            @if(!empty($tier['benefits']))
                            <ul class="space-y-4 text-blue-200/90 font-medium">
                                @foreach($tier['benefits'] as $benefit)
                                <li class="flex items-start gap-3">
                                    @if($benefit['icon'] ?? null)
                                    <img src="{{ asset($benefit['icon']) }}" alt="" class="w-6 h-6 mt-1 flex-shrink-0">
                                    @else
                                    <img src="{{ asset('assets/image/gift (2).png') }}" alt="" class="w-6 h-6 mt-1 flex-shrink-0">
                                    @endif
                                    <span data-admin="tier{{ $tierIndex + 1 }}Benefit{{ $loop->index + 1 }}">{!! $benefit['text'] ?? '' !!}</span>
                                </li>
                                @endforeach
                            </ul>
                            @endif
                            @if(isset($tier['example_calculation']) || isset($tier['example_earn']))
                            <div class="{{ $isElite ? 'bg-amber-500/10 border-amber-400/20' : ($isFeatured ? 'bg-blue-600/20 border-blue-500/30' : 'bg-blue-600/10 border-blue-500/20') }} border rounded-xl p-6">
                                <p class="text-blue-300/70 text-sm font-medium mb-3" data-admin="example{{ $tierIndex + 1 }}Label">Example Calculation:</p>
                                @if(isset($tier['example_calculation']) && !empty($tier['example_calculation']))
                                <p class="text-blue-200/80 text-sm mb-2" data-admin="example{{ $tierIndex + 1 }}">{{ $tier['example_calculation'] }}</p>
                                @endif
                                @if(isset($tier['example_earn']) && !empty($tier['example_earn']))
                                <p class="{{ $isElite ? 'text-amber-400' : 'text-blue-400' }} font-bold text-lg" data-admin="example{{ $tierIndex + 1 }}Earn">{{ $tier['example_earn'] }}</p>
                                @endif
                            </div>
                            @endif
                        </div>
                    </div>
                </article>
                @endforeach
            </div>
            @else
            <!-- Fallback: Default tiers if no data -->
            <div class="max-w-5xl mx-auto space-y-8">
                <p class="text-center text-blue-200/60">No referral tiers available. Please configure in admin panel.</p>
            </div>
            @endif

            <!-- CTA Section -->
            @if(isset($referral) && $referral && ($referral->title || $referral->button_text))
            <div class="max-w-4xl mx-auto mt-20 px-8 py-12 bg-gradient-to-r from-blue-600/20 to-blue-500/20 rounded-3xl shadow-2xl border-2 border-blue-500/30 text-center">
                @if($referral->title)
                <h2 class="text-4xl md:text-5xl font-extrabold text-white mb-4" data-admin="ctaTitle">{{ $referral->title }}</h2>
                @endif
                @if($referral->subtitle)
                <p class="text-blue-200/90 text-lg md:text-xl mb-8 max-w-2xl mx-auto" data-admin="ctaText">{{ $referral->subtitle }}</p>
                @endif
                @if($referral->button_text)
                @if($referral->button_link)
                <a href="{{ $referral->button_link }}" class="inline-flex items-center gap-3 bg-gradient-to-r from-blue-600 to-blue-500 text-white px-10 py-4 rounded-2xl font-bold text-lg shadow-xl hover:shadow-2xl hover:shadow-blue-500/50 transition-all hover:scale-105" data-admin="ctaButton">
                    <i class="fas fa-link"></i>
                    <span>{{ $referral->button_text }}</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
                @else
                <button class="inline-flex items-center gap-3 bg-gradient-to-r from-blue-600 to-blue-500 text-white px-10 py-4 rounded-2xl font-bold text-lg shadow-xl hover:shadow-2xl hover:shadow-blue-500/50 transition-all hover:scale-105" data-admin="ctaButton">
                    <i class="fas fa-link"></i>
                    <span>{{ $referral->button_text }}</span>
                    <i class="fas fa-arrow-right"></i>
                </button>
                @endif
                @endif
            </div>
            @endif
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-black/80 backdrop-blur-xl border-t border-blue-500/20 py-8 mt-20 relative z-10">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-blue-300/60 text-sm" >{{ $setting->copyright_text ?? '© 2025 AlgoOne. All rights reserved.' }}</p>
                <div class="flex items-center gap-6">
                    <a href="{{ route('frontend.privacy') }}" class="text-blue-300/60 text-sm hover:text-blue-400 transition">Privacy Policy</a>
                    <a href="{{ route('frontend.terms-conditions') }}" class="text-blue-300/60 text-sm hover:text-blue-400 transition">Terms & Conditions</a>
                </div>
            </div>
            @if(isset($setting) && $setting->legal_disclaimer)
            <div class="mt-6 max-w-5xl mx-auto flex items-start gap-3 text-xs text-blue-200/60 leading-relaxed">
                <span class="text-red-400 text-base mt-1">⚠</span>
                <div data-admin="disclaimer">
                    {!! $setting->legal_disclaimer !!}
                </div>
            </div>
            @endif
        </div>
    </footer>

    <script src="{{ asset('assets/js/admin-config.js') }}"></script>
</body>

</html>

