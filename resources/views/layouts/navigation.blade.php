<nav x-data="{ open: false, scrolled: false }" 
     @scroll.window="scrolled = (window.pageYOffset > 20)"
     :class="{ 'border-b border-white/20 bg-white/60 backdrop-blur-xl py-3 shadow-2xl shadow-slate-200/20': scrolled, 'bg-transparent py-6': !scrolled }"
     class="fixed top-4 inset-x-6 z-[100] transition-all duration-700 ease-out rounded-[2rem]">
    
    <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-10">
        <div class="flex justify-between h-16 items-center">
            
            <!-- Logo Section -->
            <div class="flex items-center gap-12">
                <a href="{{ route('dashboard') }}" class="group flex items-center gap-3 tilt-hover">
                    <div class="w-12 h-12 bg-slate-900 rounded-[1.25rem] flex items-center justify-center text-white transition-all duration-500 group-hover:rotate-12 group-hover:scale-110 group-hover:bg-brand-600 shadow-xl group-hover:shadow-brand-500/30 relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-tr from-white/10 to-transparent"></div>
                        <svg class="w-7 h-7 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <span class="text-2xl font-heading font-black text-slate-900 tracking-tighter transition-colors group-hover:text-brand-600">Task<span class="opacity-30 group-hover:opacity-10 transition-opacity">Master</span></span>
                </a>

                <!-- Desktop Navigation -->
                <div class="hidden sm:flex items-center gap-10">
                    <a href="{{ route('dashboard') }}" class="relative group py-2">
                        <span class="text-[11px] font-black uppercase tracking-[0.2em] {{ request()->routeIs('dashboard') ? 'text-slate-900' : 'text-slate-400 group-hover:text-slate-600' }} transition-colors">Overview</span>
                        @if(request()->routeIs('dashboard'))
                            <span class="absolute bottom-0 inset-x-0 h-0.5 bg-brand-600 rounded-full shadow-[0_0_8px_rgba(79,70,229,0.5)]"></span>
                        @endif
                    </a>
                    <a href="{{ route('intelligence') }}" class="relative group py-2">
                        <span class="text-[11px] font-black uppercase tracking-[0.2em] {{ request()->routeIs('intelligence') ? 'text-slate-900' : 'text-slate-400 group-hover:text-slate-600' }} transition-colors">Intelligence</span>
                        @if(request()->routeIs('intelligence'))
                            <span class="absolute bottom-0 inset-x-0 h-0.5 bg-brand-600 rounded-full shadow-[0_0_8px_rgba(79,70,229,0.5)]"></span>
                        @endif
                    </a>
                    <a href="{{ route('log') }}" class="relative group py-2">
                        <span class="text-[11px] font-black uppercase tracking-[0.2em] {{ request()->routeIs('log') ? 'text-slate-900' : 'text-slate-400 group-hover:text-slate-600' }} transition-colors">Logs</span>
                        @if(request()->routeIs('log'))
                            <span class="absolute bottom-0 inset-x-0 h-0.5 bg-brand-600 rounded-full shadow-[0_0_8px_rgba(79,70,229,0.5)]"></span>
                        @endif
                    </a>
                    <a href="{{ route('nexus') }}" class="relative group py-2">
                        <span class="text-[11px] font-black uppercase tracking-[0.2em] {{ request()->routeIs('nexus') ? 'text-slate-900' : 'text-slate-400 group-hover:text-slate-600' }} transition-colors">Nexus</span>
                        @if(request()->routeIs('nexus'))
                            <span class="absolute bottom-0 inset-x-0 h-0.5 bg-brand-600 rounded-full shadow-[0_0_8px_rgba(79,70,229,0.5)]"></span>
                        @endif
                    </a>
                </div>
            </div>

            <!-- Health & Time Metrics (Enrichment) -->
                <div class="hidden sm:flex items-center gap-8 ml-8 pr-8 border-r border-slate-100/50 h-10">
                    <div class="flex flex-col">
                        <span class="text-[8px] font-black uppercase tracking-[0.2em] text-slate-400 mb-0.5">Workspace Health</span>
                        <div class="flex items-center gap-2">
                             <span class="text-xs font-mono font-bold text-brand-600 tracking-tighter">98.4%</span>
                             <div class="flex gap-0.5">
                                <div class="w-1 h-3 bg-brand-500 rounded-full"></div>
                                <div class="w-1 h-3 bg-brand-500 rounded-full"></div>
                                <div class="w-1 h-3 bg-brand-200 rounded-full"></div>
                             </div>
                        </div>
                    </div>
                    <div class="flex flex-col" x-data="{ time: '{{ now()->format('H:i:s') }}' }" x-init="setInterval(() => { const n = new Date(); time = n.toLocaleTimeString('en-GB', { hour: '2-digit', minute: '2-digit', second: '2-digit' }) }, 1000)">
                        <span class="text-[8px] font-black uppercase tracking-[0.2em] text-slate-400 mb-0.5">Neural Clock</span>
                        <div class="flex items-center gap-2">
                            <span class="text-xs font-mono font-bold text-slate-900 tracking-tighter" x-text="time">{{ now()->format('H:i:s') }}</span>
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                        </div>
                    </div>
                </div>

            <!-- Profile / Actions -->
            <div class="hidden sm:flex sm:items-center sm:ms-6 gap-4">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center gap-3 px-4 py-2 bg-white border border-slate-200 rounded-xl text-sm font-bold text-slate-600 hover:border-slate-400 hover:text-slate-900 transition-all duration-300 shadow-sm hover:shadow-md group">
                            <div class="w-8 h-8 rounded-lg bg-slate-100 flex items-center justify-center text-slate-400 group-hover:bg-brand-50 group-hover:text-brand-600 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            </div>
                            <span>{{ Auth::user()->name }}</span>
                            <svg class="w-4 h-4 opacity-40 transition-transform group-hover:translate-y-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="p-2 space-y-1">
                            <x-dropdown-link :href="route('profile.edit')" class="rounded-lg font-bold text-slate-600 hover:bg-slate-50 hover:text-brand-600 transition-colors">
                                {{ __('My Settings') }}
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="rounded-lg font-bold text-slate-600 hover:bg-red-50 hover:text-red-600 transition-colors">
                                    {{ __('Sign Out') }}
                                </x-dropdown-link>
                            </form>
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-xl text-slate-400 hover:text-slate-600 hover:bg-slate-100 transition-all duration-300">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white border-t border-slate-100 shadow-2xl animate-fade-in-down">
        <div class="pt-2 pb-3 space-y-1 px-4">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="rounded-xl font-black uppercase text-[10px] tracking-widest">
                {{ __('Overview') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('intelligence')" :active="request()->routeIs('intelligence')" class="rounded-xl font-black uppercase text-[10px] tracking-widest">
                {{ __('Intelligence') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('log')" :active="request()->routeIs('log')" class="rounded-xl font-black uppercase text-[10px] tracking-widest">
                {{ __('Temporal Log') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('nexus')" :active="request()->routeIs('nexus')" class="rounded-xl font-black uppercase text-[10px] tracking-widest">
                {{ __('Nexus Workspace') }}
            </x-responsive-nav-link>
        </div>

        <div class="pt-4 pb-1 border-t border-slate-100 bg-slate-50/50 px-4">
            <div class="flex items-center gap-3 py-3">
                <div class="w-10 h-10 rounded-xl bg-slate-200 flex items-center justify-center text-slate-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                </div>
                <div>
                    <div class="font-black text-slate-900 tracking-tight">{{ Auth::user()->name }}</div>
                    <div class="font-bold text-xs text-slate-500 uppercase tracking-widest">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-2 space-y-1 pb-4">
                <x-responsive-nav-link :href="route('profile.edit')" class="rounded-xl font-bold">
                    {{ __('Settings') }}
                </x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="rounded-xl font-bold text-red-600">
                        {{ __('Sign Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>

