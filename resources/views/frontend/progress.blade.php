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
                        class="w-10 h-10 bg-blue-600/20 rounded-lg flex items-center justify-center border border-blue-500/30">
                        <img src="{{ isset($setting) && $setting->logo ? asset($setting->logo) : asset('assets/image/logo.png') }}" alt="Logo" class="w-8 h-8 object-contain" />
                    </div>
                    <span class="text-2xl font-bold text-white" data-admin="brandName">{{ $setting->site_title ?? 'AlgoOne' }}</span>
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
                            <i class="fas fa-exclamation-triangle text-yellow-400 text-2xl mt-1"></i>
                            <p class="text-white font-bold text-lg" data-admin="warningText">
                                {!! $guideline->warning_text !!}
                            </p>
                        </div>
                    </div>
                    @endif

                    <!-- Guidelines List -->
                    <ol class="space-y-4 text-white/90">
                        @for($i = 1; $i <= 7; $i++)
                            @php
                                $title = $guideline->{"guideline{$i}_title"};
                                $text = $guideline->{"guideline{$i}_text"};
                            @endphp
                            @if($title || $text)
                            <li class="flex items-start gap-4">
                                <span
                                    class="flex-shrink-0 w-8 h-8 bg-blue-600/20 rounded-full flex items-center justify-center border border-blue-500/30 font-bold text-blue-400">
                                    {{ $i }}
                                </span>
                                <div>
                                    @if($title)
                                    <p class="font-semibold mb-1" data-admin="guideline{{ $i }}Title">{!! $title !!}</p>
                                    @endif
                                    @if($text)
                                    <p class="text-blue-200/80" data-admin="guideline{{ $i }}Text">{!! $text !!}</p>
                                    @endif
                                </div>
                            </li>
                            @endif
                        @endfor
                    </ol>
                </div>
            </section>
            @endif

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
                            <span class="text-blue-600 font-bold text-lg" data-admin="progressPercentage">{{ $userProgress->progress_percentage ?? 33 }}%</span>
                        </div>
                        <div class="relative" style="height: 24px;">
                            <!-- The blue progress bar, ending under the thumb (ball) -->
                            <div class="absolute left-0 top-1/2 -translate-y-1/2 w-full h-3 bg-gray-200 rounded-full overflow-hidden"></div>
                            <div id="progressFillBar"
                                class="absolute left-0 top-1/2 -translate-y-1/2 h-3 rounded-full"
                                style="background: linear-gradient(90deg, #3577F5 0%, #0B64F4 100%);
                                        width: {{ $userProgress->progress_percentage ?? 33 }}%; min-width: 0; max-width: 100%;">
                            </div>
                            <!-- Custom thumb (ball) -->
                            <div id="progressThumb"
                                class="absolute top-1/2 -translate-y-1/2"
                                style="left: calc({{ $userProgress->progress_percentage ?? 33 }}% - 12px); z-index:20;">
                                <div style="width: 24px; height: 24px; background: #fff; border: 3px solid #3577F5; border-radius: 50%; box-shadow: 0 0 0 2px #fff, 0 2px 8px 0 rgba(53,119,245,0.13);"></div>
                            </div>
                            <!-- Actual range slider (for accessibility/interaction) -->
                            <input type="range" min="0" max="100" value="{{ $userProgress->progress_percentage ?? 33 }}"
                                class="absolute top-0 left-0 w-full h-6 opacity-0 cursor-pointer z-30"
                                id="progressSlider"
                                style="appearance:none; background: transparent;">
                        </div>
                        <p class="text-gray-500 text-xs mt-2" data-admin="sliderInstruction">
                            Drag the slider to explore different progress levels.
                        </p>
                    </div>

                    <!-- Phase Steps -->
                    <div class="space-y-6">
                        @php
                            // Ensure minimum 33% progress (Step 1 completed by default)
                            $progress = max($userProgress->progress_percentage ?? 33, 33);
                            $step1Completed = $progress >= 33; // Step 1 completes at 33% (default completed)
                            $step2Completed = $progress >= 66; // Step 2 completes at 66%
                            $step3Completed = $progress >= 100; // Step 3 completes at 100%
                            $step3InProgress = $progress >= 66 && $progress < 100; // Step 3 in progress between 66-100%
                        @endphp
                        
                        <!-- Step 1: Pass Phase 1 -->
                        <div
                            class="bg-white border-2 {{ $step1Completed ? 'border-green-300' : 'border-gray-200' }} rounded-xl p-6 hover:border-blue-400 transition-all">
                            <div class="flex items-start gap-4">
                                <div
                                    class="flex-shrink-0 w-12 h-12 {{ $step1Completed ? 'bg-green-500' : 'bg-gray-300 border-2 border-gray-400' }} rounded-full flex items-center justify-center">
                                    @if($step1Completed)
                                        <i class="fas fa-check text-white text-xl"></i>
                                    @else
                                        <div class="w-6 h-6 bg-gray-400 rounded-full"></div>
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center gap-3 mb-2">
                                        <h3 class="text-xl font-bold text-gray-900" data-admin="step1Title">Step 1: Pass
                                            Phase 1</h3>
                                        @if($step1Completed)
                                            <span class="bg-green-500 text-white text-xs font-bold px-3 py-1 rounded-full step1-completed"
                                                data-admin="step1Completed">Completed</span>
                                        @elseif($progress > 0 && $progress < 33)
                                            <span class="bg-blue-600 text-white text-xs font-bold px-3 py-1 rounded-full step1-in-progress"
                                                data-admin="step1InProgress">In Progress</span>
                                        @endif
                                    </div>
                                    <p class="text-gray-600 text-sm" data-admin="step1Subtitle">Achieve 10% profit
                                        target.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Step 2: Pass Phase 2 -->
                        <div
                            class="bg-white border-2 {{ $step2Completed ? 'border-green-300' : 'border-gray-200' }} rounded-xl p-6 hover:border-blue-400 transition-all">
                            <div class="flex items-start gap-4">
                                <div
                                    class="flex-shrink-0 w-12 h-12 {{ $step2Completed ? 'bg-green-500' : 'bg-gray-300 border-2 border-gray-400' }} rounded-full flex items-center justify-center">
                                    @if($step2Completed)
                                        <i class="fas fa-check text-white text-xl"></i>
                                    @else
                                        <div class="w-6 h-6 bg-gray-400 rounded-full"></div>
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center gap-3 mb-2">
                                        <h3 class="text-xl font-bold text-gray-900" data-admin="step2Title">Step 2:
                                            Pass Phase 2</h3>
                                        @if($step2Completed)
                                            <span class="bg-green-500 text-white text-xs font-bold px-3 py-1 rounded-full step2-completed"
                                                data-admin="step2Completed">Completed</span>
                                        @elseif($progress >= 33 && $progress < 66)
                                            <span class="bg-blue-600 text-white text-xs font-bold px-3 py-1 rounded-full step2-in-progress"
                                                data-admin="step2InProgress">In Progress</span>
                                        @endif
                                    </div>
                                    <p class="text-gray-600 text-sm" data-admin="step2Subtitle">Achieve 5% profit
                                        target.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Step 3: Live Phase -->
                        <div
                            class="bg-white border-2 {{ $step3Completed || $step3InProgress ? 'border-blue-400' : 'border-gray-200' }} rounded-xl p-6 hover:border-blue-400 transition-all">
                            <div class="flex items-start gap-4">
                                <div
                                    class="flex-shrink-0 w-12 h-12 {{ $step3Completed ? 'bg-green-500' : ($step3InProgress ? 'bg-blue-500' : 'bg-gray-300 border-2 border-gray-400') }} rounded-full flex items-center justify-center">
                                    @if($step3Completed)
                                        <i class="fas fa-check text-white text-xl"></i>
                                    @elseif($step3InProgress)
                                        <i class="fas fa-spinner fa-spin text-white text-xl"></i>
                                    @else
                                        <div class="w-6 h-6 bg-gray-400 rounded-full"></div>
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center gap-3 mb-2">
                                        <h3 class="text-xl font-bold text-gray-900" data-admin="step3Title">Step 3:
                                            Live Phase</h3>
                                        @if($step3Completed)
                                            <span class="bg-green-500 text-white text-xs font-bold px-3 py-1 rounded-full step3-completed"
                                                data-admin="step3Completed">Completed</span>
                                        @endif
                                        @if($step3InProgress || $step3Completed)
                                            <span class="bg-blue-600 text-white text-xs font-bold px-3 py-1 rounded-full step3-in-progress"
                                                data-admin="step3InProgress">In Progress</span>
                                        @endif
                                    </div>
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
        // Progress slider functionality with dynamic step updates
        const progressSlider = document.getElementById('progressSlider');
        const progressFillBar = document.getElementById('progressFillBar');
        const progressThumb = document.getElementById('progressThumb');
        const progressPercentage = document.querySelector('[data-admin="progressPercentage"]');

        function updateStepStatus(progress) {
            const progressValue = parseInt(progress, 10);
            
            // Step 1: Pass Phase 1 (completes at 33%)
            const step1Icon = document.querySelector('.step1-icon') || document.querySelector('[data-admin="step1Title"]')?.closest('.rounded-xl')?.querySelector('.rounded-full');
            const step1Card = document.querySelector('[data-admin="step1Title"]')?.closest('.rounded-xl');
            const step1Completed = step1Card?.querySelector('.step1-completed');
            const step1InProgress = step1Card?.querySelector('.step1-in-progress');
            const step1IconDiv = step1Card?.querySelector('.rounded-full');
            
            // Step 1: Always completed by default (33%+)
            if (progressValue >= 33) {
                // Step 1 Completed
                if (step1IconDiv) {
                    step1IconDiv.className = 'flex-shrink-0 w-12 h-12 bg-green-500 rounded-full flex items-center justify-center';
                    step1IconDiv.innerHTML = '<i class="fas fa-check text-white text-xl"></i>';
                }
                if (step1Card) {
                    step1Card.classList.remove('border-gray-200');
                    step1Card.classList.add('border-green-300');
                }
                if (step1Completed) step1Completed.style.display = 'inline-block';
                if (step1InProgress) step1InProgress.style.display = 'none';
            } else {
                // Step 1 should not be below 33% (default completed), but handle edge case
                if (step1IconDiv) {
                    step1IconDiv.className = 'flex-shrink-0 w-12 h-12 bg-green-500 rounded-full flex items-center justify-center';
                    step1IconDiv.innerHTML = '<i class="fas fa-check text-white text-xl"></i>';
                }
                if (step1Card) {
                    step1Card.classList.remove('border-gray-200');
                    step1Card.classList.add('border-green-300');
                }
                if (step1Completed) step1Completed.style.display = 'inline-block';
                if (step1InProgress) step1InProgress.style.display = 'none';
            }
            
            // Step 2: Pass Phase 2 (completes at 66%)
            const step2Card = document.querySelector('[data-admin="step2Title"]')?.closest('.rounded-xl');
            const step2Completed = step2Card?.querySelector('.step2-completed');
            const step2InProgress = step2Card?.querySelector('.step2-in-progress');
            const step2IconDiv = step2Card?.querySelector('.rounded-full');
            
            if (progressValue >= 66) {
                // Step 2 Completed
                if (step2IconDiv) {
                    step2IconDiv.className = 'flex-shrink-0 w-12 h-12 bg-green-500 rounded-full flex items-center justify-center';
                    step2IconDiv.innerHTML = '<i class="fas fa-check text-white text-xl"></i>';
                }
                if (step2Card) {
                    step2Card.classList.remove('border-gray-200');
                    step2Card.classList.add('border-green-300');
                }
                if (step2Completed) step2Completed.style.display = 'inline-block';
                if (step2InProgress) step2InProgress.style.display = 'none';
            } else if (progressValue >= 33) {
                // Step 2 In Progress
                if (step2IconDiv) {
                    step2IconDiv.className = 'flex-shrink-0 w-12 h-12 bg-gray-300 rounded-full flex items-center justify-center border-2 border-gray-400';
                    step2IconDiv.innerHTML = '<div class="w-6 h-6 bg-gray-400 rounded-full"></div>';
                }
                if (step2Card) {
                    step2Card.classList.remove('border-green-300');
                    step2Card.classList.add('border-gray-200');
                }
                if (step2Completed) step2Completed.style.display = 'none';
                if (step2InProgress) step2InProgress.style.display = 'inline-block';
            } else {
                // Step 2 Not Started (shouldn't happen as Step 1 is default completed at 33%)
                if (step2IconDiv) {
                    step2IconDiv.className = 'flex-shrink-0 w-12 h-12 bg-gray-300 rounded-full flex items-center justify-center border-2 border-gray-400';
                    step2IconDiv.innerHTML = '<div class="w-6 h-6 bg-gray-400 rounded-full"></div>';
                }
                if (step2Card) {
                    step2Card.classList.remove('border-green-300');
                    step2Card.classList.add('border-gray-200');
                }
                if (step2Completed) step2Completed.style.display = 'none';
                if (step2InProgress) step2InProgress.style.display = 'none';
            }
            
            // Step 3: Live Phase (completes at 100%)
            const step3Card = document.querySelector('[data-admin="step3Title"]')?.closest('.rounded-xl');
            const step3Completed = step3Card?.querySelector('.step3-completed');
            const step3InProgress = step3Card?.querySelector('.step3-in-progress');
            const step3IconDiv = step3Card?.querySelector('.rounded-full');
            
            if (progressValue >= 100) {
                // Step 3 Completed
                if (step3IconDiv) {
                    step3IconDiv.className = 'flex-shrink-0 w-12 h-12 bg-green-500 rounded-full flex items-center justify-center';
                    step3IconDiv.innerHTML = '<i class="fas fa-check text-white text-xl"></i>';
                }
                if (step3Card) {
                    step3Card.classList.remove('border-gray-200', 'border-blue-400');
                    step3Card.classList.add('border-blue-400');
                }
                if (step3Completed) step3Completed.style.display = 'inline-block';
                if (step3InProgress) step3InProgress.style.display = 'inline-block';
            } else if (progressValue >= 66) {
                // Step 3 In Progress
                if (step3IconDiv) {
                    step3IconDiv.className = 'flex-shrink-0 w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center';
                    step3IconDiv.innerHTML = '<i class="fas fa-spinner fa-spin text-white text-xl"></i>';
                }
                if (step3Card) {
                    step3Card.classList.remove('border-gray-200');
                    step3Card.classList.add('border-blue-400');
                }
                if (step3Completed) step3Completed.style.display = 'none';
                if (step3InProgress) step3InProgress.style.display = 'inline-block';
            } else {
                // Step 3 Not Started
                if (step3IconDiv) {
                    step3IconDiv.className = 'flex-shrink-0 w-12 h-12 bg-gray-300 rounded-full flex items-center justify-center border-2 border-gray-400';
                    step3IconDiv.innerHTML = '<div class="w-6 h-6 bg-gray-400 rounded-full"></div>';
                }
                if (step3Card) {
                    step3Card.classList.remove('border-blue-400');
                    step3Card.classList.add('border-gray-200');
                }
                if (step3Completed) step3Completed.style.display = 'none';
                if (step3InProgress) step3InProgress.style.display = 'none';
            }
        }

        if (progressSlider && progressFillBar && progressThumb && progressPercentage) {
            // Initialize step status on page load
            updateStepStatus(progressSlider.value);
            
            progressSlider.addEventListener('input', function () {
                const value = parseInt(this.value, 10);
                progressFillBar.style.width = value + '%';
                progressThumb.style.left = `calc(${value}% - 12px)`;
                progressPercentage.textContent = value + '%';
                
                // Update step statuses dynamically
                updateStepStatus(value);
            });
        }
    </script>
</body>

</html>

