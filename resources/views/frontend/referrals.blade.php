<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title data-admin="pageTitle">Referral Program - {{ $setting->site_title ?? 'AlgoOne' }}</title>
    @if(isset($setting) && $setting->favicon)
        <link rel="icon" href="{{ asset($setting->favicon) }}" type="image/x-icon">
    @else
        <link rel="icon" href="{{ asset('assets/image/favicon.png') }}" type="image/x-icon">
    @endif
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="{{ asset('assets/js/tailwind.config.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background: linear-gradient(135deg, #000000 0%, #0f172a 50%, #1e293b 100%);
            min-height: 100vh;
        }

        .card-blue {
            background: linear-gradient(145deg, #0f172a 0%, #1e293b 100%);
            border: 2px solid rgba(11, 100, 244, 0.3);
        }

        .card-blue:hover {
            border-color: rgba(11, 100, 244, 0.6);
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(11, 100, 244, 0.3);
        }

        .card-light-blue {
            background: linear-gradient(145deg, rgba(59, 130, 246, 0.15) 0%, rgba(37, 99, 235, 0.1) 100%);
            border: 2px solid rgba(59, 130, 246, 0.3);
        }

        .header-blue {
            background: linear-gradient(135deg, #000000 0%, #0f172a 100%);
            border-bottom: 2px solid rgba(11, 100, 244, 0.4);
        }

        .accent-blue {
            color: #0B64F4;
        }

        .metric-card {
            background: linear-gradient(145deg, #0f172a 0%, #1e293b 100%);
            border: 2px solid rgba(11, 100, 244, 0.2);
        }

        .metric-card:hover {
            border-color: rgba(11, 100, 244, 0.5);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(11, 100, 244, 0.2);
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header class="header-blue shadow-xl sticky top-0 z-50">
        <nav class="container mx-auto px-4 py-4 flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <a href="{{ route('frontend.index') }}" class="flex items-center space-x-3">
                    <div
                        class="w-8 h-8 rounded-lg flex items-center justify-center">
                        <img src="{{ isset($setting) && $setting->logo ? asset($setting->logo) : asset('assets/image/logo.png') }}" alt="Logo" />
                    </div>
                    <span class="text-2xl font-bold text-white" >{{ $setting->site_title ?? 'AlgoOne' }}</span>
                </a>
            </div>
            <div class="hidden md:flex items-center space-x-4">
                <a href="{{ route('frontend.buy-funding') }}"
                    class="text-blue-300 hover:text-blue-100 text-sm font-medium px-3 py-2 rounded-lg hover:bg-blue-600/10 transition-all flex items-center gap-2"
                    data-admin="navBuyFunding">
                    <i class="fas fa-briefcase"></i>
                    <span>Buy Funding</span>
                </a>
                <a href="{{ route('frontend.index') }}"
                    class="text-blue-300 hover:text-blue-100 text-sm font-medium px-3 py-2 rounded-lg hover:bg-blue-600/10 transition-all flex items-center gap-2"
                    data-admin="navBack">
                    <i class="fas fa-arrow-left"></i>
                    <span>Back</span>
                </a>
                
                <a href="{{ route('frontend.sign-in') }}"
                    class="text-blue-300 hover:text-blue-100 text-sm font-medium px-3 py-2 rounded-lg hover:bg-blue-600/10 transition-all flex items-center gap-2"
                    data-admin="navSignOut">
                    <span>Sign Out</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
            <button class="md:hidden text-white">
                <i class="fas fa-bars text-2xl"></i>
            </button>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="py-12 relative">
        <div class="container mx-auto px-4 max-w-7xl">
            <!-- Title Section -->
            <div class="text-center mb-12">
                <div class="flex items-center justify-center gap-3 mb-4">
                    <div
                        class="w-12 h-12 bg-blue-600/20 rounded-lg flex items-center justify-center border border-blue-500/30">
                        <i class="fas fa-users text-blue-400 text-xl"></i>
                    </div>
                    <h1 class="text-4xl md:text-5xl font-extrabold text-white" data-admin="pageTitle">
                        {{ $referral->title ?? 'Referral Program' }}
                    </h1>
                </div>
                @if($referral->subtitle ?? null)
                <p class="text-blue-200/80 text-lg max-w-2xl mx-auto" data-admin="pageSubtitle">
                    {{ $referral->subtitle }}
                </p>
                @endif
            </div>

            <!-- Key Metrics Section -->
            <section class="mb-8">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Total Clicks -->
                    <div class="metric-card rounded-xl p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div
                                class="w-12 h-12 bg-blue-600/20 rounded-lg flex items-center justify-center border border-blue-500/30">
                                <i class="fas fa-bolt text-blue-400 text-xl"></i>
                            </div>
                        </div>
                        <div class="text-blue-200/70 text-sm font-medium mb-1" data-admin="metricClicksLabel">Total
                            Clicks</div>
                        <div class="text-3xl font-bold text-white" data-admin="metricClicksValue">{{ $referralStat->total_clicks ?? 0 }}</div>
                    </div>

                    <!-- Unique Visitors -->
                    <div class="metric-card rounded-xl p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div
                                class="w-12 h-12 bg-purple-600/20 rounded-lg flex items-center justify-center border border-purple-500/30">
                                <i class="fas fa-eye text-purple-400 text-xl"></i>
                            </div>
                        </div>
                        <div class="text-blue-200/70 text-sm font-medium mb-1" data-admin="metricVisitorsLabel">Unique
                            Visitors</div>
                        <div class="text-3xl font-bold text-white" data-admin="metricVisitorsValue">{{ $referralStat->unique_visitors ?? 0 }}</div>
                    </div>

                    <!-- Conversions -->
                    <div class="metric-card rounded-xl p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div
                                class="w-12 h-12 bg-green-600/20 rounded-lg flex items-center justify-center border border-green-500/30">
                                <i class="fas fa-user text-green-400 text-xl"></i>
                            </div>
                        </div>
                        <div class="text-blue-200/70 text-sm font-medium mb-1" data-admin="metricConversionsLabel">
                            Conversions</div>
                        <div class="text-3xl font-bold text-white" data-admin="metricConversionsValue">{{ $referralStat->conversions ?? 0 }}</div>
                    </div>

                    <!-- Conversion Rate -->
                    <div class="metric-card rounded-xl p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div
                                class="w-12 h-12 bg-orange-600/20 rounded-lg flex items-center justify-center border border-orange-500/30">
                                <i class="fas fa-chart-line text-orange-400 text-xl"></i>
                            </div>
                        </div>
                        <div class="text-blue-200/70 text-sm font-medium mb-1" data-admin="metricRateLabel">Conversion
                            Rate</div>
                        <div class="text-3xl font-bold text-white" data-admin="metricRateValue">{{ number_format($referralStat->conversion_rate ?? 0, 2) }}%</div>
                    </div>
                </div>
            </section>

            <!-- Your Status Section -->
            <section class="mb-8">
                <div class="card-light-blue rounded-xl p-6 flex items-center justify-between">
                    <div>
                        <h2 class="text-xl font-bold text-white mb-2" data-admin="statusTitle">Your Status</h2>
                        <p class="text-blue-200/80" data-admin="statusText">You have referred <span
                                class="font-bold text-white">{{ $referralStat->referral_count ?? 0 }}</span> people</p>
                    </div>
                    <button
                        class="bg-gradient-to-r from-blue-600 to-blue-500 text-white px-6 py-3 rounded-lg font-semibold hover:shadow-lg hover:shadow-blue-500/50 transition-all shadow-md flex items-center gap-2"
                        data-admin="statusTier">
                        <i class="fas fa-bolt"></i>
                        <span>{{ $tierName ?? 'Basic Tier' }}</span>
                    </button>
                </div>
            </section>

            <!-- Your Referral Link Section -->
            <section class="mb-8">
                <div class="card-blue rounded-xl p-6">
                    <h2 class="text-xl font-bold text-white mb-4" data-admin="linkTitle">Your Referral Link</h2>
                    <div class="flex flex-col sm:flex-row gap-3 mb-4">
                        <input type="text" readonly value="{{ $referralLink ?? route('frontend.referrals-public') . '?ref=' . ($user->referral_code ?? '') }}"
                            class="flex-1 px-4 py-3 bg-slate-800/50 border border-blue-500/30 rounded-lg text-blue-200 font-mono text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                            id="referralLink" data-admin="linkInput">
                        <button
                            class="bg-blue-600 hover:bg-blue-500 text-white px-6 py-3 rounded-lg font-semibold transition-all flex items-center justify-center gap-2"
                            onclick="copyReferralLink()" data-admin="linkCopyButton">
                            <i class="fas fa-copy"></i>
                            <span>Copy</span>
                        </button>
                    </div>
                    <p class="text-blue-200/70 text-sm" data-admin="linkInstruction">
                        Share this link to start earning from your referrals. Clicks and conversions are tracked in
                        real-time.
                    </p>
                </div>
            </section>

            <!-- Your Conversions Section -->
            <section class="mb-8">
                <div class="card-blue rounded-xl p-6">
                    <div class="flex items-center gap-3 mb-6">
                        <div
                            class="w-10 h-10 bg-green-600/20 rounded-lg flex items-center justify-center border border-green-500/30">
                            <i class="fas fa-user text-green-400 text-lg"></i>
                        </div>
                        <h2 class="text-xl font-bold text-white" data-admin="conversionsTitle">Your Conversions</h2>
                    </div>
                    <div class="text-center py-12">
                        <div
                            class="w-20 h-20 bg-slate-800/50 rounded-full flex items-center justify-center mx-auto mb-4 border border-blue-500/20">
                            <i class="fas fa-user text-blue-400/50 text-3xl"></i>
                        </div>
                        <p class="text-blue-200/70 text-lg" data-admin="conversionsEmpty">
                            No conversions yet. Share your referral link to get started!
                        </p>
                    </div>
                </div>
            </section>

            <!-- Referral Tiers Section -->
            @if(isset($referral) && $referral && !empty($referral->tiers))
            <section class="mb-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($referral->tiers as $tierIndex => $tier)
                    @php
                        $isFeatured = ($tierIndex == 1); // Premium tier
                        $isElite = ($tierIndex == 2); // Platinum tier
                    @endphp
                    <div class="card-blue rounded-xl p-6 {{ $isElite ? 'border-2 border-yellow-500/40' : ($isFeatured ? 'border-2 border-amber-500/40' : '') }}">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-12 h-12 {{ $isElite ? 'bg-yellow-600/20 border-yellow-500/30' : ($isFeatured ? 'bg-amber-600/20 border-amber-500/30' : 'bg-blue-600/20 border-blue-500/30') }} rounded-lg flex items-center justify-center border">
                                @if($tier['icon'] ?? null)
                                <img src="{{ asset($tier['icon']) }}" alt="" class="w-8 h-8">
                                @elseif($isElite)
                                <i class="fas fa-gem {{ $isElite ? 'text-yellow-400' : '' }} text-xl"></i>
                                @elseif($isFeatured)
                                <i class="fas fa-crown {{ $isFeatured ? 'text-amber-400' : '' }} text-xl"></i>
                                @else
                                <i class="fas fa-bolt text-blue-400 text-xl"></i>
                                @endif
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-white" data-admin="tier{{ $tierIndex + 1 }}Name">{{ $tier['name'] ?? 'Tier ' . ($tierIndex + 1) }}</h3>
                                @if($tier['range'] ?? null)
                                <p class="text-blue-200/70 text-sm" data-admin="tier{{ $tierIndex + 1 }}Range">{{ $tier['range'] }}</p>
                                @endif
                            </div>
                        </div>
                        @if(!empty($tier['benefits']))
                        <ul class="space-y-3 text-blue-200/90">
                            @foreach($tier['benefits'] as $benefit)
                            <li class="flex items-start gap-3">
                                @if($benefit['icon'] ?? null)
                                <img src="{{ asset($benefit['icon']) }}" alt="" class="w-5 h-5 mt-1">
                                @else
                                <i class="fas fa-gift {{ $isElite ? 'text-yellow-400' : ($isFeatured ? 'text-amber-400' : 'text-blue-400') }} mt-1"></i>
                                @endif
                                <span data-admin="tier{{ $tierIndex + 1 }}Benefit{{ $loop->index + 1 }}">{!! $benefit['text'] ?? '' !!}</span>
                            </li>
                            @endforeach
                        </ul>
                        @endif
                    </div>
                    @endforeach
                </div>
            </section>
            @else
            <!-- Fallback: Default tiers if no data -->
            <section class="mb-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="card-blue rounded-xl p-6">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-12 h-12 bg-blue-600/20 rounded-lg flex items-center justify-center border border-blue-500/30">
                                <i class="fas fa-bolt text-blue-400 text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-white">Basic Tier</h3>
                                <p class="text-blue-200/70 text-sm">0-2 referrals</p>
                            </div>
                        </div>
                        <ul class="space-y-3 text-blue-200/90">
                            <li class="flex items-start gap-3">
                                <i class="fas fa-gift text-blue-400 mt-1"></i>
                                <span>Get the same account size your referral receives for FREE</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <i class="fas fa-chart-line text-blue-400 mt-1"></i>
                                <span>Earn 10% of every payout your referral receives</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </section>
            @endif

            <!-- How Referral Tracking Works Section -->
            <section class="mb-8">
                <div class="card-blue rounded-xl p-8">
                    <h2 class="text-2xl font-bold text-white mb-8 text-center" data-admin="trackingTitle">
                        How Referral Tracking Works
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <!-- Step 1 -->
                        <div class="text-center">
                            <div
                                class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4 border-2 border-blue-400/50">
                                <span class="text-white font-bold text-2xl">1</span>
                            </div>
                            <h3 class="text-lg font-bold text-white mb-2" data-admin="step1Title">Share Your Link</h3>
                            <p class="text-blue-200/80 text-sm" data-admin="step1Text">
                                Copy your unique referral link and share it with friends, on social media, or anywhere
                                else.
                            </p>
                        </div>

                        <!-- Step 2 -->
                        <div class="text-center">
                            <div
                                class="w-16 h-16 bg-purple-600 rounded-full flex items-center justify-center mx-auto mb-4 border-2 border-purple-400/50">
                                <span class="text-white font-bold text-2xl">2</span>
                            </div>
                            <h3 class="text-lg font-bold text-white mb-2" data-admin="step2Title">Track Clicks</h3>
                            <p class="text-blue-200/80 text-sm" data-admin="step2Text">
                                Every click on your link is tracked. See real-time stats on visitors and unique clicks.
                            </p>
                        </div>

                        <!-- Step 3 -->
                        <div class="text-center">
                            <div
                                class="w-16 h-16 bg-green-600 rounded-full flex items-center justify-center mx-auto mb-4 border-2 border-green-400/50">
                                <span class="text-white font-bold text-2xl">3</span>
                            </div>
                            <h3 class="text-lg font-bold text-white mb-2" data-admin="step3Title">Earn Rewards</h3>
                            <p class="text-blue-200/80 text-sm" data-admin="step3Text">
                                When someone signs up through your link, you earn rewards and climb the tier ladder!
                            </p>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-slate-900/50 border-t border-blue-500/20 py-8">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-blue-200/60 text-sm" >{{ $setting->copyright_text ?? '© 2025 AlgoOne. All rights reserved.' }}</p>
                <div class="flex items-center gap-6">
                    <a href="{{ route('frontend.privacy') }}" class="text-blue-200/60 text-sm hover:text-blue-300 transition">Privacy
                        Policy</a>
                    <a href="{{ route('frontend.terms-conditions') }}"
                        class="text-blue-200/60 text-sm hover:text-blue-300 transition">Terms & Conditions</a>
                </div>
            </div>
            @if(isset($setting) && $setting->show_legal_disclaimer && $setting->legal_disclaimer)
            <div class="mt-6 max-w-5xl mx-auto flex items-start gap-3 text-xs text-blue-200/60 leading-relaxed">
                <span class="text-red-400 text-base mt-1">⚠</span>
                <div data-admin="disclaimer">
                    {!! $setting->legal_disclaimer !!}
                </div>
            </div>
            @endif
        </div>
    </footer>

    {{--  <script src="{{ asset('assets/js/admin-config.js') }}"></script>  --}}
    <script>
        function copyReferralLink() {
            const linkInput = document.getElementById('referralLink');
            linkInput.select();
            linkInput.setSelectionRange(0, 99999); // For mobile devices

            try {
                navigator.clipboard.writeText(linkInput.value);

                // Show feedback
                const button = event.target.closest('button');
                const originalText = button.innerHTML;
                button.innerHTML = '<i class="fas fa-check"></i> <span>Copied!</span>';
                button.classList.add('bg-green-600', 'hover:bg-green-700');
                button.classList.remove('bg-blue-600', 'hover:bg-blue-500');

                setTimeout(() => {
                    button.innerHTML = originalText;
                    button.classList.remove('bg-green-600', 'hover:bg-green-700');
                    button.classList.add('bg-blue-600', 'hover:bg-blue-500');
                }, 2000);
            } catch (err) {
                // Fallback for older browsers
                document.execCommand('copy');
                alert('Link copied to clipboard!');
            }
        }
    </script>
</body>

</html>

