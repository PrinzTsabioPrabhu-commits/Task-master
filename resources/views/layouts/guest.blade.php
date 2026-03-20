<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
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
    </head>
    <body class="font-sans text-slate-900 antialiased bg-[#fbfcfd] selection:bg-brand-500/10 selection:text-brand-900 overflow-x-hidden relative">
        <!-- Background Elements (Match Welcome/Dashboard) -->
        <div class="fixed inset-0 pointer-events-none -z-10 overflow-hidden">
            <div class="absolute top-[-10%] left-[-10%] w-[40rem] h-[40rem] bg-blue-100/50 rounded-full mix-blend-multiply filter blur-[120px] animate-pulse opacity-60"></div>
            <div class="absolute bottom-[-10%] right-[-10%] w-[40rem] h-[40rem] bg-indigo-100/50 rounded-full mix-blend-multiply filter blur-[120px] animate-pulse animation-delay-2000 opacity-60"></div>
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[60rem] h-[60rem] bg-slate-50 rounded-full mix-blend-overlay filter blur-[100px] opacity-40"></div>
        </div>

        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-12 sm:pt-0 relative px-6">
            <div class="mb-12 z-10 transition-all duration-700 ease-out-quint hover:scale-110 reveal-animation" style="animation-delay: 100ms;">
                <a href="/" class="flex flex-col items-center group">
                    <div class="w-16 h-16 bg-slate-900 rounded-[1.5rem] flex items-center justify-center text-white shadow-2xl transition-all duration-500 group-hover:rotate-6 group-hover:bg-brand-600 group-hover:scale-110 relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-tr from-white/20 to-transparent"></div>
                        <svg class="w-8 h-8 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                </a>
            </div>

            <div class="w-full sm:max-w-md px-10 py-12 glass-morph rounded-[3rem] relative overflow-hidden z-10 reveal-animation shadow-2xl shadow-blue-900/5" style="animation-delay: 200ms;">
                <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-transparent via-brand-500/20 to-transparent"></div>
                {{ $slot }}
            </div>
            
            <div class="mt-16 text-center z-10 pb-12 reveal-animation" style="animation-delay: 800ms;">
                <p class="text-[9px] font-black text-slate-300 uppercase tracking-[0.5em]">Workspace Collective — Integrity by Design</p>
            </div>
        </div>
    </body>
</html>
