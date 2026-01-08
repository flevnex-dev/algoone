<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title data-admin="pageTitle">{{ ($terms->page_title ?? 'Terms & Conditions') }} - {{ $setting->site_title ?? 'AlgoOne' }}</title>
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
        .warning-box {
            background: linear-gradient(145deg, rgba(239, 68, 68, 0.1) 0%, rgba(220, 38, 38, 0.1) 100%);
            border: 2px solid rgba(239, 68, 68, 0.4);
        }
    </style>
</head>

<body>
    <!-- Animated Background -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-0 left-0 w-96 h-96 bg-blue-600/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl"></div>
    </div>

    <!-- Header -->
    <header class="header-blue shadow-xl sticky top-0 z-50">
        <nav class="container mx-auto px-4 py-4 flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <a href="{{ route('frontend.index') }}" class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-600 to-blue-500 rounded-xl flex items-center justify-center shadow-lg border border-blue-500/30">
                        <img src="{{ asset($setting->logo ?? 'assets/image/logo.png') }}" alt="Logo" class="w-10 h-10 object-contain" />
                    </div>
                    <span class="text-2xl font-bold text-white" >{{ $setting->site_title ?? 'AlgoOne' }}</span>
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
                    <i class="fas fa-file-contract text-blue-400"></i>
                    <span class="text-blue-400 text-sm font-semibold uppercase tracking-wide">LEGAL DOCUMENT</span>
                </div>
                <h1 class="text-5xl md:text-6xl font-extrabold text-white mb-4" data-admin="pageTitle">{{ $terms->page_title ?? 'Terms & Conditions' }}</h1>
                @if($terms->last_updated ?? null)
                <p class="text-blue-300/70 text-lg" data-admin="lastUpdated">Last Updated: {{ $terms->last_updated }}</p>
                @endif
            </div>

            <!-- Content -->
            @if(isset($terms) && $terms && !empty($terms->details))
            <div class="content-card rounded-2xl p-8 shadow-xl">
                <div class="prose prose-invert max-w-none">
                    <div class="text-blue-200/90 leading-relaxed">
                        {!! $terms->details !!}
                    </div>
                </div>
            </div>
            @else
            <!-- Fallback: Default content if no data -->
            <div class="content-card rounded-2xl p-8 shadow-xl">
                <p class="text-blue-200/90 leading-relaxed">
                    Terms & Conditions content will be displayed here.
                </p>
            </div>
            @endif
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-black/80 backdrop-blur-xl border-t border-blue-500/20 py-8 mt-16 relative z-10">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-blue-300/60 text-sm" data-admin="copyright">{{ $setting->copyright_text ?? '© 2025 AlgoOne. All rights reserved.' }}</p>
                <div class="flex items-center gap-6">
                    <a href="{{ route('frontend.privacy') }}" class="text-blue-300/60 text-sm hover:text-blue-400 transition">Privacy Policy</a>
                    <a href="{{ route('frontend.terms-conditions') }}" class="text-blue-300/60 text-sm hover:text-blue-400 transition">Terms & Conditions</a>
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
</body>

</html>

