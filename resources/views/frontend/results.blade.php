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
        .card-blue {
            background: linear-gradient(145deg, #0f172a 0%, #1e293b 100%);
            border: 2px solid rgba(11, 100, 244, 0.3);
        }
        .card-blue:hover {
            border-color: rgba(11, 100, 244, 0.6);
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(11, 100, 244, 0.3);
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
                        class="w-8 h-8  rounded-lg flex items-center justify-center">
                        <img src="{{ asset($setting->logo ?? 'assets/image/logo.png') }}" alt="Logo"/>
                    </div>
                    <span class="text-lg md:text-xl lg:text-2xl font-semibold md:font-bold text-white" >{{ $setting->site_title ?? 'AlgoOne' }}</span>
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
        <section class="py-24">
            <div class="max-w-4xl mx-auto text-center px-4">
                <!-- Badge -->
                <div class="inline-flex items-center gap-2 px-5 py-2 mb-6
                            rounded-full border border-green-500/40
                            bg-green-500/20 text-green-400 font-semibold text-sm shadow">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m5 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    REAL RESULTS • REAL PAYOUTS
                </div>

                <!-- Heading -->
                <h1 class="text-4xl md:text-5xl font-extrabold text-white mb-6">
                    Real Traders. Real
                    <span class="text-blue-400">Payouts</span>
                </h1>

                <!-- Highlight text -->
                <p class="text-blue-300 font-semibold text-lg leading-relaxed mb-6">
                    » Live Payouts, Video Testimonials, Live Client Payout Recordings,
                    Live Stream Recordings, Clients sending Us Our 30% And More!
                </p>

                <!-- Sub text -->
                <p class="text-blue-200/60 text-base mb-10">
                    Everything is visible inside our live Telegram community.
                    We never get paid until payout.
                </p>

                <!-- CTA -->
                <a href="#"
                class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-blue-500 hover:shadow-2xl hover:shadow-blue-500/50
                        text-white px-3 lg:px-4 py-2 lg:py-2.5 rounded-xl font-semibold lg:font-bold text-lg
                        shadow-lg transition hover:scale-[1.02]">
                    Get Started Today
                    <i class="fas fa-arrow-right"></i>
                </a>

            </div>
        </section>

        <!-- ================= Video Testimonials ================= -->
        <section class="mb-20">
            <div class="max-w-7xl mx-auto px-4">
                <div class="flex items-center justify-center gap-3 mb-12">
                    <i class="fas fa-check-circle text-green-400 text-2xl"></i>
                    <h2 class="text-3xl font-bold text-white">
                        Video Testimonials
                    </h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Card -->
                    <div class="module-card rounded-xl shadow p-4">
                        <div class="aspect-video rounded-lg overflow-hidden mb-4">
                            <iframe
                                src="https://www.youtube.com/embed/ysz5S6PUM-U"
                                class="w-full h-full"
                                frameborder="0"
                                allowfullscreen>
                            </iframe>
                        </div>
                        <h4 class="font-semibold text-lg text-white">Chid</h4>
                        <p class="text-blue-200/60 text-sm mt-1">
                            I outsourced a lot of people before, but this finally worked.
                        </p>
                    </div>

                    <div class="module-card rounded-xl shadow p-4">
                        <div class="aspect-video rounded-lg overflow-hidden mb-4">
                            <iframe
                                src="https://www.youtube.com/embed/jNQXAC9IVRw"
                                class="w-full h-full"
                                frameborder="0"
                                allowfullscreen>
                            </iframe>
                        </div>
                        <h4 class="font-semibold text-lg text-white">Candie</h4>
                        <p class="text-blue-200/60 text-sm mt-1">
                            Support is fast and professional. Best experience so far.
                        </p>
                    </div>

                    <div class="module-card rounded-xl shadow p-4">
                        <div class="aspect-video rounded-lg overflow-hidden mb-4">
                            <iframe
                                src="https://www.youtube.com/embed/tgbNymZ7vqY"
                                class="w-full h-full"
                                frameborder="0"
                                allowfullscreen>
                            </iframe>
                        </div>
                        <h4 class="font-semibold text-lg text-white">Roscoe</h4>
                        <p class="text-blue-200/60 text-sm mt-1">
                            Transparency and communication are next level.
                        </p>
                    </div>

                    <div class="module-card rounded-xl shadow p-4">
                        <div class="aspect-video rounded-lg overflow-hidden mb-4">
                            <iframe
                                src="https://www.youtube.com/embed/oUFJJNQGwhk"
                                class="w-full h-full"
                                frameborder="0"
                                allowfullscreen>
                            </iframe>
                        </div>
                        <h4 class="font-semibold text-lg text-white">Elijah</h4>
                        <p class="text-blue-200/60 text-sm mt-1">
                            Everything was smooth. I did not trade myself at all.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- ================= Recorded Live Streams ================= -->
        <section class="mb-20 py-16">
            <div class="max-w-7xl mx-auto px-4">
                <div class="flex items-center justify-center gap-3 mb-12">
                    <i class="fa-solid fa-video text-blue-400 text-2xl"></i>
                    <h2 class="text-3xl font-bold text-white">
                        Recorded Live Streams
                    </h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="module-card rounded-xl shadow overflow-hidden">
                        <div class="aspect-video">
                            <iframe
                                src="https://www.youtube.com/embed/9bZkp7q19f0"
                                class="w-full h-full"
                                frameborder="0"
                                allowfullscreen>
                            </iframe>
                        </div>
                    </div>

                    <div class="module-card rounded-xl shadow overflow-hidden">
                        <div class="aspect-video">
                            <iframe
                                src="https://www.youtube.com/embed/3tmd-ClpJxA"
                                class="w-full h-full"
                                frameborder="0"
                                allowfullscreen>
                            </iframe>
                        </div>
                    </div>

                    <div class="module-card rounded-xl shadow overflow-hidden">
                        <div class="aspect-video">
                            <iframe
                                src="https://www.youtube.com/embed/L_jWHffIx5E"
                                class="w-full h-full"
                                frameborder="0"
                                allowfullscreen>
                            </iframe>
                        </div>
                    </div>

                    <div class="module-card rounded-xl shadow overflow-hidden">
                        <div class="aspect-video">
                            <iframe
                                src="https://www.youtube.com/embed/e-ORhEE9VVg"
                                class="w-full h-full"
                                frameborder="0"
                                allowfullscreen>
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ================= Verified Payout Proofs ================= -->
        <section class="mb-20">
            <div class="max-w-7xl mx-auto px-4">
                <div class="flex items-center justify-center gap-3 mb-12">
                    <i class="fas fa-shield-check text-green-400 text-2xl"></i>
                    <h2 class="text-3xl font-bold text-white">
                        Verified Payout Proofs
                    </h2>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                    <img src="https://placehold.co/400x500/png" class="rounded-xl shadow border border-blue-500/40" />
                    <img src="https://placehold.co/400x500/png" class="rounded-xl shadow border border-blue-500/40" />
                    <img src="https://placehold.co/400x500/png" class="rounded-xl shadow border border-blue-500/40" />
                </div>

                <div class="text-center mt-10">
                    <a href="#"
                        class="inline-flex items-center gap-3 bg-white text-blue-600 px-3 lg:px-6 py-2 lg:py-2.5 rounded-lg font-semibold lg:font-bold hover:scale-[1.02] transition">
                        <span>For More Results Press Here</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </section>

        <!-- ================= Final CTA ================= -->
        <section class="py-16 px-4">
            <div class="banner-blue rounded-2xl max-w-4xl mx-auto text-center py-12 px-8">
                <h2 class="text-3xl md:text-4xl font-bold mb-4 text-white">
                    Ready to Join the Winners?
                </h2>

                <p class="text-blue-100 mb-8">
                    Join hundreds of traders who trust us. We only profit when you profit.
                </p>

                <a href="#"
                    class="inline-flex items-center gap-3 bg-white text-blue-600 px-6 py-3 rounded-lg font-bold hover:bg-gray-100 hover:scale-[1.02] transition">
                    <span>Get Started Today</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </section>
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
</body>
</html>

