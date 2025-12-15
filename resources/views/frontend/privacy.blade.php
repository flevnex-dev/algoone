<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title data-admin="pageTitle">Privacy Policy - AlgoOne</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="{{ asset('assets/js/tailwind.config.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background: linear-gradient(135deg, #000000 0%, #0f172a 50%, #000000 100%);
            min-height: 100vh;
        }
        .content-card {
            background: linear-gradient(145deg, rgba(15, 23, 42, 0.95) 0%, rgba(0, 0, 0, 0.95) 100%);
            border: 2px solid rgba(11, 100, 244, 0.3);
            backdrop-filter: blur(10px);
        }
        .content-card:hover {
            border-color: rgba(11, 100, 244, 0.5);
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(11, 100, 244, 0.2);
        }
        .header-blue {
            background: linear-gradient(135deg, #000000 0%, #0f172a 100%);
            border-bottom: 2px solid rgba(11, 100, 244, 0.3);
        }
    </style>
</head>

<body>
    <!-- Animated Background -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-0 right-0 w-96 h-96 bg-blue-600/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl"></div>
    </div>

    <!-- Header -->
    <header class="header-blue shadow-xl sticky top-0 z-50">
        <nav class="container mx-auto px-4 py-4 flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <a href="{{ route('frontend.index') }}" class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-600 to-blue-500 rounded-xl flex items-center justify-center shadow-lg border border-blue-500/30">
                        <img src="{{ asset('assets/image/logo.png') }}" alt="Logo" class="w-10 h-10 object-contain" />
                    </div>
                    <span class="text-2xl font-bold text-white" data-admin="brandName">AlgoOne</span>
                </a>
            </div>
            <a href="{{ route('frontend.index') }}" class="text-blue-300 hover:text-blue-100 text-sm font-medium px-4 py-2 rounded-lg hover:bg-blue-600/10 transition-all border border-blue-500/30 flex items-center gap-2">
                <i class="fas fa-arrow-left"></i>
                <span data-admin="backButton">Back to Home</span>
            </a>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="py-12 relative z-10">
        <div class="container mx-auto px-4 max-w-5xl">
            <!-- Page Title -->
            <div class="mb-12 text-center">
                <div class="inline-flex items-center gap-2 bg-blue-600/20 border border-blue-500/40 rounded-full px-6 py-3 mb-6">
                    <i class="fas fa-shield-alt text-blue-400"></i>
                    <span class="text-blue-400 text-sm font-semibold uppercase tracking-wide">PRIVACY & SECURITY</span>
                </div>
                <h1 class="text-5xl md:text-6xl font-extrabold text-white mb-4" data-admin="pageTitle">Privacy Policy</h1>
                <p class="text-blue-300/70 text-lg" data-admin="lastUpdated">Last Updated: November 13, 2025</p>
            </div>

            <!-- Content Sections - Card Grid Style -->
            <div class="grid md:grid-cols-2 gap-6">
                <!-- Section 1 -->
                <section class="content-card rounded-2xl p-8 shadow-xl">
                    <div class="w-14 h-14 rounded-xl bg-blue-600/20 flex items-center justify-center border border-blue-500/30 mb-4">
                        <i class="fas fa-info-circle text-blue-400 text-2xl"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-white mb-4" data-admin="section1Title">1. Introduction</h2>
                    <p class="text-blue-200/90 leading-relaxed" data-admin="section1Text">
                        AlgoOne ("we," "our," or "us") is committed to protecting your privacy. This Privacy Policy explains how we collect, use, and safeguard your personal information when you use our services for managing virtual demo trading accounts.
                    </p>
                </section>

                <!-- Section 2 -->
                <section class="content-card rounded-2xl p-8 shadow-xl">
                    <div class="w-14 h-14 rounded-xl bg-blue-600/20 flex items-center justify-center border border-blue-500/30 mb-4">
                        <i class="fas fa-database text-blue-400 text-2xl"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-white mb-4" data-admin="section2Title">2. Information We Collect</h2>
                    <p class="text-blue-200/90 mb-3" data-admin="section2Intro">To provide our demo account management services, we collect:</p>
                    <ul class="list-disc list-inside space-y-2 text-blue-200/80 ml-2" data-admin="section2List">
                        <li>Personal identification information</li>
                        <li>Account credentials for demo platforms</li>
                        <li>Trading performance data</li>
                        <li>Communication records</li>
                        <li>Usage data and analytics</li>
                    </ul>
                </section>

                <!-- Section 3 -->
                <section class="content-card rounded-2xl p-8 shadow-xl">
                    <div class="w-14 h-14 rounded-xl bg-blue-600/20 flex items-center justify-center border border-blue-500/30 mb-4">
                        <i class="fas fa-cogs text-blue-400 text-2xl"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-white mb-4" data-admin="section3Title">3. How We Use Your Information</h2>
                    <p class="text-blue-200/90 mb-3" data-admin="section3Intro">We use the information we collect for:</p>
                    <ul class="list-disc list-inside space-y-2 text-blue-200/80 ml-2" data-admin="section3List">
                        <li>Manage virtual demo trading accounts</li>
                        <li>Track performance metrics</li>
                        <li>Communicate about account status</li>
                        <li>Provide customer support</li>
                        <li>Improve our services</li>
                        <li>Comply with legal obligations</li>
                    </ul>
                </section>

                <!-- Section 4 -->
                <section class="content-card rounded-2xl p-8 shadow-xl md:col-span-2">
                    <div class="w-14 h-14 rounded-xl bg-blue-600/20 flex items-center justify-center border border-blue-500/30 mb-4">
                        <i class="fas fa-exclamation-circle text-blue-400 text-2xl"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-white mb-4" data-admin="section4Title">4. Operational Parameters Disclosure</h2>
                    <div class="bg-blue-600/10 border border-blue-500/30 rounded-xl p-6 my-4">
                        <h3 class="text-lg font-semibold text-blue-200 mb-3" data-admin="section4Subtitle">Simulated Trading Infrastructure</h3>
                        <p class="text-blue-200/90" data-admin="section4Text">
                            All transactional interfaces on our platform are virtualized demonstration environments. Accumulated datasets and performance indicators are expressly non-representative of tangible monetary instruments, actualized capital appreciation, or prospective yield assurances. Antecedent simulated performance metrics have negligible correlation to subsequent outcomes in live capital deployment scenarios.
                        </p>
                    </div>
                </section>

                <!-- Section 5 -->
                <section class="content-card rounded-2xl p-8 shadow-xl">
                    <div class="w-14 h-14 rounded-xl bg-blue-600/20 flex items-center justify-center border border-blue-500/30 mb-4">
                        <i class="fas fa-lock text-blue-400 text-2xl"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-white mb-4" data-admin="section5Title">5. Data Security</h2>
                    <p class="text-blue-200/90 leading-relaxed" data-admin="section5Text">
                        We implement industry-standard security measures, including encryption, secure servers, and access controls, to protect your personal information. However, no method of transmission over the internet is 100% secure, and we cannot guarantee absolute security.
                    </p>
                </section>

                <!-- Section 6 -->
                <section class="content-card rounded-2xl p-8 shadow-xl">
                    <div class="w-14 h-14 rounded-xl bg-blue-600/20 flex items-center justify-center border border-blue-500/30 mb-4">
                        <i class="fas fa-share-alt text-blue-400 text-2xl"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-white mb-4" data-admin="section6Title">6. Data Sharing</h2>
                    <p class="text-blue-200/90 mb-3" data-admin="section6Intro">We do not sell your personal information. We may share with:</p>
                    <ul class="list-disc list-inside space-y-2 text-blue-200/80 ml-2" data-admin="section6List">
                        <li>Third-party demo trading platforms</li>
                        <li>Service providers</li>
                        <li>Legal authorities when required</li>
                    </ul>
                </section>

                <!-- Section 7 -->
                <section class="content-card rounded-2xl p-8 shadow-xl">
                    <div class="w-14 h-14 rounded-xl bg-blue-600/20 flex items-center justify-center border border-blue-500/30 mb-4">
                        <i class="fas fa-user-shield text-blue-400 text-2xl"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-white mb-4" data-admin="section7Title">7. Your Rights</h2>
                    <p class="text-blue-200/90 mb-3" data-admin="section7Intro">You have the following rights:</p>
                    <ul class="list-disc list-inside space-y-2 text-blue-200/80 ml-2" data-admin="section7List">
                        <li>Access your personal information</li>
                        <li>Request correction</li>
                        <li>Request deletion</li>
                        <li>Opt-out of marketing</li>
                        <li>Withdraw consent</li>
                    </ul>
                </section>

                <!-- Section 8 -->
                <section class="content-card rounded-2xl p-8 shadow-xl">
                    <div class="w-14 h-14 rounded-xl bg-blue-600/20 flex items-center justify-center border border-blue-500/30 mb-4">
                        <i class="fas fa-envelope text-blue-400 text-2xl"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-white mb-4" data-admin="section8Title">8. Contact Us</h2>
                    <p class="text-blue-200/90 mb-2" data-admin="section8Text">
                        If you have any questions about this Privacy Policy or our data practices, please contact us at:
                    </p>
                    <p class="text-blue-300 font-semibold" data-admin="section8Email">
                        <i class="fas fa-envelope mr-2"></i>
                        <a href="mailto:support@tradingplus.ai" class="text-blue-400 hover:text-blue-300 underline">support@tradingplus.ai</a>
                    </p>
                </section>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-black/80 backdrop-blur-xl border-t border-blue-500/20 py-8 mt-16 relative z-10">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-blue-300/60 text-sm" data-admin="copyright">© 2025 AlgoOne. All rights reserved.</p>
                <div class="flex items-center gap-6">
                    <a href="{{ route('frontend.privacy') }}" class="text-blue-300/60 text-sm hover:text-blue-400 transition">Privacy Policy</a>
                    <a href="{{ route('frontend.terms-conditions') }}" class="text-blue-300/60 text-sm hover:text-blue-400 transition">Terms & Conditions</a>
                </div>
            </div>
            <div class="mt-6 max-w-5xl mx-auto flex items-start gap-3 text-xs text-blue-200/60 leading-relaxed">
                <span class="text-red-400 text-base mt-1">⚠</span>
                <p data-admin="disclaimer">
                    <strong class="text-blue-200/80">LEGAL DISCLAIMER</strong> — All quantitative performance indicators, statistical analyses, trading results, and any associated data visualizations or informational content displayed are NON-FACTUAL and constitute hypothetical simulations exclusively for demonstrative purposes. No actual transactions occur on this platform, and past performance is not indicative of future results.
                </p>
            </div>
        </div>
    </footer>

    <script src="{{ asset('assets/js/admin-config.js') }}"></script>
</body>

</html>

