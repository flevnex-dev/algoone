<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title data-admin="pageTitle">Official Payouts - {{ $setting->site_title ?? 'AlgoOne' }}</title>
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background: linear-gradient(180deg, #000000 0%, #0f172a 50%, #1e293b 100%);
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
                        @if(isset($setting) && $setting->logo)
                            <img src="{{ asset($setting->logo) }}" alt="Logo" />
                        @else
                            <img src="{{ asset('assets/image/logo.png') }}" alt="Logo"/>
                        @endif
                    </div>
                    <span class="text-2xl font-bold text-white" >{{ $setting->site_title ?? 'AlgoOne' }}</span>
                </a>
            </div>
            <div class="hidden md:flex items-center space-x-4">
                <a href="{{ route('frontend.index') }}"
                    class="text-blue-300 hover:text-blue-100 text-sm font-medium px-4 py-2 rounded-lg hover:bg-blue-600/10 transition-all flex items-center gap-2">
                    <i class="fas fa-arrow-left"></i>
                    <span data-admin="backButton">Back to Home</span>
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
            <!-- Privacy Banner -->
            <div class="bg-blue-600/20 border border-blue-400/40 rounded-lg px-6 py-4 mb-8 text-center">
                <p class="text-blue-100 text-sm font-medium" data-admin="privacyBanner">
                    NOT ALL DATA IS UPDATED, ONLY PEOPLE WHICH ALLOW US TO SHARE THEIR NAME AND PAYOUT. WE RESPECT
                    PRIVACY
                </p>
            </div>

            <!-- Verified Badge and Title -->
            <div class="text-center mb-12">
                <div
                    class="inline-flex items-center gap-2 bg-green-500/20 border border-green-500/40 rounded-full px-6 py-3 mb-6">
                    <i class="fas fa-check-circle text-green-400"></i>
                    <span class="text-green-400 text-sm font-semibold" data-admin="verifiedBadge">VERIFIED
                        PAYOUTS</span>
                </div>
                <h1 class="text-4xl md:text-6xl font-extrabold text-white mb-4" data-admin="pageTitle">Official Payouts
                </h1>
                <p class="text-blue-200 text-lg md:text-xl max-w-3xl mx-auto" data-admin="pageSubtitle">
                    Complete transparency of all client payouts. Every dollar paid out is tracked and verified.
                </p>
            </div>

            <!-- Key Metrics -->
            <div class="mb-12 space-y-6">
                <!-- Large Top Card -->
                <div class="card-blue rounded-2xl p-8 shadow-xl border-2 border-green-500/40">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <div class="text-blue-200/70 text-sm font-medium mb-3" data-admin="totalPaidLabel">Total
                                Paid Out to Clients</div>
                            <div class="flex items-baseline gap-2">
                                <span class="text-green-400 text-4xl md:text-5xl font-bold">$</span>
                                <span class="text-green-400 text-4xl md:text-5xl font-bold"
                                    data-admin="totalPaid">{{ number_format($totalPaid, 0) }}</span>
                            </div>
                        </div>
                        <div class="flex flex-col justify-center">
                            <div class="text-blue-200/70 text-sm font-medium mb-3" data-admin="sinceLabel">Since January {{ now()->format('Y') }}</div>
                            <div class="text-white text-2xl md:text-3xl font-bold" data-admin="payoutsThisMonth">{{ $payoutsThisMonth }}
                                Payout{{ $payoutsThisMonth != 1 ? 's' : '' }} This Month</div>
                        </div>
                    </div>
                </div>

                <!-- Four Smaller Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="card-blue rounded-2xl p-6 shadow-xl border-2 border-blue-500/40">
                        <div class="flex items-center gap-2 text-blue-200/70 text-sm font-medium mb-3">
                            <i class="fas fa-calendar text-blue-400"></i>
                            <span data-admin="decemberLabel">{{ now()->format('F') }} Total</span>
                        </div>
                        <div class="text-white text-3xl font-bold" data-admin="decemberTotal">${{ number_format($currentMonthTotal, 0) }}</div>
                    </div>
                    <div class="card-blue rounded-2xl p-6 shadow-xl border-2 border-green-500/40">
                        <div class="flex items-center gap-2 text-blue-200/70 text-sm font-medium mb-3">
                            <i class="fas fa-chart-line text-green-400"></i>
                            <span data-admin="averageLabel">Average Payout</span>
                        </div>
                        <div class="text-white text-3xl font-bold" data-admin="averagePayout">${{ number_format($averagePayout, 0) }}</div>
                    </div>
                    <div class="card-blue rounded-2xl p-6 shadow-xl border-2 border-yellow-500/40">
                        <div class="flex items-center gap-2 text-blue-200/70 text-sm font-medium mb-3">
                            <i class="fas fa-trophy text-yellow-400"></i>
                            <span data-admin="highestLabel">Highest Payout</span>
                        </div>
                        <div class="text-white text-3xl font-bold" data-admin="highestPayout">${{ number_format($highestPayout, 0) }}</div>
                    </div>
                    <div class="card-blue rounded-2xl p-6 shadow-xl border-2 border-blue-500/40">
                        <div class="flex items-center gap-2 text-blue-200/70 text-sm font-medium mb-3">
                            <i class="fas fa-users text-blue-400"></i>
                            <span data-admin="totalPayoutsLabel">Total Payouts</span>
                        </div>
                        <div class="text-white text-3xl font-bold" data-admin="totalPayouts">{{ $totalPayouts }}</div>
                    </div>
                </div>
            </div>

            <!-- Payout Performance Charts -->
            <div class="mb-12 space-y-6">
                <div class="card-blue rounded-2xl p-8 shadow-xl border border-blue-500/30">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6 mb-6">
                        <div>
                            <p class="text-blue-200/60 text-sm font-semibold uppercase tracking-wide">Monthly Payout
                                History</p>
                            <h3 class="text-2xl md:text-3xl font-bold text-white mt-1">Monthly Payouts - {{ now()->format('Y') }}</h3>
                            <p class="text-blue-200/70 text-sm md:text-base mt-2">Month-wise payout amounts from January to December {{ now()->format('Y') }}.</p>
                        </div>
                        <div
                            class="flex items-center gap-3 bg-blue-600/15 border border-blue-500/30 rounded-full px-4 py-2">
                            <span
                                class="w-2.5 h-2.5 rounded-full bg-green-400 shadow-[0_0_0_6px_rgba(74,222,128,0.25)]"></span>
                            <span class="text-blue-100 text-sm font-semibold">Updated monthly</span>
                        </div>
                    </div>
                    <div class="h-72 bg-black/40 rounded-2xl border border-blue-500/30 p-4 relative overflow-hidden">
                        <canvas id="cumulativeChart" class="w-full h-full"></canvas>
                    </div>
                </div>
            </div>

            <!-- Detailed Payouts Table -->
            <div class="card-blue rounded-2xl p-8 shadow-xl mb-12">
                <h2 class="text-2xl md:text-3xl font-bold text-white mb-2" data-admin="tableTitle">{{ $latestMonth }}
                    Detailed Payouts</h2>
                <p class="text-blue-300/60 text-sm mb-6" data-admin="tableNote">Note: Only public payouts are displayed here</p>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-blue-500/30">
                                <th class="text-left text-blue-200/70 font-semibold py-4 px-4"
                                    data-admin="tableHeader1">Name</th>
                                <th class="text-left text-blue-200/70 font-semibold py-4 px-4"
                                    data-admin="tableHeader2">Date</th>
                                <th class="text-left text-blue-200/70 font-semibold py-4 px-4"
                                    data-admin="tableHeader3">Country</th>
                                <th class="text-right text-blue-200/70 font-semibold py-4 px-4"
                                    data-admin="tableHeader4">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($latestMonthPayouts as $payout)
                            <tr class="border-b border-blue-500/10">
                                <td class="text-white font-medium py-4 px-4" data-admin="payoutName">{{ $payout->name ?? 'N/A' }}</td>
                                <td class="text-blue-200/80 py-4 px-4" data-admin="payoutDate">{{ $payout->payout_date->format('M d, Y') }}</td>
                                <td class="text-blue-200/80 py-4 px-4" data-admin="payoutCountry">{{ $payout->country ?? 'N/A' }}</td>
                                <td class="text-green-400 text-right font-bold py-4 px-4" data-admin="payoutAmount">
                                    ${{ number_format($payout->amount, 2) }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center text-blue-200/60 py-8">No payouts available for this month</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-slate-900/50 border-t border-blue-500/20 py-8">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-blue-200/60 text-sm" >
                    @if(isset($setting) && $setting->copyright_text)
                        {{ $setting->copyright_text }}
                    @else
                        © {{ date('Y') }} {{ $setting->site_title ?? 'AlgoOne' }}. All rights reserved.
                    @endif
                </p>
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
            @else
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
            @endif
        </div>
    </footer>

    {{--  <script src="{{ asset('assets/js/admin-config.js') }}"></script>  --}}
    <script src="{{ asset('assets/js/charts.js') }}"></script>
    
    <script>
        // Pass chart data to JavaScript
        window.payoutChartData = @json($cumulativeData);
        window.payoutTotalPaid = {{ $totalPaid }};
        window.payoutStats = {
            totalPayouts: {{ $totalPayouts }},
            averagePayout: {{ $averagePayout }},
            highestPayout: {{ $highestPayout }},
            currentMonthTotal: {{ $currentMonthTotal }},
            payoutsThisMonth: {{ $payoutsThisMonth }}
        };
    </script>
    
    <script src="{{ asset('assets/js/payout.js') }}"></script>
</body>

</html>

