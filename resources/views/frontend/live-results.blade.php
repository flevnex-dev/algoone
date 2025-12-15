<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title data-admin="pageTitle">Live Results - AlgoOne</title>
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
        .message-card {
            background: linear-gradient(145deg, rgba(15, 23, 42, 0.95) 0%, rgba(0, 0, 0, 0.95) 100%);
            backdrop-filter: blur(10px);
            border: 2px solid rgba(11, 100, 244, 0.3);
            transition: all 0.3s ease;
        }
        .message-card:hover {
            transform: translateX(8px);
            border-color: rgba(11, 100, 244, 0.6);
            box-shadow: 0 10px 30px rgba(11, 100, 244, 0.3);
        }
        .header-gradient {
            background: linear-gradient(135deg, #000000 0%, #0f172a 100%);
            border-bottom: 2px solid rgba(11, 100, 244, 0.3);
        }
        .amount-badge {
            background: linear-gradient(135deg, #0B64F4 0%, #2563EB 100%);
        }
    </style>
</head>

<body>
    <!-- Animated Background -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-20 right-20 w-72 h-72 bg-blue-600/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-20 left-20 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl"></div>
    </div>

    <!-- Header -->
    <header class="header-gradient shadow-xl sticky top-0 z-50">
        <nav class="container mx-auto px-4 py-4 flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <a href="{{ route('frontend.index') }}" class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-600 to-blue-500 rounded-xl flex items-center justify-center shadow-lg border border-blue-500/30">
                        <img src="{{ asset('assets/image/logo.png') }}" alt="Logo" class="w-10 h-10 object-contain" />
                    </div>
                    <span class="text-2xl font-bold text-white" data-admin="pageHeader">Live Results</span>
                </a>
            </div>
            <a href="{{ route('frontend.index') }}" class="text-blue-300 hover:text-blue-100 text-sm font-medium px-4 py-2 rounded-lg hover:bg-blue-600/10 transition-all border border-blue-500/30 flex items-center gap-2">
                <i class="fas fa-arrow-left"></i>
                <span>Back</span>
            </a>
        </nav>
    </header>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-12 max-w-4xl relative z-10">
        <!-- Page Title Section -->
        <div class="text-center mb-12">
            <div class="inline-flex items-center gap-2 bg-blue-600/20 border border-blue-500/40 rounded-full px-6 py-3 mb-6">
                <i class="fas fa-comments text-blue-400"></i>
                <span class="text-blue-400 text-sm font-semibold uppercase tracking-wide">REAL-TIME FEEDBACK</span>
            </div>
            <h1 class="text-5xl md:text-6xl font-extrabold text-white mb-4" data-admin="pageTitle">Success Stories</h1>
            <p class="text-xl text-blue-200/80" data-admin="pageSubtitle">See what our traders are saying about their payouts</p>
        </div>

        <!-- Messages Container - Timeline Style -->
        <div class="space-y-6 max-h-[65vh] overflow-y-auto pr-2 custom-scrollbar mb-8">
            <!-- Message Card 1 -->
            <div class="message-card rounded-2xl p-6 shadow-xl relative">
                <div class="flex gap-5">
                    <div class="h-16 w-16 rounded-2xl bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center text-white text-2xl font-bold flex-shrink-0 shadow-lg border-2 border-blue-400/30">
                        Q
                    </div>
                    <div class="flex-1">
                        <div class="flex flex-wrap items-center gap-3 mb-3">
                            <h3 class="font-bold text-white text-lg" data-admin="userName1">Quinn Palmer</h3>
                            <span class="amount-badge text-white text-sm font-bold px-4 py-1.5 rounded-full shadow-lg" data-admin="amount1">
                                <i class="fas fa-dollar-sign mr-1"></i>$13,344
                            </span>
                            <span class="text-blue-300/70 text-sm" data-admin="time1">
                                <i class="fas fa-clock mr-1"></i>13h ago
                            </span>
                        </div>
                        <p class="text-blue-200/90 text-base" data-admin="message1">Life changing! 🙌</p>
                    </div>
                </div>
            </div>

            <!-- Message Card 2 -->
            <div class="message-card rounded-2xl p-6 shadow-xl relative">
                <div class="flex gap-5">
                    <div class="h-16 w-16 rounded-2xl bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center text-white text-2xl font-bold flex-shrink-0 shadow-lg border-2 border-blue-400/30">
                        B
                    </div>
                    <div class="flex-1">
                        <div class="flex flex-wrap items-center gap-3 mb-3">
                            <h3 class="font-bold text-white text-lg" data-admin="userName2">Blake Rivers</h3>
                            <span class="amount-badge text-white text-sm font-bold px-4 py-1.5 rounded-full shadow-lg" data-admin="amount2">
                                <i class="fas fa-dollar-sign mr-1"></i>$15,371
                            </span>
                            <span class="text-blue-300/70 text-sm" data-admin="time2">
                                <i class="fas fa-calendar mr-1"></i>11/29/2025
                            </span>
                        </div>
                        <p class="text-blue-200/90 text-base" data-admin="message2">Weekly payout just hit my account. This is incredible! 🤑</p>
                    </div>
                </div>
            </div>

            <!-- Message Card 3 -->
            <div class="message-card rounded-2xl p-6 shadow-xl relative">
                <div class="flex gap-5">
                    <div class="h-16 w-16 rounded-2xl bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center text-white text-2xl font-bold flex-shrink-0 shadow-lg border-2 border-blue-400/30">
                        R
                    </div>
                    <div class="flex-1">
                        <div class="flex flex-wrap items-center gap-3 mb-3">
                            <h3 class="font-bold text-white text-lg" data-admin="userName3">Ryan Santos</h3>
                            <span class="amount-badge text-white text-sm font-bold px-4 py-1.5 rounded-full shadow-lg" data-admin="amount3">
                                <i class="fas fa-dollar-sign mr-1"></i>$24,661
                            </span>
                            <span class="text-blue-300/70 text-sm" data-admin="time3">
                                <i class="fas fa-calendar mr-1"></i>11/28/2025
                            </span>
                        </div>
                        <p class="text-blue-200/90 text-base" data-admin="message3">My account got funded faster than expected. Amazing work!</p>
                    </div>
                </div>
            </div>

            <!-- Message Card 4 -->
            <div class="message-card rounded-2xl p-6 shadow-xl relative">
                <div class="flex gap-5">
                    <div class="h-16 w-16 rounded-2xl overflow-hidden flex-shrink-0 border-2 border-blue-500/30 shadow-lg">
                        <img src="https://i.pravatar.cc/80?img=5" class="h-full w-full object-cover" alt="User">
                    </div>
                    <div class="flex-1">
                        <div class="flex flex-wrap items-center gap-3 mb-3">
                            <h3 class="font-bold text-white text-lg" data-admin="userName4">Blake Rivers</h3>
                            <span class="amount-badge text-white text-sm font-bold px-4 py-1.5 rounded-full shadow-lg" data-admin="amount4">
                                <i class="fas fa-dollar-sign mr-1"></i>$16,116
                            </span>
                            <span class="text-blue-300/70 text-sm" data-admin="time4">
                                <i class="fas fa-calendar mr-1"></i>11/28/2025
                            </span>
                        </div>
                        <p class="text-blue-200/90 text-base" data-admin="message4">Another successful withdrawal. The system really delivers!</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Input Box -->
        <div class="bg-gradient-to-r from-blue-600/20 to-blue-500/20 backdrop-blur-xl rounded-2xl p-6 shadow-2xl border-2 border-blue-500/30">
            <div class="flex items-end gap-4">
                <textarea rows="3" placeholder="Share your trading success..." 
                    class="flex-1 resize-none outline-none text-white bg-black/30 border-2 border-blue-500/30 px-5 py-4 rounded-xl placeholder-blue-400/40 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all"
                    data-admin="inputPlaceholder"></textarea>
                <button class="bg-gradient-to-r from-blue-600 to-blue-500 h-14 w-14 flex items-center justify-center rounded-xl text-white hover:shadow-xl hover:shadow-blue-500/50 transition-all flex-shrink-0 border-2 border-blue-400/30">
                    <i class="fas fa-paper-plane text-lg"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="mt-16 bg-black/80 backdrop-blur-xl border-t border-blue-500/20 py-8 relative z-10">
        <div class="container mx-auto px-4">
            <div class="max-w-5xl mx-auto flex items-start gap-3 text-xs text-blue-200/70 leading-relaxed">
                <span class="text-yellow-400 text-lg mt-1">⚠</span>
                <p data-admin="disclaimer">
                    <strong class="text-blue-200/90">LEGAL DISCLAIMER</strong> — All quantitative performance indicators, statistical analyses, trading results, and any associated data visualizations or informational content displayed are presented for demonstration purposes only and are not indicative of future performance.
                </p>
            </div>
        </div>
    </footer>

    <script src="{{ asset('assets/js/admin-config.js') }}"></script>
    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 8px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: rgba(11, 100, 244, 0.1);
            border-radius: 10px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: rgba(11, 100, 244, 0.4);
            border-radius: 10px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: rgba(11, 100, 244, 0.6);
        }
    </style>
</body>

</html>

