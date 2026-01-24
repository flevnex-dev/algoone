<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title data-admin="pageTitle">Buy Funding - {{ $setting->site_title ?? 'AlgoOne' }}</title>
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

        .comparison-card {
            background: linear-gradient(145deg, #0f172a 0%, #1e293b 100%);
            border: 2px solid rgba(11, 100, 244, 0.3);
            transition: all 0.3s ease;
        }

        .comparison-card:hover {
            border-color: rgba(11, 100, 244, 0.6);
            box-shadow: 0 10px 30px rgba(11, 100, 244, 0.3);
        }

        .account-section {
            background: linear-gradient(145deg, rgba(11, 100, 244, 0.1) 0%, rgba(11, 100, 244, 0.05) 100%);
            border: 1px solid rgba(11, 100, 244, 0.2);
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
                        class="w-10 h-10 rounded-lg flex items-center justify-center border border-blue-500/30">
                        <img src="{{ asset($setting->logo ?? 'assets/image/logo.png') }}" alt="Logo" class="w-8 h-8" />
                    </div>
                    <span class="text-2xl font-bold text-white" >{{ $setting->site_title ?? 'AlgoOne' }}</span>
                </a>
            </div>
            <div class="hidden md:flex items-center space-x-4">
                <a href="{{ route('frontend.index') }}"
                    class="text-blue-300 hover:text-blue-100 text-sm font-medium px-3 py-2 rounded-lg hover:bg-blue-600/10 transition-all flex items-center gap-2"
                    data-admin="navProgress">
                    <i class="fas fa-chart-line"></i>
                    <span>Progress</span>
                </a>
                <a href="{{ route('frontend.official-myfxbooks') }}"
                    class="text-blue-300 hover:text-blue-100 text-sm font-medium px-3 py-2 rounded-lg hover:bg-blue-600/10 transition-all flex items-center gap-2"
                    data-admin="navMyfxbooks">
                    <i class="fas fa-book"></i>
                    <span>Myfxbooks</span>
                </a>
                <a href="{{ route('frontend.payout') }}"
                    class="text-blue-300 hover:text-blue-100 text-sm font-medium px-3 py-2 rounded-lg hover:bg-blue-600/10 transition-all flex items-center gap-2"
                    data-admin="navPayouts">
                    <i class="fas fa-money-bill-wave"></i>
                    <span>Payouts</span>
                </a>
                <a href="{{ route('frontend.referrals') }}"
                    class="text-blue-300 hover:text-blue-100 text-sm font-medium px-3 py-2 rounded-lg hover:bg-blue-600/10 transition-all flex items-center gap-2"
                    data-admin="navReferrals">
                    <i class="fas fa-users"></i>
                    <span>Referrals</span>
                </a>
                <a href="{{ route('frontend.masterclass') }}"
                    class="text-blue-300 hover:text-blue-100 text-sm font-medium px-3 py-2 rounded-lg hover:bg-blue-600/10 transition-all flex items-center gap-2"
                    data-admin="navMasterclass">
                    <i class="fas fa-graduation-cap"></i>
                    <span>Masterclass</span>
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
                <h1 class="text-5xl md:text-6xl font-extrabold text-blue-400 mb-4" data-admin="mainTitle">
                    {{ $buyFunding->main_title ?? 'More Funding = More Profits' }}
                </h1>
                @if($buyFunding->main_subtitle ?? null)
                <p class="text-blue-200/80 text-xl max-w-3xl mx-auto" data-admin="mainSubtitle">
                    {{ $buyFunding->main_subtitle }}
                </p>
                @endif
            </div>

            <!-- Comparison Cards Section -->
            <section class="mb-12">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Small vs Medium Account -->
                    <div class="comparison-card rounded-xl p-6">
                        <div class="account-section rounded-lg p-6 mb-4 relative">
                            <div class="flex items-center justify-between mb-2">
                                <h3 class="text-2xl font-bold text-white" data-admin="smallAccountTitle">
                                    {{ $buyFunding->comparison1_small_account_title ?? '$5,000 Account' }}
                                </h3>
                                <i class="fas fa-chart-line text-blue-400 text-xl"></i>
                            </div>
                            <div class="mt-4">
                                <p class="text-blue-200/70 text-sm mb-1" data-admin="smallAccountLabel">
                                    {{ $buyFunding->comparison1_small_account_label ?? 'Profit per 5% gain' }}
                                </p>
                                <p class="text-4xl font-bold text-blue-400" data-admin="smallAccountProfit">
                                    {{ $buyFunding->comparison1_small_account_profit ?? '$250' }}
                                </p>
                            </div>
                        </div>

                        <div class="flex justify-center my-4">
                            <i class="fas fa-arrow-down text-blue-400 text-2xl"></i>
                        </div>

                        <div class="account-section rounded-lg p-6 relative">
                            <div class="flex items-center justify-between mb-2">
                                <h3 class="text-2xl font-bold text-white" data-admin="mediumAccountTitle">
                                    {{ $buyFunding->comparison1_medium_account_title ?? '$100,000 Account' }}
                                </h3>
                                <i class="fas fa-chart-line text-blue-400 text-xl"></i>
                            </div>
                            <div class="mt-4">
                                <p class="text-blue-200/70 text-sm mb-1" data-admin="mediumAccountLabel">
                                    {{ $buyFunding->comparison1_medium_account_label ?? 'Profit per 5% gain' }}
                                </p>
                                <p class="text-4xl font-bold text-blue-400" data-admin="mediumAccountProfit">
                                    {{ $buyFunding->comparison1_medium_account_profit ?? '$5,000' }}
                                </p>
                            </div>
                        </div>

                        @if($buyFunding->comparison1_button_text ?? null)
                        <button
                            class="w-full mt-6 bg-gradient-to-r from-blue-600 to-blue-500 text-white px-6 py-4 rounded-lg font-bold text-lg hover:shadow-xl hover:shadow-blue-500/50 transition-all shadow-lg"
                            data-admin="smallMediumButton">
                            {{ $buyFunding->comparison1_button_text }}
                        </button>
                        @endif
                    </div>

                    <!-- Medium vs Large Account -->
                    <div class="comparison-card rounded-xl p-6">
                        <div class="account-section rounded-lg p-6 mb-4 relative">
                            <div class="flex items-center justify-between mb-2">
                                <h3 class="text-2xl font-bold text-white" data-admin="mediumAccountTitle2">
                                    {{ $buyFunding->comparison2_medium_account_title ?? '$100,000 Account' }}
                                </h3>
                                <i class="fas fa-chart-line text-blue-400 text-xl"></i>
                            </div>
                            <div class="mt-4">
                                <p class="text-blue-200/70 text-sm mb-1" data-admin="mediumAccountLabel2">
                                    {{ $buyFunding->comparison2_medium_account_label ?? 'Profit per 5% gain' }}
                                </p>
                                <p class="text-4xl font-bold text-blue-400" data-admin="mediumAccountProfit2">
                                    {{ $buyFunding->comparison2_medium_account_profit ?? '$5,000' }}
                                </p>
                            </div>
                        </div>

                        <div class="flex justify-center my-4">
                            <i class="fas fa-arrow-down text-blue-400 text-2xl"></i>
                        </div>

                        <div class="account-section rounded-lg p-6 relative">
                            <div class="flex items-center justify-between mb-2">
                                <h3 class="text-2xl font-bold text-white" data-admin="largeAccountTitle">
                                    {{ $buyFunding->comparison2_large_account_title ?? '$400,000 Account' }}
                                </h3>
                                <i class="fas fa-chart-line text-blue-400 text-xl"></i>
                            </div>
                            <div class="mt-4">
                                <p class="text-blue-200/70 text-sm mb-1" data-admin="largeAccountLabel">
                                    {{ $buyFunding->comparison2_large_account_label ?? 'Profit per 5% gain' }}
                                </p>
                                <p class="text-4xl font-bold text-blue-400" data-admin="largeAccountProfit">
                                    {{ $buyFunding->comparison2_large_account_profit ?? '$20,000' }}
                                </p>
                            </div>
                        </div>

                        @if($buyFunding->comparison2_button_text ?? null)
                        <button
                            class="w-full mt-6 bg-gradient-to-r from-blue-600 to-blue-500 text-white px-6 py-4 rounded-lg font-bold text-lg hover:shadow-xl hover:shadow-blue-500/50 transition-all shadow-lg"
                            data-admin="mediumLargeButton">
                            {{ $buyFunding->comparison2_button_text }}
                        </button>
                        @endif
                    </div>
                </div>
            </section>

            <!-- Chart Section -->
            <section class="mb-12">
                <div class="card-blue rounded-xl p-8">
                    <h2 class="text-3xl font-bold text-white mb-2 text-center" data-admin="chartTitle">
                        {{ $buyFunding->chart_title ?? 'Account Size vs Profit Potential' }}
                    </h2>
                    @if($buyFunding->chart_subtitle ?? null)
                    <p class="text-blue-200/70 text-center mb-8" data-admin="chartSubtitle">
                        {{ $buyFunding->chart_subtitle }}
                    </p>
                    @endif
                    <div class="h-96 mb-6">
                        <canvas id="profitChart"></canvas>
                    </div>
                    @if($buyFunding->chart_conclusion ?? null)
                    <p class="text-blue-200/80 text-center text-lg" data-admin="chartConclusion">
                        {{ $buyFunding->chart_conclusion }}
                    </p>
                    @endif
                </div>
            </section>

            <!-- Call to Action Section -->
            <section class="mb-12">
                <div class="card-light-blue rounded-xl p-8 border-2 border-blue-500/40">
                    <div class="text-center">
                        @if($buyFunding->cta_title ?? null)
                        <h2 class="text-3xl font-bold text-white mb-3" data-admin="ctaTitle">
                            {{ $buyFunding->cta_title }}
                        </h2>
                        @endif
                        @if($buyFunding->cta_subtitle ?? null)
                        <p class="text-blue-200/80 text-xl mb-8" data-admin="ctaSubtitle">
                            {{ $buyFunding->cta_subtitle }}
                        </p>
                        @endif
                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            @if($buyFunding->cta_button1_text ?? null)
                            <button
                                class="bg-transparent border-2 border-blue-500 text-blue-400 px-8 py-4 rounded-lg font-bold text-lg hover:bg-blue-500/10 transition-all"
                                data-admin="ctaButton1">
                                {{ $buyFunding->cta_button1_text }}
                            </button>
                            @endif
                            @if($buyFunding->cta_button2_text ?? null)
                            <a href="{{ $buyFunding->cta_button2_link ?? '#' }}"
                                class="bg-gradient-to-r from-blue-600 to-blue-500 text-white px-8 py-4 rounded-lg font-bold text-lg hover:shadow-xl hover:shadow-blue-500/50 transition-all shadow-lg flex items-center justify-center gap-2"
                                data-admin="ctaButton2">
                                <span>{{ $buyFunding->cta_button2_text }}</span>
                                <i class="fas fa-arrow-right"></i>
                            </a>
                            @endif
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

    {{--  <script src="{{ asset('assets/js/admin-config.js') }}"></script>  --}}
    <script>
        // Chart.js Configuration - Dynamic Data
        const ctx = document.getElementById('profitChart');
        @php
            $chartLabels = $buyFunding->chart_data['labels'] ?? ['$5k', '$10k', '$25k', '$50k', '$100k', '$200k', '$300k', '$400k'];
            $chartData = $buyFunding->chart_data['data'] ?? [250, 500, 1250, 2500, 5000, 10000, 15000, 20000];
        @endphp
        const chartLabels = @json($chartLabels);
        const chartData = @json($chartData);
        const maxValue = Math.max(...chartData);
        const stepSize = Math.ceil(maxValue / 4);
        
        const profitChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: chartLabels,
                datasets: [{
                    label: 'Profit Potential',
                    data: chartData,
                    backgroundColor: 'rgba(139, 92, 246, 0.8)',
                    borderColor: 'rgba(139, 92, 246, 1)',
                    borderWidth: 2,
                    borderRadius: 8,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(15, 23, 42, 0.9)',
                        titleColor: '#fff',
                        bodyColor: '#e0e7ff',
                        borderColor: 'rgba(11, 100, 244, 0.5)',
                        borderWidth: 1,
                        padding: 12,
                        callbacks: {
                            label: function (context) {
                                return 'Profit: $' + context.parsed.y.toLocaleString();
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: maxValue,
                        ticks: {
                            stepSize: stepSize,
                            color: '#94a3b8',
                            font: {
                                family: 'Montserrat',
                                size: 12
                            },
                            callback: function (value) {
                                return '$' + (value / 1000) + 'k';
                            }
                        },
                        grid: {
                            color: 'rgba(148, 163, 184, 0.1)'
                        }
                    },
                    x: {
                        ticks: {
                            color: '#94a3b8',
                            font: {
                                family: 'Montserrat',
                                size: 12,
                                weight: '600'
                            }
                        },
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    </script>
</body>

</html>

