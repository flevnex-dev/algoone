<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title data-admin="pageTitle">Past Performance - {{ $setting->site_title ?? '' }}</title>
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
                        class="w-8 h-8 rounded-lg flex items-center justify-center">
                        <img src="{{ isset($setting) && $setting->logo ? asset($setting->logo) : asset('assets/image/logo.png') }}" alt="Logo" />
                    </div>
                    <span class="text-2xl font-bold text-white">{{ $setting->site_title ?? '' }}</span>
                </a>
            </div>
            <div class="hidden md:flex items-center space-x-4">
                <button
                    onclick="window.location.reload()"
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
            @if($pastPerformanceSection)
            <section class="mb-12">
                <div class="card-blue rounded-2xl p-8 shadow-xl">
                    <h2 class="text-2xl md:text-3xl font-bold text-white mb-4" data-admin="transparencyTitle">
                        {{ $pastPerformanceSection->transparency_title ?? 'Transparency in Trading' }}</h2>
                    <p class="text-blue-100 text-lg leading-relaxed mb-4" data-admin="transparencyText">
                        {{ $pastPerformanceSection->transparency_text ?? 'At AlgoOne, we believe in complete transparency. The data you see here represents real prop firm trading performance—no exaggeration, no hidden metrics. Our goal is to empower traders with the tools and transparency they need to make informed decisions. All performance data is from actual prop firm accounts, demonstrating our consistent, reliable trading strategies.' }}
                    </p>
                    <a href="{{ $pastPerformanceSection->view_reports_link ?? '#' }}"
                        class="text-blue-400 hover:text-blue-300 font-semibold text-base inline-flex items-center gap-2 transition-colors">
                        <span data-admin="viewReports">{{ $pastPerformanceSection->view_reports_text ?? 'View detailed MyFxBook reports' }}</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </section>
            @endif

            <!-- Select Trading Week -->
            <section class="mb-12">
                <h2 class="text-2xl md:text-3xl font-bold text-white mb-6" data-admin="weekSelectorTitle">Select Trading
                    Week</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4">
                    @forelse($weeks as $key => $week)
                    <button class="card-blue rounded-xl p-4 text-left hover:bg-blue-600/20 transition-all group week-card {{ $currentWeek && $week->id == $currentWeek->id ? 'active bg-blue-600 border-2 border-blue-400' : '' }}"
                        data-week-id="{{ $week->id }}">
                        <div class="{{ $currentWeek && $week->id == $currentWeek->id ? 'text-white/90' : 'text-blue-200/70' }} text-xs font-medium mb-1">
                            {{ $week->week_label }}
                        </div>
                        <div class="{{ $currentWeek && $week->id == $currentWeek->id ? 'text-white/80' : 'text-blue-300/60' }} text-xs mb-2">
                            {{ $week->start_date->format('d/m/y') }} - {{ $week->end_date->format('d/m/y') }}
                        </div>
                        <div class="{{ $currentWeek && $week->id == $currentWeek->id ? 'text-white' : 'text-blue-400' }} font-bold text-lg group-hover:text-blue-300">
                            {{ $week->total_gain >= 0 ? '+' : '' }}{{ number_format($week->total_gain, 2) }}%
                        </div>
                    </button>
                    @empty
                    <div class="col-span-full text-center text-blue-300/60 py-8">
                        <p>No trading weeks available yet.</p>
                    </div>
                    @endforelse
                </div>
            </section>

            @if($currentWeek)
            <!-- Current Week Summary -->
            <section class="mb-12" id="weekSummarySection">
                <div class="card-emerald rounded-2xl p-6 shadow-xl">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
                        <div>
                            <h2 class="text-2xl md:text-3xl font-bold text-white mb-2" data-admin="weekSummaryTitle">
                                Week {{ $currentWeek->start_date->format('d/m/y') }} - {{ $currentWeek->end_date->format('d/m/y') }}</h2>
                            <p class="text-blue-200/70 text-base" data-admin="accountSize">
                                Account Size: ${{ number_format($currentWeek->account_size, 2) }}
                            </p>
                        </div>
                        <div class="text-center min-w-[300px] shadow-lg bg-blue-600/30 rounded-xl p-4">
                            <div class="text-white/90 text-sm font-medium mb-1" data-admin="netGainLabel">
                                Net Weekly Gain {{ $currentWeek->total_gain >= 0 ? '+' : '' }}{{ number_format($currentWeek->total_gain, 2) }}%
                            </div>
                            <div class="text-emerald-200/70 text-xs" data-admin="endingDate">
                                Ending: {{ $currentWeek->end_date->format('l, F d, Y') }}
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Equity Growth Chart -->
            @if($currentWeek->performanceDetail)
            <section class="mb-12" id="chartSection">
                <div class="card-emerald rounded-2xl p-6 shadow-xl">
                    <h2 class="text-2xl md:text-3xl font-bold text-white mb-6" data-admin="chartTitle">This Week Equity
                        Growth</h2>
                    <div
                        class="h-80 bg-blue-900/30 rounded-lg border border-blue-500/20 flex items-center justify-center w-full">
                        <canvas id="weekEquityGrowthChart"
                            data-chart-labels="{{ json_encode($currentWeek->performanceDetail->chart_labels ?? []) }}"
                            data-chart-data="{{ json_encode($currentWeek->performanceDetail->chart_data ?? []) }}"
                            style="width:100% !important; height:100% !important; display:block">
                        </canvas>
                    </div>
                </div>
            </section>
            @endif
            @endif

            <!-- Week Overview -->
            @if($pastPerformanceSection)
            <section class="mb-12">
                <div class="card-blue rounded-2xl p-8 shadow-xl">
                    <h2 class="text-2xl md:text-3xl font-bold text-white mb-4" data-admin="overviewTitle">{{ $pastPerformanceSection->overview_title ?? 'Week Overview' }}
                    </h2>
                    <p class="text-blue-100 text-lg leading-relaxed" data-admin="overviewText">
                        {{ $pastPerformanceSection->overview_text ?? 'The week unfolded with dynamic price action that demanded both agility and confidence. Strategic scaling into momentum plays and calculated position management resulted in a strong weekly performance.' }}
                    </p>
                </div>
            </section>
            @endif

            @if($currentWeek && $currentWeek->performanceDetail)
            <!-- Performance Breakdown -->
            <section class="mb-12" id="performanceBreakdownSection">
                <div class="card-blue rounded-2xl p-8 shadow-xl">
                    <h2 class="text-2xl md:text-3xl font-bold text-white mb-6" data-admin="breakdownTitle">Performance
                        Breakdown</h2>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-10">
                        <div class="bg-blue-900/30 border border-blue-500/20 rounded-xl p-4">
                            <div class="text-blue-200/70 text-sm font-medium mb-2">Total Gain</div>
                            <div class="text-blue-400 text-2xl font-bold" data-admin="totalGain">
                                {{ $currentWeek->performanceDetail->total_gain >= 0 ? '+' : '' }}{{ number_format($currentWeek->performanceDetail->total_gain, 2) }}%
                            </div>
                        </div>
                        <div class="bg-blue-900/30 border border-blue-500/20 rounded-xl p-4">
                            <div class="text-blue-200/70 text-sm font-medium mb-2">Trade Accuracy</div>
                            <div class="text-blue-400 text-2xl font-bold" data-admin="accuracy">
                                {{ $currentWeek->performanceDetail->trade_accuracy ? number_format($currentWeek->performanceDetail->trade_accuracy, 0) . '%' : 'N/A' }}
                            </div>
                        </div>
                        <div class="bg-blue-900/30 border border-blue-500/20 rounded-xl p-4">
                            <div class="text-blue-200/70 text-sm font-medium mb-2">Risk-Reward Ratio</div>
                            <div class="text-blue-400 text-2xl font-bold" data-admin="riskReward">
                                {{ $currentWeek->performanceDetail->risk_reward_ratio ? number_format($currentWeek->performanceDetail->risk_reward_ratio, 1) : 'N/A' }}
                            </div>
                        </div>
                        <div class="bg-emerald-900/30 border border-emerald-500/20 rounded-xl p-4">
                            <div class="text-emerald-200/70 text-sm font-medium mb-2">Largest Drawdown</div>
                            <div class="text-red-400 text-2xl font-bold" data-admin="drawdown">
                                {{ $currentWeek->performanceDetail->largest_drawdown ? number_format($currentWeek->performanceDetail->largest_drawdown, 2) . '%' : 'N/A' }}
                            </div>
                        </div>
                    </div>

                    <div class="space-y-8">
                        @if($currentWeek->performanceDetail->markets_traded && count($currentWeek->performanceDetail->markets_traded) > 0)
                        <div>
                            <h3 class="text-xl font-semibold text-white mb-4" data-admin="marketsTitle">Primary Markets
                                Traded:</h3>
                            <div class="space-y-3">
                                @foreach($currentWeek->performanceDetail->markets_traded as $market)
                                <div
                                    class="bg-blue-900/20 border border-blue-500/10 rounded-lg px-4 py-3 flex items-center justify-between text-white/90">
                                    <span data-admin="market{{ $loop->index + 1 }}">{{ $market['market'] ?? 'N/A' }}</span>
                                    <span class="text-blue-300 font-semibold" data-admin="market{{ $loop->index + 1 }}Volume">
                                        {{ $market['volume_percentage'] ?? 0 }}% of volume
                                    </span>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        @if($currentWeek->performanceDetail->daily_performance && count($currentWeek->performanceDetail->daily_performance) > 0)
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
                                    @foreach($currentWeek->performanceDetail->daily_performance as $day)
                                    <div class="grid grid-cols-3 px-4 py-3 items-center">
                                        <span>{{ $day['day'] ?? 'N/A' }}</span>
                                        <span class="font-semibold text-center {{ isset($day['change']) && strpos($day['change'], '-') !== false ? 'text-red-400' : 'text-emerald-400' }}"
                                            data-admin="{{ strtolower($day['day'] ?? '') }}Change">
                                            {{ $day['change'] ?? 'N/A' }}
                                        </span>
                                        <span class="text-right" data-admin="{{ strtolower($day['day'] ?? '') }}Equity">
                                            {{ $day['equity'] ?? 'N/A' }}
                                        </span>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </section>
            @endif

            <!-- Outlook & Notices -->
            @if($pastPerformanceSection)
            <section class="mb-12">
                <div class="card-blue rounded-2xl p-8 shadow-xl space-y-6">
                    <div class="border border-blue-500/20 rounded-2xl p-6 bg-blue-900/10">
                        <h2 class="text-2xl md:text-3xl font-bold text-white mb-3" data-admin="outlookTitle">{{ $pastPerformanceSection->outlook_title ?? 'Outlook for Next Week' }}</h2>
                        <p class="text-blue-100 text-lg leading-relaxed" data-admin="outlookText">
                            {{ $pastPerformanceSection->outlook_text ?? 'Expecting GBPUSD to show strength with key economic data releases this week. XAUUSD could see profit-taking but maintain overall uptrend. EURUSD projected to remain range-bound pending central bank commentary.' }}
                        </p>
                    </div>

                    <div class="border border-blue-500/20 rounded-2xl p-6 bg-blue-900/10 space-y-3">
                        <p class="text-white text-sm leading-relaxed">
                            <span class="font-semibold text-blue-200" data-admin="nextUpdateLabel">{{ $pastPerformanceSection->next_update_label ?? 'Next Weekly Update:' }}</span>
                            <span class="text-blue-100" data-admin="nextUpdateText">{{ $pastPerformanceSection->next_update_text ?? 'New performance data is published every Friday at 3:00 PM UTC after the trading week concludes.' }}</span>
                        </p>
                        <p class="text-white/90 text-sm leading-relaxed">
                            <span class="font-semibold text-blue-200" data-admin="noticeLabel">{{ $pastPerformanceSection->notice_label ?? 'Note:' }}</span>
                            <span class="text-blue-100" data-admin="noticeText">{{ $pastPerformanceSection->notice_text ?? 'Performance data prior to these weeks was not tracked on this platform. All future trading results will continue to be published here for full transparency.' }}</span>
                        </p>
                    </div>
                </div>
            </section>
            @endif
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

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    {{--  <script src="{{ asset('assets/js/admin-config.js') }}"></script>  --}}
    <script src="{{ asset('assets/js/past-performance.js') }}"></script>
</body>

</html>

