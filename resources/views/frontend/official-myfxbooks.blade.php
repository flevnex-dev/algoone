<!DOCTYPE html>
<html lang="en" class="font-montserrat">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title data-admin="pageTitle">Official Myfxbooks - {{ $setting->site_title ?? 'AlgoOne' }}</title>
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

        .card-modern {
            background: linear-gradient(145deg, #0f172a 0%, #1e293b 100%);
            border: 1px solid rgba(11, 100, 244, 0.2);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
        }

        .card-modern:hover {
            border-color: rgba(11, 100, 244, 0.5);
            transform: translateY(-5px);
            box-shadow: 0 12px 40px rgba(11, 100, 244, 0.2);
        }

        .header-blue {
            background: linear-gradient(135deg, #000000 0%, #0f172a 100%);
            border-bottom: 2px solid rgba(11, 100, 244, 0.3);
        }

        .accent-blue {
            color: #0B64F4;
        }

        .bg-blue-glow {
            background: linear-gradient(135deg, rgba(11, 100, 244, 0.1) 0%, rgba(37, 99, 235, 0.1) 100%);
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
                        <img src="{{ isset($setting) && $setting->logo ? asset($setting->logo) : asset('assets/image/logo.png') }}" alt="AlgoOne Logo" class="w-8 h-8 object-contain" />
                    </div>
                    <span class="text-2xl font-bold text-white" >{{ $setting->site_title ?? 'AlgoOne' }}</span>
                </a>
            </div>
            <div class="hidden md:flex items-center space-x-4">
                <a href="{{ route('frontend.index') }}"
                    class="text-blue-400 hover:text-blue-100 text-sm font-medium px-4 py-2 rounded-lg hover:bg-blue-600/10 transition-all flex items-center gap-2">
                    <i class="fas fa-arrow-left"></i>
                    <span>Back to Home</span>
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
            <!-- Verified Badge -->
            @if($officialMyfxbooksSection)
            <div class="flex justify-center mb-6">
                <div
                    class="inline-flex items-center gap-2 bg-blue-glow border border-blue-500/40 rounded-full px-6 py-2">
                    <i class="fas fa-check-circle text-blue-400"></i>
                    <span class="text-blue-300 text-sm font-semibold" data-admin="verifiedBadge">{{ $officialMyfxbooksSection->verified_badge_text ?? 'VERIFIED BY MYFXBOOK' }}</span>
                </div>
            </div>

            <!-- Page Title -->
            <div class="text-center mb-12">
                <h1 class="text-4xl md:text-6xl font-extrabold text-white mb-4" data-admin="pageTitle">{{ $officialMyfxbooksSection->page_title ?? 'Official Myfxbooks' }}</h1>
                <p class="text-blue-200 text-lg md:text-xl max-w-3xl mx-auto" data-admin="pageSubtitle">
                    {{ $officialMyfxbooksSection->page_subtitle ?? 'Designed Specifically for Prop Firms. 100% Rule Compliant. Never Breaks Trading Guidelines.' }}
                </p>
            </div>
            @endif

            <!-- Average Metrics -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12 max-w-4xl mx-auto">
                <div class="card-modern rounded-2xl p-8 text-center">
                    <div class="text-blue-200 text-base font-semibold mb-3" data-admin="metricLabel1">Average Gain
                        Across All Accounts</div>
                    <div class="text-blue-400 text-5xl md:text-6xl font-extrabold" data-admin="metricValue1">
                        {{ $averageGain >= 0 ? '+' : '' }}{{ number_format($averageGain, 2) }}%
                    </div>
                </div>
                <div class="card-modern rounded-2xl p-8 text-center">
                    <div class="text-blue-200 text-base font-semibold mb-3" data-admin="metricLabel2">Average Drawdown
                    </div>
                    <div class="text-blue-400 text-5xl md:text-6xl font-extrabold" data-admin="metricValue2">{{ number_format($averageDrawdown, 2) }}%</div>
                </div>
            </div>

            <!-- Introduction -->
            @if($officialMyfxbooksSection)
            <div class="max-w-4xl mx-auto mb-12 space-y-4 text-center">
                <p class="text-blue-100 text-lg leading-relaxed" data-admin="introText1">
                    {{ $officialMyfxbooksSection->intro_text1 ?? 'Myfxbook is the world\'s most trusted third-party verification platform for trading results.' }}
                </p>
                <p class="text-blue-100 text-lg leading-relaxed" data-admin="introText2">
                    {{ $officialMyfxbooksSection->intro_text2 ?? 'Every account below is independently verified and tracked in real-time. Click any account to view the official Myfxbook link for complete transparency and detailed performance metrics.' }}
                </p>
                <p class="text-blue-300/70 text-sm italic mt-6" data-admin="disclaimerNote">
                    {{ $officialMyfxbooksSection->disclaimer_note ?? '*All accounts shown are demo accounts. Results do not represent real money trading.' }}
                </p>
            </div>
            @endif

            <!-- Performance Cards Grid -->
            @if(isset($accounts) && $accounts->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
                @foreach($accounts as $index => $account)
                <div class="card-modern rounded-2xl p-6 transition-all duration-300">
                    <div class="flex justify-between items-center">
                        <span class="text-[#737b8c] font-semibold">{{ $account->account_number ?? 'Account #' . ($index + 1) }}</span>
                        <div
                            class="flex items-center gap-1.5 bg-blue-600/20 border border-blue-500/40 rounded-full px-3 py-1">
                            <i class="fas fa-check-circle text-blue-400 text-xs"></i>
                            <span class="text-blue-300 text-xs font-semibold">Verified</span>
                        </div>
                    </div>
                    <h4 class="text-white font-semibold mt-2">{{ $account->account_name ?? 'ICMarkets MT4' }}</h4>
                    <div class="mb-3 pt-2">
                        @php
                            $riskClass = 'bg-green-500/20 text-green-400 border-green-500/30';
                            if (str_contains(strtolower($account->risk_label ?? ''), 'medium')) {
                                $riskClass = 'bg-orange-500/20 text-orange-400 border-orange-500/30';
                            }
                            if (str_contains(strtolower($account->risk_label ?? ''), 'high risk')) {
                                $riskClass = 'bg-orange-500/20 text-orange-400 border-orange-500/30';
                            }
                        @endphp
                        <span
                            class="inline-block {{ $riskClass }} text-xs font-semibold px-3 py-1 rounded-full border">
                            {{ $account->risk_label ?? 'Low Risk' }}
                        </span>
                    </div>
                    <p class="text-blue-200/70 text-sm mb-4 leading-relaxed">
                        {{ $account->description ?? 'Trading account with verified performance metrics.' }}
                    </p>
                    <div class="h-52 bg-blue-600/10 rounded-lg mb-4 border border-blue-500/20 relative p-3">
                        <canvas class="account-chart" 
                                data-chart-id="account{{ $account->id }}"
                                data-total-gain="{{ $account->total_gain ?? '0%' }}"
                                data-chart-labels="{{ is_array($account->chart_labels) ? json_encode($account->chart_labels) : json_encode([]) }}"
                                data-chart-data="{{ is_array($account->chart_data) ? json_encode($account->chart_data) : json_encode([]) }}"></canvas>
                    </div>
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <div class="text-blue-300/60 text-xs mb-1">Total Gain</div>
                            <div class="text-blue-400 text-2xl font-bold">{{ $account->total_gain ?? 'N/A' }}</div>
                        </div>
                        <div>
                            <div class="text-blue-300/60 text-xs mb-1">Monthly</div>
                            <div class="text-white text-lg font-semibold">{{ $account->monthly ?? 'N/A' }}</div>
                        </div>
                        <div>
                            <div class="text-blue-300/60 text-xs mb-1">Drawdown</div>
                            <div class="text-white text-lg font-semibold">{{ $account->drawdown ?? 'N/A' }}</div>
                        </div>
                        <div>
                            <div class="text-blue-300/60 text-xs mb-1">Balance</div>
                            <div class="text-white text-lg font-semibold">{{ $account->balance ?? 'N/A' }}</div>
                        </div>
                    </div>
                    <a href="{{ $account->myfxbook_link ?? '#' }}"
                        @if($account->myfxbook_link && $account->myfxbook_link !== '#')
                            target="_blank" rel="noopener noreferrer"
                        @endif
                        class="inline-flex items-center gap-2 text-blue-400 hover:text-blue-300 text-sm font-semibold transition-colors">
                        <span>View on Myfxbook</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
                @endforeach
            </div>
            @else
            <div class="text-center py-12">
                <p class="text-blue-200 text-lg">No accounts available. Please upload accounts from admin panel.</p>
            </div>
            @endif

            <!-- Call to Action -->
            @if($officialMyfxbooksSection)
            <div class="card-modern rounded-3xl p-12 text-center mb-12 max-w-4xl mx-auto">
                <h2 class="text-3xl md:text-4xl font-extrabold text-white mb-4" data-admin="ctaTitle">{{ $officialMyfxbooksSection->cta_title ?? 'Want Results Like These?' }}</h2>
                <p class="text-blue-200 text-lg md:text-xl mb-8 max-w-2xl mx-auto" data-admin="ctaText">
                    {{ $officialMyfxbooksSection->cta_text ?? 'Join hundreds of traders who trust AlgoOne with their prop firm challenges. We only profit when you profit.' }}
                </p>
                <a href="{{ $officialMyfxbooksSection->cta_button_link ?? '#' }}"
                    @if($officialMyfxbooksSection->cta_button_link && $officialMyfxbooksSection->cta_button_link !== '#')
                        target="_blank" rel="noopener noreferrer"
                    @endif
                    class="bg-gradient-to-r from-blue-600 to-blue-500 text-white px-8 py-4 rounded-xl font-bold text-lg hover:shadow-2xl transition-all duration-300 inline-flex items-center gap-3">
                    <span data-admin="ctaButton">{{ $officialMyfxbooksSection->cta_button_text ?? 'Get Started Today' }}</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
            @endif
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-black/50 border-t border-blue-500/20 py-8">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-blue-200/60 text-sm" data-admin="copyright">{{ $setting->copyright_text ?? '© 2025 AlgoOne. All rights reserved.' }}</p>
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

    <script src="{{ asset('assets/js/admin-config.js') }}"></script>
    
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            // Generate chart data for each account from database
            document.querySelectorAll(".account-chart").forEach((canvas) => {
                const chartId = canvas.dataset.chartId;
                if (!chartId || typeof Chart === "undefined") return;

                canvas.style.width = "100%";
                canvas.style.height = "100%";

                const ctx = canvas.getContext("2d");
                
                // Get chart labels and data from database (uploaded via Excel/CSV)
                let chartLabels = [];
                let chartData = [];
                
                try {
                    const labelsJson = canvas.dataset.chartLabels || '[]';
                    const dataJson = canvas.dataset.chartData || '[]';
                    chartLabels = JSON.parse(labelsJson);
                    chartData = JSON.parse(dataJson);
                } catch (e) {
                    console.error('Error parsing chart data:', e);
                }
                
                // If no chart data from database, fallback to calculated data based on total_gain
                if (!chartLabels || chartLabels.length === 0 || !chartData || chartData.length === 0) {
                    // Default labels
                    chartLabels = ["Jul '23", "Sep '23", "Nov '23", "Jan '24", "Apr '24"];
                    
                    // Parse total_gain and calculate progression
                    const totalGainStr = canvas.dataset.totalGain || "0%";
                    const cleanedStr = totalGainStr.replace(/[+\s%]/g, '').trim();
                    const totalGainValue = parseFloat(cleanedStr) || 0;
                    
                    // Generate progression based on TWR formula concept
                    chartData = [
                        0,
                        totalGainValue * 0.15,
                        totalGainValue * 0.35,
                        totalGainValue * 0.60,
                        totalGainValue
                    ];
                }
                
                new Chart(ctx, {
                    type: "line",
                    data: {
                        labels: chartLabels,
                        datasets: [
                            {
                                label: "Growth",
                                data: chartData,
                                borderColor: "#0B64F4",
                                backgroundColor: (context) => {
                                    const { chart } = context;
                                    const { ctx, chartArea } = chart;
                                    if (!chartArea) return null;
                                    const gradient = ctx.createLinearGradient(
                                        0,
                                        chartArea.top,
                                        0,
                                        chartArea.bottom
                                    );
                                    gradient.addColorStop(0, "rgba(11, 100, 244, 0.30)");
                                    gradient.addColorStop(0.5, "rgba(11, 100, 244, 0.15)");
                                    gradient.addColorStop(1, "rgba(11, 100, 244, 0.00)");
                                    return gradient;
                                },
                                fill: true,
                                tension: 0.4,
                                borderWidth: 3,
                                pointRadius: 5,
                                pointHoverRadius: 8,
                                pointBackgroundColor: "#ffffff",
                                pointBorderColor: "#0B64F4",
                                pointBorderWidth: 2,
                                pointHoverBackgroundColor: "#ffffff",
                                pointHoverBorderColor: "#0B64F4",
                                pointHoverBorderWidth: 3,
                            },
                        ],
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false },
                            tooltip: {
                                enabled: true,
                                backgroundColor: "rgba(255, 255, 255, 0.98)",
                                titleColor: "#0f172a",
                                bodyColor: "#0B64F4",
                                borderColor: "rgba(203, 213, 225, 0.5)",
                                borderWidth: 1,
                                padding: 12,
                                cornerRadius: 8,
                                caretSize: 6,
                                displayColors: false,
                                titleFont: { family: "Montserrat", size: 13, weight: "400" },
                                bodyFont: { family: "Montserrat", size: 14, weight: "300" },
                                bodySpacing: 6,
                                callbacks: {
                                    title: (ctx) => (ctx?.length ? ctx[0].label : ""),
                                    label: (ctx) => {
                                        const raw = ctx.parsed?.y;
                                        if (!Number.isFinite(raw))
                                            return `Growth: ${ctx.formattedValue}%`;

                                        const formatted = Number.isInteger(raw) ? raw : raw.toFixed(2);

                                        // Calculate change from previous point
                                        const prev =
                                            ctx.dataIndex > 0
                                                ? ctx.chart.data.datasets[ctx.datasetIndex].data[
                                                    ctx.dataIndex - 1
                                                ]
                                                : null;

                                        if (prev === null || ctx.dataIndex === 0) {
                                            return `Growth: ${formatted}%`;
                                        }

                                        const delta = raw - prev;
                                        const deltaFormatted = Number.isInteger(delta)
                                            ? delta
                                            : delta.toFixed(2);
                                        const sign = delta > 0 ? "+" : "";

                                        return [
                                            `Growth: ${formatted}%`,
                                            `Change: ${sign}${deltaFormatted}%`,
                                        ];
                                    },
                                },
                            },
                        },
                        scales: {
                            x: {
                                display: true,
                                grid: {
                                    display: true,
                                    color: "rgba(148, 163, 184, 0.1)",
                                    drawBorder: false,
                                },
                                ticks: {
                                    color: "rgba(148, 163, 184, 0.8)",
                                    font: { family: "Montserrat", size: 10, weight: "500" },
                                    padding: 8,
                                },
                                border: { display: false },
                            },
                            y: {
                                display: true,
                                beginAtZero: true,
                                grid: {
                                    display: true,
                                    color: "rgba(148, 163, 184, 0.1)",
                                    drawBorder: false,
                                },
                                ticks: {
                                    color: "rgba(148, 163, 184, 0.8)",
                                    font: { family: "Montserrat", size: 11, weight: "500" },
                                    padding: 8,
                                    callback: (value) => `${value}%`,
                                },
                                border: { display: false },
                            },
                        },
                        interaction: {
                            mode: "index",
                            intersect: false,
                        },
                        onHover: (event, activeElements) => {
                            event.native.target.style.cursor = activeElements.length
                                ? "pointer"
                                : "default";
                        },
                        animation: {
                            duration: 1200,
                            easing: "easeInOutQuart",
                        },
                    },
                });
            });
        });
    </script>
</body>

</html>

