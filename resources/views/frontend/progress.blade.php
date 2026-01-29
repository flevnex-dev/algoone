<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title data-admin="pageTitle">Progress - {{ $setting->site_title ?? 'AlgoOne' }}</title>
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

        .card-white {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
        }

        .header-blue {
            background: rgba(15, 23, 42, 0.8);
            backdrop-filter: blur(8px);
            border-bottom: 1px solid rgba(11, 100, 244, 0.2);
        }

        /* Vertical Timeline Styles */
        .timeline-container {
            position: relative;
            padding-left: 3rem;
        }

        .timeline-line {
            position: absolute;
            left: 1.5rem;
            top: 0;
            bottom: 0;
            width: 3px;
            background: rgba(11, 100, 244, 0.1);
            border-radius: 999px;
            overflow: hidden;
        }

        .timeline-line-fill {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 0%;
            background: linear-gradient(to bottom, #3577F5, #0B64F4);
            box-shadow: 0 0 15px rgba(53, 119, 245, 0.5);
            transition: height 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .step-node {
            position: relative;
            margin-bottom: 3rem;
            transition: all 0.3s ease;
        }

        .step-node:last-child {
            margin-bottom: 0;
        }

        .step-indicator {
            position: absolute;
            left: -3rem;
            top: 0;
            width: 3.5rem;
            height: 3.5rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #0f172a;
            border: 2px solid rgba(11, 100, 244, 0.2);
            z-index: 10;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            transform: translateX(-0.25rem); /* Adjust for slightly larger size */
        }

        .step-node.completed .step-indicator {
            background: #10b981;
            border-color: #10b981;
            box-shadow: 0 0 15px rgba(16, 185, 129, 0.4);
        }

        .step-node.in-progress .step-indicator {
            background: #3b82f6;
            border-color: #3b82f6;
            box-shadow: 0 0 20px rgba(59, 130, 246, 0.6);
            transform: scale(1.1);
        }

        .step-card {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 1.25rem;
            padding: 1.5rem;
            transition: all 0.3s ease;
        }

        .step-node.active .step-card {
            background: rgba(59, 130, 246, 0.05);
            border-color: rgba(59, 130, 246, 0.2);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .progress-glow {
            filter: drop-shadow(0 0 8px rgba(53, 119, 245, 0.4));
        }

        /* Slider Customization */
        #progressSlider::-webkit-slider-thumb {
            -webkit-appearance: none;
            width: 24px;
            height: 24px;
            background: #fff;
            border: 4px solid #3b82f6;
            border-radius: 50%;
            cursor: pointer;
            box-shadow: 0 0 15px rgba(59, 130, 246, 0.5);
            transition: all 0.2s ease;
        }

        #progressSlider::-webkit-slider-thumb:hover {
            transform: scale(1.2);
            box-shadow: 0 0 20px rgba(59, 130, 246, 0.8);
        }
    </style>
</head>

<body>
    <!-- Top Banner -->
    @if(isset($topbar) && $topbar)
    <div class="bg-gradient-to-r from-blue-600 via-blue-500 to-blue-600 text-white py-3 relative">
        <div class="absolute inset-0 bg-black/10"></div>
        <div class="container mx-auto px-4 relative z-10">
            <div class="flex items-center justify-center gap-2 text-sm font-medium">
                <span data-admin="banner-text">{!! $topbar->content !!}</span>
                @if($topbar->extra_content)
                <span class="hidden md:inline" data-admin="banner-text-extra">{!! $topbar->extra_content !!}</span>
                @endif
            </div>
        </div>
    </div>
    @endif

    <!-- Header -->
    <header class="header-blue shadow-xl sticky top-0 z-50">
        <nav class="container mx-auto px-4 py-4 flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <a href="{{ route('frontend.index') }}" class="flex items-center space-x-3">
                    <div
                        class="w-8 h-8rounded-lg flex items-center justify-center">
                        <img src="{{ isset($setting) && $setting->logo ? asset($setting->logo) : asset('assets/image/logo.png') }}" alt="Logo" />
                    </div>
                    <span class="text-lg md:text-xl lg:text-2xl font-semibold md:font-bold text-white" >{{ $setting->site_title ?? 'AlgoOne' }}</span>
                </a>
            </div>
            <div class="hidden md:flex items-center space-x-4">
                <a href="{{ route('frontend.official-myfxbooks') }}"
                    class="text-blue-300 hover:text-blue-100 text-sm font-medium px-3 py-2 rounded-lg hover:bg-blue-600/10 transition-all"
                    data-admin="navMyfxbooks">Myfxbooks</a>
                <a href="{{ route('frontend.payout') }}"
                    class="text-blue-300 hover:text-blue-100 text-sm font-medium px-3 py-2 rounded-lg hover:bg-blue-600/10 transition-all"
                    data-admin="navPayouts">Payouts</a>
                <a href="{{ route('frontend.referrals') }}"
                    class="text-blue-300 hover:text-blue-100 text-sm font-medium px-3 py-2 rounded-lg hover:bg-blue-600/10 transition-all"
                    data-admin="navReferrals">Referrals</a>
                <a href="{{ route('frontend.masterclass') }}"
                    class="text-blue-300 hover:text-blue-100 text-sm font-medium px-3 py-2 rounded-lg hover:bg-blue-600/10 transition-all"
                    data-admin="navMasterclass">Masterclass</a>
                <a href="{{ route('frontend.buy-funding') }}"
                    class="text-blue-300 hover:text-blue-100 text-sm font-medium px-3 py-2 rounded-lg hover:bg-blue-600/10 transition-all"
                    data-admin="navBuyFunding">Buy Funding</a>
                
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit"
                        class="text-blue-300 hover:text-blue-100 text-sm font-medium px-3 py-2 rounded-lg hover:bg-blue-600/10 transition-all flex items-center gap-2"
                        data-admin="navSignOut">
                        <span>Sign Out</span>
                        <i class="fas fa-arrow-right"></i>
                    </button>
                </form>
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
                    Welcome back, {{ auth()->user()->name ?? 'Trader' }}!
                </h1>
                <p class="text-blue-200/70 text-lg" data-admin="welcomeSubtitle">
                    Track your progress and see community payouts.
                </p>
            </div>

            <!-- Important Information Section -->
            @if(isset($guideline) && $guideline)
            <section class="mb-12">
                <div class="card-light-blue rounded-2xl p-8 shadow-xl">
                    <div class="flex items-center gap-3 mb-6">
                        <div
                            class="w-10 h-10 bg-blue-600/20 rounded-lg flex items-center justify-center border border-blue-500/30">
                            <i class="fas fa-shield-alt text-blue-400 text-xl"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl md:text-3xl font-bold text-white" data-admin="importantTitle">
                                {{ $guideline->title ?? 'Important Information' }}
                            </h2>
                            @if($guideline->subtitle)
                            <p class="text-blue-200/70 text-sm" data-admin="importantSubtitle">{{ $guideline->subtitle }}</p>
                            @endif
                        </div>
                    </div>

                    @if($guideline->warning_text)
                    <!-- Warning Box -->
                    <div class="bg-blue-600/20 border border-blue-500/40 rounded-xl p-6 mb-8">
                        <div class="flex items-start gap-4">
                            <i class="fas fa-exclamation-triangle text-yellow-400 text-2xl"></i>
                            <p class="text-white font-bold text-lg mt-1" data-admin="warningText">
                                {!! $guideline->warning_text !!}
                            </p>
                        </div>
                    </div>
                    @endif

                    <!-- Guidelines List -->
                    <ol class="space-y-4 text-white/90">
                        @if(is_array($guideline->guidelines))
                            @foreach($guideline->guidelines as $index => $item)
                                @if(!empty($item['title']) || !empty($item['text']))
                                <li class="flex items-start gap-4">
                                    <span
                                        class="flex-shrink-0 w-8 h-8 bg-blue-600/20 rounded-full flex items-center justify-center border border-blue-500/30 font-bold text-blue-400">
                                        {{ $index + 1 }}
                                    </span>
                                    <div>
                                        @if(!empty($item['title']))
                                        <p class="font-semibold mb-1">{!! $item['title'] !!}</p>
                                        @endif
                                        @if(!empty($item['text']))
                                        <p class="text-blue-200/80">{!! $item['text'] !!}</p>
                                        @endif
                                    </div>
                                </li>
                                @endif
                            @endforeach
                        @endif
                    </ol>
                </div>
            </section>
            @endif

            <!-- Redesigned Progress Section -->
            <section class="mb-12">
                <div class="card-white rounded-3xl p-8 md:p-12">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-12">
                        <div>
                            <h2 class="text-3xl md:text-4xl font-black text-white mb-2 tracking-tight" data-admin="progressTitle">
                                Your Progress
                            </h2>
                            <p class="text-blue-200/50 text-base" data-admin="progressSubtitle">
                                Track your journey through the phases
                            </p>
                        </div>
                        <div class="bg-blue-600/10 border border-blue-500/20 px-6 py-3 rounded-2xl backdrop-blur-md">
                            <span class="text-blue-400 font-medium mr-2" data-admin="progressLabel">Current Status:</span>
                            <span class="text-white font-bold text-2xl" data-admin="progressPercentage">{{ $userProgress->progress_percentage ?? 33 }}%</span>
                        </div>
                    </div>

                    <!-- Enhanced Progress Interaction -->
                    <div class="mb-16">
                        <div class="relative pt-6">
                            <!-- Background Track -->
                            <div class="absolute left-0 top-1/2 -translate-y-1/2 w-full h-4 bg-slate-800 rounded-full border border-white/5"></div>
                            
                            <!-- Animated Glow Track -->
                            <div id="progressFillBar"
                                class="absolute left-0 top-1/2 -translate-y-1/2 h-4 rounded-full transition-all duration-500 ease-out progress-glow"
                                style="background: linear-gradient(90deg, #3577F5 0%, #0B64F4 100%);
                                        width: {{ $userProgress->progress_percentage ?? 33 }}%;">
                                <div class="absolute inset-0 bg-white/20 animate-pulse rounded-full"></div>
                            </div>

                            <!-- Interactive Slider -->
                            <input type="range" min="0" max="100" value="{{ $userProgress->progress_percentage ?? 33 }}"
                                class="absolute top-0 left-0 w-full h-12 opacity-0 cursor-pointer z-30"
                                id="progressSlider"
                                style="appearance:none; background: transparent;">
                            
                            <!-- Legend Marks -->
                            <div class="flex justify-between mt-6 px-1">
                                <span class="text-xs font-bold text-slate-500">0%</span>
                                <span class="text-xs font-bold text-slate-500">25%</span>
                                <span class="text-xs font-bold text-slate-500">50%</span>
                                <span class="text-xs font-bold text-slate-500">75%</span>
                                <span class="text-xs font-bold text-slate-500">100%</span>
                            </div>
                        </div>
                    </div>

                    <!-- Vertical Premium Timeline -->
                    <div class="timeline-container max-w-4xl mx-auto">
                        <div class="timeline-line">
                            <div id="timelineFill" class="timeline-line-fill"></div>
                        </div>

                        @php
                            $progress = max($userProgress->progress_percentage ?? 33, 33);
                            $steps = [
                                [
                                    'title' => 'Step 1: Pass Phase 1',
                                    'subtitle' => 'Achieve 10% profit target.',
                                    'threshold' => 33,
                                    'id' => 'step1'
                                ],
                                [
                                    'title' => 'Step 2: Pass Phase 2',
                                    'subtitle' => 'Achieve 5% profit target.',
                                    'threshold' => 66,
                                    'id' => 'step2'
                                ],
                                [
                                    'title' => 'Step 3: Live Phase',
                                    'subtitle' => 'First payout requires 35 trading days',
                                    'requirement' => 'Complete 35 trading days before first payout eligibility.',
                                    'threshold' => 100,
                                    'id' => 'step3'
                                ]
                            ];
                        @endphp

                        @foreach($steps as $index => $step)
                            @php
                                $isCompleted = $progress >= $step['threshold'];
                                $isLastStep = $index === count($steps) - 1;
                                $isInProgress = !$isCompleted && ($index === 0 || $progress >= $steps[$index-1]['threshold']);
                            @endphp
                            
                            <div class="step-node {{ $isCompleted ? 'completed' : ($isInProgress ? 'in-progress' : '') }} {{ $isInProgress ? 'active' : '' }}" 
                                 data-threshold="{{ $step['threshold'] }}" id="{{ $step['id'] }}_container">
                                <div class="step-indicator">
                                    @if($isCompleted)
                                        <i class="fas fa-check text-white text-2xl"></i>
                                    @elseif($isInProgress)
                                        <i class="fas fa-spinner fa-spin text-white text-2xl"></i>
                                    @else
                                        <i class="fas fa-lock text-slate-600 text-lg"></i>
                                    @endif
                                </div>
                                
                                <div class="step-card">
                                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                                        <div>
                                            <div class="flex items-center gap-3 mb-1">
                                                <h3 class="text-xl font-bold text-white" data-admin="{{ $step['id'] }}Title">
                                                    {{ $step['title'] }}
                                                </h3>
                                                @if($isCompleted)
                                                    <span class="bg-emerald-500/20 text-emerald-400 text-[10px] uppercase tracking-widest font-black px-2 py-1 rounded-md border border-emerald-500/30" 
                                                          data-admin="{{ $step['id'] }}Completed">Completed</span>
                                                @elseif($isInProgress)
                                                    <span class="bg-blue-500/20 text-blue-400 text-[10px] uppercase tracking-widest font-black px-2 py-1 rounded-md border border-blue-500/30" 
                                                          data-admin="{{ $step['id'] }}InProgress">In Progress</span>
                                                @endif
                                            </div>
                                            <p class="text-slate-400 text-sm" data-admin="{{ $step['id'] }}Subtitle">{{ $step['subtitle'] }}</p>
                                            @if(isset($step['requirement']))
                                                <p class="text-slate-500 text-xs mt-2 italic" data-admin="{{ $step['id'] }}Requirement">{{ $step['requirement'] }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
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
        // Progress interaction functionality
        const progressSlider = document.getElementById('progressSlider');
        const progressFillBar = document.getElementById('progressFillBar');
        const timelineFill = document.getElementById('timelineFill');
        const progressPercentage = document.querySelector('[data-admin="progressPercentage"]');

        function updateUI(progressValue) {
            progressValue = parseInt(progressValue, 10);
            
            // Update Top Progress Bar
            if (progressFillBar) progressFillBar.style.width = progressValue + '%';
            if (progressPercentage) progressPercentage.textContent = progressValue + '%';

            // Update Vertical Timeline Line
            if (timelineFill) timelineFill.style.height = progressValue + '%';

            // Update Steps
            const steps = [
                { id: 'step1', threshold: 33 },
                { id: 'step2', threshold: 66 },
                { id: 'step3', threshold: 100 }
            ];

            steps.forEach((step, index) => {
                const container = document.getElementById(`${step.id}_container`);
                if (!container) return;

                const indicator = container.querySelector('.step-indicator');
                const badgeContainer = container.querySelector('.flex.items-center.gap-3.mb-1');
                
                const isCompleted = progressValue >= step.threshold;
                const isInProgress = !isCompleted && (index === 0 || progressValue >= steps[index-1].threshold);

                // Reset
                container.classList.remove('completed', 'in-progress', 'active');
                if (indicator) indicator.innerHTML = '<i class="fas fa-lock text-slate-600 text-lg"></i>';
                
                // Clear existing badges
                const existingBadges = container.querySelectorAll('span[data-admin$="Completed"], span[data-admin$="InProgress"]');
                existingBadges.forEach(b => b.remove());

                if (isCompleted) {
                    container.classList.add('completed');
                    if (indicator) indicator.innerHTML = '<i class="fas fa-check text-white text-2xl"></i>';
                    
                    if (badgeContainer) {
                        const badge = document.createElement('span');
                        badge.className = 'bg-emerald-500/20 text-emerald-400 text-[10px] uppercase tracking-widest font-black px-2 py-1 rounded-md border border-emerald-500/30';
                        badge.setAttribute('data-admin', `${step.id}Completed`);
                        badge.textContent = 'Completed';
                        badgeContainer.appendChild(badge);
                    }
                } else if (isInProgress) {
                    container.classList.add('in-progress', 'active');
                    if (indicator) indicator.innerHTML = '<i class="fas fa-spinner fa-spin text-white text-2xl"></i>';
                    
                    if (badgeContainer) {
                        const badge = document.createElement('span');
                        badge.className = 'bg-blue-500/20 text-blue-400 text-[10px] uppercase tracking-widest font-black px-2 py-1 rounded-md border border-blue-500/30';
                        badge.setAttribute('data-admin', `${step.id}InProgress`);
                        badge.textContent = 'In Progress';
                        badgeContainer.appendChild(badge);
                    }
                }
            });
        }

        if (progressSlider) {
            // Initialize
            updateUI(progressSlider.value);
            
            progressSlider.addEventListener('input', function () {
                updateUI(this.value);
            });
        }
    </script>
</body>

</html>

