<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title data-admin="pageTitle">Past Performance - AlgoOne</title>
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

        .header-blue {
            background: linear-gradient(135deg, #000000 0%, #0f172a 100%);
            border-bottom: 2px solid rgba(11, 100, 244, 0.4);
        }

        .accent-blue {
            color: #0B64F4;
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
                        class="w-10 h-10 bg-blue-600/20 rounded-lg flex items-center justify-center border border-blue-500/30">
                        <img src="{{ asset('assets/image/logo.png') }}" alt="Logo" class="w-8 h-8 object-contain" />
                    </div>
                    <span class="text-2xl font-bold text-white" data-admin="brandName">AlgoOne</span>
                </a>
            </div>
            <div class="hidden md:flex items-center space-x-4">
                <button
                    class="text-blue-300 hover:text-blue-100 text-sm font-medium px-3 py-2 rounded-lg hover:bg-blue-600/10 transition-all flex items-center gap-2">
                    <i class="fas fa-sync-alt"></i>
                    <span data-admin="refreshButton">Refresh</span>
                </button>
                <a href="{{ route('frontend.official-myfxbooks') }}"
                    class="text-blue-300 hover:text-blue-100 text-sm font-medium px-3 py-2 rounded-lg hover:bg-blue-600/10 transition-all"
                    data-admin="navMyfxbooks">Myfxbooks</a>
                <a href="{{ route('frontend.payout') }}"
                    class="text-blue-300 hover:text-blue-100 text-sm font-medium px-3 py-2 rounded-lg hover:bg-blue-600/10 transition-all"
                    data-admin="navPayouts">Payouts</a>
                <a href="{{ route('frontend.live-results') }}"
                    class="text-white bg-blue-600 text-sm font-medium px-3 py-2 rounded-lg hover:bg-blue-500 transition-all"
                    data-admin="navLiveResults">Live Results</a>
            </div>
            <button class="md:hidden text-white">
                <i class="fas fa-bars text-2xl"></i>
            </button>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="py-12 relative">
        <div class="container mx-auto px-4 max-w-7xl">
            <!-- Page Title -->
            <h1 class="text-4xl md:text-5xl font-extrabold text-white mb-12" data-admin="pageTitle">Past Performance
            </h1>

            <!-- Transparency Section -->
            <section class="mb-12">
                <div class="card-blue rounded-2xl p-8 shadow-xl">
                    <h2 class="text-2xl md:text-3xl font-bold text-white mb-4" data-admin="transparencyTitle">
                        Transparency in Trading</h2>
                    <p class="text-blue-100 text-lg leading-relaxed mb-4" data-admin="transparencyText">
                        At AlgoOne, we believe in complete transparency. The data you see here represents real prop firm
                        trading performance—no exaggeration, no hidden metrics. Our goal is to empower traders with the
                        tools and transparency they need to make informed decisions. All performance data is from actual
                        prop firm accounts, demonstrating our consistent, reliable trading strategies.
                    </p>
                    <a href="#"
                        class="text-blue-400 hover:text-blue-300 font-semibold text-base inline-flex items-center gap-2 transition-colors">
                        <span data-admin="viewReports">View detailed MyFxBook reports</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </section>

            <!-- Select Trading Week -->
            <section class="mb-12">
                <h2 class="text-2xl md:text-3xl font-bold text-white mb-6" data-admin="weekSelectorTitle">Select Trading
                    Week</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4">
                    <!-- Week Cards -->
                    <button class="card-blue rounded-xl p-4 text-left hover:bg-blue-600/20 transition-all group"
                        data-week="1">
                        <div class="text-blue-200/70 text-xs font-medium mb-1" data-admin="week1Label">Week 1</div>
                        <div class="text-blue-300/60 text-xs mb-2" data-admin="week1Date">09/09/24 - 13/09/24</div>
                        <div class="text-blue-400 font-bold text-lg group-hover:text-blue-300" data-admin="week1Gain">
                            +2.45%</div>
                    </button>
                    <button class="card-blue rounded-xl p-4 text-left hover:bg-blue-600/20 transition-all group"
                        data-week="2">
                        <div class="text-blue-200/70 text-xs font-medium mb-1" data-admin="week2Label">Week 2</div>
                        <div class="text-blue-300/60 text-xs mb-2" data-admin="week2Date">16/09/24 - 20/09/24</div>
                        <div class="text-blue-400 font-bold text-lg group-hover:text-blue-300" data-admin="week2Gain">
                            +1.56%</div>
                    </button>
                    <button class="card-blue rounded-xl p-4 text-left hover:bg-blue-600/20 transition-all group"
                        data-week="3">
                        <div class="text-blue-200/70 text-xs font-medium mb-1" data-admin="week3Label">Week 3</div>
                        <div class="text-blue-300/60 text-xs mb-2" data-admin="week3Date">23/09/24 - 27/09/24</div>
                        <div class="text-blue-400 font-bold text-lg group-hover:text-blue-300" data-admin="week3Gain">
                            +2.78%</div>
                    </button>
                    <button class="card-blue rounded-xl p-4 text-left hover:bg-blue-600/20 transition-all group"
                        data-week="4">
                        <div class="text-blue-200/70 text-xs font-medium mb-1" data-admin="week4Label">Week 4</div>
                        <div class="text-blue-300/60 text-xs mb-2" data-admin="week4Date">30/09/24 - 04/10/24</div>
                        <div class="text-blue-400 font-bold text-lg group-hover:text-blue-300" data-admin="week4Gain">
                            +2.12%</div>
                    </button>
                    <button class="card-blue rounded-xl p-4 text-left hover:bg-blue-600/20 transition-all group"
                        data-week="5">
                        <div class="text-blue-200/70 text-xs font-medium mb-1" data-admin="week5Label">Week 5</div>
                        <div class="text-blue-300/60 text-xs mb-2" data-admin="week5Date">07/10/24 - 11/10/24</div>
                        <div class="text-blue-400 font-bold text-lg group-hover:text-blue-300" data-admin="week5Gain">
                            +1.93%</div>
                    </button>
                    <button class="card-blue rounded-xl p-4 text-left hover:bg-blue-600/20 transition-all group"
                        data-week="6">
                        <div class="text-blue-200/70 text-xs font-medium mb-1" data-admin="week6Label">Week 6</div>
                        <div class="text-blue-300/60 text-xs mb-2" data-admin="week6Date">14/10/24 - 18/10/24</div>
                        <div class="text-blue-400 font-bold text-lg group-hover:text-blue-300" data-admin="week6Gain">
                            +2.67%</div>
                    </button>
                    <button class="card-blue rounded-xl p-4 text-left hover:bg-blue-600/20 transition-all group"
                        data-week="7">
                        <div class="text-blue-200/70 text-xs font-medium mb-1" data-admin="week7Label">Week 7</div>
                        <div class="text-blue-300/60 text-xs mb-2" data-admin="week7Date">21/10/24 - 25/10/24</div>
                        <div class="text-blue-400 font-bold text-lg group-hover:text-blue-300" data-admin="week7Gain">
                            +1.45%</div>
                    </button>
                    <button class="card-blue rounded-xl p-4 text-left hover:bg-blue-600/20 transition-all group"
                        data-week="8">
                        <div class="text-blue-200/70 text-xs font-medium mb-1" data-admin="week8Label">Week 8</div>
                        <div class="text-blue-300/60 text-xs mb-2" data-admin="week8Date">28/10/24 - 01/11/24</div>
                        <div class="text-blue-400 font-bold text-lg group-hover:text-blue-300" data-admin="week8Gain">
                            +2.91%</div>
                    </button>
                    <button class="card-blue rounded-xl p-4 text-left hover:bg-blue-600/20 transition-all group"
                        data-week="9">
                        <div class="text-blue-200/70 text-xs font-medium mb-1" data-admin="week9Label">Week 9</div>
                        <div class="text-blue-300/60 text-xs mb-2" data-admin="week9Date">28/10/24 - 01/11/24</div>
                        <div class="text-blue-400 font-bold text-lg group-hover:text-blue-300" data-admin="week9Gain">
                            +1.87%</div>
                    </button>
                    <button class="card-blue rounded-xl p-4 text-left hover:bg-blue-600/20 transition-all group"
                        data-week="10">
                        <div class="text-blue-200/70 text-xs font-medium mb-1" data-admin="week10Label">Week 10</div>
                        <div class="text-blue-300/60 text-xs mb-2" data-admin="week10Date">04/11/24 - 08/11/24</div>
                        <div class="text-blue-400 font-bold text-lg group-hover:text-blue-300" data-admin="week10Gain">
                            +2.34%</div>
                    </button>
                    <button class="card-blue rounded-xl p-4 text-left hover:bg-blue-600/20 transition-all group"
                        data-week="11">
                        <div class="text-blue-200/70 text-xs font-medium mb-1" data-admin="week11Label">Week 11</div>
                        <div class="text-blue-300/60 text-xs mb-2" data-admin="week11Date">11/11/24 - 15/11/24</div>
                        <div class="text-blue-400 font-bold text-lg group-hover:text-blue-300" data-admin="week11Gain">
                            +2.23%</div>
                    </button>
                    <button class="card-blue rounded-xl p-4 text-left hover:bg-blue-600/20 transition-all group"
                        data-week="12">
                        <div class="text-blue-200/70 text-xs font-medium mb-1" data-admin="week12Label">Week 12</div>
                        <div class="text-blue-300/60 text-xs mb-2" data-admin="week12Date">10/11/25 - 14/11/25</div>
                        <div class="text-blue-400 font-bold text-lg group-hover:text-blue-300" data-admin="week12Gain">
                            +1.81%</div>
                    </button>
                    <button class="card-blue rounded-xl p-4 text-left hover:bg-blue-600/20 transition-all group"
                        data-week="last">
                        <div class="text-blue-200/70 text-xs font-medium mb-1" data-admin="lastWeekLabel">Last Week
                        </div>
                        <div class="text-blue-300/60 text-xs mb-2" data-admin="lastWeekDate">17/11/25 - 21/11/25</div>
                        <div class="text-blue-400 font-bold text-lg group-hover:text-blue-300"
                            data-admin="lastWeekGain">
                            +2.01%</div>
                    </button>
                    <button
                        class="card-blue rounded-xl p-4 text-left hover:bg-blue-600/20 transition-all group active bg-blue-600 border-2 border-blue-400"
                        data-week="current">
                        <div class="text-white/90 text-xs font-medium mb-1" data-admin="currentWeekLabel">This Week
                        </div>
                        <div class="text-white/80 text-xs mb-2" data-admin="currentWeekDate">24/11/25 - 28/11/25</div>
                        <div class="text-white font-bold text-lg" data-admin="currentWeekGain">+2.98%</div>
                    </button>
                </div>
            </section>

            <!-- Current Week Summary -->
            <section class="mb-12">
                <div class="card-emerald rounded-2xl p-6 shadow-xl">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
                        <div>
                            <h2 class="text-2xl md:text-3xl font-bold text-white mb-2" data-admin="weekSummaryTitle">
                                Week 24/11/25 - 28/11/25</h2>
                            <p class="text-blue-200/70 text-base" data-admin="accountSize">Account Size: $100,000
                                (Example)</p>
                        </div>
                        <div class="text-center min-w-[300px] shadow-lg bg-blue-600/30 rounded-xl p-4">
                            <div class="text-white/90 text-sm font-medium mb-1" data-admin="netGainLabel">Net Weekly
                                Gain +2.98%</div>
                            <div class="text-emerald-200/70 text-xs" data-admin="endingDate">Ending: Friday, November
                                28, 2025</div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Equity Growth Chart -->
            <section class="mb-12">
                <div class="card-emerald rounded-2xl p-6 shadow-xl">
                    <h2 class="text-2xl md:text-3xl font-bold text-white mb-6" data-admin="chartTitle">This Week Equity
                        Growth</h2>
                    <div
                        class="h-80 bg-blue-900/30 rounded-lg border border-blue-500/20 flex items-center justify-center w-full">
                        <!-- "w-full" on parent for full width, add style for canvas  -->
                        <canvas id="weekEquityGrowthChart"
                            style="width:100% !important; height:100% !important; display:block"></canvas>
                    </div>
                </div>
            </section>

            <!-- Week Overview -->
            <section class="mb-12">
                <div class="card-blue rounded-2xl p-8 shadow-xl">
                    <h2 class="text-2xl md:text-3xl font-bold text-white mb-4" data-admin="overviewTitle">Week Overview
                    </h2>
                    <p class="text-blue-100 text-lg leading-relaxed" data-admin="overviewText">
                        The week unfolded with dynamic price action that demanded both agility and confidence. Strategic
                        scaling into momentum plays and calculated position management resulted in a strong weekly
                        performance.
                    </p>
                </div>
            </section>

            <!-- Performance Breakdown -->
            <section class="mb-12">
                <div class="card-blue rounded-2xl p-8 shadow-xl">
                    <h2 class="text-2xl md:text-3xl font-bold text-white mb-6" data-admin="breakdownTitle">Performance
                        Breakdown</h2>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-10">
                        <div class="bg-blue-900/30 border border-blue-500/20 rounded-xl p-4">
                            <div class="text-blue-200/70 text-sm font-medium mb-2">Total Gain</div>
                            <div class="text-blue-400 text-2xl font-bold" data-admin="totalGain">+2.98%</div>
                        </div>
                        <div class="bg-blue-900/30 border border-blue-500/20 rounded-xl p-4">
                            <div class="text-blue-200/70 text-sm font-medium mb-2">Trade Accuracy</div>
                            <div class="text-blue-400 text-2xl font-bold" data-admin="accuracy">83%</div>
                        </div>
                        <div class="bg-blue-900/30 border border-blue-500/20 rounded-xl p-4">
                            <div class="text-blue-200/70 text-sm font-medium mb-2">Risk-Reward Ratio</div>
                            <div class="text-blue-400 text-2xl font-bold" data-admin="riskReward">2.2</div>
                        </div>
                        <div class="bg-emerald-900/30 border border-emerald-500/20 rounded-xl p-4">
                            <div class="text-emerald-200/70 text-sm font-medium mb-2">Largest Drawdown</div>
                            <div class="text-red-400 text-2xl font-bold" data-admin="drawdown">-1.4%</div>
                        </div>
                    </div>

                    <div class="space-y-8">
                        <div>
                            <h3 class="text-xl font-semibold text-white mb-4" data-admin="marketsTitle">Primary Markets
                                Traded:</h3>
                            <div class="space-y-3">
                                <div
                                    class="bg-blue-900/20 border border-blue-500/10 rounded-lg px-4 py-3 flex items-center justify-between text-white/90">
                                    <span data-admin="market1">XAUUSD</span>
                                    <span class="text-blue-300 font-semibold" data-admin="market1Volume">55% of
                                        volume</span>
                                </div>
                                <div
                                    class="bg-blue-900/20 border border-blue-500/10 rounded-lg px-4 py-3 flex items-center justify-between text-white/90">
                                    <span data-admin="market2">GBPUSD</span>
                                    <span class="text-blue-300 font-semibold" data-admin="market2Volume">27% of
                                        volume</span>
                                </div>
                                <div
                                    class="bg-blue-900/20 border border-blue-500/10 rounded-lg px-4 py-3 flex items-center justify-between text-white/90">
                                    <span data-admin="market3">EURUSD</span>
                                    <span class="text-blue-300 font-semibold" data-admin="market3Volume">18% of
                                        volume</span>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h3 class="text-xl font-semibold text-white mb-4" data-admin="dailySummaryTitle">Daily
                                Performance Summary:</h3>
                            <div class="overflow-hidden rounded-xl border border-blue-500/20 bg-blue-900/20">
                                <div
                                    class="grid grid-cols-3 text-sm font-semibold text-blue-200/70 border-b border-blue-500/20 px-4 py-3">
                                    <span>Day</span>
                                    <span class="text-center">Daily Change</span>
                                    <span class="text-right">Equity Balance</span>
                                </div>
                                <div class="divide-y divide-blue-500/10 text-white/90">
                                    <div class="grid grid-cols-3 px-4 py-3 items-center">
                                        <span>Monday</span>
                                        <span class="text-emerald-400 font-semibold text-center"
                                            data-admin="mondayChange">+1.13%</span>
                                        <span class="text-right" data-admin="mondayEquity">$101,130</span>
                                    </div>
                                    <div class="grid grid-cols-3 px-4 py-3 items-center">
                                        <span>Tuesday</span>
                                        <span class="text-emerald-400 font-semibold text-center"
                                            data-admin="tuesdayChange">+1.04%</span>
                                        <span class="text-right" data-admin="tuesdayEquity">$102,181.75</span>
                                    </div>
                                    <div class="grid grid-cols-3 px-4 py-3 items-center">
                                        <span>Wednesday</span>
                                        <span class="text-emerald-400 font-semibold text-center"
                                            data-admin="wednesdayChange">+1.07%</span>
                                        <span class="text-right" data-admin="wednesdayEquity">$103,275.10</span>
                                    </div>
                                    <div class="grid grid-cols-3 px-4 py-3 items-center">
                                        <span>Thursday</span>
                                        <span class="text-red-400 font-semibold text-center"
                                            data-admin="thursdayChange">-0.30%</span>
                                        <span class="text-right" data-admin="thursdayEquity">$102,965.27</span>
                                    </div>
                                    <div class="grid grid-cols-3 px-4 py-3 items-center">
                                        <span>Friday</span>
                                        <span class="text-emerald-400 font-semibold text-center"
                                            data-admin="fridayChange">+0.04%</span>
                                        <span class="text-right" data-admin="fridayEquity">$103,006.46</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Outlook & Notices -->
            <section class="mb-12">
                <div class="card-blue rounded-2xl p-8 shadow-xl space-y-6">
                    <div class="border border-blue-500/20 rounded-2xl p-6 bg-blue-900/10">
                        <h2 class="text-2xl md:text-3xl font-bold text-white mb-3" data-admin="outlookTitle">Outlook for
                            Next Week</h2>
                        <p class="text-blue-100 text-lg leading-relaxed" data-admin="outlookText">
                            Expecting GBPUSD to show strength with key economic data releases this week. XAUUSD could
                            see
                            profit-taking but maintain overall uptrend. EURUSD projected to remain range-bound pending
                            central bank commentary.
                        </p>
                    </div>

                    <div class="border border-blue-500/20 rounded-2xl p-6 bg-blue-900/10 space-y-3">
                        <p class="text-white text-sm leading-relaxed">
                            <span class="font-semibold text-blue-200" data-admin="nextUpdateLabel">Next Weekly
                                Update:</span>
                            <span class="text-blue-100" data-admin="nextUpdateText">New performance data is published
                                every
                                Friday at 3:00 PM UTC after the trading week concludes.</span>
                        </p>
                        <p class="text-white/90 text-sm leading-relaxed">
                            <span class="font-semibold text-blue-200" data-admin="noticeLabel">Note:</span>
                            <span class="text-blue-100" data-admin="noticeText">Performance data prior to these weeks
                                was not
                                tracked on this platform. All future trading results will continue to be published here
                                for
                                full transparency.</span>
                        </p>
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
                    <strong class="text-blue-200/80">LEGAL DISCLAIMER</strong> — All quantitative performance
                    indicators, statistical analyses, trading results, and any associated data visualizations or
                    informational content displayed are NON-FACTUAL and constitute hypothetical simulations exclusively
                    for demonstrative purposes. No actual transactions occur on this platform, and past performance is
                    not indicative of future results.
                </p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('assets/js/admin-config.js') }}"></script>
    <script src="{{ asset('assets/js/past-performance.js') }}"></script>
</body>

</html>

