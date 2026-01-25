<!DOCTYPE html>
<html lang="en" class="font-montserrat">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title >{{ $setting->site_title ?? 'AlgoOne - Professional Prop Firm Trading Management' }}</title>
    @if(isset($setting) && $setting->favicon)
        <link rel="icon" href="{{ asset($setting->favicon) }}" type="image/x-icon">
    @else
        <link rel="icon" href="{{ asset('assets/image/favicon.png') }}" type="image/x-icon">
    @endif
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="{{ asset('assets/js/tailwind.config.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <style>
        .font-montserrat {
            font-family: 'Montserrat', sans-serif;
        }

        .gradient-bg {
            background: linear-gradient(135deg, #000000 0%, #0f172a 50%, #000000 100%);
        }

        .accent-gradient {
            background: linear-gradient(135deg, #0B64F4 0%, #2563EB 100%);
        }

        .text-accent {
            color: #0B64F4;
        }

        .border-accent {
            border-color: #0B64F4;
        }

        .bg-accent {
            background-color: #0B64F4;
        }

        .hover-accent:hover {
            background-color: #2563EB;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        @keyframes pulse-glow {

            0%,
            100% {
                box-shadow: 0 0 20px rgba(11, 100, 244, 0.3);
            }

            50% {
                box-shadow: 0 0 40px rgba(11, 100, 244, 0.6);
            }
        }

        .float-animation {
            animation: float 6s ease-in-out infinite;
        }

        .pulse-glow {
            animation: pulse-glow 3s ease-in-out infinite;
        }

        .glass-effect {
            background: rgba(0, 0, 0, 0.4);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(11, 100, 244, 0.2);
        }

        .hexagon-clip {
            clip-path: polygon(30% 0%, 70% 0%, 100% 50%, 70% 100%, 30% 100%, 0% 50%);
        }

        .tilt-card {
            transform: perspective(1000px) rotateX(5deg) rotateY(-5deg);
            transition: all 0.3s ease;
        }

        .tilt-card:hover {
            transform: perspective(1000px) rotateX(0deg) rotateY(0deg) scale(1.05);
        }
    </style>
</head>

<body class="gradient-bg font-montserrat">
    <!-- Animated Background Grid -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none z-0">
        <div class="absolute inset-0"
            style="background-image: linear-gradient(rgba(11, 100, 244, 0.03) 1px, transparent 1px), linear-gradient(90deg, rgba(11, 100, 244, 0.03) 1px, transparent 1px); background-size: 50px 50px;">
        </div>
        <div class="absolute top-0 left-0 w-96 h-96 bg-blue-600/10 rounded-full blur-3xl float-animation"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl float-animation"
            style="animation-delay: 2s;"></div>
        <div class="absolute top-1/2 left-1/2 w-96 h-96 bg-blue-600/5 rounded-full blur-3xl float-animation"
            style="animation-delay: 4s;"></div>
    </div>

    <!-- Top Banner - Curved Design -->
    @if(isset($topbar) && $topbar)
    <div class="relative z-10 overflow-hidden">
        <div class="bg-gradient-to-r from-blue-600 via-blue-500 to-blue-600 text-white py-4 relative">
            <div class="absolute inset-0 bg-black/10"></div>
            <div class="container mx-auto px-4 relative z-10">
                <div class="flex items-center justify-center gap-3 text-sm font-medium">
                    <img src="{{ asset('assets/image/megaphone.png') }}" alt="megaphone" class="w-5 h-5 animate-bounce">
                    <img src="{{ asset('assets/image/firework2.png') }}" alt="" class="w-6 h-6">
                    <span>{!! $topbar->content !!}</span>
                    @if($topbar->extra_content)
                    <span class="hidden md:inline" >{!! $topbar->extra_content !!}</span>
                    @endif
                </div>
            </div>
            <div class="absolute bottom-0 left-0 right-0 h-4 bg-gradient-to-b from-blue-600 to-transparent"></div>
        </div>
    </div>
    @endif

    <!-- Header - Glass Morphism -->
    <header class="glass-effect sticky top-0 z-50 transition-all duration-300 shadow-2xl">
        <nav class="container mx-auto px-4 py-4 flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <div
                    class="w-8 h-8">
                    <img src="{{ isset($setting) && $setting->logo ? asset($setting->logo) : asset('assets/image/logo.png') }}" alt=""
                        class="" decoding="async" loading="eager" />
                </div>
                <span class="text-2xl font-extrabold text-white tracking-tight" >{{ $setting->site_title ?? '' }}</span>
            </div>
            <div class="hidden md:flex items-center space-x-3">
                <a href="{{ route('frontend.past-performance') }}"
                    class="text-white/90 hover:text-blue-400 text-sm font-semibold transition-all px-4 py-2 rounded-lg hover:bg-blue-600/20 relative group">
                    <span>Past Performance</span>
                    <span
                        class="absolute bottom-0 left-0 w-0 h-0.5 bg-blue-400 group-hover:w-full transition-all"></span>
                </a>
                <a href="{{ route('frontend.live-results') }}"
                    class="text-white/90 hover:text-blue-400 text-sm font-semibold transition-all px-4 py-2 rounded-lg hover:bg-blue-600/20 relative group">
                    <span>Live Results</span>
                    <span
                        class="absolute bottom-0 left-0 w-0 h-0.5 bg-blue-400 group-hover:w-full transition-all"></span>
                </a>
                <a href="{{ isset($signal) && $signal->join_button_link ? $signal->join_button_link : '#' }}" target="_blank"
                    class="text-white/90 hover:text-blue-400 text-sm font-semibold transition-all px-4 py-2 rounded-lg hover:bg-blue-600/20 relative group">
                    <span>Signals</span>
                    <span
                        class="absolute bottom-0 left-0 w-0 h-0.5 bg-blue-400 group-hover:w-full transition-all"></span>
                </a>
                @auth
                <a href="{{ route('frontend.progress') }}"
                    class="text-white/90 hover:text-blue-400 text-sm font-semibold transition-all px-4 py-2 rounded-lg hover:bg-blue-600/20">
                    Progress
                </a>
                @else
                <a href="{{ route('frontend.sign-in') }}"
                    class="text-white/90 hover:text-blue-400 text-sm font-semibold transition-all px-4 py-2 rounded-lg hover:bg-blue-600/20">
                    Sign In
                </a>
                @endauth
                <a href="{{ isset($hero) && $hero->primary_cta_link ? $hero->primary_cta_link : '#' }}" target="_blank"
                    class="accent-gradient text-white px-6 py-2 rounded-lg text-sm font-bold hover:shadow-2xl hover:shadow-blue-500/50 transition-all shadow-xl hover:scale-105 border border-blue-400/30 inline-block">
                    <span >Get Started</span>
                </a>
            </div>
            <button
                class="flex md:hidden text-white mobile-menu-toggle py-2 outline-none focus:outline-none active:outline-none rounded-lg transition-all items-center justify-center"
                aria-label="Toggle menu">
                <svg class="menu-icon w-6 h-6 text-white transition-all" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                    </path>
                </svg>
                <svg class="close-icon w-6 h-6 text-white transition-all hidden" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
        </nav>
        <!-- Mobile Menu -->
        <div class="mobile-menu hidden md:hidden glass-effect border-t border-blue-500/30">
            <div class="container mx-auto px-4 py-6 space-y-2">
                <a href="{{ route('frontend.past-performance') }}"
                    class="flex items-center gap-3 text-white/90 hover:text-blue-400 font-medium py-3 px-4 rounded-lg hover:bg-blue-600/20 transition-all">
                    <span>Past Performance</span>
                </a>
                <a href="{{ route('frontend.live-results') }}"
                    class="flex items-center gap-3 text-white/90 hover:text-blue-400 font-medium py-3 px-4 rounded-lg hover:bg-blue-600/20 transition-all">
                    <span>Live Results</span>
                </a>
                <a href="{{ isset($signal) && $signal->join_button_link ? $signal->join_button_link : '#' }}" target="_blank"
                    class="flex items-center gap-3 text-white/90 hover:text-blue-400 font-medium py-3 px-4 rounded-lg hover:bg-blue-600/20 transition-all">
                    <span>Signals</span>
                </a>
                <a href="{{ route('frontend.sign-in') }}"
                    class="block text-white/90 hover:text-blue-400 font-medium py-3 px-4 rounded-lg hover:bg-blue-600/20 transition-all">Sign
                    In</a>
                <a href="{{ isset($hero) && $hero->primary_cta_link ? $hero->primary_cta_link : '#' }}" target="_blank"
                    class="w-full accent-gradient text-white px-6 py-3 rounded-lg font-semibold hover:shadow-xl transition-all shadow-lg mt-4 inline-block text-center">
                    <span >Get Started</span>
                </a>
            </div>
        </div>
    </header>

    <!-- Hero Section - Centered with Floating Elements -->
    <section class="relative py-15 md:py-20 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-b from-blue-900/30 via-transparent to-black"></div>
        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-5xl mx-auto text-center">
                <!-- Floating Badge -->
                @if($hero && $hero->badge_text)
                <div
                    class="inline-flex bg-blue-600/30 border-1.5 border-blue-500/50 text-white px-2 md:px-6 py-2 md:py-3
                    rounded-full md:font-semibold mb-2 md:mb-6 items-center shadow-2xl gap-1 md:gap-3 glass-effect">
                    <img src="{{ asset('assets/image/verified.png') }}" alt="" class="w-3 md:w-4 h-3 md:h-4">
                    <span class="text-xs md:text-sm">{{ $hero->badge_text }}</span>
                </div>
                @endif

                <!-- Main Heading -->
                @if($hero && $hero->title)
                <h1 class="text-2xl md:text-4xl font-extrabold text-white mb-2 md:mb-6 leading-tight" style="line-height: 1.15;">
                    {!! $hero->title !!}
                </h1>
                @endif

                @if($hero && $hero->description)
                <p class="text-base md:text-lg text-white/80 mb-2 md:mb-4 leading-relaxed max-w-3xl mx-auto"
                    >
                    {{ $hero->description }}
                </p>
                @endif

                <!-- Rating Stars -->
                <div class="flex items-center justify-center gap-2 md:gap-6 mb-4 md:mb-6">
                    <div class="flex items-center space-x-1">
                        <img src="{{ asset('assets/image/star.png') }}" alt="star" class="w-4 md:w-5 h-4 md:h-5">
                        <img src="{{ asset('assets/image/star.png') }}" alt="star" class="w-4 md:w-5 h-4 md:h-5">
                        <img src="{{ asset('assets/image/star.png') }}" alt="star" class="w-4 md:w-5 h-4 md:h-5">
                        <img src="{{ asset('assets/image/star.png') }}" alt="star" class="w-4 md:w-5 h-4 md:h-5">
                        <img src="{{ asset('assets/image/star.png') }}" alt="star" class="w-4 md:w-5 h-4 md:h-5">
                    </div>
                    @if($hero)
                    <div class="text-left">
                        <div class="text-white font-bold text-lg md:text-xl" data-admin="rating">{{ $hero->rating }}</div>
                        <div class="text-white/70 text-sm md:text-base" data-admin="traders-count">{{ $hero->traders_count }}</div>
                    </div>
                    @endif
                </div>

                <!-- CTA Buttons -->
                @if($hero)
                <div class="flex flex-col sm:flex-row gap-4 justify-center mb-4">
                    <a 
                        href="{{ $hero->primary_cta_link ?? '#' }}" 
                        target="_blank"
                        class="w-full sm:w-auto"
                    >
                        <button
                            class="w-full sm:w-auto accent-gradient text-white px-6 py-3 rounded-2xl
                            font-semibold text-base md:text-lg shadow-2xl flex items-center justify-center gap-3"
                        >
                            <span data-admin="primary-cta">{{ $hero->primary_cta_text }}</span>
                            <img src="{{ asset('assets/image/right-arrow.png') }}" alt="right arrow" class="w-4 md:w-5 h-4 md:h-5 ">
                        </button>
                    </a>
                    <a 
                        href="{{ $hero->signin_cta_link ?? route('frontend.sign-in') }}"
                        class="w-full sm:w-auto"
                    >
                        <button
                            class="w-full sm:w-auto glass-effect text-white border-2 border-blue-500/50 px-6 py-3 rounded-2xl
                            font-semibold text-base md:text-lg hover:bg-blue-600/20 hover:border-blue-500 transition-all shadow-xl"
                        >
                            <span data-admin="signin-button">{{ $hero->signin_cta_text }}</span>
                        </button>
                    </a>
                </div>

                <!-- Quick Links -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ $hero->myfxbook_link ?? route('frontend.official-myfxbooks') }}"
                        class="glass-effect border border-blue-500/50 text-white px-6 py-3.5 rounded-xl text-base hover:bg-blue-600/20 flex items-center gap-3 transition-all shadow-lg justify-center">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5">
                            <path d="M8.38 12L10.79 14.42L15.62 9.57996" stroke="#0B64F4" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round"></path>
                            <path
                                d="M10.75 2.44995C11.44 1.85995 12.57 1.85995 13.27 2.44995L14.85 3.80995C15.15 4.06995 15.71 4.27995 16.11 4.27995H17.81C18.87 4.27995 19.74 5.14995 19.74 6.20995V7.90995C19.74 8.29995 19.95 8.86995 20.21 9.16995L21.57 10.7499C22.16 11.4399 22.16 12.5699 21.57 13.2699L20.21 14.8499C19.95 15.1499 19.74 15.7099 19.74 16.1099V17.8099C19.74 18.8699 18.87 19.7399 17.81 19.7399H16.11C15.72 19.7399 15.15 19.9499 14.85 20.2099L13.27 21.5699C12.58 22.1599 11.45 22.1599 10.75 21.5699L9.17 20.2099C8.87 19.9499 8.31 19.7399 7.91 19.7399H6.18C5.12 19.7399 4.25 18.8699 4.25 17.8099V16.0999C4.25 15.7099 4.04 15.1499 3.79 14.8499L2.44 13.2599C1.86 12.5699 1.86 11.4499 2.44 10.7599L3.79 9.16995C4.04 8.86995 4.25 8.30995 4.25 7.91995V6.19995C4.25 5.13995 5.12 4.26995 6.18 4.26995H7.91C8.3 4.26995 8.87 4.05995 9.17 3.79995L10.75 2.44995Z"
                                stroke="#0B64F4" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            </path>
                        </svg>
                        <span data-admin="myfxbook-link">{{ $hero->myfxbook_text }}</span>
                    </a>
                    <a href="{{ $hero->payout_link ?? route('frontend.payout') }}"
                        class="glass-effect border border-blue-500/50 text-white px-6 py-3.5 rounded-xl text-base hover:bg-blue-600/20 flex items-center gap-3 transition-all shadow-lg justify-center">
                        <i class="fas fa-dollar-sign text-blue-400"></i>
                        <span data-admin="payout-link">{{ $hero->payout_text }}</span>
                    </a>
                </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Elite Trading Signals Section - Hexagon Cards -->
    <section id="signals" class="bg-gradient-to-b from-white via-blue-50/50 to-white py-16 md:py-24 relative">
        <div class="container mx-auto px-4">
            @if($signal && $signal->is_active)
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-6 md:mb-8">
                    @if($signal->badge_text)
                    <div
                        class="inline-flex items-center justify-center px-4 md:px-6 py-3.5 rounded-full 
                        bg-gradient-to-r from-blue-600 to-blue-500 text-white font-semibold md:font-bold text-sm md:text-base mb-4 
                        md:mb-6 shadow-2xl gap-2 md:gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 md:w-5 h-4 md:h-5">
                            <path d="M13 2L3 14h7v8l9-12h-7V2z"></path>
                        </svg>
                        <span data-admin="signals-badge" class="text-white">{{ $signal->badge_text }}</span>
                    </div>
                    @endif

                    @if($signal->title)
                    <h2 class="text-2xl md:text-4xl font-extrabold text-gray-900 mb-2 md:mb-3"
                        data-admin="signals-title">
                        {!! $signal->title !!}
                    </h2>
                    @endif

                    @if($signal->description)
                    <p class="text-sm md:text-base text-gray-700 mb-2 md:mb-3 md:max-w-3xl mx-auto"
                        data-admin="signals-description">
                        {!! $signal->description !!}
                    </p>
                    @endif
                </div>

                <!-- Stats Cards - Hexagon Style -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 md:gap-8 mb-4 md:mb-6">
                    <div
                        class="bg-gradient-to-br from-blue-50 to-white border-2 border-blue-200 p-6 md:p-10 rounded-3xl shadow-2xl text-center transform hover:scale-105 transition-all relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-blue-600/10 rounded-full blur-2xl"></div>
                        <div class="relative">
                            <div class="text-3xl md:text-4xl font-extrabold text-blue-600 mb-2 md:mb-3" data-admin="win-rate">
                                {{ $signal->win_rate }}</div>
                            <div class="text-lg md:text-xl font-bold text-gray-800">Win Rate</div>
                        </div>
                    </div>
                    <div
                        class="bg-gradient-to-br from-blue-50 to-white border-2 border-blue-200 p-6 md:p-10 rounded-3xl shadow-2xl text-center transform hover:scale-105 transition-all relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-blue-600/10 rounded-full blur-2xl"></div>
                        <div class="relative">
                            <div class="text-3xl md:text-4xl font-extrabold text-blue-600 mb-2 md:mb-3"
                                data-admin="risk-reward">{{ $signal->risk_reward }}</div>
                            <div class="text-lg md:text-xl font-bold text-gray-800">Risk-Reward Ratio</div>
                        </div>
                    </div>
                    <div
                        class="bg-gradient-to-br from-blue-50 to-white border-2 border-blue-200 p-6 md:p-10 rounded-3xl shadow-2xl text-center transform hover:scale-105 transition-all relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-blue-600/10 rounded-full blur-2xl"></div>
                        <div class="relative">
                            <div class="text-3xl md:text-4xl font-extrabold text-blue-600 mb-2 md:mb-3" data-admin="market">
                                {{ $signal->primary_market }}</div>
                            <div class="text-lg md:text-xl font-bold text-gray-800">Primary Market</div>
                        </div>
                    </div>
                </div>

                <!-- Why Different Card - Glass Effect -->
                <div class="relative mb-6 md:mb-8">
                    <div
                        class="absolute -inset-4 bg-gradient-to-r from-blue-600/20 to-blue-500/20 rounded-3xl blur-2xl">
                    </div>
                    <div
                        class="relative bg-white/80 backdrop-blur-xl border-2 border-blue-200 p-6 md:p-10 rounded-3xl shadow-2xl">
                        <h3 class="text-2xl md:text-4xl font-bold text-gray-900 mb-2 md:mb-3 text-center"
                            data-admin="why-different-title">{{ $signal->why_different_title }}</h3>
                        <p class="leading-relaxed text-sm md:text-base lg:text-lg text-justify text-gray-700"
                            data-admin="why-different-text">
                            {!! $signal->why_different_text !!}
                        </p>
                    </div>
                </div>

                <div class="text-center">
                    <a href="{{ $signal->join_button_link ?? '#' }}" target="_blank">
                        <button
                            class="accent-gradient text-white px-4 py-2 md:py-3 rounded-2xl font-semibold text-base md:text-lg 
                            shadow-2xl flex items-center gap-2.5 mx-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 md:w-6 h-5 md:h-6">
                                <path d="M13 2L3 14h7v8l9-12h-7V2z"></path>
                            </svg>
                            <span data-admin="join-signals-button">{{ $signal->join_button_text }}</span>
                        </button>
                    </a>
                </div>
            </div>
            @endif
        </div>
    </section>

    <!-- How It Works Section - Circular Timeline -->
    @if($howItWorks && $howItWorks->is_active)
    <section class="py-16 md:py-24 relative">
        <div class="container mx-auto px-4">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-8 md:mb-12">
                    <div class="inline-flex items-center gap-3 bg-blue-600/20 border-2 border-blue-500 text-blue-400 px-4 md:px-6 py-2 md:py-3 rounded-full text-sm font-semibold md:font-bold mb-6 shadow-xl glass-effect">
                        <img src="{{ asset('assets/image/firework2.png') }}" alt="" class="w-5 md:w-7 h-5 md:h-7">
                        <span data-admin="how-it-works-badge" class="text-white">{{ $howItWorks->badge_text ?? 'How It Works' }}</span>
                    </div>
                    <h2 class="text-2xl md:text-4xl font-bold text-white mb-2 md:mb-8" data-admin="how-it-works-title">{{ $howItWorks->title }}</h2>
                    <p class="text-base md:text-2xl text-white/70 mb-3 md:mb-4" data-admin="how-it-works-subtitle">{{ $howItWorks->subtitle }}</p>
                </div>

                <!-- Circular Timeline Layout -->
                <div class="relative">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-10">
                        <!-- Step 1 -->
                        <div class="relative h-full flex flex-col">
                            <div class="glass-effect border-2 border-blue-500/30 rounded-3xl shadow-2xl p-5 md:p-8 hover:border-blue-500 hover:scale-105 transition-all flex flex-col h-full">
                                <div class="flex flex-col items-center text-center mb-4 md:mb-6">
                                    <div class="w-20 h-20 md:w-24 md:h-24 rounded-full bg-blue-600/20 flex items-center justify-center border-4 border-blue-500/30 mb-3 md:mb-5 pulse-glow">
                                        <img src="{{ asset($howItWorks->step1_image ?? 'assets/image/check-mark.png') }}" alt="Step 1 Icon" class="w-11 h-11 md:w-14 md:h-14">
                                    </div>
                                    <div class="text-2xl md:text-3xl font-black text-blue-600/20 mb-2 md:mb-4">01</div>
                                </div>
                                <h3 class="text-xl md:text-3xl font-bold text-white mb-2 md:mb-4 text-center" data-admin="step1-title">{{ $howItWorks->step1_title }}</h3>
                                <div class="text-white/80 leading-relaxed text-base md:text-lg text-center flex-1 mb-4 md:mb-8"
                                    data-admin="step1-description">
                                    {!! $howItWorks->step1_description !!}
                                </div>
                            </div>
                        </div>

                        <!-- Step 2 -->
                        <div class="relative h-full flex flex-col">
                            <div class="glass-effect border-2 border-blue-500/30 rounded-3xl shadow-2xl p-5 md:p-8 hover:border-blue-500 hover:scale-105 transition-all flex flex-col h-full">
                                <div class="flex flex-col items-center text-center mb-4 md:mb-6">
                                    <div class="text-2xl md:text-3xl font-black text-blue-600/20 mb-2 md:mb-4">02</div>
                                    <div class="w-20 h-20 md:w-24 md:h-24 rounded-full bg-blue-600/20 flex items-center justify-center border-4 border-blue-500/30 mb-3 md:mb-5 pulse-glow">
                                        <img src="{{ asset($howItWorks->step2_image ?? 'assets/image/trend.png') }}" alt="Step 2 Icon" class="w-11 h-11 md:w-14 md:h-14">
                                    </div>
                                </div>
                                <h3 class="text-xl md:text-3xl font-bold text-white mb-2 md:mb-4 text-center" data-admin="step2-title">{{ $howItWorks->step2_title }}</h3>
                                <div class="text-white/80 leading-relaxed text-base md:text-lg text-center flex-1 mb-4 md:mb-8"
                                    data-admin="step2-description">
                                    {!! $howItWorks->step2_description !!}
                                </div>
                            </div>
                        </div>

                        <!-- Step 3 -->
                        <div class="relative h-full flex flex-col">
                            <div class="glass-effect border-2 border-blue-500/30 rounded-3xl shadow-2xl p-5 md:p-8 hover:border-blue-500 hover:scale-105 transition-all flex flex-col h-full">
                                <div class="flex flex-col items-center text-center mb-4 md:mb-6">
                                    <div class="w-20 h-20 md:w-24 md:h-24 rounded-full bg-blue-600/20 flex items-center justify-center border-4 border-blue-500/30 mb-3 md:mb-5 pulse-glow">
                                        <img src="{{ asset($howItWorks->step3_image ?? 'assets/image/security.png') }}" alt="Step 3 Icon" class="w-11 h-11 md:w-14 md:h-14">
                                    </div>
                                    <div class="text-2xl md:text-3xl font-black text-blue-600/20 mb-2 md:mb-4">03</div>
                                </div>
                                <h3 class="text-xl md:text-3xl font-bold text-white mb-2 md:mb-4 text-center" data-admin="step3-title">{{ $howItWorks->step3_title }}</h3>
                                <div class="text-white/80 leading-relaxed text-base md:text-lg text-center flex-1 mb-4 md:mb-8"
                                    data-admin="step3-description">
                                    {!! $howItWorks->step3_description !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-center mt-6 md:mt-10">
                        <a href="{{ $howItWorks->cta_link ?? '#' }}" target="_blank">
                            <button
                                class="accent-gradient text-white px-4 md:px-7 py-3 md:py-4 rounded-2xl font-semibold text-base md:text-lg shadow-xl flex items-center gap-3 md:gap-4 mx-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 md:w-7 h-5 md:h-7">
                                    <path d="M13 2L3 14h7v8l9-12h-7V2z"></path>
                                </svg>
                                <span data-admin="how-it-works-button">{{ $howItWorks->cta_text ?? 'Get Started Now' }}</span>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    @if($results && $results->is_active)
    <!-- Proven Track Record Section - Card Grid with  Results Section -->
    <section id="results" class="bg-gradient-to-br from-blue-900/40 via-black to-black py-16 md:py-24 relative">
        <div class="container mx-auto px-4">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-8 md:mb-12">
                    <div
                        class="inline-flex items-center gap-3 bg-blue-600/20 border-2 border-blue-500 text-blue-400 px-6 py-2.5 md:py-3.5 rounded-full text-sm font-bold mb-8 shadow-xl glass-effect">
                        <img src="{{ asset('assets/image/verified (1).png') }}" alt="" class="w-4 md:w-7 h-4 md:h-7">
                        <span data-admin="performance-badge">{{ $results->badge_text }}</span>
                    </div>
                    <h2 class="text-2xl md:text-4xl font-extrabold text-white mb-2 md:mb-3" data-admin="track-record-title">
                        {{ $results->title }}</h2>
                    <p class="text-base md:text-xl text-white/70 mb-2 md:mb-3" data-admin="track-record-subtitle">
                        {{ $results->subtitle }}
                    </p>
                    <p class="text-sm text-white/60 italic" data-admin="track-record-disclaimer">
                        {{ $results->disclaimer }}
                    </p>
                </div>

                <!-- Accounts Grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @if(!empty($results->accounts) && is_array($results->accounts))
                        @foreach($results->accounts as $index => $acc)
                        <div
                            class="glass-effect border-2 border-blue-500/20 p-4 rounded-3xl shadow-2xl card-hover transform hover:scale-105 transition-all">
                            <div class="flex justify-between items-center mb-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-7 h-7 bg-blue-500 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M10 2a5 5 0 00-5 5v2a2 2 0 00-2 2v5a2 2 0 002 2h10a2 2 0 002-2v-5a2 2 0 00-2-2H7V7a3 3 0 015.905-.75 1 1 0 001.937-.5A5.002 5.002 0 0010 2z" />
                                        </svg>
                                    </div>
                                    <span class="text-white font-bold text-base md:text-lg">{{ $acc['name'] ?? '' }}</span>
                                </div>
                                <div
                                    class="flex items-center gap-2 px-4 bg-blue-600/20 border border-blue-500 py-2 rounded-full">
                                    <svg class="w-5 h-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" />
                                    </svg>
                                    <span class="text-blue-400 text-xs font-bold">{{ $acc['subtext'] ?? '' }}</span>
                                </div>
                            </div>
                            <div class="h-52 rounded-xl mb-6 relative p-3 bg-black/50 border border-blue-500/20">
                                <canvas class="account-chart" 
                                        data-chart-id="account{{ $index }}"
                                        data-chart-labels="{{ is_array($acc['chart_labels'] ?? null) ? json_encode($acc['chart_labels']) : json_encode([]) }}"
                                        data-chart-data="{{ is_array($acc['chart_data'] ?? null) ? json_encode($acc['chart_data']) : json_encode([]) }}"></canvas>
                            </div>
                            <div class="space-y-6">
                                <div class="grid grid-cols-2 gap-6">
                                    <div>
                                        <div class="text-white/60 text-sm mb-2">Total Gain</div>
                                        <div class="text-blue-400 text-3xl font-bold">{{ $acc['total_gain'] ?? '+0%' }}</div>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-white/60 text-sm mb-2">Balance</div>
                                        <div class="text-white text-2xl font-bold">{{ $acc['balance'] ?? '$0.00' }}</div>
                                    </div>
                                </div>
                                <div class="grid grid-cols-3 gap-4 pt-4 border-t border-white/20">
                                    <div>
                                        <div class="text-white/60 text-xs mb-1">Daily</div>
                                        <div class="text-white font-bold">{{ $acc['daily'] ?? '0%' }}</div>
                                    </div>
                                    <div>
                                        <div class="text-white/60 text-xs mb-1">Monthly</div>
                                        <div class="text-white font-bold">{{ $acc['monthly'] ?? '0%' }}</div>
                                    </div>
                                    <div>
                                        <div class="text-white/60 text-xs mb-1">Drawdown</div>
                                        <div class="text-white font-bold">{{ $acc['drawdown'] ?? '0%' }}</div>
                                    </div>
                                </div>
                                <div class="pt-4 border-t border-white/20 space-y-3">
                                    <div class="flex justify-between">
                                        <span class="text-white/60 text-sm">Profit</span>
                                        <span class="text-blue-400 font-bold">{{ $acc['profit'] ?? '$0.00' }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-white/60 text-sm">Deposits</span>
                                        <span class="text-white font-semibold">{{ $acc['deposits'] ?? '$0.00' }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-white/60 text-sm">Platform</span>
                                        <span class="text-white font-semibold">{{ $acc['platform'] ?? 'N/A' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>

                <!-- Performance Summary -->
                <div class="glass-effect border-2 border-blue-500/40 rounded-3xl p-6 md:p-10  shadow-2xl overflow-hidden relative mb-8 mt-12 md:mt-14">
                    <div class="absolute top-0 right-0 w-96 h-96 bg-blue-600/10 rounded-full blur-3xl"></div>
                    <div class="relative flex flex-col md:flex-row items-start md:items-center justify-between gap-4 md:gap-10">
                        <div class="flex-1">
                            <div
                                class="inline-flex items-center gap-2.5 px-5 py-2.5 rounded-full bg-blue-600/20 border-2 border-blue-500/50 mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="w-5 h-5 text-blue-400">
                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="text-xs md:text-sm font-bold text-blue-400 uppercase tracking-wider">Performance
                                    Summary</span>
                            </div>
                            <h3 class="text-2xl md:text-4xl font-extrabold text-white mb-2 md:mb-3"
                                data-admin="performance-summary-title">
                                {!! $results->summary_title !!}
                            </h3>
                            <div class="text-base md:text-lg text-white/80 leading-relaxed max-w-2xl"
                                data-admin="performance-summary-description">
                                {!! $results->summary_description !!}
                            </div>
                        </div>
                        <a href="{{ $results->view_results_link }}"
                            class="accent-gradient text-white px-4 md:px-6 py-2 md:py-3.5 rounded-2xl font-semibold text-base md:text-lg shadow-2xl hover:shadow-blue-500/50 transition-all flex items-center justify-center gap-2.5 md:gap-4 group hover:scale-105">
                            <span data-admin="view-results-button">{{ $results->view_results_text }}</span>
                            <img src="{{ asset('assets/image/right-arrow.png') }}" alt="right arrow"
                                class="w-3 md:w-5 h-3 md:h-5">
                        </a>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row items-center justify-center gap-6 text-center">
                    <a href="{{ $results->myfxbook_link }}"
                        class="w-full sm:w-auto glass-effect border-2 border-blue-500/50 text-white px-8 py-2.5 md:py-4 rounded-xl text-lg hover:bg-blue-600/20 flex items-center gap-3 transition-all shadow-xl justify-center hover:scale-105">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5">
                            <path d="M8.38 12L10.79 14.42L15.62 9.57996" stroke="#0B64F4" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round"></path>
                            <path
                                d="M10.75 2.44995C11.44 1.85995 12.57 1.85995 13.27 2.44995L14.85 3.80995C15.15 4.06995 15.71 4.27995 16.11 4.27995H17.81C18.87 4.27995 19.74 5.14995 19.74 6.20995V7.90995C19.74 8.29995 19.95 8.86995 20.21 9.16995L21.57 10.7499C22.16 11.4399 22.16 12.5699 21.57 13.2699L20.21 14.8499C19.95 15.1499 19.74 15.7099 19.74 16.1099V17.8099C19.74 18.8699 18.87 19.7399 17.81 19.7399H16.11C15.72 19.7399 15.15 19.9499 14.85 20.2099L13.27 21.5699C12.58 22.1599 11.45 22.1599 10.75 21.5699L9.17 20.2099C8.87 19.9499 8.31 19.7399 7.91 19.7399H6.18C5.12 19.7399 4.25 18.8699 4.25 17.8099V16.0999C4.25 15.7099 4.04 15.1499 3.79 14.8499L2.44 13.2599C1.86 12.5699 1.86 11.4499 2.44 10.7599L3.79 9.16995C4.04 8.86995 4.25 8.30995 4.25 7.91995V6.19995C4.25 5.13995 5.12 4.26995 6.18 4.26995H7.91C8.3 4.26995 8.87 4.05995 9.17 3.79995L10.75 2.44995Z"
                                stroke="#0B64F4" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            </path>
                        </svg>
                        <span data-admin="myfxbook-link-bottom">{{ $results->myfxbook_text }}</span>
                    </a>
                    <a href="{{ $results->payout_link }}"
                        class="w-full sm:w-auto glass-effect border-2 border-blue-500/50 text-white px-8 py-2.5 md:py-4 rounded-xl 
                        text-lg hover:bg-blue-600/20 flex items-center gap-3 transition-all shadow-xl justify-center hover:scale-105">
                        <i class="fas fa-dollar-sign text-blue-400 text-xl"></i>
                        <span data-admin="payout-link-bottom">{{ $results->payout_text }}</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
    @endif

    @if($whyChoose && $whyChoose->is_active)
    <!-- Why Choose AlgoOne Section - Feature Grid -->
    <section class="py-16 md:py-24 relative">
        <div class="container mx-auto px-4">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-6 md:mb-12">
                    <h2 class="text-2xl md:text-4xl font-bold text-white mb-2 md:mb-3 leading-tight" data-admin="why-choose-title">
                        {{ $whyChoose->title }}
                    </h2>
                    <p class="text-base md:text-xl text-white/70 leading-relaxed" data-admin="why-choose-subtitle">
                        {{ $whyChoose->subtitle }}
                    </p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @for($i = 1; $i <= 6; $i++)
                        <!-- Card {{ $i }} -->
                        <div
                            class="glass-effect border-2 border-blue-500/20 rounded-3xl shadow-2xl p-8 hover:shadow-blue-500/30 hover:border-blue-500/50 transition-all transform hover:-translate-y-2">
                            <div
                                class="w-16 h-16 rounded-2xl bg-blue-600/20 flex items-center justify-center mb-6 border-2 border-blue-500/30 pulse-glow">
                                <img src="{{ asset($whyChoose->{"card{$i}_image"}) }}" alt="check icon" class="w-9 h-9">
                            </div>
                            <h3 class="text-2xl font-bold text-white mb-4" data-admin="feature{{ $i }}-title">{{ $whyChoose->{"card{$i}_title"} }}
                            </h3>
                            <p class="text-base text-white/70 leading-relaxed" data-admin="feature{{ $i }}-description">
                                {{ $whyChoose->{"card{$i}_description"} }}
                            </p>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </section>
    @endif

    @if($referral && $referral->is_active)
    <!-- Referral Program Section -->
    <section class="relative py-16 md:py-24 bg-gradient-to-br from-white via-blue-50/50 to-white overflow-hidden">
        <div class="absolute right-0 top-0 w-96 h-96 bg-blue-100/50 rounded-full blur-3xl opacity-60 pointer-events-none"></div>
        <div class="container mx-auto px-4 relative">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-6 md:mb-12">
                    <h2 class="text-2xl md:text-4xl font-bold text-gray-900 mb-2 md:mb-3 leading-tight" data-admin="referral-title">
                        {{ $referral->title }}</h2>
                    <p class="text-base md:text-lg text-gray-700 leading-relaxed" data-admin="referral-subtitle">{{ $referral->subtitle }}</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach($referral->tiers ?? [] as $tier)
                        <article class="relative bg-white/80 backdrop-blur-xl border-2 border-gray-300 rounded-3xl shadow-2xl px-6 py-8 md:px-10 md:py-12 hover:shadow-3xl transition-all transform hover:scale-105 flex flex-col h-full">
                            
                            <!-- Dynamic Badge -->
                            @if(!empty($tier['badge_text']))
                            <span class="absolute -top-5 right-6 bg-gradient-to-r from-blue-600 to-blue-500 text-white px-5 py-2.5 md:px-6 md:py-3 text-xs md:text-sm font-bold rounded-full shadow-xl flex items-center gap-2">
                                @if(!empty($tier['badge_icon']))
                                    <img src="{{ asset($tier['badge_icon']) }}" alt="" class="w-5 h-5 md:w-6 md:h-6">
                                @endif
                                {{ $tier['badge_text'] }}
                            </span>
                            @endif

                            <div class="flex items-center gap-4 md:gap-5 mb-5 md:mb-8">
                                <div class="w-14 h-14 md:w-20 md:h-20 rounded-2xl bg-blue-100 flex items-center justify-center border-2 border-blue-200">
                                    <img src="{{ asset($tier['icon'] ?? '') }}" alt="" class="w-8 h-8 md:w-12 md:h-12">
                                </div>
                                <div>
                                    <h3 class="text-base md:text-2xl font-bold text-gray-900">{{ $tier['name'] ?? '' }}</h3>
                                    <p class="text-xs md:text-sm text-gray-600 font-medium">{{ $tier['range'] ?? '' }}</p>
                                </div>
                            </div>
                            
                            <ul class="space-y-4 md:space-y-5 text-gray-700 font-medium">
                                @foreach($tier['benefits'] ?? [] as $benefit)
                                <li class="flex items-start gap-3 md:gap-4">
                                    <img src="{{ asset($benefit['icon'] ?? '') }}" alt="" class="w-6 h-6 md:w-8 md:h-8 mt-1 flex-shrink-0">
                                    <span class="text-xs md:text-base">{!! $benefit['text'] ?? '' !!}</span>
                                </li>
                                @endforeach
                            </ul>
                        </article>
                    @endforeach
                </div>

                <div class="text-center mt-3 md:mt-10">
                    <div class="flex justify-center">
                        <a 
                            href="{{ $referral->button_link ?? '#' }}" 
                            target="_blank"
                            class="w-full sm:w-auto"
                        >
                            <button
                                class="sm:w-auto bg-black text-white border-2 border-gray-700 px-4 md:px-6 py-2.5 md:py-3 rounded-2xl 
                                font-semibold text-base md:text-lg shadow-2xl flex items-center justify-center gap-3 hover:shadow-3xl
                                 hover:scale-105 transition-all mt-5 md:mt-10 mb-0 mx-auto"
                            >
                                <span data-admin="learn-referrals-button">{{ $referral->button_text }}</span>
                                <img src="{{ asset('assets/image/right-arrow.png') }}" alt="right arrow" class="w-4 md:w-6 h-4  md:h-6">
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- Ready to Start Trading Section - Full Width Banner -->
    @if($cta && $cta->is_active)
    <section class="py-12 md:py-20 relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-600 via-blue-500 to-blue-600"></div>
        <div class="absolute inset-0 bg-black/20"></div>
        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-5xl mx-auto text-center">
                <h2 class="text-2xl md:text-4xl font-extrabold text-white mb-2 md:mb-4" data-admin="cta-section-title">{{ $cta->title }}</h2>
                <p class="text-base md:text-xl text-white/90 mb-4 md:mb-6" data-admin="cta-section-description">
                    {{ $cta->description }}
                </p>
                <a href="{{ $cta->button_link ?? '#' }}" target="_blank" class="w-full sm:w-auto inline-block">
                    <button
                        class=" sm:w-auto accent-gradient text-white px-4 py-2.5 md:py-3 rounded-2xl font-semibold
                         text-base md:text-lg shadow-2xl flex items-center justify-center gap-3 hover:shadow-xl border-2 
                         border-white/20 mx-auto"
                    >
                        <span data-admin="create-account-button text-sm md:text-base">{{ $cta->button_text }}</span>
                        <img src="{{ asset('assets/image/right-arrow.png') }}" alt="right arrow" class="w-4 md:w-5 h-4 md:h-5">
                    </button>
                </a>
            </div>
        </div>
    </section>
    @endif

    <!-- Footer -->
    <footer class="bg-black py-12 border-t-2 border-blue-500/20">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                <p class="text-white/60 text-sm" >{{ $setting->copyright_text ?? '© 2025 All rights reserved.' }}</p>
                <div class="flex items-center gap-8">
                    <a href="{{ route('frontend.privacy') }}"
                        class="text-white/60 text-sm hover:text-blue-400 transition-colors font-medium">Privacy
                        Policy</a>
                    <a href="{{ route('frontend.terms-conditions') }}"
                        class="text-white/60 text-sm hover:text-blue-400 transition-colors font-medium">Terms &
                        Conditions</a>
                </div>
            </div>
            @if($setting->show_legal_disclaimer)
            <div class="bg-black/50 px-6 py-8 mt-10 rounded-2xl border border-blue-500/20">
                <div class="max-w-5xl mx-auto flex items-start gap-4 text-xs text-white/60 leading-relaxed">
                    <span class="text-red-400 text-xl mt-1">⚠</span>
                    <div >
                        {!! $setting->legal_disclaimer ?? '' !!}
                    </div>
                </div>
            </div>
            @endif
        </div>
    </footer>

    <script src="{{ asset('assets/js/charts.js') }}"></script>
    {{--  <script src="{{ asset('assets/js/admin-config.js') }}"></script>  --}}
    <script>
        // Mobile menu toggle
        const mobileMenuBtn = document.querySelector('.mobile-menu-toggle');
        const mobileMenu = document.querySelector('.mobile-menu');
        const menuIcon = mobileMenuBtn?.querySelector('.menu-icon');
        const closeIcon = mobileMenuBtn?.querySelector('.close-icon');

        if (mobileMenuBtn && mobileMenu && menuIcon && closeIcon) {
            mobileMenuBtn.addEventListener('click', function () {
                const isHidden = mobileMenu.classList.contains('hidden');

                if (isHidden) {
                    mobileMenu.classList.remove('hidden');
                    menuIcon.classList.add('hidden');
                    closeIcon.classList.remove('hidden');
                    document.body.style.overflow = 'hidden';
                } else {
                    mobileMenu.classList.add('hidden');
                    menuIcon.classList.remove('hidden');
                    closeIcon.classList.add('hidden');
                    document.body.style.overflow = '';
                }
            });

            const mobileMenuLinks = mobileMenu.querySelectorAll('a, button');
            mobileMenuLinks.forEach(link => {
                link.addEventListener('click', function () {
                    mobileMenu.classList.add('hidden');
                    menuIcon.classList.remove('hidden');
                    closeIcon.classList.add('hidden');
                    document.body.style.overflow = '';
                });
            });
        }

        // Header scroll effect
        const header = document.querySelector('header');
        window.addEventListener('scroll', function () {
            const currentScroll = window.pageYOffset;
            if (currentScroll > 100) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });

        // Intersection Observer for scroll animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver(function (entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, observerOptions);

        document.querySelectorAll('section, .card-hover').forEach(el => {
            el.classList.add('fade-on-scroll');
            observer.observe(el);
        });

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    const headerOffset = 80;
                    const elementPosition = target.getBoundingClientRect().top;
                    const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

                    window.scrollTo({
                        top: offsetPosition,
                        behavior: 'smooth'
                    });

                    const mobileMenu = document.querySelector('.mobile-menu');
                    const menuIcon = document.querySelector('.menu-icon');
                    const closeIcon = document.querySelector('.close-icon');
                    if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
                        mobileMenu.classList.add('hidden');
                        if (menuIcon) menuIcon.classList.remove('hidden');
                        if (closeIcon) closeIcon.classList.add('hidden');
                        document.body.style.overflow = '';
                    }
                }
            });
        });
    </script>
</body>

</html>