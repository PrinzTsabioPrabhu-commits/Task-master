<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Task Master — Design Your Productivity</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800|outfit:300,400,600,700,900" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --brand-primary: #4F46E5;
            --ease-out-expo: cubic-bezier(0.16, 1, 0.3, 1);
        }

        .glass-header {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
        }

        /* Custom selection color */
        ::selection {
            background: rgba(79, 70, 229, 0.15);
            color: #4338ca;
        }

        .tilt-card {
            perspective: 1000px;
            transform-style: preserve-3d;
        }

        .tilt-card:hover {
            transform: rotateX(2deg) rotateY(-2deg) scale(1.02);
        }

        .border-beam-container {
            position: absolute;
            inset: 0;
            border-radius: inherit;
            pointer-events-none;
            overflow: hidden;
            mask-image: linear-gradient(black, black), linear-gradient(black, black);
            mask-clip: content-box, border-box;
            mask-composite: exclude;
            padding: 1px;
            opacity: 0;
            transition: opacity 0.5s var(--ease-out-expo);
        }

        .tilt-card:hover .border-beam-container {
            opacity: 1;
        }

        .border-beam {
            position: absolute;
            aspect-ratio: 1;
            width: 100%;
            background: conic-gradient(from 0deg at 50% 50%, transparent 0deg, var(--brand-primary) 60deg, transparent 120deg);
            animation: beam-rotate 4s linear infinite;
            offset-path: rect(0% 100% 100% 0% round 2.5rem);
        }

        @keyframes beam-rotate {
            from { offset-distance: 0%; }
            to { offset-distance: 100%; }
        }

        .animate-pulse-slow {
            animation: pulse-slow 4s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        @keyframes pulse-slow {
            0%, 100% { opacity: 0.1; }
            50% { opacity: 0.3; }
        }
    </style>
</head>
<body class="antialiased bg-[#F8FAFC] text-slate-900 font-body selection:bg-brand-500/10 overflow-x-hidden">
    
    <div class="fixed inset-0 pointer-events-none -z-10">
        <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] bg-brand-500/10 rounded-full blur-[120px] animate-pulse"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[30%] h-[30%] bg-brand-600/5 rounded-full blur-[100px]"></div>
    </div>

    <nav x-data="{ scrolled: false }" 
         @scroll.window="scrolled = (window.pageYOffset > 30)"
         :class="{ 'glass-header py-4 mx-6 mt-4 rounded-3xl border border-white/40 shadow-sm': scrolled, 'bg-transparent py-8': !scrolled }"
         class="fixed top-0 inset-x-0 z-[100] transition-all duration-500 ease-in-out">
        <div class="max-w-7xl mx-auto px-8 flex justify-between items-center">
            <a href="/" class="flex items-center gap-2 group">
                <div class="w-9 h-9 bg-slate-900 rounded-lg flex items-center justify-center text-white shadow-lg transition-transform duration-500 group-hover:scale-110 group-hover:rotate-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
                <span class="text-xl font-heading font-black tracking-tight">Task<span class="text-brand-600">Master</span></span>
            </a>
            
            <div class="hidden md:flex gap-10">
                <a href="#features" class="text-[11px] font-bold uppercase tracking-widest text-slate-500 hover:text-brand-600 transition-colors">Methodology</a>
                <a href="#how-it-works" class="text-[11px] font-bold uppercase tracking-widest text-slate-500 hover:text-brand-600 transition-colors">Framework</a>
                <a href="#cta" class="text-[11px] font-bold uppercase tracking-widest text-slate-500 hover:text-brand-600 transition-colors">Access</a>
            </div>

            <div class="flex items-center gap-6">
                @auth
                    <a href="{{ url('/dashboard') }}" class="px-6 py-2.5 bg-slate-900 text-white text-sm font-bold rounded-xl hover:bg-brand-600 transition-all shadow-md">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-bold text-slate-600 hover:text-slate-900 transition-colors hidden sm:block">Log In</a>
                    <a href="{{ route('register') }}" class="px-6 py-2.5 bg-slate-900 text-white text-sm font-bold rounded-xl hover:bg-brand-600 transition-all shadow-lg hover:shadow-brand-500/20">Get Started</a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="relative z-10">
        
        <header class="pt-56 pb-32 max-w-7xl mx-auto px-8">
            <div class="max-w-5xl">
                <div class="reveal-animation" style="animation-delay: 100ms;">
                    <span class="inline-flex items-center gap-2 px-4 py-1.5 bg-white border border-slate-200 rounded-full shadow-sm mb-8">
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-brand-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-brand-500"></span>
                        </span>
                        <span class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-600">System v2.0 Live</span>
                    </span>
                </div>

                <h1 class="reveal-animation text-6xl md:text-[8rem] font-heading font-black text-slate-900 leading-[0.9] tracking-tighter mb-10" style="animation-delay: 200ms;">
                    Master your <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-600 to-indigo-400">Momentum.</span>
                </h1>
                
                <p class="reveal-animation text-xl md:text-2xl font-medium text-slate-500 max-w-2xl leading-relaxed mb-12" style="animation-delay: 300ms;">
                    Sebuah ruang digital minimalis yang dirancang untuk arsitek ide dan eksekutor tingkat tinggi. Fokus tanpa batas, disiplin mutlak.
                </p>

                <div class="reveal-animation flex flex-wrap gap-5" style="animation-delay: 400ms;">
                    <a href="{{ route('register') }}" class="group flex items-center gap-3 px-10 py-5 bg-brand-600 text-white text-lg font-bold rounded-2xl hover:bg-brand-700 transition-all shadow-xl shadow-brand-500/20">
                        <span>Bangun Sekarang</span>
                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                    <a href="#features" class="px-10 py-5 bg-white border border-slate-200 text-slate-900 text-lg font-bold rounded-2xl hover:bg-slate-50 transition-all">
                        Pelajari Metode
                    </a>
                </div>
            </div>
        </header>

        <section id="features" class="py-24 max-w-7xl mx-auto px-8">
            <div class="relative rounded-[3rem] overflow-hidden bg-slate-900 p-2 border-4 border-white shadow-2xl reveal-animation" style="animation-delay: 500ms;">
                <div class="absolute inset-0 bg-gradient-to-br from-brand-500/20 to-transparent opacity-50"></div>
                <div class="relative rounded-[2.5rem] bg-slate-950 border border-white/10 aspect-video flex items-center justify-center p-12 text-center group">
                    <!-- Ambient Glow Effect -->
                    <div class="absolute inset-0 bg-brand-500/5 animate-pulse-slow pointer-events-none"></div>
                    
                    <!-- Productivity Contexts -->
                    <div class="absolute top-8 left-8 flex flex-col gap-3">
                        <div class="px-3 py-1 bg-white/5 border border-white/10 rounded-full backdrop-blur-md flex items-center gap-2 shadow-sm">
                            <div class="w-1.5 h-1.5 rounded-full bg-blue-400 shadow-[0_0_8px_rgba(96,165,250,0.8)]"></div>
                            <span class="text-[8px] font-black uppercase tracking-widest text-white/70">Context: Focused Mode</span>
                        </div>
                        <div class="px-3 py-1 bg-white/5 border border-white/10 rounded-full backdrop-blur-md flex items-center gap-2 shadow-sm">
                            <svg class="w-3 h-3 text-brand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2z"></path></svg>
                            <span class="text-[8px] font-black uppercase tracking-widest text-white/70">Project: Global Refinement</span>
                        </div>
                    </div>

                    <div class="absolute bottom-8 right-8 flex flex-col gap-3 items-end">
                        <div class="px-3 py-1 bg-white/5 border border-white/10 rounded-full backdrop-blur-md flex items-center gap-2 shadow-sm">
                            <span class="text-[8px] font-black uppercase tracking-widest text-white/50">Velocity: 12 Tasks/Day</span>
                        </div>
                        <div class="px-3 py-1 bg-white/5 border border-white/10 rounded-full backdrop-blur-md flex items-center gap-2 shadow-sm">
                            <span class="text-[8px] font-black uppercase tracking-widest text-white/90">Progress: 84% Complete</span>
                        </div>
                    </div>

                    <!-- Floating Task Tags (Dynamic Visuals) -->
                    <div class="absolute top-1/4 right-12 flex flex-col gap-2 rotate-6 opacity-40 group-hover:opacity-100 group-hover:rotate-0 transition-all duration-700">
                        <span class="px-2 py-0.5 bg-brand-500/20 border border-brand-500/30 rounded text-[7px] font-black text-brand-400 uppercase tracking-widest">#HighPriority</span>
                        <span class="px-2 py-0.5 bg-indigo-500/20 border border-indigo-500/30 rounded text-[7px] font-black text-indigo-400 uppercase tracking-widest">#System_Refinement</span>
                    </div>

                    <!-- Team Avatar Stack -->
                    <div class="absolute bottom-1/4 left-12 flex -space-x-2 opacity-30 group-hover:opacity-100 transition-opacity duration-700">
                        <div class="w-6 h-6 rounded-full bg-slate-800 border border-white/10 flex items-center justify-center text-[7px] font-black text-white">TS</div>
                        <div class="w-6 h-6 rounded-full bg-brand-600 border border-white/10 flex items-center justify-center text-[7px] font-black text-white">AM</div>
                        <div class="w-6 h-6 rounded-full bg-indigo-600 border border-white/10 flex items-center justify-center text-[7px] font-black text-white">+5</div>
                    </div>

                    <div class="space-y-6 relative z-10">
                        <div class="w-24 h-24 bg-brand-600 rounded-3xl mx-auto flex items-center justify-center text-white shadow-2xl group-hover:rotate-12 transition-transform duration-700">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <h2 class="text-4xl md:text-6xl font-heading font-black text-white tracking-tight leading-tight">
                            Manajemen Tugas yang <br><span class="text-brand-500">Elegan & Cerdas.</span>
                        </h2>
                    </div>
                </div>
            </div>
        </section>

        <section id="ecosystem" class="py-32 relative overflow-hidden">
            <div class="max-w-7xl mx-auto px-8 relative z-10">
                <div class="text-center mb-24 reveal-animation" style="animation-delay: 600ms;">
                    <h2 class="text-5xl md:text-7xl font-heading font-black text-slate-900 tracking-tighter leading-none mb-6">
                        Ekosistem <span class="text-brand-600">Terpadu.</span>
                    </h2>
                    <p class="text-lg font-bold text-slate-400 uppercase tracking-[0.3em]">Arsitektur Produktivitas Masa Depan</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Card 1 -->
                    <div class="glass-morph p-8 rounded-[2.5rem] border border-white/40 shadow-xl shadow-blue-900/5 transition-all duration-700 tilt-card group reveal-animation relative overflow-hidden" style="animation-delay: 700ms;">
                        <div class="border-beam-container"><div class="border-beam"></div></div>
                        <div class="relative z-10 transition-transform duration-700 group-hover:translate-z-10">
                            <div class="flex justify-between items-start mb-6">
                                <div class="w-14 h-14 bg-slate-900 rounded-2xl flex items-center justify-center text-white group-hover:bg-brand-600 group-hover:rotate-6 transition-all duration-500 shadow-lg">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path></svg>
                                </div>
                                <div class="px-2 py-1 bg-brand-500/10 border border-brand-500/20 rounded text-[7px] font-black text-brand-600 tracking-widest uppercase">CORE</div>
                            </div>
                            <h4 class="text-xl font-heading font-black text-slate-900 mb-3 tracking-tight group-hover:translate-y-[-2px] transition-transform duration-500">Glass-Morph UI</h4>
                            <p class="text-sm font-medium text-slate-500 leading-relaxed mb-6 group-hover:translate-y-[-2px] transition-transform duration-500">Estetika transparan yang dirancang untuk mengurangi *cognitive load* dan polusi visual.</p>
                            
                            <div class="pt-4 border-t border-slate-100 flex items-center justify-between group-hover:border-brand-500/20 transition-colors">
                                <span class="text-[9px] font-bold text-slate-400 uppercase tracking-tighter">Accuracy: 99.9%</span>
                                <div class="w-1.5 h-1.5 rounded-full bg-brand-500 animate-pulse"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div class="glass-morph p-8 rounded-[2.5rem] border border-white/40 shadow-xl shadow-blue-900/5 transition-all duration-700 tilt-card group reveal-animation relative overflow-hidden" style="animation-delay: 800ms;">
                        <div class="border-beam-container"><div class="border-beam" style="animation-delay: -1s;"></div></div>
                        <div class="relative z-10 transition-transform duration-700 group-hover:translate-z-10">
                            <div class="flex justify-between items-start mb-6">
                                <div class="w-14 h-14 bg-slate-900 rounded-2xl flex items-center justify-center text-white group-hover:bg-brand-600 group-hover:rotate-6 transition-all duration-500 shadow-lg">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <div class="px-2 py-1 bg-emerald-500/10 border border-emerald-500/20 rounded text-[7px] font-black text-emerald-600 tracking-widest uppercase">SYNC</div>
                            </div>
                            <h4 class="text-xl font-heading font-black text-slate-900 mb-3 tracking-tight group-hover:translate-y-[-2px] transition-transform duration-500">Sub-second Sync</h4>
                            <p class="text-sm font-medium text-slate-500 leading-relaxed mb-6 group-hover:translate-y-[-2px] transition-transform duration-500">Sinkronisasi instan antar perangkat tanpa jeda. Apa yang Anda tulis di sini, ada di sana.</p>
                            
                            <div class="pt-4 border-t border-slate-100 flex items-center justify-between group-hover:border-emerald-500/20 transition-colors">
                                <span class="text-[9px] font-bold text-slate-400 uppercase tracking-tighter">Latency: < 40ms</span>
                                <div class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3 -->
                    <div class="glass-morph p-8 rounded-[2.5rem] border border-white/40 shadow-xl shadow-blue-900/5 transition-all duration-700 tilt-card group reveal-animation relative overflow-hidden" style="animation-delay: 900ms;">
                        <div class="border-beam-container"><div class="border-beam" style="animation-delay: -2s;"></div></div>
                        <div class="relative z-10 transition-transform duration-700 group-hover:translate-z-10">
                            <div class="flex justify-between items-start mb-6">
                                <div class="w-14 h-14 bg-slate-900 rounded-2xl flex items-center justify-center text-white group-hover:bg-brand-600 group-hover:rotate-6 transition-all duration-500 shadow-lg">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                </div>
                                <div class="px-2 py-1 bg-indigo-500/10 border border-indigo-500/20 rounded text-[7px] font-black text-indigo-600 tracking-widest uppercase">SMART</div>
                            </div>
                            <h4 class="text-xl font-heading font-black text-slate-900 mb-3 tracking-tight group-hover:translate-y-[-2px] transition-transform duration-500">Neural Focus</h4>
                            <p class="text-sm font-medium text-slate-500 leading-relaxed mb-6 group-hover:translate-y-[-2px] transition-transform duration-500">Antarmuka adaptif yang mengikuti ritme kerja Anda untuk mempertahankan ambang fokus maksimal.</p>
                            
                            <div class="pt-4 border-t border-slate-100 flex items-center justify-between group-hover:border-indigo-500/20 transition-colors">
                                <span class="text-[9px] font-bold text-slate-400 uppercase tracking-tighter">AI Engine: Active</span>
                                <div class="w-1.5 h-1.5 rounded-full bg-indigo-500 animate-pulse"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 4 -->
                    <div class="glass-morph p-8 rounded-[2.5rem] border border-white/40 shadow-xl shadow-blue-900/5 transition-all duration-700 tilt-card group reveal-animation relative overflow-hidden" style="animation-delay: 1000ms;">
                        <div class="border-beam-container"><div class="border-beam" style="animation-delay: -3s;"></div></div>
                        <div class="relative z-10 transition-transform duration-700 group-hover:translate-z-10">
                            <div class="flex justify-between items-start mb-6">
                                <div class="w-14 h-14 bg-slate-900 rounded-2xl flex items-center justify-center text-white group-hover:bg-brand-600 group-hover:rotate-6 transition-all duration-500 shadow-lg">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                </div>
                                <div class="px-2 py-1 bg-amber-500/10 border border-amber-500/20 rounded text-[7px] font-black text-amber-600 tracking-widest uppercase">MOTION</div>
                            </div>
                            <h4 class="text-xl font-heading font-black text-slate-900 mb-3 tracking-tight group-hover:translate-y-[-2px] transition-transform duration-500">Cinematic Motion</h4>
                            <p class="text-sm font-medium text-slate-500 leading-relaxed mb-6 group-hover:translate-y-[-2px] transition-transform duration-500">Animasi transisi organik yang memberikan kepuasan taktil pada setiap interaksi digital.</p>
                            
                            <div class="pt-4 border-t border-slate-100 flex items-center justify-between group-hover:border-amber-500/20 transition-colors">
                                <span class="text-[9px] font-bold text-slate-400 uppercase tracking-tighter">Refresh: 60 FPS</span>
                                <div class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 5 -->
                    <div class="glass-morph p-8 rounded-[2.5rem] border border-white/40 shadow-xl shadow-blue-900/5 transition-all duration-700 tilt-card group reveal-animation relative overflow-hidden" style="animation-delay: 1100ms;">
                        <div class="border-beam-container"><div class="border-beam" style="animation-delay: -1.5s;"></div></div>
                        <div class="relative z-10 transition-transform duration-700 group-hover:translate-z-10">
                            <div class="flex justify-between items-start mb-6">
                                <div class="w-14 h-14 bg-slate-900 rounded-2xl flex items-center justify-center text-white group-hover:bg-brand-600 group-hover:rotate-6 transition-all duration-500 shadow-lg">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                                </div>
                                <div class="px-2 py-1 bg-red-500/10 border border-red-500/20 rounded text-[7px] font-black text-red-600 tracking-widest uppercase">SECURE</div>
                            </div>
                            <h4 class="text-xl font-heading font-black text-slate-900 mb-3 tracking-tight group-hover:translate-y-[-2px] transition-transform duration-500">Data Integrity</h4>
                            <p class="text-sm font-medium text-slate-500 leading-relaxed mb-6 group-hover:translate-y-[-2px] transition-transform duration-500">Keamanan tingkat enkripsi militer untuk memastikan rencana strategis Anda tetap menjadi rahasia.</p>
                            
                            <div class="pt-4 border-t border-slate-100 flex items-center justify-between group-hover:border-red-500/20 transition-colors">
                                <span class="text-[9px] font-bold text-slate-400 uppercase tracking-tighter">Crypto: AES-256</span>
                                <div class="w-1.5 h-1.5 rounded-full bg-red-500 animate-pulse"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 6 -->
                    <div class="glass-morph p-8 rounded-[2.5rem] border border-white/40 shadow-xl shadow-blue-900/5 transition-all duration-700 tilt-card group reveal-animation relative overflow-hidden" style="animation-delay: 1200ms;">
                        <div class="border-beam-container"><div class="border-beam" style="animation-delay: -2.5s;"></div></div>
                        <div class="relative z-10 transition-transform duration-700 group-hover:translate-z-10">
                            <div class="flex justify-between items-start mb-6">
                                <div class="w-14 h-14 bg-slate-900 rounded-2xl flex items-center justify-center text-white group-hover:bg-brand-600 group-hover:rotate-6 transition-all duration-500 shadow-lg">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
                                </div>
                                <div class="px-2 py-1 bg-cyan-500/10 border border-cyan-500/20 rounded text-[7px] font-black text-cyan-600 tracking-widest uppercase">GLOBAL</div>
                            </div>
                            <h4 class="text-xl font-heading font-black text-slate-900 mb-3 tracking-tight group-hover:translate-y-[-2px] transition-transform duration-500">Global Command</h4>
                            <p class="text-sm font-medium text-slate-500 leading-relaxed mb-6 group-hover:translate-y-[-2px] transition-transform duration-500">Kelola proyek lintas zona waktu dan tim dengan satu pusat kendali yang terintegrasi sempurna.</p>
                            
                            <div class="pt-4 border-t border-slate-100 flex items-center justify-between group-hover:border-cyan-500/20 transition-colors">
                                <span class="text-[9px] font-bold text-slate-400 uppercase tracking-tighter">Nodes: 24 Region</span>
                                <div class="w-1.5 h-1.5 rounded-full bg-cyan-500 animate-pulse"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 7 -->
                    <div class="glass-morph p-8 rounded-[2.5rem] border border-white/40 shadow-xl shadow-blue-900/5 transition-all duration-700 tilt-card group reveal-animation relative overflow-hidden" style="animation-delay: 1300ms;">
                        <div class="border-beam-container"><div class="border-beam" style="animation-delay: -3.5s;"></div></div>
                        <div class="relative z-10 transition-transform duration-700 group-hover:translate-z-10">
                            <div class="flex justify-between items-start mb-6">
                                <div class="w-14 h-14 bg-slate-900 rounded-2xl flex items-center justify-center text-white group-hover:bg-brand-600 group-hover:rotate-6 transition-all duration-500 shadow-lg">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                                </div>
                                <div class="px-2 py-1 bg-fuchsia-500/10 border border-fuchsia-500/20 rounded text-[7px] font-black text-fuchsia-600 tracking-widest uppercase">ARCHIVE</div>
                            </div>
                            <h4 class="text-xl font-heading font-black text-slate-900 mb-3 tracking-tight group-hover:translate-y-[-2px] transition-transform duration-500">Smart Archive</h4>
                            <p class="text-sm font-medium text-slate-500 leading-relaxed mb-6 group-hover:translate-y-[-2px] transition-transform duration-500">Pengarsipan cerdas yang memisahkan antara hiruk-pikuk harian dan arsip pencapaian jangka panjang.</p>
                            
                            <div class="pt-4 border-t border-slate-100 flex items-center justify-between group-hover:border-fuchsia-500/20 transition-colors">
                                <span class="text-[9px] font-bold text-slate-400 uppercase tracking-tighter">Space: Unlimited</span>
                                <div class="w-1.5 h-1.5 rounded-full bg-fuchsia-500 animate-pulse"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 8 -->
                    <div class="glass-morph p-8 rounded-[2.5rem] border border-white/40 shadow-xl shadow-blue-900/5 transition-all duration-700 tilt-card group reveal-animation relative overflow-hidden" style="animation-delay: 1400ms;">
                        <div class="border-beam-container"><div class="border-beam" style="animation-delay: -0.5s;"></div></div>
                        <div class="relative z-10 transition-transform duration-700 group-hover:translate-z-10">
                            <div class="flex justify-between items-start mb-6">
                                <div class="w-14 h-14 bg-slate-900 rounded-2xl flex items-center justify-center text-white group-hover:bg-brand-600 group-hover:rotate-6 transition-all duration-500 shadow-lg">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                </div>
                                <div class="px-2 py-1 bg-slate-500/10 border border-slate-500/20 rounded text-[7px] font-black text-slate-600 tracking-widest uppercase">OFFLINE</div>
                            </div>
                            <h4 class="text-xl font-heading font-black text-slate-900 mb-3 tracking-tight group-hover:translate-y-[-2px] transition-transform duration-500">Offline Engine</h4>
                            <p class="text-sm font-medium text-slate-500 leading-relaxed mb-6 group-hover:translate-y-[-2px] transition-transform duration-500">Eksekusi tanpa batas meski tanpa koneksi. Data Anda disinkronkan otomatis saat kembali online.</p>
                            
                            <div class="pt-4 border-t border-slate-100 flex items-center justify-between group-hover:border-slate-500/20 transition-colors">
                                <span class="text-[9px] font-bold text-slate-400 uppercase tracking-tighter">State: Persistent</span>
                                <div class="w-1.5 h-1.5 rounded-full bg-slate-500 animate-pulse"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Decorative Blobs -->
            <div class="absolute top-1/2 left-0 w-96 h-96 bg-brand-500/5 rounded-full blur-[100px] -translate-x-1/2"></div>
            <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-indigo-500/5 rounded-full blur-[120px] translate-x-1/3"></div>
        </section>

        <section id="how-it-works" class="py-32 bg-white relative">
            <!-- Decorative Pixel Grid -->
            <div class="absolute top-0 right-0 w-64 h-64 opacity-[0.03] pointer-events-none" style="background-image: radial-gradient(#000 1px, transparent 1px); background-size: 20px 20px;"></div>

            <div class="max-w-7xl mx-auto px-8 relative z-10">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-24 items-center">
                    <div class="space-y-12">
                        <h2 class="text-5xl font-heading font-black text-slate-900 tracking-tight leading-none">
                            Dirancang dengan <br>Ketelitian <span class="text-brand-600">Piksel.</span>
                        </h2>
                        <div class="space-y-10">
                            <div class="group flex gap-6">
                                <div class="w-12 h-12 shrink-0 bg-slate-50 rounded-xl flex items-center justify-center text-brand-600 font-black group-hover:bg-brand-600 group-hover:text-white transition-colors uppercase">01</div>
                                <div class="space-y-2">
                                    <h4 class="text-xl font-bold text-slate-900">Kedalaman Layer</h4>
                                    <p class="text-slate-500 leading-relaxed font-medium">Efek shadow bertingkat yang memberikan kesan elemen melayang secara natural pada z-axis.</p>
                                </div>
                            </div>
                            <div class="group flex gap-6">
                                <div class="w-12 h-12 shrink-0 bg-slate-50 rounded-xl flex items-center justify-center text-brand-600 font-black group-hover:bg-brand-600 group-hover:text-white transition-colors uppercase">02</div>
                                <div class="space-y-2">
                                    <h4 class="text-xl font-bold text-slate-900">Transisi Organik</h4>
                                    <p class="text-slate-500 leading-relaxed font-medium">Animasi menggunakan cubic-bezier khusus untuk sensasi gerakan yang luwes dan responsif.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Technical Specs Grid -->
                        <div class="grid grid-cols-2 gap-4 mt-12 pt-12 border-t border-slate-100">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span class="text-[10px] font-black uppercase tracking-widest text-slate-400">60 FPS Transitions</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span class="text-[10px] font-black uppercase tracking-widest text-slate-400">Dynamic Blur Radius</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span class="text-[10px] font-black uppercase tracking-widest text-slate-400">HSL Adaptive Palette</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span class="text-[10px] font-black uppercase tracking-widest text-slate-400">Vector Architecture</span>
                            </div>
                        </div>
                    </div>
                    <div class="relative">
                        <!-- Decorative Ruler -->
                        <div class="absolute -top-12 left-1/2 -translate-x-1/2 flex gap-1 items-end pointer-events-none opacity-20">
                            @for ($i = 0; $i < 40; $i++)
                                <div class="w-px {{ $i % 5 == 0 ? 'h-6 bg-slate-900' : 'h-3 bg-slate-400' }}"></div>
                            @endfor
                        </div>
                        <div class="aspect-square rounded-[4rem] bg-slate-50 border border-slate-100 flex items-center justify-center">
                            <div class="w-2/3 h-2/3 bg-slate-900 rounded-[3rem] shadow-2xl rotate-6 animate-pulse p-8 flex items-end relative overflow-hidden">
                                <div class="absolute inset-0 bg-gradient-to-tr from-brand-600/20 to-transparent"></div>
                                <div class="w-full h-2 bg-brand-500/30 rounded-full overflow-hidden relative z-10">
                                    <div class="w-3/4 h-full bg-brand-500"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="cta" class="py-32 max-w-7xl mx-auto px-8">
            <div class="relative bg-brand-600 rounded-[3.5rem] p-12 md:p-24 text-center overflow-hidden group shadow-2xl shadow-brand-500/20">
                <div class="absolute inset-0 bg-slate-900 opacity-0 group-hover:opacity-10 transition-opacity duration-700"></div>
                <!-- Floating Decorative Icons for CTA -->
                <div class="absolute top-10 right-10 w-20 h-20 border border-white/20 rounded-full flex items-center justify-center text-white/20 -rotate-12 group-hover:scale-110 transition-transform">
                    <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 24 24"><path d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>

                <h2 class="relative z-10 text-5xl md:text-8xl font-heading font-black text-white tracking-tighter leading-none mb-12">
                    Siap Mengatur <br>Masa Depanmu?
                </h2>
                <div class="relative z-10 mb-12">
                    <a href="{{ route('register') }}" class="inline-flex items-center gap-4 px-12 py-6 bg-white text-slate-900 text-xl font-black rounded-3xl hover:scale-105 active:scale-95 transition-all shadow-2xl group/btn">
                        <span>Deploy My Workspace</span>
                        <svg class="w-6 h-6 group-hover/btn:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>

                <!-- Social Proof & Trust Bar -->
                <div class="relative z-10 flex flex-col items-center gap-6 pt-12 border-t border-white/10">
                    <p class="text-[10px] font-black uppercase tracking-[0.4em] text-white/60">Bergabung dengan 15,000+ Visioner Global</p>
                    <div class="flex gap-8 opacity-40 hover:opacity-100 transition-opacity duration-700">
                        <span class="text-sm font-black text-white tracking-widest italic">ISO-27001</span>
                        <span class="text-sm font-black text-white tracking-widest italic">GDPR READY</span>
                        <span class="text-sm font-black text-white tracking-widest italic">SOC2 TYPE II</span>
                    </div>
                </div>
            </div>
        </section>

        <footer class="pt-24 pb-12 border-t border-slate-100 bg-slate-50">
            <div class="max-w-7xl mx-auto px-8">
                <div class="flex flex-col md:flex-row justify-between items-start gap-12 mb-20">
                    <div class="max-w-xs space-y-6">
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 bg-slate-900 rounded-lg flex items-center justify-center text-white">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                            </div>
                            <span class="text-lg font-heading font-black tracking-tight">Task<span class="text-brand-600">Master</span></span>
                        </div>
                        <p class="text-slate-500 font-medium leading-relaxed">Membantu kamu tetap waras di tengah hiruk-pikuk dunia digital.</p>
                    </div>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-16">
                        <div class="space-y-4">
                            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Socials</p>
                            <nav class="flex flex-col gap-2 font-bold text-sm text-slate-600">
                                <a href="#" class="hover:text-brand-600 transition-colors">Twitter</a>
                                <a href="#" class="hover:text-brand-600 transition-colors">GitHub</a>
                            </nav>
                        </div>
                        <div class="space-y-4">
                            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Legal</p>
                            <nav class="flex flex-col gap-2 font-bold text-sm text-slate-600">
                                <a href="#" class="hover:text-brand-600 transition-colors">Privacy</a>
                                <a href="#" class="hover:text-brand-600 transition-colors">Terms</a>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="pt-8 border-t border-slate-200 flex flex-col md:flex-row justify-between gap-4">
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">© 2026 Task Master Collective.</p>
                    <p class="text-xs font-bold text-slate-300 uppercase tracking-widest">Designed for absolute focus.</p>
                </div>
            </div>
        </footer>
    </main>

</body>
</html>