<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title data-admin="pageTitle">{{ ($masterclass->course_title ?? 'Masterclass Trading Course') }} - {{ $setting->site_title ?? 'AlgoOne' }}</title>
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
        .header-blue {
            background: linear-gradient(135deg, #000000 0%, #0f172a 100%);
            border-bottom: 2px solid rgba(11, 100, 244, 0.4);
        }
        .banner-blue {
            background: linear-gradient(135deg, #0B64F4 0%, #2563EB 100%);
        }
        .module-card {
            background: linear-gradient(145deg, #0f172a 0%, #1e293b 100%);
            border: 2px solid rgba(11, 100, 244, 0.3);
            transition: all 0.3s ease;
        }
        .module-card:hover {
            border-color: rgba(11, 100, 244, 0.6);
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(11, 100, 244, 0.3);
        }
        .video-iframe-wrapper {
            position: relative;
            width: 100%;
            padding-top: 56.25%; /* 16:9 Aspect Ratio */
            margin-bottom: 1rem;
        }
        .video-iframe-wrapper iframe,
        .video-iframe-fallback {
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
            border-radius: 0.5rem;
            border: 1px solid rgba(11,100,244,0.15);
            background: #151e31;
        }
        .logo-overlay {
            position: absolute;
            top: 10px;
            left: 10px;
            z-index: 10;
            background: rgba(0,0,0,0.5);
            padding: 3px 8px 3px 3px;
            border-radius: 7px;
            display: flex;
            align-items: center;
        }
        .logo-overlay img {
            width: 28px;
            height: 28px;
            object-fit: contain;
            display: block;
        }
    </style>
</head>

<body>
    <!-- Limited Time Banner -->
    <div class="banner-blue text-white py-3 text-center">
        <p class="text-sm md:text-base font-semibold" data-admin="bannerText">
            <span class="font-bold">LIMITED TIME:</span> We're covering 30% of fees + BOGO offers! This is the perfect
            time to increase funding!
        </p>
    </div>

    <!-- Header -->
    <header class="header-blue shadow-xl sticky top-0 z-50">
        <nav class="container mx-auto px-4 py-4 flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <a href="{{ route('frontend.index') }}" class="flex items-center space-x-3">
                    <div
                        class="w-10 h-10 bg-blue-600/20 rounded-lg flex items-center justify-center border border-blue-500/30">
                        <img src="{{ asset($setting->logo ?? 'assets/image/logo.png') }}" alt="Logo" class="w-8 h-8 object-contain" />
                    </div>
                    <span class="text-2xl font-bold text-white" >{{ $setting->site_title ?? 'AlgoOne' }}</span>
                </a>
            </div>
            <div class="hidden md:flex items-center space-x-4">
                <a href="{{ route('frontend.buy-funding') }}"
                    class="text-blue-300 hover:text-blue-100 text-sm font-medium px-3 py-2 rounded-lg hover:bg-blue-600/10 transition-all flex items-center gap-2"
                    data-admin="navBuyFunding">
                    <i class="fas fa-briefcase"></i>
                    <span>Buy More Funding</span>
                </a>
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
            <!-- Course Introduction -->
            <div class="mb-12">
                <div class="flex items-center gap-4 mb-6">
                    <div
                        class="w-16 h-16 bg-blue-600/20 rounded-lg flex items-center justify-center border border-blue-500/30">
                        <i class="fas fa-book-open text-blue-400 text-2xl"></i>
                    </div>
                    <div>
                        <h1 class="text-4xl md:text-5xl font-extrabold text-white" data-admin="courseTitle">
                            {{ $masterclass->course_title ?? 'Masterclass Trading Course' }}
                        </h1>
                        @if($masterclass->course_subtitle ?? null)
                        <p class="text-blue-200/80 text-lg mt-2" data-admin="courseSubtitle">
                            {{ $masterclass->course_subtitle }}
                        </p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Course Modules Grid -->
            @if(isset($masterclass) && $masterclass && !empty($masterclass->modules))
            <section class="mb-12">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($masterclass->modules as $index => $module)
                    <div class="module-card rounded-xl p-4">
                        <div class="video-iframe-wrapper">
                            <div class="logo-overlay">
                                <img src="{{ asset($setting->logo ?? 'assets/image/logo.png') }}" alt="Logo" />
                            </div>
                            <iframe src="{{ $module['video_url'] ?? 'https://www.youtube.com/embed/nR32hc8qcpA' }}"
                                title="Module {{ $index + 1 }} Video" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen></iframe>
                        </div>
                        <div class="text-white font-bold text-sm mb-2 {{ ($module['status'] ?? 'pending') == 'completed' ? 'bg-green-500 inline-block px-2 py-1 rounded' : '' }}">
                            {{ $module['title'] ?? 'Module ' . ($index + 1) }}
                            @if(($module['status'] ?? 'pending') == 'completed')
                            <span class="ml-2">DONE</span>
                            @endif
                        </div>
                        @php
                            // Convert embed URL to watch URL for YouTube link
                            $watchUrl = str_replace('/embed/', '/watch?v=', $module['video_url'] ?? 'https://www.youtube.com/embed/nR32hc8qcpA');
                        @endphp
                        <a href="{{ $watchUrl }}" target="_blank" rel="noopener"
                            class="w-full inline-flex items-center justify-center gap-2 bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-semibold transition-all"
                            data-admin="module{{ $index + 1 }}Button">
                            <i class="fab fa-youtube"></i>
                            <span>Watch on YouTube</span>
                        </a>
                    </div>
                    @endforeach
                </div>
            </section>
            @else
            <!-- Fallback: Default modules if no data -->
            <section class="mb-12">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @for($i = 1; $i <= 10; $i++)
                    <div class="module-card rounded-xl p-4">
                        <div class="video-iframe-wrapper">
                            <div class="logo-overlay">
                                <img src="{{ asset($setting->logo ?? 'assets/image/logo.png') }}" alt="Logo" />
                            </div>
                            <iframe src="https://www.youtube.com/embed/nR32hc8qcpA"
                                title="Module {{ $i }} Video" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen></iframe>
                        </div>
                        <div class="text-white font-bold text-sm mb-2">Module {{ $i }}</div>
                        <a href="https://www.youtube.com/watch?v=nR32hc8qcpA" target="_blank" rel="noopener"
                            class="w-full inline-flex items-center justify-center gap-2 bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-semibold transition-all">
                            <i class="fab fa-youtube"></i>
                            <span>Watch on YouTube</span>
                        </a>
                    </div>
                    @endfor
                </div>
            </section>
            @endif

            <!-- Call to Action -->
            @if(isset($masterclass) && $masterclass && $masterclass->cta_button_text)
            <section class="mb-12">
                <div class="text-center">
                    @if($masterclass->cta_button_link)
                    <a href="{{ $masterclass->cta_button_link }}"
                        class="inline-block bg-gradient-to-r from-blue-600 to-blue-500 text-white px-8 py-4 rounded-lg font-bold text-lg hover:shadow-xl hover:shadow-blue-500/50 transition-all shadow-lg"
                        data-admin="ctaButton">
                        {{ $masterclass->cta_button_text }}
                    </a>
                    @else
                    <button
                        class="bg-gradient-to-r from-blue-600 to-blue-500 text-white px-8 py-4 rounded-lg font-bold text-lg hover:shadow-xl hover:shadow-blue-500/50 transition-all shadow-lg"
                        data-admin="ctaButton">
                        {{ $masterclass->cta_button_text }}
                    </button>
                    @endif
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

    {{--  <script src="{{ asset('assets/js/admin-config.js') }}"></script>  --}}
</body>
</html>

