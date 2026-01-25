<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error <?= isset($exception) ? $exception->getCode() : '500' ?> | Luxid Framework</title>
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        * {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        @keyframes gradientFlow {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            33% { transform: translateY(-20px); }
            66% { transform: translateY(-10px); }
        }

        @keyframes pulse-glow {
            0%, 100% { opacity: 0.05; filter: blur(40px); }
            50% { opacity: 0.1; filter: blur(60px); }
        }

        @keyframes shimmer {
            0% { background-position: -1000px 0; }
            100% { background-position: 1000px 0; }
        }

        @keyframes flicker {
            0%, 19.999%, 22%, 62.999%, 64%, 64.999%, 70%, 100% {
                opacity: 0.99;
                filter: drop-shadow(0 0 1px rgba(255, 255, 255, 0.1));
            }
            20%, 21.999%, 63%, 63.999%, 65%, 69.999% {
                opacity: 0.4;
                filter: none;
            }
        }

        @keyframes scanline {
            0% { top: 0%; }
            100% { top: 100%; }
        }

        @keyframes errorPulse {
            0%, 100% { box-shadow: 0 0 20px rgba(239, 68, 68, 0.3); }
            50% { box-shadow: 0 0 40px rgba(239, 68, 68, 0.5); }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes glitch {
            0% { transform: translate(0); }
            20% { transform: translate(-2px, 2px); }
            40% { transform: translate(-2px, -2px); }
            60% { transform: translate(2px, 2px); }
            80% { transform: translate(2px, -2px); }
            100% { transform: translate(0); }
        }

        .gradient-bg {
            background: linear-gradient(-45deg, #000000, #111111, #222222, #000000);
            background-size: 400% 400%;
            animation: gradientFlow 20s ease infinite;
        }

        .error-glow {
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.1) 0%, rgba(185, 28, 28, 0.2) 100%);
            border: 1px solid rgba(239, 68, 68, 0.2);
            animation: errorPulse 3s ease-in-out infinite;
        }

        .glass-effect {
            background: rgba(0, 0, 0, 0.4);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .glow-orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(60px);
            animation: pulse-glow 8s ease-in-out infinite;
            pointer-events: none;
        }

        .shimmer {
            background: linear-gradient(to right, transparent 0%, rgba(255,255,255,0.05) 50%, transparent 100%);
            background-size: 1000px 100%;
            animation: shimmer 3s infinite;
        }

        .bg-grid {
            background-image:
                linear-gradient(rgba(255,255,255,0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.03) 1px, transparent 1px);
            background-size: 50px 50px;
        }

        .pixel-grid {
            background-image:
                radial-gradient(rgba(255, 255, 255, 0.1) 1px, transparent 1px);
            background-size: 20px 20px;
            background-position: -10px -10px;
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.8s ease-out forwards;
        }

        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-300 { animation-delay: 0.3s; }

        [class*="delay-"] {
            opacity: 0;
        }

        .glitch-effect {
            position: relative;
            animation: glitch 0.3s linear infinite;
        }

        .glitch-effect::before,
        .glitch-effect::after {
            content: attr(data-text);
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .glitch-effect::before {
            left: 2px;
            text-shadow: -1px 0 rgba(239, 68, 68, 0.7);
            animation: glitch 0.3s linear infinite reverse;
        }

        .glitch-effect::after {
            left: -2px;
            text-shadow: 1px 0 rgba(59, 130, 246, 0.7);
            animation: glitch 0.3s linear infinite;
        }

        .error-code {
            font-size: clamp(4rem, 15vw, 12rem);
            font-weight: 900;
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 50%, #b91c1c 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            line-height: 1;
            text-shadow: 0 0 30px rgba(239, 68, 68, 0.3);
        }

        .status-text {
            color: rgba(255, 255, 255, 0.8);
            font-size: clamp(1.5rem, 4vw, 2.5rem);
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.2em;
        }
    </style>
</head>
<body class="bg-black text-white overflow-x-hidden min-h-screen">
    <!-- Animated Background -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute inset-0 bg-grid opacity-20"></div>
        <div class="glow-orb w-96 h-96 bg-red-500/10 top-0 -left-48" style="animation-delay: 0s;"></div>
        <div class="glow-orb w-80 h-80 bg-red-500/5 top-1/3 right-0" style="animation-delay: 2s;"></div>
        <div class="glow-orb w-72 h-72 bg-red-900/10 bottom-0 left-1/4" style="animation-delay: 4s;"></div>
        <div class="glow-orb w-64 h-64 bg-red-900/5 bottom-1/4 right-1/3" style="animation-delay: 6s;"></div>
        <div class="absolute inset-0 pixel-grid opacity-10"></div>
    </div>

    <!-- Scanline Effect -->
    <div class="fixed top-0 left-0 w-full h-px bg-gradient-to-r from-transparent via-red-500/50 to-transparent animate-scanline z-50 pointer-events-none"></div>

    <!-- Main Content -->
    <div class="relative min-h-screen flex items-center justify-center px-6">
        <div class="max-w-4xl mx-auto text-center">

            <!-- Error Code -->
            <div class="mb-8 animate-fade-in-up glitch-effect" data-text="ERROR <?= isset($exception) ? $exception->getCode() : '500' ?>">
                <div class="error-code">
                    <?= isset($exception) ? $exception->getCode() : '500' ?>
                </div>
            </div>

            <!-- Status Text -->
            <div class="status-text mb-6 animate-fade-in-up delay-100">
                <?php if (isset($exception)): ?>
                    <?php
                        $statusTexts = [
                            400 => 'Bad Request',
                            401 => 'Unauthorized',
                            403 => 'Forbidden',
                            404 => 'Not Found',
                            500 => 'Internal Server Error',
                            503 => 'Service Unavailable'
                        ];
                        $code = $exception->getCode();
                        echo $statusTexts[$code] ?? 'Error';
                    ?>
                <?php else: ?>
                    Internal Server Error
                <?php endif; ?>
            </div>

            <!-- Error Message -->
            <div class="glass-effect rounded-2xl p-8 mb-8 animate-fade-in-up delay-200 error-glow">
                <div class="flex items-center justify-center gap-3 mb-4">
                    <svg class="w-6 h-6 text-red-400 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.998-.833-2.732 0L4.282 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                    </svg>
                    <h3 class="text-xl font-semibold text-red-300">Error Details</h3>
                </div>

                <div class="text-gray-300 text-lg mb-6 leading-relaxed">
                    <?php if (isset($exception)): ?>
                        <?= htmlspecialchars($exception->getMessage()) ?>
                    <?php else: ?>
                        An unexpected error occurred while processing your request.
                    <?php endif; ?>
                </div>

                <!-- Specific Error Context -->
                <div class="border-t border-red-900/30 pt-6">
                    <?php if (isset($exception) && $exception->getCode() === 404): ?>
                        <div class="text-gray-400">
                            <p class="mb-4">The requested resource could not be found on this server.</p>
                            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-red-900/20">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 21h7a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                </svg>
                                <span>Check the URL or navigate back</span>
                            </div>
                        </div>
                    <?php elseif (isset($exception) && $exception->getCode() === 403): ?>
                        <div class="text-gray-400">
                            <p class="mb-4">You don't have permission to access this resource.</p>
                            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-red-900/20">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                                <span>Authentication required</span>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="text-gray-400">
                            <p>Our team has been notified of this issue. Please try again later.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center animate-fade-in-up delay-300">
                <a href="/"
                   class="group relative px-8 py-4 rounded-xl font-semibold bg-gray-900/50 hover:bg-gray-900/70 border border-gray-700 hover:border-gray-600 transition-all duration-300 overflow-hidden">
                    <div class="absolute inset-0 shimmer opacity-20"></div>
                    <span class="relative flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        Return Home
                    </span>
                </a>

                <a href="https://luxid-dev.netlify.app/"
                   target="_blank"
                   class="px-8 py-4 rounded-xl font-semibold bg-red-900/20 hover:bg-red-900/30 border border-red-800/30 hover:border-red-700/40 transition-all duration-300 flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                    Documentation
                </a>
            </div>

            <!-- Framework Info -->
            <div class="mt-12 pt-8 border-t border-gray-800/50 animate-fade-in-up delay-300">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full glass-effect">
                    <span class="w-2 h-2 bg-red-400 rounded-full animate-pulse"></span>
                    <span class="text-sm text-gray-400">Luxid Framework v<?= $version ?? '0.1.7' ?></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Error Debug Info (Only in development) -->
    <?php if (isset($exception) && ($exception->getCode() === 500 || $exception->getCode() >= 500)): ?>
        <div class="fixed bottom-4 left-4 right-4 max-w-4xl mx-auto">
            <details class="glass-effect rounded-xl p-4 text-sm">
                <summary class="cursor-pointer text-gray-400 hover:text-gray-300 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>Technical Details (Development)</span>
                </summary>
                <div class="mt-3 p-3 bg-black/50 rounded-lg overflow-x-auto">
                    <pre class="text-gray-400 text-xs font-mono"><code><?php
                        if (isset($exception)) {
                            echo 'File: ' . $exception->getFile() . "\n";
                            echo 'Line: ' . $exception->getLine() . "\n";
                            echo 'Trace: ' . "\n" . $exception->getTraceAsString();
                        }
                    ?></code></pre>
                </div>
            </details>
        </div>
    <?php endif; ?>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Glitch effect for error code
            const errorCode = document.querySelector('.glitch-effect');
            if (errorCode) {
                setInterval(() => {
                    errorCode.style.animation = 'glitch 0.3s linear';
                    setTimeout(() => {
                        errorCode.style.animation = 'none';
                    }, 300);
                }, 3000);
            }

            // Fade in animations
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        if (entry.target.classList.contains('animate-fade-in-up')) {
                            entry.target.style.animation = 'fadeInUp 0.6s ease-out forwards';
                        }
                    }
                });
            }, { threshold: 0.1 });

            document.querySelectorAll('.animate-fade-in-up').forEach(el => {
                observer.observe(el);
            });

            // Red scanline animation
            const scanline = document.createElement('style');
            scanline.textContent = `
                @keyframes scanline {
                    0% { top: 0%; opacity: 0.3; }
                    100% { top: 100%; opacity: 0.8; }
                }
                .animate-scanline {
                    animation: scanline 2s linear infinite;
                }
            `;
            document.head.appendChild(scanline);
        });
    </script>
</body>
</html>
