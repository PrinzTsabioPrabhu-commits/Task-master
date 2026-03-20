<x-app-layout>
    <x-slot name="header">
        {{ __('Nexus Workspace') }}
    </x-slot>

    <!-- Background Elements -->
    <div class="fixed inset-0 pointer-events-none -z-10 overflow-hidden">
        <div class="absolute top-[-5%] right-[-5%] w-[35%] h-[35%] bg-indigo-500/5 rounded-full blur-[120px]"></div>
        <div class="absolute bottom-[20%] left-[-10%] w-[40%] h-[40%] bg-brand-500/5 rounded-full blur-[100px]"></div>
    </div>

    <div class="py-16">
        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-10">
            
            <!-- High-Impact Header -->
            <div class="mb-16 reveal-stagger">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-white/60 backdrop-blur-sm border border-slate-200 rounded-full shadow-sm mb-6">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-brand-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-brand-500"></span>
                    </span>
                    <span class="text-[9px] font-black uppercase tracking-[0.2em] text-slate-500">Collaborator Nexus</span>
                </div>
                
                <h1 class="text-4xl md:text-7xl font-heading font-black text-slate-900 leading-[1.1] tracking-tighter">
                    Team <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-600 to-indigo-400">Environment.</span>
                </h1>
                
                <p class="text-slate-400 font-bold text-xs mt-6 uppercase tracking-[0.25em] flex items-center gap-3">
                    <span class="w-12 h-px bg-slate-200"></span>
                    Workspace nodes & contributors
                </p>
            </div>

            <!-- Workspace Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-16">
                @php
                    $stats = [
                        ['label' => 'Active Nodes', 'val' => $activeNodes, 'col' => 'text-slate-900'],
                        ['label' => 'Sync Latency', 'val' => '0.04ms', 'col' => 'text-brand-600'],
                        ['label' => 'System Efficiency', 'val' => $efficiency . '%', 'col' => 'text-emerald-600'],
                        ['label' => 'Total Commits', 'fi' => $totalCommits, 'col' => 'text-indigo-600'],
                    ];
                @endphp
                @foreach($stats as $s)
                <div class="glass-morph p-6 rounded-[2rem] border border-white/40 shadow-xl">
                    <span class="text-[8px] font-black uppercase tracking-widest text-slate-400 block mb-2">{{ $s['label'] }}</span>
                    <h4 class="text-2xl font-heading font-black {{ $s['col'] }} tracking-tighter italic">{{ $s['val'] ?? $s['fi'] }}</h4>
                </div>
                @endforeach
            </div>

            <!-- Contributor Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @php
                    $team = [
                        ['name' => 'Prinz Tsabio', 'role' => 'LEAD ARCHITECT', 'init' => 'PT', 'status' => 'ONLINE'],
                        ['name' => 'Sarah Miller', 'role' => 'SYSTEM ANALYST', 'init' => 'SM', 'status' => 'SYNCING'],
                        ['name' => 'James Thorne', 'role' => 'CORE DEV', 'init' => 'JT', 'status' => 'IDLE'],
                        ['name' => 'Elena Vance', 'role' => 'UI ENGINE', 'init' => 'EV', 'status' => 'ONLINE'],
                    ];
                @endphp

                @foreach($team as $t)
                <div class="glass-morph p-8 rounded-[3rem] shadow-2xl relative overflow-hidden group tilt-card">
                    <div class="border-beam-container"><div class="border-beam"></div></div>
                    
                    <div class="flex flex-col items-center text-center">
                        <div class="w-20 h-20 bg-slate-900 rounded-[1.5rem] flex items-center justify-center text-xl font-heading font-black text-white mb-6 transition-transform duration-500 group-hover:rotate-[15deg] group-hover:scale-110 shadow-xl relative overflow-hidden">
                            <div class="absolute inset-0 bg-gradient-to-tr from-white/10 to-transparent"></div>
                            {{ $t['init'] }}
                        </div>
                        
                        <h3 class="text-xl font-heading font-black text-slate-900 tracking-tight italic">{{ $t['name'] }}</h3>
                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-[0.2em] mt-2">{{ $t['role'] }}</p>
                        
                        <div class="mt-8 flex items-center gap-3 px-4 py-1.5 bg-slate-50 rounded-full border border-slate-100">
                             <span class="w-1.5 h-1.5 rounded-full {{ $t['status'] === 'ONLINE' ? 'bg-emerald-500 animate-pulse' : ($t['status'] === 'SYNCING' ? 'bg-brand-500 animate-ping' : 'bg-slate-300') }}"></span>
                             <span class="text-[8px] font-black uppercase tracking-widest text-slate-500">{{ $t['status'] }}</span>
                        </div>

                        <div class="grid grid-cols-2 gap-4 w-full mt-10 pt-8 border-t border-slate-50">
                            <div class="text-center">
                                <span class="text-[7px] font-black text-slate-400 uppercase block">Commits</span>
                                <span class="text-sm font-mono font-bold text-slate-900">482</span>
                            </div>
                            <div class="text-center">
                                <span class="text-[7px] font-black text-slate-400 uppercase block">Efficiency</span>
                                <span class="text-sm font-mono font-bold text-emerald-600">98.2%</span>
                            </div>
                        </div>

                        <button class="mt-8 w-full py-3 bg-white border border-slate-200 rounded-xl text-[9px] font-black tracking-widest uppercase hover:bg-slate-900 hover:text-white transition-all shadow-sm">Initialize Comms</button>
                    </div>
                </div>
                @endforeach

                <!-- Add Node Card -->
                <div class="border-2 border-dashed border-slate-200 rounded-[3rem] p-8 flex flex-col items-center justify-center group hover:border-brand-300 hover:bg-white/50 transition-all cursor-pointer">
                    <div class="w-16 h-16 bg-slate-50 rounded-2xl flex items-center justify-center text-slate-300 group-hover:bg-brand-50 group-hover:text-brand-500 transition-all">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path></svg>
                    </div>
                    <span class="mt-6 text-[10px] font-black text-slate-400 group-hover:text-slate-900 uppercase tracking-widest">Connect New Node</span>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
