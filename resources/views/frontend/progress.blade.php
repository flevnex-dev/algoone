<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title data-admin="pageTitle">Progress - AlgoOne</title>
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

        .card-white {
            background: linear-gradient(145deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.9) 100%);
            border: 2px solid rgba(11, 100, 244, 0.2);
        }

        .header-blue {
            background: linear-gradient(135deg, #000000 0%, #0f172a 100%);
            border-bottom: 2px solid rgba(11, 100, 244, 0.4);
        }

        .accent-blue {
            color: #0B64F4;
        }

        .progress-slider {
            -webkit-appearance: none;
            appearance: none;
            width: 100%;
            height: 8px;
            border-radius: 5px;
            background: rgba(11, 100, 244, 0.2);
            outline: none;
        }

        .progress-slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: #0B64F4;
            cursor: pointer;
            box-shadow: 0 0 10px rgba(11, 100, 244, 0.5);
        }

        .progress-slider::-moz-range-thumb {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: #0B64F4;
            cursor: pointer;
            border: none;
            box-shadow: 0 0 10px rgba(11, 100, 244, 0.5);
        }

        .progress-bar-fill {
            background: linear-gradient(90deg, #0B64F4 0%, #2563EB 100%);
            height: 8px;
            border-radius: 5px;
            transition: width 0.3s ease;
        }
    </style>
</head>

<body>
    <!-- Top Banner -->
    <div class="bg-gradient-to-r from-blue-600 via-blue-500 to-blue-600 text-white py-3 relative">
        <div class="absolute inset-0 bg-black/10"></div>
        <div class="container mx-auto px-4 relative z-10">
            <div class="flex items-center justify-center gap-2 text-sm font-medium">
                <span data-admin="banner-text">LIMITED TIME: We're covering 30% of fees + BOGO offers! This is the
                    perfect time to increase funding!</span>
            </div>
        </div>
    </div>

    <!-- Header -->
    <header class="header-blue shadow-xl sticky top-0 z-50">
        <nav class="container mx-auto px-4 py-4 flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <a href="{{ route('frontend.index') }}" class="flex items-center space-x-3">
                    <div
                        class="w-10 h-10 bg-blue-600/20 rounded-lg flex items-center justify-center border border-blue-500/30">
                        <img src="{{ asset('assets/image/logo.png') }}" alt="Logo" class="w-8 h-8 object-contain" />
                    </div>
                    <span class="text-2xl font-bold text-white" data-admin="brandName">AlgoOne</span>
                </a>
            </div>
            <div class="hidden md:flex items-center space-x-4">
                <a href="{{ route('frontend.official-myfxbooks') }}"
                    class="text-blue-300 hover:text-blue-100 text-sm font-medium px-3 py-2 rounded-lg hover:bg-blue-600/10 transition-all"
                    data-admin="navMyfxbooks">Myfxbooks</a>
                <a href="{{ route('frontend.payout') }}"
                    class="text-blue-300 hover:text-blue-100 text-sm font-medium px-3 py-2 rounded-lg hover:bg-blue-600/10 transition-all"
                    data-admin="navPayouts">Payouts</a>
                <a href="{{ route('frontend.referrals-public') }}"
                    class="text-blue-300 hover:text-blue-100 text-sm font-medium px-3 py-2 rounded-lg hover:bg-blue-600/10 transition-all"
                    data-admin="navReferrals">Referrals</a>
                <a href="{{ route('frontend.masterclass') }}"
                    class="text-blue-300 hover:text-blue-100 text-sm font-medium px-3 py-2 rounded-lg hover:bg-blue-600/10 transition-all"
                    data-admin="navMasterclass">Masterclass</a>
                <a href="{{ route('frontend.buy-funding') }}"
                    class="text-blue-300 hover:text-blue-100 text-sm font-medium px-3 py-2 rounded-lg hover:bg-blue-600/10 transition-all"
                    data-admin="navBuyFunding">Buy Funding</a>
                <button
                    class="bg-gradient-to-r from-blue-600 to-blue-500 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:shadow-xl hover:shadow-blue-500/50 transition-all shadow-lg flex items-center gap-2"
                    data-admin="navJoinSignals">
                    <i class="fas fa-bolt"></i>
                    <span>Join Signals</span>
                </button>
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
            <!-- Welcome Section -->
            <div class="mb-8">
                <h1 class="text-4xl md:text-5xl font-extrabold text-white mb-2" data-admin="welcomeTitle">
                    Welcome back, Jonathan Sven!
                </h1>
                <p class="text-blue-200/70 text-lg" data-admin="welcomeSubtitle">
                    Track your progress and see community payouts.
                </p>
            </div>

            <!-- Important Information Section -->
            <section class="mb-12">
                <div class="card-light-blue rounded-2xl p-8 shadow-xl">
                    <div class="flex items-center gap-3 mb-6">
                        <div
                            class="w-10 h-10 bg-blue-600/20 rounded-lg flex items-center justify-center border border-blue-500/30">
                            <i class="fas fa-shield-alt text-blue-400 text-xl"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl md:text-3xl font-bold text-white" data-admin="importantTitle">
                                Important Information
                            </h2>
                            <p class="text-blue-200/70 text-sm" data-admin="importantSubtitle">Please read carefully</p>
                        </div>
                    </div>

                    <!-- Warning Box -->
                    <div class="bg-blue-600/20 border border-blue-500/40 rounded-xl p-6 mb-8">
                        <div class="flex items-start gap-4">
                            <i class="fas fa-exclamation-triangle text-yellow-400 text-2xl mt-1"></i>
                            <p class="text-white font-bold text-lg" data-admin="warningText">
                                YOU NEVER DO A SINGLE THING - WE DO ALL THE TRADING FOR YOU.
                            </p>
                        </div>
                    </div>

                    <!-- Guidelines List -->
                    <ol class="space-y-4 text-white/90">
                        <li class="flex items-start gap-4">
                            <span
                                class="flex-shrink-0 w-8 h-8 bg-blue-600/20 rounded-full flex items-center justify-center border border-blue-500/30 font-bold text-blue-400">
                                1
                            </span>
                            <div>
                                <p class="font-semibold mb-1" data-admin="guideline1Title">Do NOT log into the MT5
                                    account:</p>
                                <p class="text-blue-200/80" data-admin="guideline1Text">We may face IP issues. You can
                                    log into the prop firm dashboard, but never the MT5 platform.</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-4">
                            <span
                                class="flex-shrink-0 w-8 h-8 bg-blue-600/20 rounded-full flex items-center justify-center border border-blue-500/30 font-bold text-blue-400">
                                2
                            </span>
                            <div>
                                <p class="font-semibold mb-1" data-admin="guideline2Title">Be patient with realistic
                                    gains:</p>
                                <p class="text-blue-200/80" data-admin="guideline2Text">We make realistic gains, not
                                    unrealistic ones. We will take our time. Please do not stress us out.</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-4">
                            <span
                                class="flex-shrink-0 w-8 h-8 bg-blue-600/20 rounded-full flex items-center justify-center border border-blue-500/30 font-bold text-blue-400">
                                3
                            </span>
                            <div>
                                <p class="font-semibold mb-1" data-admin="guideline3Title">Phase 1 → Phase 2 transition:
                                </p>
                                <p class="text-blue-200/80" data-admin="guideline3Text">After passing Phase 1, we go to
                                    Phase 2 which requires 5% to pass.</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-4">
                            <span
                                class="flex-shrink-0 w-8 h-8 bg-blue-600/20 rounded-full flex items-center justify-center border border-blue-500/30 font-bold text-blue-400">
                                4
                            </span>
                            <div>
                                <p class="font-semibold mb-1" data-admin="guideline4Title">Complete KYC verification:
                                </p>
                                <p class="text-blue-200/80" data-admin="guideline4Text">Try to complete KYC with the
                                    prop firm at this point (after Phase 1).</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-4">
                            <span
                                class="flex-shrink-0 w-8 h-8 bg-blue-600/20 rounded-full flex items-center justify-center border border-blue-500/30 font-bold text-blue-400">
                                5
                            </span>
                            <div>
                                <p class="font-semibold mb-1" data-admin="guideline5Title">Live Phase requirement:</p>
                                <p class="text-blue-200/80" data-admin="guideline5Text">Once Phase 2 is passed, 35
                                    trading days are needed on the Live Phase.</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-4">
                            <span
                                class="flex-shrink-0 w-8 h-8 bg-blue-600/20 rounded-full flex items-center justify-center border border-blue-500/30 font-bold text-blue-400">
                                6
                            </span>
                            <div>
                                <p class="font-semibold mb-1" data-admin="guideline6Title">Request your payout:</p>
                                <p class="text-blue-200/80" data-admin="guideline6Text">After 35 trading days on Live
                                    Phase are complete, you can request a payout from the prop firm.</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-4">
                            <span
                                class="flex-shrink-0 w-8 h-8 bg-blue-600/20 rounded-full flex items-center justify-center border border-blue-500/30 font-bold text-blue-400">
                                7
                            </span>
                            <div>
                                <p class="font-semibold mb-1" data-admin="guideline7Title">Send us our share:</p>
                                <p class="text-blue-200/80" data-admin="guideline7Text">Once you get the payout, send us
                                    30% through whichever method is best for you.</p>
                            </div>
                        </li>
                    </ol>
                </div>
            </section>

            <!-- Your Progress Section -->
            <section class="mb-12">
                <div class="card-white rounded-2xl p-8 shadow-xl">
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2" data-admin="progressTitle">
                        Your Progress
                    </h2>
                    <p class="text-gray-600 text-sm mb-6" data-admin="progressSubtitle">
                        Track your journey through the phases
                    </p>

                    <!-- Progress Bar -->
                    <div class="mb-8">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-gray-700 font-semibold" data-admin="progressLabel">Progress</span>
                            <span class="text-blue-600 font-bold text-lg" data-admin="progressPercentage">19%</span>
                        </div>
                        <div class="relative" style="height: 24px;">
                            <!-- The blue progress bar, ending under the thumb (ball) -->
                            <div class="absolute left-0 top-1/2 -translate-y-1/2 w-full h-3 bg-gray-200 rounded-full overflow-hidden"></div>
                            <div id="progressFillBar"
                                class="absolute left-0 top-1/2 -translate-y-1/2 h-3 rounded-full"
                                style="background: linear-gradient(90deg, #3577F5 0%, #0B64F4 100%);
                                        width: 19%; min-width: 0; max-width: 100%;">
                            </div>
                            <!-- Custom thumb (ball) -->
                            <div id="progressThumb"
                                class="absolute top-1/2 -translate-y-1/2"
                                style="left: calc(19% - 12px); z-index:20;">
                                <div style="width: 24px; height: 24px; background: #fff; border: 3px solid #3577F5; border-radius: 50%; box-shadow: 0 0 0 2px #fff, 0 2px 8px 0 rgba(53,119,245,0.13);"></div>
                            </div>
                            <!-- Actual range slider (for accessibility/interaction) -->
                            <input type="range" min="0" max="100" value="19"
                                class="absolute top-0 left-0 w-full h-6 opacity-0 cursor-pointer z-30"
                                id="progressSlider"
                                style="appearance:none; background: transparent;">
                        </div>
                        <p class="text-gray-500 text-xs mt-2" data-admin="sliderInstruction">
                            Drag the slider to explore different progress levels.
                        </p>
                        <script>
                            const slider = document.getElementById('progressSlider');
                            const fillBar = document.getElementById('progressFillBar');
                            const thumb = document.getElementById('progressThumb');
                            const percent = document.querySelector('[data-admin="progressPercentage"]');
                            slider.addEventListener('input', function () {
                                const value = parseInt(this.value, 10);
                                fillBar.style.width = value + '%';
                                thumb.style.left = `calc(${value}% - 12px)`;
                                percent.textContent = value + '%';
                            });
                        </script>
                    </div>

                    <!-- Phase Steps -->
                    <div class="space-y-6">
                        <!-- Step 1: Pass Phase 1 -->
                        <div
                            class="bg-white border-2 border-gray-200 rounded-xl p-6 hover:border-blue-400 transition-all">
                            <div class="flex items-start gap-4">
                                <div
                                    class="flex-shrink-0 w-12 h-12 bg-green-500 rounded-full flex items-center justify-center">
                                    <i class="fas fa-check text-white text-xl"></i>
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center gap-3 mb-2">
                                        <h3 class="text-xl font-bold text-gray-900" data-admin="step1Title">Step 1: Pass
                                            Phase 1</h3>
                                        <span class="bg-green-500 text-white text-xs font-bold px-3 py-1 rounded-full"
                                            data-admin="step1Completed">Completed</span>
                                        <span class="bg-blue-600 text-white text-xs font-bold px-3 py-1 rounded-full"
                                            data-admin="step1InProgress">In Progress</span>
                                    </div>
                                    <p class="text-gray-600 text-sm" data-admin="step1Subtitle">Achieve 10% profit
                                        target.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Step 2: Pass Phase 2 -->
                        <div
                            class="bg-white border-2 border-gray-200 rounded-xl p-6 hover:border-blue-400 transition-all">
                            <div class="flex items-start gap-4">
                                <div
                                    class="flex-shrink-0 w-12 h-12 bg-gray-300 rounded-full flex items-center justify-center border-2 border-gray-400">
                                    <div class="w-6 h-6 bg-gray-400 rounded-full"></div>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-xl font-bold text-gray-900 mb-2" data-admin="step2Title">Step 2:
                                        Pass Phase 2</h3>
                                    <p class="text-gray-600 text-sm" data-admin="step2Subtitle">Achieve 5% profit
                                        target.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Step 3: Live Phase -->
                        <div
                            class="bg-white border-2 border-gray-200 rounded-xl p-6 hover:border-blue-400 transition-all">
                            <div class="flex items-start gap-4">
                                <div
                                    class="flex-shrink-0 w-12 h-12 bg-gray-300 rounded-full flex items-center justify-center border-2 border-gray-400">
                                    <div class="w-6 h-6 bg-gray-400 rounded-full"></div>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-xl font-bold text-gray-900 mb-2" data-admin="step3Title">Step 3:
                                        Live Phase</h3>
                                    <p class="text-gray-600 text-sm mb-2" data-admin="step3Subtitle">First payout
                                        requires 35 trading days</p>
                                    <p class="text-gray-500 text-xs" data-admin="step3Requirement">Complete 35 trading
                                        days before first payout eligibility.</p>
                                </div>
                            </div>
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
                <p class="text-blue-200/60 text-sm" data-admin="copyright">© 2025 AlgoOne. All rights reserved.</p>
                <div class="flex items-center gap-6">
                    <a href="{{ route('frontend.privacy') }}" class="text-blue-200/60 text-sm hover:text-blue-300 transition">Privacy
                        Policy</a>
                    <a href="{{ route('frontend.terms-conditions') }}"
                        class="text-blue-200/60 text-sm hover:text-blue-300 transition">Terms & Conditions</a>
                </div>
            </div>
            <div class="mt-6 max-w-5xl mx-auto flex items-start gap-3 text-xs text-blue-200/60 leading-relaxed">
                <span class="text-red-400 text-base mt-1">⚠</span>
                <p data-admin="disclaimer">
                    <strong class="text-red-500">LEGAL DISCLAIMER</strong> — All quantitative performance
                    indicators, statistical analyses, financial metrics, trading results, and associated data are
                    <strong>NON-FACTUAL</strong> and constitute hypothetical simulations exclusively for demonstrative,
                    illustrative, and presentational purposes. No bona fide securities transactions, investment
                    activities,
                    or monetary exchanges are executed through the platform.
                </p>
            </div>
        </div>
    </footer>

    <script src="{{ asset('assets/js/admin-config.js') }}"></script>
    <script>
        // Progress slider functionality
        const progressSlider = document.getElementById('progressSlider');
        const progressBarFill = document.querySelector('.progress-bar-fill');
        const progressPercentage = document.querySelector('[data-admin="progressPercentage"]');

        if (progressSlider && progressBarFill && progressPercentage) {
            progressSlider.addEventListener('input', function () {
                const value = this.value;
                progressBarFill.style.width = value + '%';
                progressPercentage.textContent = value + '%';
            });
        }
    </script>
</body>

</html>

