<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title data-admin="pageTitle">Referral Program - AlgoOne</title>
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
                        <img src="{{ asset('assets/image/logo.png') }}" alt="Logo" class="w-10 h-10 object-contain" />
                    </div>
                    <span class="text-2xl font-bold text-white" data-admin="brandName">AlgoOne</span>
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
                <h2 class="text-5xl md:text-7xl font-extrabold text-white mb-6" data-admin="pageTitle">Earn While You Refer</h2>
                <p class="text-xl md:text-2xl text-blue-200/80 max-w-2xl mx-auto" data-admin="pageSubtitle">Earn free funding and revenue share by referring traders to AlgoOne.</p>
            </div>

            <!-- Tier Cards - Vertical Stack Layout -->
            <div class="max-w-5xl mx-auto space-y-8">
                <!-- Basic Tier -->
                <article class="tier-card rounded-3xl shadow-2xl px-10 py-12 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-blue-600/10 rounded-full blur-2xl"></div>
                    <div class="relative">
                        <div class="flex flex-col md:flex-row items-start md:items-center gap-6 mb-8">
                            <div class="w-20 h-20 rounded-2xl bg-blue-600/20 flex items-center justify-center border-2 border-blue-500/30">
                                <img src="{{ asset('assets/image/group.png') }}" alt="" class="w-12 h-12">
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center gap-3 mb-2">
                                    <h3 class="text-3xl font-bold text-white" data-admin="tier1Name">Basic Tier</h3>
                                    <span class="bg-blue-600/20 border border-blue-500/40 text-blue-400 text-xs font-bold px-3 py-1 rounded-full">0-2 referrals</span>
                                </div>
                                <p class="text-blue-300/70 text-sm" data-admin="tier1Range">Perfect for getting started</p>
                            </div>
                        </div>
                        <div class="grid md:grid-cols-2 gap-6 mb-6">
                            <ul class="space-y-4 text-blue-200/90 font-medium">
                                <li class="flex items-start gap-3">
                                    <img src="{{ asset('assets/image/gift (2).png') }}" alt="" class="w-6 h-6 mt-1 flex-shrink-0">
                                    <span data-admin="tier1Benefit1">Get the same account size your referral receives</span>
                                </li>
                                <li class="flex items-start gap-3">
                                    <img src="{{ asset('assets/image/trend (4).png') }}" alt="" class="w-6 h-6 mt-1 flex-shrink-0">
                                    <span data-admin="tier1Benefit2">Earn 10% of every payout</span>
                                </li>
                            </ul>
                            <div class="bg-blue-600/10 border border-blue-500/20 rounded-xl p-6">
                                <p class="text-blue-300/70 text-sm font-medium mb-3" data-admin="exampleLabel">Example Calculation:</p>
                                <p class="text-blue-200/80 text-sm mb-2" data-admin="example1">Referral gets $10,000 payout → Prop firm takes 20% = $8,000</p>
                                <p class="text-blue-400 font-bold text-lg" data-admin="example1Earn">You earn: $800 (10% of $8,000)</p>
                            </div>
                        </div>
                    </div>
                </article>

                <!-- Premium Tier - Featured -->
                <article class="tier-card featured rounded-3xl shadow-2xl px-10 py-12 relative overflow-hidden">
                    <div class="absolute -top-4 -right-4 bg-gradient-to-r from-blue-600 to-blue-500 text-white px-6 py-2 text-sm font-bold rounded-bl-2xl shadow-xl flex items-center gap-2" data-admin="popularBadge">
                        <i class="fas fa-star"></i>
                        <span>POPULAR</span>
                    </div>
                    <div class="absolute top-0 right-0 w-40 h-40 bg-blue-600/20 rounded-full blur-3xl"></div>
                    <div class="relative">
                        <div class="flex flex-col md:flex-row items-start md:items-center gap-6 mb-8">
                            <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-amber-400 to-orange-500 flex items-center justify-center border-2 border-amber-400/50 shadow-lg">
                                <img src="{{ asset('assets/image/crown (1).png') }}" alt="" class="w-12 h-12">
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center gap-3 mb-2">
                                    <h3 class="text-3xl font-bold text-white" data-admin="tier2Name">Premium Tier</h3>
                                    <span class="bg-amber-500/20 border border-amber-400/40 text-amber-300 text-xs font-bold px-3 py-1 rounded-full">2-5 referrals</span>
                                </div>
                                <p class="text-blue-300/70 text-sm" data-admin="tier2Range">Most popular choice</p>
                            </div>
                        </div>
                        <div class="grid md:grid-cols-2 gap-6 mb-6">
                            <ul class="space-y-4 text-blue-200/90 font-medium">
                                <li class="flex items-start gap-3">
                                    <img src="{{ asset('assets/image/gift (1).png') }}" alt="" class="w-6 h-6 mt-1 flex-shrink-0">
                                    <span data-admin="tier2Benefit1">FREE <span class="text-blue-400 font-bold">$100K</span> account bonus</span>
                                </li>
                                <li class="flex items-start gap-3">
                                    <img src="{{ asset('assets/image/trend (3).png') }}" alt="" class="w-6 h-6 mt-1 flex-shrink-0">
                                    <span data-admin="tier2Benefit2">Earn <span class="text-blue-400 font-bold">15%</span> of every payout</span>
                                </li>
                            </ul>
                            <div class="bg-blue-600/20 border border-blue-500/30 rounded-xl p-6">
                                <p class="text-blue-300/70 text-sm font-medium mb-3" data-admin="example2Label">Example Calculation:</p>
                                <p class="text-blue-200/80 text-sm mb-2" data-admin="example2">Referral gets $10,000 payout → Prop firm takes 20% = $8,000</p>
                                <p class="text-blue-400 font-bold text-lg" data-admin="example2Earn">You earn: $1,200 (15% of $8,000)</p>
                            </div>
                        </div>
                    </div>
                </article>

                <!-- Platinum Tier -->
                <article class="tier-card rounded-3xl shadow-2xl px-10 py-12 relative overflow-hidden border-2 border-amber-400/30">
                    <div class="absolute -top-4 -right-4 bg-gradient-to-r from-amber-400 to-orange-500 text-amber-900 px-6 py-2 text-sm font-bold rounded-bl-2xl shadow-xl flex items-center gap-2" data-admin="eliteBadge">
                        <img src="{{ asset('assets/image/diamond.png') }}" alt="" class="w-4 h-4">
                        <span>ELITE</span>
                    </div>
                    <div class="absolute top-0 right-0 w-40 h-40 bg-amber-500/10 rounded-full blur-3xl"></div>
                    <div class="relative">
                        <div class="flex flex-col md:flex-row items-start md:items-center gap-6 mb-8">
                            <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-amber-300 to-orange-400 flex items-center justify-center border-2 border-amber-400/50 shadow-lg">
                                <img src="{{ asset('assets/image/flash (1).png') }}" alt="" class="w-12 h-12">
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center gap-3 mb-2">
                                    <h3 class="text-3xl font-bold text-white" data-admin="tier3Name">Platinum</h3>
                                    <span class="bg-amber-500/20 border border-amber-400/40 text-amber-300 text-xs font-bold px-3 py-1 rounded-full">5+ referrals</span>
                                </div>
                                <p class="text-blue-300/70 text-sm" data-admin="tier3Range">Ultimate tier for serious referrers</p>
                            </div>
                        </div>
                        <div class="grid md:grid-cols-2 gap-6 mb-6">
                            <ul class="space-y-4 text-blue-200/90 font-medium">
                                <li class="flex items-start gap-3">
                                    <img src="{{ asset('assets/image/wallet (1).png') }}" alt="" class="w-6 h-6 mt-1 flex-shrink-0">
                                    <span data-admin="tier3Benefit1"><span class="font-bold text-amber-400">50% off</span> funding increases</span>
                                </li>
                                <li class="flex items-start gap-3">
                                    <img src="{{ asset('assets/image/gift (1).png') }}" alt="" class="w-6 h-6 mt-1 flex-shrink-0">
                                    <span data-admin="tier3Benefit2">FREE <span class="font-bold text-amber-400">$200K</span> account</span>
                                </li>
                                <li class="flex items-start gap-3">
                                    <img src="{{ asset('assets/image/crown (1).png') }}" alt="" class="w-6 h-6 mt-1 flex-shrink-0">
                                    <span data-admin="tier3Benefit3">Priority managed accounts</span>
                                </li>
                            </ul>
                            <div class="bg-amber-500/10 border border-amber-400/20 rounded-xl p-6">
                                <p class="text-blue-300/70 text-sm font-medium mb-3" data-admin="example3Label">Example Calculation:</p>
                                <p class="text-blue-200/80 text-sm mb-2" data-admin="example3">Referral gets $10,000 payout → Prop firm takes 20% = $8,000</p>
                                <p class="text-amber-400 font-bold text-lg" data-admin="example3Earn">You earn: $1,200 (15% of $8,000)</p>
                            </div>
                        </div>
                    </div>
                </article>
            </div>

            <!-- CTA Section -->
            <div class="max-w-4xl mx-auto mt-20 px-8 py-12 bg-gradient-to-r from-blue-600/20 to-blue-500/20 rounded-3xl shadow-2xl border-2 border-blue-500/30 text-center">
                <h2 class="text-4xl md:text-5xl font-extrabold text-white mb-4" data-admin="ctaTitle">Ready to Start Earning?</h2>
                <p class="text-blue-200/90 text-lg md:text-xl mb-8 max-w-2xl mx-auto" data-admin="ctaText">Sign up now to get your unique referral link and start building your passive income stream</p>
                <button class="inline-flex items-center gap-3 bg-gradient-to-r from-blue-600 to-blue-500 text-white px-10 py-4 rounded-2xl font-bold text-lg shadow-xl hover:shadow-2xl hover:shadow-blue-500/50 transition-all hover:scale-105" data-admin="ctaButton">
                    <i class="fas fa-link"></i>
                    <span>Get Your Referral Link</span>
                    <i class="fas fa-arrow-right"></i>
                </button>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-black/80 backdrop-blur-xl border-t border-blue-500/20 py-8 mt-20 relative z-10">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-blue-300/60 text-sm" data-admin="copyright">© 2025 AlgoOne. All rights reserved.</p>
                <div class="flex items-center gap-6">
                    <a href="{{ route('frontend.privacy') }}" class="text-blue-300/60 text-sm hover:text-blue-400 transition">Privacy Policy</a>
                    <a href="{{ route('frontend.terms-conditions') }}" class="text-blue-300/60 text-sm hover:text-blue-400 transition">Terms & Conditions</a>
                </div>
            </div>
            <div class="mt-6 max-w-5xl mx-auto flex items-start gap-3 text-xs text-blue-200/60 leading-relaxed">
                <span class="text-red-400 text-base mt-1">⚠</span>
                <p data-admin="disclaimer">
                    <strong class="text-blue-200/80">LEGAL DISCLAIMER</strong> — All quantitative performance indicators, statistical analyses, trading results, and any associated data visualizations or informational content displayed are NON-FACTUAL and constitute hypothetical simulations exclusively for demonstrative purposes. No actual transactions occur on this platform, and past performance is not indicative of future results.
                </p>
            </div>
        </div>
    </footer>

    <script src="{{ asset('assets/js/admin-config.js') }}"></script>
</body>

</html>

