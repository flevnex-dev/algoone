<!DOCTYPE html>
<html lang="en" class="font-montserrat">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title data-admin="site-title">AlgoOne - Professional Prop Firm Trading Management</title>
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
    <div class="relative z-10 overflow-hidden">
        <div class="bg-gradient-to-r from-blue-600 via-blue-500 to-blue-600 text-white py-4 relative">
            <div class="absolute inset-0 bg-black/10"></div>
            <div class="container mx-auto px-4 relative z-10">
                <div class="flex items-center justify-center gap-3 text-sm font-medium">
                    <img src="{{ asset('assets/image/megaphone.png') }}" alt="megaphone" class="w-5 h-5 animate-bounce">
                    <img src="{{ asset('assets/image/firework2.png') }}" alt="" class="w-6 h-6">
                    <span data-admin="banner-text">LIMITED TIME: We're covering <span class="underline font-bold">30% of
                            fees</span></span>
                    <span class="hidden md:inline" data-admin="banner-text-extra">+ Most prop firms have BOGO
                        offers!</span>
                </div>
            </div>
            <div class="absolute bottom-0 left-0 right-0 h-4 bg-gradient-to-b from-blue-600 to-transparent"></div>
        </div>
    </div>

    <!-- Header - Glass Morphism -->
    <header class="glass-effect sticky top-0 z-50 transition-all duration-300 shadow-2xl">
        <nav class="container mx-auto px-4 py-4 flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <div
                    class="w-12 h-12 bg-gradient-to-br from-blue-600 to-blue-500 rounded-xl flex items-center justify-center shadow-xl border border-blue-400/30 transform hover:rotate-12 transition-transform pulse-glow">
                    <img src="{{ asset('assets/image/logo.png') }}" alt="AlgoOne Logo"
                        class="block max-w-full max-h-full object-contain p-2" decoding="async" loading="eager" />
                </div>
                <span class="text-2xl font-extrabold text-white tracking-tight" data-admin="site-name">AlgoOne</span>
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
                <a href="#signals"
                    class="text-white/90 hover:text-blue-400 text-sm font-semibold transition-all px-4 py-2 rounded-lg hover:bg-blue-600/20 relative group">
                    <span>Signals</span>
                    <span
                        class="absolute bottom-0 left-0 w-0 h-0.5 bg-blue-400 group-hover:w-full transition-all"></span>
                </a>
                <a href="{{ route('frontend.sign-in') }}"
                    class="text-white/90 hover:text-blue-400 text-sm font-semibold transition-all px-4 py-2 rounded-lg hover:bg-blue-600/20">
                    Sign In
                </a>
                <button
                    class="accent-gradient text-white px-6 py-2 rounded-lg text-sm font-bold hover:shadow-2xl hover:shadow-blue-500/50 transition-all shadow-xl hover:scale-105 border border-blue-400/30">
                    <span data-admin="cta-button">Get Started</span>
                </button>
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
                <a href="#signals"
                    class="flex items-center gap-3 text-white/90 hover:text-blue-400 font-medium py-3 px-4 rounded-lg hover:bg-blue-600/20 transition-all">
                    <span>Signals</span>
                </a>
                <a href="{{ route('frontend.sign-in') }}"
                    class="block text-white/90 hover:text-blue-400 font-medium py-3 px-4 rounded-lg hover:bg-blue-600/20 transition-all">Sign
                    In</a>
                <button
                    class="w-full accent-gradient text-white px-6 py-3 rounded-lg font-semibold hover:shadow-xl transition-all shadow-lg mt-4">
                    <span data-admin="cta-button">Get Started</span>
                </button>
            </div>
        </div>
    </header>

    <!-- Hero Section - Centered with Floating Elements -->
    <section class="relative py-15 md:py-20 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-b from-blue-900/30 via-transparent to-black"></div>
        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-5xl mx-auto text-center">
                <!-- Floating Badge -->
                <div
                    class="inline-flex bg-blue-600/30 border-2 border-blue-500/50 text-blue-400 px-8 py-4 rounded-full text-sm font-bold mb-8 items-center shadow-2xl gap-3 glass-effect float-animation">
                    <img src="{{ asset('assets/image/verified.png') }}" alt="check" class="w-6 h-6" style="object-fit: contain;">
                    <span data-admin="hero-badge">WE ONLY MAKE MONEY WHEN YOU MAKE MONEY</span>
                </div>

                <!-- Main Heading -->
                <h1 class="text-6xl md:text-8xl font-extrabold text-white mb-8 leading-tight" data-admin="hero-title">
                    <span class="block mb-2">Professional</span>
                    <span
                        class="block bg-gradient-to-r from-blue-400 via-blue-500 to-blue-600 bg-clip-text text-transparent">Prop
                        Firm Trading</span>
                </h1>

                <p class="text-2xl md:text-3xl text-white/80 mb-12 leading-relaxed max-w-3xl mx-auto"
                    data-admin="hero-description">
                    We pass your prop firm challenges with precision and get you funded. Zero risk - if we fail, we
                    refund you + $500.
                </p>

                <!-- Rating Stars -->
                <div class="flex items-center justify-center gap-8 mb-12">
                    <div class="flex items-center space-x-1">
                        <img src="{{ asset('assets/image/star.png') }}" alt="star" class="w-8 h-8">
                        <img src="{{ asset('assets/image/star.png') }}" alt="star" class="w-8 h-8">
                        <img src="{{ asset('assets/image/star.png') }}" alt="star" class="w-8 h-8">
                        <img src="{{ asset('assets/image/star.png') }}" alt="star" class="w-8 h-8">
                        <img src="{{ asset('assets/image/star.png') }}" alt="star" class="w-8 h-8">
                    </div>
                    <div class="text-left">
                        <div class="text-white font-bold text-2xl" data-admin="rating">5.0 Rating</div>
                        <div class="text-white/70 text-base" data-admin="traders-count">500+ traders</div>
                    </div>
                </div>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center mb-8">
                    <button
                        class="accent-gradient text-white px-12 py-5 rounded-2xl font-bold text-lg shadow-2xl hover:shadow-blue-500/50 flex items-center justify-center gap-3 hover:scale-105 transition-all pulse-glow">
                        <span data-admin="primary-cta">Start Trading Now</span>
                        <img src="{{ asset('assets/image/right-arrow.png') }}" alt="right arrow" class="w-5 h-5 animate-bounce">
                    </button>
                    <a href="{{ route('frontend.sign-in') }}">
                        <button
                            class="glass-effect text-white border-2 border-blue-500/50 px-12 py-5 rounded-2xl font-bold text-lg hover:bg-blue-600/20 hover:border-blue-500 transition-all shadow-xl">
                            <span data-admin="signin-button">Sign In</span>
                        </button>
                    </a>
                </div>

                <!-- Quick Links -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('frontend.official-myfxbooks') }}"
                        class="glass-effect border border-blue-500/50 text-white px-8 py-3 rounded-xl text-base hover:bg-blue-600/20 flex items-center gap-3 transition-all shadow-lg justify-center">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5">
                            <path d="M8.38 12L10.79 14.42L15.62 9.57996" stroke="#0B64F4" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round"></path>
                            <path
                                d="M10.75 2.44995C11.44 1.85995 12.57 1.85995 13.27 2.44995L14.85 3.80995C15.15 4.06995 15.71 4.27995 16.11 4.27995H17.81C18.87 4.27995 19.74 5.14995 19.74 6.20995V7.90995C19.74 8.29995 19.95 8.86995 20.21 9.16995L21.57 10.7499C22.16 11.4399 22.16 12.5699 21.57 13.2699L20.21 14.8499C19.95 15.1499 19.74 15.7099 19.74 16.1099V17.8099C19.74 18.8699 18.87 19.7399 17.81 19.7399H16.11C15.72 19.7399 15.15 19.9499 14.85 20.2099L13.27 21.5699C12.58 22.1599 11.45 22.1599 10.75 21.5699L9.17 20.2099C8.87 19.9499 8.31 19.7399 7.91 19.7399H6.18C5.12 19.7399 4.25 18.8699 4.25 17.8099V16.0999C4.25 15.7099 4.04 15.1499 3.79 14.8499L2.44 13.2599C1.86 12.5699 1.86 11.4499 2.44 10.7599L3.79 9.16995C4.04 8.86995 4.25 8.30995 4.25 7.91995V6.19995C4.25 5.13995 5.12 4.26995 6.18 4.26995H7.91C8.3 4.26995 8.87 4.05995 9.17 3.79995L10.75 2.44995Z"
                                stroke="#0B64F4" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            </path>
                        </svg>
                        <span data-admin="myfxbook-link">Check Myfxbook</span>
                    </a>
                    <a href="{{ route('frontend.payout') }}"
                        class="glass-effect border border-blue-500/50 text-white px-8 py-3 rounded-xl text-base hover:bg-blue-600/20 flex items-center gap-3 transition-all shadow-lg justify-center">
                        <i class="fas fa-dollar-sign text-blue-400"></i>
                        <span data-admin="payout-link">Check Payouts</span>
                    </a>
                </div>
            </div>

            <!-- Floating Performance Card -->
            <div class="absolute top-1/2 right-10 transform -translate-y-1/2 hidden xl:block">
                <div class="glass-effect border-2 border-blue-500/30 rounded-3xl p-8 shadow-2xl tilt-card w-80">
                    <div class="space-y-6">
                        <div class="flex items-center justify-between">
                            <div class="text-blue-400 font-bold text-sm">Total Performance</div>
                            <div class="text-white font-bold text-3xl">$815K+</div>
                        </div>
                        <div class="h-3 bg-blue-600/20 rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-blue-500 to-blue-600 rounded-full"
                                style="width: 85%"></div>
                        </div>
                        <div class="grid grid-cols-3 gap-4">
                            <div class="text-center">
                                <div class="text-blue-400 font-bold text-2xl">226%</div>
                                <div class="text-white/70 text-xs">Avg Gain</div>
                            </div>
                            <div class="text-center">
                                <div class="text-blue-400 font-bold text-2xl">4.9%</div>
                                <div class="text-white/70 text-xs">Drawdown</div>
                            </div>
                            <div class="text-center">
                                <div class="text-blue-400 font-bold text-2xl">500+</div>
                                <div class="text-white/70 text-xs">Traders</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Elite Trading Signals Section - Hexagon Cards -->
    <section id="signals" class="bg-gradient-to-b from-white via-blue-50/50 to-white py-32 md:py-40 relative">
        <div class="container mx-auto px-4">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-20">
                    <div
                        class="inline-flex items-center justify-center px-10 py-5 rounded-full bg-gradient-to-r from-blue-600 to-blue-500 text-white font-bold text-sm mb-10 shadow-2xl gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-7 h-7">
                            <path d="M13 2L3 14h7v8l9-12h-7V2z"></path>
                        </svg>
                        <span data-admin="signals-badge">FREE SIGNALS CHANNEL</span>
                    </div>
                    <h2 class="text-5xl sm:text-6xl md:text-7xl font-extrabold text-gray-900 mb-8 leading-tight"
                        data-admin="signals-title">
                        Elite Trading Signals<br>
                        <span
                            class="bg-gradient-to-r from-blue-600 to-blue-500 bg-clip-text text-transparent">Completely
                            Free</span>
                    </h2>
                    <p class="text-xl md:text-2xl text-gray-700 mb-16 max-w-3xl mx-auto"
                        data-admin="signals-description">
                        Join our exclusive signals channel where we share professional GBPJPY trades with an exceptional
                        track record.
                    </p>
                </div>

                <!-- Stats Cards - Hexagon Style -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-10 mb-16">
                    <div
                        class="bg-gradient-to-br from-blue-50 to-white border-2 border-blue-200 p-12 rounded-3xl shadow-2xl text-center transform hover:scale-105 transition-all relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-blue-600/10 rounded-full blur-2xl"></div>
                        <div class="relative">
                            <div class="text-6xl md:text-7xl font-extrabold text-blue-600 mb-4" data-admin="win-rate">
                                80%</div>
                            <div class="text-xl font-bold text-gray-800">Win Rate</div>
                        </div>
                    </div>
                    <div
                        class="bg-gradient-to-br from-blue-50 to-white border-2 border-blue-200 p-12 rounded-3xl shadow-2xl text-center transform hover:scale-105 transition-all relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-blue-600/10 rounded-full blur-2xl"></div>
                        <div class="relative">
                            <div class="text-6xl md:text-7xl font-extrabold text-blue-600 mb-4"
                                data-admin="risk-reward">1:3</div>
                            <div class="text-xl font-bold text-gray-800">Risk-Reward Ratio</div>
                        </div>
                    </div>
                    <div
                        class="bg-gradient-to-br from-blue-50 to-white border-2 border-blue-200 p-12 rounded-3xl shadow-2xl text-center transform hover:scale-105 transition-all relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-blue-600/10 rounded-full blur-2xl"></div>
                        <div class="relative">
                            <div class="text-6xl md:text-7xl font-extrabold text-blue-600 mb-4" data-admin="market">
                                GBPJPY</div>
                            <div class="text-xl font-bold text-gray-800">Primary Market</div>
                        </div>
                    </div>
                </div>

                <!-- Why Different Card - Glass Effect -->
                <div class="relative mb-12">
                    <div
                        class="absolute -inset-4 bg-gradient-to-r from-blue-600/20 to-blue-500/20 rounded-3xl blur-2xl">
                    </div>
                    <div
                        class="relative bg-white/80 backdrop-blur-xl border-2 border-blue-200 p-12 rounded-3xl shadow-2xl">
                        <h3 class="text-4xl md:text-5xl font-bold text-gray-900 mb-8 text-center"
                            data-admin="why-different-title">Why We're Different</h3>
                        <p class="leading-relaxed text-xl md:text-2xl text-center text-gray-700"
                            data-admin="why-different-text">
                            While others charge hundreds or thousands for signal services, we believe everyone deserves
                            a fair opportunity to start somewhere with trading. Our consistently profitable signals are
                            shared completely free because we know that success in trading shouldn't be locked behind
                            paywalls. Join thousands of traders who trust our analysis and execution on GBPJPY – one of
                            the most reliable currency pairs with excellent volatility and liquidity.
                        </p>
                    </div>
                </div>

                <div class="text-center">
                    <button
                        class="accent-gradient text-white px-14 py-6 rounded-2xl font-bold text-xl md:text-2xl shadow-2xl hover:shadow-blue-500/50 transition-all flex items-center gap-4 mx-auto hover:scale-105 pulse-glow">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-7 h-7">
                            <path d="M13 2L3 14h7v8l9-12h-7V2z"></path>
                        </svg>
                        <span data-admin="join-signals-button">Join Free Signals Now</span>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section - Circular Timeline -->
    <section class="py-32 md:py-40 relative">
        <div class="container mx-auto px-4">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-24">
                    <h2 class="text-6xl md:text-8xl font-extrabold text-white mb-8" data-admin="how-it-works-title">How
                        It Works</h2>
                    <p class="text-3xl md:text-4xl text-white/70" data-admin="how-it-works-subtitle">Three simple steps
                        to success</p>
                </div>

                <!-- Circular Timeline Layout -->
                <div class="relative">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                        <!-- Step 1 -->
                        <div class="relative">
                            <div
                                class="glass-effect border-2 border-blue-500/30 rounded-3xl shadow-2xl p-10 hover:border-blue-500 hover:scale-105 transition-all h-full">
                                <div class="flex flex-col items-center text-center mb-6">
                                    <div
                                        class="w-24 h-24 rounded-full bg-blue-600/20 flex items-center justify-center border-4 border-blue-500/30 mb-6 pulse-glow">
                                        <img src="{{ asset('assets/image/check-mark.png') }}" alt="check icon" class="w-14 h-14">
                                    </div>
                                    <div class="text-8xl font-black text-blue-600/20 mb-4">01</div>
                                </div>
                                <h3 class="text-3xl font-bold text-white mb-6 text-center" data-admin="step1-title">Get
                                    Your Challenge</h3>
                                <p class="text-white/80 leading-relaxed text-lg text-center"
                                    data-admin="step1-description">
                                    Purchase a prop firm challenge from a trusted firm. We cover 30% of the challenge
                                    fee to reduce your upfront cost.
                                </p>
                            </div>
                        </div>

                        <!-- Step 2 -->
                        <div class="relative">
                            <div
                                class="glass-effect border-2 border-blue-500/30 rounded-3xl shadow-2xl p-10 hover:border-blue-500 hover:scale-105 transition-all h-full">
                                <div class="flex flex-col items-center text-center mb-6">
                                    <div class="text-8xl font-black text-blue-600/20 mb-4">02</div>
                                    <div
                                        class="w-24 h-24 rounded-full bg-blue-600/20 flex items-center justify-center border-4 border-blue-500/30 mb-6 pulse-glow">
                                        <img src="{{ asset('assets/image/trend.png') }}" alt="trend icon" class="w-14 h-14">
                                    </div>
                                </div>
                                <h3 class="text-3xl font-bold text-white mb-6 text-center" data-admin="step2-title">We
                                    Pass It</h3>
                                <p class="text-white/80 leading-relaxed text-lg text-center"
                                    data-admin="step2-description">
                                    Our expert traders pass your challenge with precision and discipline. If we fail,
                                    you get a full refund + $500 guarantee.
                                </p>
                            </div>
                        </div>

                        <!-- Step 3 -->
                        <div class="relative">
                            <div
                                class="glass-effect border-2 border-blue-500/30 rounded-3xl shadow-2xl p-10 hover:border-blue-500 hover:scale-105 transition-all h-full">
                                <div class="flex flex-col items-center text-center mb-6">
                                    <div
                                        class="w-24 h-24 rounded-full bg-blue-600/20 flex items-center justify-center border-4 border-blue-500/30 mb-6 pulse-glow">
                                        <img src="{{ asset('assets/image/security.png') }}" alt="security icon" class="w-14 h-14">
                                    </div>
                                    <div class="text-8xl font-black text-blue-600/20 mb-4">03</div>
                                </div>
                                <h3 class="text-3xl font-bold text-white mb-6 text-center" data-admin="step3-title">Get
                                    Your Payout</h3>
                                <p class="text-white/80 leading-relaxed text-lg text-center"
                                    data-admin="step3-description">
                                    You receive your payout from the prop firm. We take 30% of what you take home – only
                                    when you profit.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Proven Track Record Section - Card Grid with Hover Effects -->
    <section id="results" class="bg-gradient-to-br from-blue-900/40 via-black to-black py-32 md:py-40 relative">
        <div class="container mx-auto px-4">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-24">
                    <div
                        class="inline-flex items-center gap-3 bg-blue-600/20 border-2 border-blue-500 text-blue-400 px-8 py-4 rounded-full text-sm font-bold mb-10 shadow-xl glass-effect">
                        <img src="{{ asset('assets/image/verified (1).png') }}" alt="" class="w-7 h-7">
                        <span data-admin="performance-badge">Performance Tracking</span>
                    </div>
                    <h2 class="text-6xl md:text-8xl font-extrabold text-white mb-8" data-admin="track-record-title">
                        Proven Track Record</h2>
                    <p class="text-2xl md:text-3xl text-white/70 mb-6" data-admin="track-record-subtitle">
                        Real accounts, real results. All our trading performance is third-party tracked and monitored.
                    </p>
                    <p class="text-sm text-white/60 italic" data-admin="track-record-disclaimer">
                        "All results shown are from virtual demo accounts and do not represent real profits or
                        guaranteed returns."
                    </p>
                </div>

                <!-- Accounts Grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                    <!-- Account 1 -->
                    <div
                        class="glass-effect border-2 border-blue-500/20 p-8 rounded-3xl shadow-2xl card-hover transform hover:scale-105 transition-all">
                        <div class="flex justify-between items-center mb-6">
                            <div class="flex items-center gap-3">
                                <div class="w-7 h-7 bg-blue-500 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M10 2a5 5 0 00-5 5v2a2 2 0 00-2 2v5a2 2 0 002 2h10a2 2 0 002-2v-5a2 2 0 00-2-2H7V7a3 3 0 015.905-.75 1 1 0 001.937-.5A5.002 5.002 0 0010 2z" />
                                    </svg>
                                </div>
                                <span class="text-white font-bold text-lg">Account #1</span>
                            </div>
                            <div
                                class="flex items-center gap-2 px-4 bg-blue-600/20 border border-blue-500 py-2 rounded-full">
                                <svg class="w-5 h-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" />
                                </svg>
                                <span class="text-blue-400 text-xs font-bold">Verified</span>
                            </div>
                        </div>
                        <div class="h-52 rounded-xl mb-6 relative p-3 bg-black/50 border border-blue-500/20">
                            <canvas class="account-chart" data-chart-id="account1"></canvas>
                        </div>
                        <div class="space-y-6">
                            <div class="grid grid-cols-2 gap-6">
                                <div>
                                    <div class="text-white/60 text-sm mb-2">Total Gain</div>
                                    <div class="text-blue-400 text-3xl font-bold">+154.63%</div>
                                </div>
                                <div class="text-right">
                                    <div class="text-white/60 text-sm mb-2">Balance</div>
                                    <div class="text-white text-2xl font-bold">$252,124.82</div>
                                </div>
                            </div>
                            <div class="grid grid-cols-3 gap-4 pt-4 border-t border-white/20">
                                <div>
                                    <div class="text-white/60 text-xs mb-1">Daily</div>
                                    <div class="text-white font-bold">0.71%</div>
                                </div>
                                <div>
                                    <div class="text-white/60 text-xs mb-1">Monthly</div>
                                    <div class="text-white font-bold">14.86%</div>
                                </div>
                                <div>
                                    <div class="text-white/60 text-xs mb-1">Drawdown</div>
                                    <div class="text-white font-bold">3.91%</div>
                                </div>
                            </div>
                            <div class="pt-4 border-t border-white/20 space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-white/60 text-sm">Profit</span>
                                    <span class="text-blue-400 font-bold">$154,639.72</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-white/60 text-sm">Deposits</span>
                                    <span class="text-white font-semibold">$100,000.00</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-white/60 text-sm">Platform</span>
                                    <span class="text-white font-semibold">ICMarkets MT4</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Account 2 -->
                    <div
                        class="glass-effect border-2 border-blue-500/20 p-8 rounded-3xl shadow-2xl card-hover transform hover:scale-105 transition-all">
                        <div class="flex justify-between items-center mb-6">
                            <div class="flex items-center gap-3">
                                <div class="w-7 h-7 bg-blue-500 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M10 2a5 5 0 00-5 5v2a2 2 0 00-2 2v5a2 2 0 002 2h10a2 2 0 002-2v-5a2 2 0 00-2-2H7V7a3 3 0 015.905-.75 1 1 0 001.937-.5A5.002 5.002 0 0010 2z" />
                                    </svg>
                                </div>
                                <span class="text-white font-bold text-lg">Account #2</span>
                            </div>
                            <div
                                class="flex items-center gap-2 px-4 bg-blue-600/20 border border-blue-500 py-2 rounded-full">
                                <svg class="w-5 h-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" />
                                </svg>
                                <span class="text-blue-400 text-xs font-bold">Verified</span>
                            </div>
                        </div>
                        <div class="h-52 rounded-xl mb-6 relative p-3 bg-black/50 border border-blue-500/20">
                            <canvas class="account-chart" data-chart-id="account2"></canvas>
                        </div>
                        <div class="space-y-6">
                            <div class="grid grid-cols-2 gap-6">
                                <div>
                                    <div class="text-white/60 text-sm mb-2">Total Gain</div>
                                    <div class="text-blue-400 text-3xl font-bold">+325.97%</div>
                                </div>
                                <div class="text-right">
                                    <div class="text-white/60 text-sm mb-2">Balance</div>
                                    <div class="text-white text-2xl font-bold">$136,250.22</div>
                                </div>
                            </div>
                            <div class="grid grid-cols-3 gap-4 pt-4 border-t border-white/20">
                                <div>
                                    <div class="text-white/60 text-xs mb-1">Daily</div>
                                    <div class="text-white font-bold">0.08%</div>
                                </div>
                                <div>
                                    <div class="text-white/60 text-xs mb-1">Monthly</div>
                                    <div class="text-white font-bold">2.51%</div>
                                </div>
                                <div>
                                    <div class="text-white/60 text-xs mb-1">Drawdown</div>
                                    <div class="text-white font-bold">3.51%</div>
                                </div>
                            </div>
                            <div class="pt-4 border-t border-white/20 space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-white/60 text-sm">Profit</span>
                                    <span class="text-blue-400 font-bold">$240,980.38</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-white/60 text-sm">Deposits</span>
                                    <span class="text-white font-semibold">$250,000.00</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-white/60 text-sm">Platform</span>
                                    <span class="text-white font-semibold">Blueberry MT5</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Account 3 -->
                    <div
                        class="glass-effect border-2 border-blue-500/20 p-8 rounded-3xl shadow-2xl card-hover transform hover:scale-105 transition-all">
                        <div class="flex justify-between items-center mb-6">
                            <div class="flex items-center gap-3">
                                <div class="w-7 h-7 bg-blue-500 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M10 2a5 5 0 00-5 5v2a2 2 0 00-2 2v5a2 2 0 002 2h10a2 2 0 002-2v-5a2 2 0 00-2-2H7V7a3 3 0 015.905-.75 1 1 0 001.937-.5A5.002 5.002 0 0010 2z" />
                                    </svg>
                                </div>
                                <span class="text-white font-bold text-lg">Account #3</span>
                            </div>
                            <div
                                class="flex items-center gap-2 px-4 bg-blue-600/20 border border-blue-500 py-2 rounded-full">
                                <svg class="w-5 h-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" />
                                </svg>
                                <span class="text-blue-400 text-xs font-bold">Verified</span>
                            </div>
                        </div>
                        <div class="h-52 rounded-xl mb-6 relative p-3 bg-black/50 border border-blue-500/20">
                            <canvas class="account-chart" data-chart-id="account3"></canvas>
                        </div>
                        <div class="space-y-6">
                            <div class="grid grid-cols-2 gap-6">
                                <div>
                                    <div class="text-white/60 text-sm mb-2">Total Gain</div>
                                    <div class="text-blue-400 text-3xl font-bold">+56.26%</div>
                                </div>
                                <div class="text-right">
                                    <div class="text-white/60 text-sm mb-2">Balance</div>
                                    <div class="text-white text-2xl font-bold">$110,904.26</div>
                                </div>
                            </div>
                            <div class="grid grid-cols-3 gap-4 pt-4 border-t border-white/20">
                                <div>
                                    <div class="text-white/60 text-xs mb-1">Daily</div>
                                    <div class="text-white font-bold">0.21%</div>
                                </div>
                                <div>
                                    <div class="text-white/60 text-xs mb-1">Monthly</div>
                                    <div class="text-white font-bold">4.03%</div>
                                </div>
                                <div>
                                    <div class="text-white/60 text-xs mb-1">Drawdown</div>
                                    <div class="text-white font-bold">2.89%</div>
                                </div>
                            </div>
                            <div class="pt-4 border-t border-white/20 space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-white/60 text-sm">Profit</span>
                                    <span class="text-blue-400 font-bold">$420,115.63</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-white/60 text-sm">Deposits</span>
                                    <span class="text-white font-semibold">$1,139,530.06</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-white/60 text-sm">Platform</span>
                                    <span class="text-white font-semibold">ICMarkets MT4</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Performance Summary -->
                <div
                    class="glass-effect border-2 border-blue-500/40 rounded-3xl p-12 md:p-16 shadow-2xl overflow-hidden relative mb-12 mt-16 md:mt-20">
                    <div class="absolute top-0 right-0 w-96 h-96 bg-blue-600/10 rounded-full blur-3xl"></div>
                    <div class="relative flex flex-col md:flex-row items-start md:items-center justify-between gap-8">
                        <div class="flex-1">
                            <div
                                class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-blue-600/20 border-2 border-blue-500/50 mb-6">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="w-5 h-5 text-blue-400">
                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="text-sm font-bold text-blue-400 uppercase tracking-wider">Performance
                                    Summary</span>
                            </div>
                            <h3 class="text-5xl md:text-7xl font-extrabold text-white mb-6 leading-tight"
                                data-admin="performance-summary-title">
                                Over <span
                                    class="bg-gradient-to-r from-blue-400 to-blue-600 bg-clip-text text-transparent">$815K</span>
                                in Demo Performance
                            </h3>
                            <p class="text-xl md:text-2xl text-white/80 leading-relaxed max-w-2xl"
                                data-admin="performance-summary-description">
                                Our algorithms have generated consistent returns across multiple virtual demo accounts.
                                Track our verified performance and see real results.
                            </p>
                        </div>
                        <button
                            class="accent-gradient text-white px-12 py-5 rounded-2xl font-bold text-lg md:text-xl shadow-2xl hover:shadow-blue-500/50 transition-all flex items-center justify-center gap-3 group hover:scale-105 pulse-glow">
                            <span data-admin="view-results-button">View All Results</span>
                            <img src="{{ asset('assets/image/right-arrow.png') }}" alt="right arrow"
                                class="w-5 h-5 group-hover:translate-x-1 transition-transform">
                        </button>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row items-center justify-center gap-6 text-center">
                    <a href="{{ route('frontend.official-myfxbooks') }}"
                        class="w-full sm:w-auto glass-effect border-2 border-blue-500/50 text-white px-10 py-4 rounded-xl text-lg hover:bg-blue-600/20 flex items-center gap-3 transition-all shadow-xl justify-center hover:scale-105">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5">
                            <path d="M8.38 12L10.79 14.42L15.62 9.57996" stroke="#0B64F4" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round"></path>
                            <path
                                d="M10.75 2.44995C11.44 1.85995 12.57 1.85995 13.27 2.44995L14.85 3.80995C15.15 4.06995 15.71 4.27995 16.11 4.27995H17.81C18.87 4.27995 19.74 5.14995 19.74 6.20995V7.90995C19.74 8.29995 19.95 8.86995 20.21 9.16995L21.57 10.7499C22.16 11.4399 22.16 12.5699 21.57 13.2699L20.21 14.8499C19.95 15.1499 19.74 15.7099 19.74 16.1099V17.8099C19.74 18.8699 18.87 19.7399 17.81 19.7399H16.11C15.72 19.7399 15.15 19.9499 14.85 20.2099L13.27 21.5699C12.58 22.1599 11.45 22.1599 10.75 21.5699L9.17 20.2099C8.87 19.9499 8.31 19.7399 7.91 19.7399H6.18C5.12 19.7399 4.25 18.8699 4.25 17.8099V16.0999C4.25 15.7099 4.04 15.1499 3.79 14.8499L2.44 13.2599C1.86 12.5699 1.86 11.4499 2.44 10.7599L3.79 9.16995C4.04 8.86995 4.25 8.30995 4.25 7.91995V6.19995C4.25 5.13995 5.12 4.26995 6.18 4.26995H7.91C8.3 4.26995 8.87 4.05995 9.17 3.79995L10.75 2.44995Z"
                                stroke="#0B64F4" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            </path>
                        </svg>
                        <span data-admin="myfxbook-link-bottom">Check Myfxbook</span>
                    </a>
                    <a href="{{ route('frontend.payout') }}"
                        class="w-full sm:w-auto glass-effect border-2 border-blue-500/50 text-white px-10 py-4 rounded-xl text-lg hover:bg-blue-600/20 flex items-center gap-3 transition-all shadow-xl justify-center hover:scale-105">
                        <i class="fas fa-dollar-sign text-blue-400 text-xl"></i>
                        <span data-admin="payout-link-bottom">Check Payouts</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose AlgoOne Section - Asymmetric Grid -->
    <section class="py-32 md:py-40 relative">
        <div class="container mx-auto px-4">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-24">
                    <h2 class="text-6xl md:text-8xl font-extrabold text-white mb-8" data-admin="why-choose-title">Why
                        Choose AlgoOne?</h2>
                    <p class="text-3xl md:text-4xl text-white/70" data-admin="why-choose-subtitle">Risk-free trading
                        management you can trust</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Card 1: Zero Risk Guarantee -->
                    <div
                        class="glass-effect border-2 border-blue-500/20 rounded-3xl shadow-2xl p-10 hover:shadow-blue-500/30 hover:border-blue-500/50 transition-all transform hover:-translate-y-2">
                        <div
                            class="w-20 h-20 rounded-2xl bg-blue-600/20 flex items-center justify-center mb-6 border-2 border-blue-500/30 pulse-glow">
                            <img src="{{ asset('assets/image/check-mark.png') }}" alt="check icon" class="w-12 h-12">
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-4" data-admin="feature1-title">Zero Risk Guarantee
                        </h3>
                        <p class="text-base text-white/70 leading-relaxed" data-admin="feature1-description">
                            We cover 30% of your challenge fee. If we fail to pass, we refund everything plus $500.
                        </p>
                    </div>

                    <!-- Card 2: MYFXBook Verified -->
                    <div
                        class="glass-effect border-2 border-blue-500/20 rounded-3xl shadow-2xl p-10 hover:shadow-blue-500/30 hover:border-blue-500/50 transition-all transform hover:-translate-y-2">
                        <div
                            class="w-20 h-20 rounded-2xl bg-blue-600/20 flex items-center justify-center mb-6 border-2 border-blue-500/30 pulse-glow">
                            <img src="{{ asset('assets/image/check-mark.png') }}" alt="check icon" class="w-12 h-12">
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-4" data-admin="feature2-title">MYFXBook Verified
                        </h3>
                        <p class="text-base text-white/70 leading-relaxed" data-admin="feature2-description">
                            All our trading results are third-party tracked with full transparency and accountability on
                            demo accounts.
                        </p>
                    </div>

                    <!-- Card 3: Real-Time Tracking -->
                    <div
                        class="glass-effect border-2 border-blue-500/20 rounded-3xl shadow-2xl p-10 hover:shadow-blue-500/30 hover:border-blue-500/50 transition-all transform hover:-translate-y-2">
                        <div
                            class="w-20 h-20 rounded-2xl bg-blue-600/20 flex items-center justify-center mb-6 border-2 border-blue-500/30 pulse-glow">
                            <img src="{{ asset('assets/image/check-mark.png') }}" alt="check icon" class="w-12 h-12">
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-4" data-admin="feature3-title">Real-Time Tracking
                        </h3>
                        <p class="text-base text-white/70 leading-relaxed" data-admin="feature3-description">
                            Monitor your account performance 24/7 through our intuitive dashboard.
                        </p>
                    </div>

                    <!-- Card 4: Educational Resources -->
                    <div
                        class="glass-effect border-2 border-blue-500/20 rounded-3xl shadow-2xl p-10 hover:shadow-blue-500/30 hover:border-blue-500/50 transition-all transform hover:-translate-y-2">
                        <div
                            class="w-20 h-20 rounded-2xl bg-blue-600/20 flex items-center justify-center mb-6 border-2 border-blue-500/30 pulse-glow">
                            <img src="{{ asset('assets/image/check-mark.png') }}" alt="check icon" class="w-12 h-12">
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-4" data-admin="feature4-title">Educational Resources
                        </h3>
                        <p class="text-base text-white/70 leading-relaxed" data-admin="feature4-description">
                            Access exclusive trading education videos and materials to learn alongside us.
                        </p>
                    </div>

                    <!-- Card 5: Performance-Based Model -->
                    <div
                        class="glass-effect border-2 border-blue-500/20 rounded-3xl shadow-2xl p-10 hover:shadow-blue-500/30 hover:border-blue-500/50 transition-all transform hover:-translate-y-2">
                        <div
                            class="w-20 h-20 rounded-2xl bg-blue-600/20 flex items-center justify-center mb-6 border-2 border-blue-500/30 pulse-glow">
                            <img src="{{ asset('assets/image/check-mark.png') }}" alt="check icon" class="w-12 h-12">
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-4" data-admin="feature5-title">Performance-Based
                            Model</h3>
                        <p class="text-base text-white/70 leading-relaxed" data-admin="feature5-description">
                            We only take 30% of your profits. No profits? No fees. Our interests are perfectly aligned.
                        </p>
                    </div>

                    <!-- Card 6: Institutional Grade Trading -->
                    <div
                        class="glass-effect border-2 border-blue-500/20 rounded-3xl shadow-2xl p-10 hover:shadow-blue-500/30 hover:border-blue-500/50 transition-all transform hover:-translate-y-2">
                        <div
                            class="w-20 h-20 rounded-2xl bg-blue-600/20 flex items-center justify-center mb-6 border-2 border-blue-500/30 pulse-glow">
                            <img src="{{ asset('assets/image/check-mark.png') }}" alt="check icon" class="w-12 h-12">
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-4" data-admin="feature6-title">Institutional Grade
                            Trading</h3>
                        <p class="text-base text-white/70 leading-relaxed" data-admin="feature6-description">
                            Hedge fund quality algorithms and risk management systems protecting every trade.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Referral Program Section - Gradient Cards -->
    <section class="relative py-32 md:py-40 bg-gradient-to-br from-white via-blue-50/50 to-white overflow-hidden">
        <div
            class="absolute right-0 top-0 w-96 h-96 bg-blue-100/50 rounded-full blur-3xl opacity-60 pointer-events-none">
        </div>
        <div class="container mx-auto px-4 relative">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-24">
                    <h2 class="text-6xl md:text-8xl font-extrabold text-gray-900 mb-8" data-admin="referral-title">
                        Referral Program</h2>
                    <p class="text-2xl md:text-3xl text-gray-700" data-admin="referral-subtitle">Earn free funding and
                        revenue share by referring traders.</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                    <!-- Basic Tier -->
                    <article
                        class="bg-white/80 backdrop-blur-xl border-2 border-gray-300 rounded-3xl shadow-2xl px-10 py-12 hover:shadow-3xl transition-all transform hover:scale-105">
                        <div class="flex items-center gap-5 mb-8">
                            <div
                                class="w-20 h-20 rounded-2xl bg-blue-100 flex items-center justify-center border-2 border-blue-200">
                                <img src="{{ asset('assets/image/group.png') }}" alt="" class="w-12 h-12">
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold text-gray-900" data-admin="tier1-name">Basic Tier</h3>
                                <p class="text-sm text-gray-600 font-medium" data-admin="tier1-range">0-2 referrals</p>
                            </div>
                        </div>
                        <ul class="space-y-6 text-gray-700 font-medium">
                            <li class="flex items-start gap-4">
                                <img src="{{ asset('assets/image/gift (2).png') }}" alt="" class="w-8 h-8 mt-1 flex-shrink-0">
                                <span data-admin="tier1-benefit1">Get the same account size your referral
                                    receives</span>
                            </li>
                            <li class="flex items-start gap-4">
                                <img src="{{ asset('assets/image/trend (4).png') }}" alt="" class="w-8 h-8 mt-1 flex-shrink-0">
                                <span data-admin="tier1-benefit2">Earn 10% of every payout</span>
                            </li>
                        </ul>
                    </article>
                    <!-- Premium Tier -->
                    <article
                        class="relative bg-gradient-to-br from-blue-50 to-white border-2 border-blue-500 rounded-3xl shadow-2xl px-10 py-12 hover:scale-105 transition-all">
                        <span
                            class="absolute -top-5 right-6 bg-gradient-to-r from-blue-600 to-blue-500 text-white px-6 py-3 text-sm font-bold rounded-full shadow-xl">
                            POPULAR
                        </span>
                        <div class="flex items-center gap-5 mb-8">
                            <div
                                class="w-20 h-20 rounded-2xl bg-gradient-to-br from-amber-400 to-orange-500 flex items-center justify-center shadow-lg">
                                <img src="{{ asset('assets/image/crown (1).png') }}" alt="" class="w-12 h-12">
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold text-gray-900" data-admin="tier2-name">Premium Tier</h3>
                                <p class="text-sm text-gray-600 font-medium" data-admin="tier2-range">2-5 referrals</p>
                            </div>
                        </div>
                        <ul class="space-y-6 text-gray-700 font-medium">
                            <li class="flex items-start gap-4">
                                <img src="{{ asset('assets/image/gift (1).png') }}" alt="" class="w-8 h-8 mt-1 flex-shrink-0">
                                <span data-admin="tier2-benefit1">FREE <span
                                        class="text-blue-600 font-bold">$100K</span> account bonus</span>
                            </li>
                            <li class="flex items-start gap-4">
                                <img src="{{ asset('assets/image/trend (3).png') }}" alt="" class="w-8 h-8 mt-1 flex-shrink-0">
                                <span data-admin="tier2-benefit2">Earn <span class="text-blue-600 font-bold">15%</span>
                                    of every payout</span>
                            </li>
                        </ul>
                    </article>
                    <!-- Platinum Tier -->
                    <article
                        class="relative bg-white/80 backdrop-blur-xl border-2 border-amber-400 rounded-3xl shadow-2xl px-10 py-12 hover:shadow-3xl transition-all transform hover:scale-105">
                        <span
                            class="absolute -top-5 right-6 bg-gradient-to-r from-amber-400 to-orange-500 text-amber-900 px-6 py-3 text-sm font-bold rounded-full shadow-xl flex items-center gap-2">
                            <img src="{{ asset('assets/image/diamond.png') }}" alt="" class="w-6 h-6"> ELITE
                        </span>
                        <div class="flex items-center gap-5 mb-8">
                            <div
                                class="w-20 h-20 rounded-2xl bg-gradient-to-br from-amber-300 to-orange-400 flex items-center justify-center shadow-lg">
                                <img src="{{ asset('assets/image/flash (1).png') }}" alt="" class="w-12 h-12">
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold text-gray-900" data-admin="tier3-name">Platinum</h3>
                                <p class="text-sm text-gray-600 font-medium" data-admin="tier3-range">5+ referrals</p>
                            </div>
                        </div>
                        <ul class="space-y-6 text-gray-700 font-medium">
                            <li class="flex items-start gap-4">
                                <img src="{{ asset('assets/image/wallet (1).png') }}" alt="" class="w-8 h-8 mt-1 flex-shrink-0">
                                <span data-admin="tier3-benefit1"><span class="font-bold text-amber-600">50% off</span>
                                    funding increases</span>
                            </li>
                            <li class="flex items-start gap-4">
                                <img src="{{ asset('assets/image/gift (1).png') }}" alt="" class="w-8 h-8 mt-1 flex-shrink-0">
                                <span data-admin="tier3-benefit2">FREE <span
                                        class="font-bold text-amber-600">$200K</span> account</span>
                            </li>
                            <li class="flex items-start gap-4">
                                <img src="{{ asset('assets/image/crown (1).png') }}" alt="" class="w-8 h-8 mt-1 flex-shrink-0">
                                <span data-admin="tier3-benefit3">Priority managed accounts</span>
                            </li>
                        </ul>
                    </article>
                </div>
                <div class="text-center mt-20">
                    <a href="{{ route('frontend.referrals-public') }}">
                        <button
                            class="inline-flex items-center gap-3 bg-black text-white border-2 border-gray-700 px-14 py-6 rounded-2xl font-bold text-lg shadow-2xl hover:shadow-3xl hover:scale-105 transition-all">
                            <span data-admin="learn-referrals-button">Learn More About Referrals</span>
                            <img src="{{ asset('assets/image/right-arrow.png') }}" alt="right arrow" class="w-6 h-6">
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Ready to Start Trading Section - Full Width Banner -->
    <section class="py-32 md:py-40 relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-600 via-blue-500 to-blue-600"></div>
        <div class="absolute inset-0 bg-black/20"></div>
        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-5xl mx-auto text-center">
                <h2 class="text-5xl md:text-7xl font-extrabold text-white mb-8" data-admin="cta-section-title">Ready to
                    Start Trading?</h2>
                <p class="text-2xl md:text-3xl text-white/90 mb-12" data-admin="cta-section-description">
                    Join hundreds of traders who trust AlgoOne with their prop firm accounts.
                </p>
                <a href="#"
                    class="inline-flex items-center gap-3 bg-black text-white px-14 py-6 rounded-2xl font-bold text-xl md:text-2xl shadow-2xl hover:shadow-3xl hover:scale-105 transition-all border-2 border-white/20 pulse-glow">
                    <span data-admin="create-account-button">Create Free Account</span>
                    <img src="{{ asset('assets/image/right-arrow.png') }}" alt="right arrow" class="w-6 h-6">
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-black py-12 border-t-2 border-blue-500/20">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                <p class="text-white/60 text-sm" data-admin="copyright">© 2025 AlgoOne. All rights reserved.</p>
                <div class="flex items-center gap-8">
                    <a href="{{ route('frontend.privacy') }}"
                        class="text-white/60 text-sm hover:text-blue-400 transition-colors font-medium">Privacy
                        Policy</a>
                    <a href="{{ route('frontend.terms-conditions') }}"
                        class="text-white/60 text-sm hover:text-blue-400 transition-colors font-medium">Terms &
                        Conditions</a>
                </div>
            </div>
            <div class="bg-black/50 px-6 py-8 mt-10 rounded-2xl border border-blue-500/20">
                <div class="max-w-5xl mx-auto flex items-start gap-4 text-xs text-white/60 leading-relaxed">
                    <span class="text-red-400 text-xl mt-1">⚠</span>
                    <p data-admin="legal-disclaimer">
                        <strong class="text-white/80">LEGAL DISCLAIMER</strong> — Notwithstanding any representations,
                        warranties, or statements to the contrary contained herein or elsewhere, all quantitative
                        performance indicators, statistical analyses, trading results, and any associated data
                        visualizations or informational content displayed are NON-FACTUAL and constitute hypothetical
                        simulations exclusively for demonstrative purposes. No actual transactions occur on this
                        platform, and past performance is not indicative of future results.
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <script src="{{ asset('assets/js/charts.js') }}"></script>
    <script src="{{ asset('assets/js/admin-config.js') }}"></script>
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