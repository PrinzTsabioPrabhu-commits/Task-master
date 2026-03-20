<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Task Master') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800|outfit:400,500,600,700,800,900&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            /* Stealth Scrollbar - Ultra Thin */
            ::-webkit-scrollbar { width: 4px; }
            ::-webkit-scrollbar-track { background: transparent; }
            ::-webkit-scrollbar-thumb { 
                background: rgba(79, 70, 229, 0.1); 
                border-radius: 20px; 
            }
            ::-webkit-scrollbar-thumb:hover { background: rgba(79, 70, 229, 0.2); }

            .bg-grid-global { 
                background-size: 40px 40px; 
                background-image: radial-gradient(circle, rgba(0, 0, 0, 0.03) 1px, transparent 1px); 
            }

            /* Animated Mesh Gradient */
            .mesh-gradient {
                position: fixed;
                inset: 0;
                z-index: -1;
                background-color: #f8fafc;
                background-image: 
                    radial-gradient(at 0% 0%, rgba(79, 70, 229, 0.05) 0px, transparent 50%),
                    radial-gradient(at 100% 0%, rgba(99, 102, 241, 0.05) 0px, transparent 50%),
                    radial-gradient(at 100% 100%, rgba(129, 140, 248, 0.05) 0px, transparent 50%),
                    radial-gradient(at 0% 100%, rgba(165, 180, 252, 0.05) 0px, transparent 50%);
                filter: blur(100px);
                animation: mesh-move 20s ease infinite;
            }

            @keyframes mesh-move {
                0%, 100% { transform: scale(1) translate(0, 0); }
                33% { transform: scale(1.1) translate(20px, -20px); }
                66% { transform: scale(0.9) translate(-20px, 20px); }
            }
            
            /* Floating Particles */
            .particle {
                position: fixed;
                width: 2px;
                height: 2px;
                background: rgba(79, 70, 229, 0.2);
                border-radius: 50%;
                pointer-events: none;
                z-index: -1;
                animation: float-up 15s linear infinite;
            }
            @keyframes float-up {
                0% { transform: translateY(100vh) translateX(0); opacity: 0; }
                50% { opacity: 0.5; }
                100% { transform: translateY(-10vh) translateX(20px); opacity: 0; }
            }

            @keyframes shimmer {
                0% { transform: translateX(-100%); }
                100% { transform: translateX(300%); }
            }
            
            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(12px); }
                to { opacity: 1; transform: translateY(0); }
            }
            .page-animate { animation: fadeIn 1s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
        </style>
    </head>
    <body class="font-sans text-slate-900 antialiased selection:bg-brand-500/10 selection:text-brand-900 bg-[#f8fafc] overflow-x-hidden relative">
        <!-- Noise Texture Overlay -->
        <div class="noise-overlay pointer-events-none opacity-[0.015]"></div>

        <div class="min-h-screen relative flex flex-col">
            
            <!-- Global Background Elements -->
            <div class="mesh-gradient"></div>
            <div class="fixed inset-0 z-0 bg-grid-global pointer-events-none opacity-40"></div>
            
            <div class="relative z-10 flex flex-col min-h-screen pt-32">
                <!-- System Status Bar -->
                <div class="fixed top-0 inset-x-0 h-1 bg-gradient-to-r from-brand-600/40 via-indigo-400/20 to-brand-600/40 z-[110]">
                    <div class="h-full bg-brand-600 w-1/3 animate-[shimmer_3s_infinite_linear]" style="background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);"></div>
                </div>
                <div class="fixed top-1 inset-x-0 py-1.5 px-8 flex justify-end z-[110] pointer-events-none">
                    <div class="flex items-center gap-3 bg-white/40 backdrop-blur-md px-3 py-1 rounded-full border border-white/40 shadow-sm">
                        <span class="relative flex h-1.5 w-1.5">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-1.5 w-1.5 bg-emerald-500"></span>
                        </span>
                        <span class="text-[7px] font-black uppercase tracking-[0.2em] text-slate-500">Neural Focus Active</span>
                    </div>
                </div>
                <!-- Global Navigation -->
                @include('layouts.navigation')

                <!-- Minimalist Breadcrumb-style Header -->
                @isset($header)
                    <header class="max-w-7xl w-full mx-auto px-6 sm:px-8 lg:px-10 pt-4 pb-4 reveal-animation" style="animation-delay: 100ms;">
                        <div class="flex items-center gap-3">
                            <a href="{{ route('dashboard') }}" class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 hover:text-brand-600 transition-colors">Workspace</a>
                            <span class="text-slate-300 text-[10px]">•</span>
                            <span class="text-[10px] font-black uppercase tracking-[0.3em] text-slate-900 uppercase">{{ $header }}</span>
                        </div>
                    </header>
                @endisset

                <!-- Page Content & Sidebar Layout -->
                <div class="max-w-7xl w-full mx-auto px-6 sm:px-8 lg:px-10 flex gap-10">
                    <!-- Main content -->
                    <main class="flex-grow">
                        {{ $slot }}
                    </main>                    <!-- Activity Sidebar (Aesthetic Density) -->
                    <aside class="hidden xl:block w-72 shrink-0 reveal-animation h-fit sticky top-32 space-y-8" style="animation-delay: 600ms;">
                        <!-- System Status -->
                        <div class="glass-morph p-6 rounded-[2.5rem] border border-white/40 shadow-xl shadow-slate-200/10">
                            <h3 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-6 flex items-center justify-between">
                                System Status
                                <span class="flex items-center gap-2 text-emerald-500">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                    ONLINE
                                </span>
                            </h3>
                            <div class="space-y-4">
                                <div class="p-4 rounded-3xl bg-slate-50/50 border border-white shadow-sm">
                                    <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest block mb-2">Memory Load</span>
                                    <div class="h-1 w-full bg-slate-200 rounded-full overflow-hidden">
                                        <div class="h-full w-[42%] bg-brand-500 rounded-full"></div>
                                    </div>
                                    <div class="flex justify-between mt-2 text-[8px] font-bold text-slate-400">
                                        <span>HUB-ALPHA</span>
                                        <span>42%</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Neural Commits -->
                        <div class="glass-morph p-6 rounded-[2.5rem] border border-white/40 shadow-xl shadow-slate-200/10">
                            <h3 class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-6">Neural Commits</h3>
                            <div class="space-y-6">
                                <div class="flex gap-4 group cursor-pointer">
                                    <div class="w-1 bg-brand-500 rounded-full transition-all group-hover:h-8"></div>
                                    <div>
                                        <p class="text-xs font-bold text-slate-900 group-hover:text-brand-600 transition-colors">Refactored Core Engine</p>
                                        <span class="text-[9px] font-medium text-slate-400 uppercase tracking-widest">2m ago • #SYNC</span>
                                    </div>
                                </div>
                                <div class="flex gap-4 group cursor-pointer">
                                    <div class="w-1 bg-slate-200 rounded-full transition-all group-hover:h-8 group-hover:bg-brand-500"></div>
                                    <div>
                                        <p class="text-xs font-bold text-slate-900 group-hover:text-brand-600 transition-colors">Neural UI Update</p>
                                        <span class="text-[9px] font-medium text-slate-400 uppercase tracking-widest">15m ago • #DESIGN</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Mini Environment Meta -->
                        <div class="p-6 rounded-[2.5rem] bg-slate-950 text-white shadow-2xl relative overflow-hidden group">
                            <div class="absolute inset-0 bg-gradient-to-br from-brand-600/20 to-transparent"></div>
                            <div class="relative z-10">
                                <span class="text-[8px] font-black opacity-40 uppercase tracking-[0.25em]">Environment</span>
                                <p class="text-xs font-bold mt-1">Production Alpha v2.5</p>
                                <div class="mt-4 flex items-center gap-2">
                                    <div class="flex -space-x-1">
                                        <div class="w-4 h-4 rounded-full bg-white/20 border border-white/20"></div>
                                        <div class="w-4 h-4 rounded-full bg-white/10 border border-white/20"></div>
                                    </div>
                                    <span class="text-[8px] font-bold opacity-30 uppercase">Nodes Active</span>
                                </div>
                            </div>
                        </div>
                    </aside>
                </div>
                
                <!-- Simple Footer -->
                <footer class="max-w-7xl w-full mx-auto px-6 sm:px-8 lg:px-10 py-12 text-center border-t border-slate-200/60 mt-20">
                    <p class="text-slate-400 text-sm font-bold uppercase tracking-widest">© {{ date('Y') }} Task Master Inc. — Productive by Design.</p>
                </footer>
            </div>
            
            <!-- Particle Generator (Background) -->
            <div class="particle" style="left: 10%; animation-delay: 0s;"></div>
            <div class="particle" style="left: 30%; animation-delay: 5s;"></div>
            <div class="particle" style="left: 50%; animation-delay: 2s;"></div>
            <div class="particle" style="left: 70%; animation-delay: 8s;"></div>
            <div class="particle" style="left: 90%; animation-delay: 4s;"></div>
        </div>
    </body>
</html>
