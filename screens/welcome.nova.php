<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Luxid Framework</title>
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

        @keyframes matrixRain {
            0% { transform: translateY(-100%); }
            100% { transform: translateY(100vh); }
        }

        .gradient-bg {
            background: linear-gradient(-45deg, #000000, #111111, #222222, #000000);
            background-size: 400% 400%;
            animation: gradientFlow 20s ease infinite;
        }

        .gradient-text {
            background: linear-gradient(135deg, #ffffff 0%, #cccccc 25%, #999999 50%, #cccccc 75%, #ffffff 100%);
            background-size: 300% 300%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: gradientFlow 8s ease infinite;
        }

        .gradient-br {
            background: linear-gradient(to bottom right, #000000, #111111);
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

        .hover-lift {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .hover-lift:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.5);
        }

        .feature-card {
            background: rgba(255, 255, 255, 0.02);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .feature-card:hover {
            background: rgba(255, 255, 255, 0.05);
            border-color: rgba(255, 255, 255, 0.15);
            transform: translateY(-8px) scale(1.02);
        }

        .code-window {
            background: linear-gradient(to bottom, rgba(0,0,0,0.6), rgba(0,0,0,0.8));
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .matrix-rain {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
            opacity: 0.05;
            overflow: hidden;
        }

        .matrix-char {
            position: absolute;
            color: rgba(255, 255, 255, 0.3);
            font-family: 'Courier New', monospace;
            font-size: 14px;
            animation: matrixRain linear infinite;
        }

        .scanline {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background: linear-gradient(to right, transparent 0%, rgba(255,255,255,0.1) 50%, transparent 100%);
            animation: scanline 8s linear infinite;
            pointer-events: none;
            z-index: 9999;
        }

        .flicker {
            animation: flicker 3s linear infinite;
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

        .animate-fade-in-up {
            animation: fadeInUp 0.8s ease-out forwards;
        }

        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-300 { animation-delay: 0.3s; }
        .delay-400 { animation-delay: 0.4s; }
        .delay-500 { animation-delay: 0.5s; }

        [class*="delay-"] {
            opacity: 0;
        }

        .bg-grid {
            background-image:
                linear-gradient(rgba(255,255,255,0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.03) 1px, transparent 1px);
            background-size: 50px 50px;
        }

        .btn-primary {
            position: relative;
            overflow: hidden;
            background: linear-gradient(135deg, #111111 0%, #000000 100%);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #222222 0%, #111111 100%);
            border-color: rgba(255, 255, 255, 0.3);
            box-shadow: 0 0 30px rgba(255, 255, 255, 0.1);
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.2);
        }

        .pixel-grid {
            background-image:
                radial-gradient(rgba(255, 255, 255, 0.1) 1px, transparent 1px);
            background-size: 20px 20px;
            background-position: -10px -10px;
        }
    </style>
</head>
<body class="bg-black text-white overflow-x-hidden">
    <!-- Animated Background -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute inset-0 bg-grid opacity-20"></div>
        <div class="glow-orb w-96 h-96 bg-white top-0 -left-48 opacity-5" style="animation-delay: 0s;"></div>
        <div class="glow-orb w-80 h-80 bg-gray-800 top-1/3 right-0 opacity-10" style="animation-delay: 2s;"></div>
        <div class="glow-orb w-72 h-72 bg-gray-900 bottom-0 left-1/4 opacity-10" style="animation-delay: 4s;"></div>
        <div class="glow-orb w-64 h-64 bg-gray-800 bottom-1/4 right-1/3 opacity-10" style="animation-delay: 6s;"></div>

        <!-- Pixel Grid Overlay -->
        <div class="absolute inset-0 pixel-grid opacity-10"></div>
    </div>

    <!-- Hero Section -->
    <div class="relative min-h-screen flex items-center justify-center px-6 pt-20">
        <div class="max-w-6xl mx-auto text-center">

            <!-- Badge -->
            <div class="inline-flex items-center px-4 py-2 rounded-full glass-effect mb-8 animate-fade-in-up border border-gray-700">
                <span class="w-2 h-2 bg-white rounded-full mr-2 animate-pulse flicker"></span>
                <span class="text-sm font-medium text-gray-300">Luxid Framework v<?= $version ?? '0.1.7' ?></span>
            </div>

            <!-- Main Heading -->
            <h1 class="text-6xl md:text-8xl font-black mb-6 animate-fade-in-up delay-100 flicker">
                Build with
                <br>
                <span class="gradient-text">Elegance</span>
            </h1>

            <!-- Subheading -->
            <p class="text-xl md:text-2xl text-gray-400 max-w-3xl mx-auto mb-12 leading-relaxed animate-fade-in-up delay-200">
                The modern PHP framework that combines the power of <span class="text-white font-semibold">Nova Templates</span>,
                <span class="text-gray-300 font-semibold">L ORM</span>, and
                <span class="text-gray-200 font-semibold">Juice CLI</span> with the beauty of the SEA architecture.
            </p>

            <!-- CTA Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center mb-16 animate-fade-in-up delay-300">
                <a href="https://luxid-dev.netlify.app/"
                   class="group relative px-8 py-4 rounded-xl btn-primary font-semibold hover-lift overflow-hidden"
                   target="_blank"
                   >
                    <div class="absolute inset-0 shimmer opacity-20"></div>
                    <span class="relative flex items-center justify-center gap-2">
                        Get Started
                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </span>
                </a>
                <a href="https://luxid-dev.netlify.app/"
                   class="px-8 py-4 rounded-xl btn-secondary font-semibold hover-lift flex items-center justify-center gap-2"
                    https://luxid-dev.netlify.app/
                   >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                    Documentation
                </a>
            </div>
        </div>
    </div>

    <script>
        // Initialize animations
        document.addEventListener('DOMContentLoaded', () => {
            // Fade in staggered elements
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.animation = 'fadeInUp 0.6s ease-out forwards';
                    }
                });
            }, { threshold: 0.1 });

            document.querySelectorAll('.animate-fade-in-up').forEach(el => {
                observer.observe(el);
            });

            // Add hover effects to feature cards
            document.querySelectorAll('.feature-card').forEach(card => {
                card.addEventListener('mouseenter', () => {
                    card.style.transform = 'translateY(-8px) scale(1.02)';
                });
                card.addEventListener('mouseleave', () => {
                    card.style.transform = 'translateY(0) scale(1)';
                });
            });

            // Add flicker effect to specific elements
            setInterval(() => {
                document.querySelectorAll('.flicker').forEach(el => {
                    el.style.opacity = Math.random() > 0.1 ? '1' : '0.7';
                });
            }, 100);
        });
    </script>
</body>
</html>
