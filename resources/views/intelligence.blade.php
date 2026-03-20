<x-app-layout>
    <x-slot name="header">
        {{ __('Intelligence Center') }}
    </x-slot>

    <!-- Background Elements -->
    <div class="fixed inset-0 pointer-events-none -z-10 overflow-hidden">
        <div class="absolute top-[-10%] left-[-5%] w-[40%] h-[40%] bg-brand-500/5 rounded-full blur-[120px]"></div>
        <div class="absolute bottom-[10%] right-[-10%] w-[35%] h-[35%] bg-indigo-500/5 rounded-full blur-[100px]"></div>
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
                    <span class="text-[9px] font-black uppercase tracking-[0.2em] text-slate-500">Neural Analytics Hub</span>
                </div>
                
                <h1 class="text-4xl md:text-7xl font-heading font-black text-slate-900 leading-[1.1] tracking-tighter">
                    Data-Driven <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-600 to-indigo-400">Intelligence.</span>
                </h1>
                
                <p class="text-slate-400 font-bold text-xs mt-6 uppercase tracking-[0.25em] flex items-center gap-3">
                    <span class="w-12 h-px bg-slate-200"></span>
                    Performance metrics & priority density
                </p>
            </div>

            <!-- Intelligence Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- Main Chart Card -->
                <div class="lg:col-span-2 glass-morph p-10 rounded-[3rem] shadow-2xl relative overflow-hidden group">
                    <div class="border-beam-container"><div class="border-beam"></div></div>
                    
                    <div class="flex items-center justify-between mb-12">
                        <div>
                            <h3 class="text-2xl font-heading font-black text-slate-900 tracking-tight italic">Productivity <span class="text-brand-600">Pulse</span></h3>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">Neural output across last 7-day cycle</p>
                        </div>
                        <div class="px-4 py-2 bg-slate-50 rounded-xl border border-slate-100 flex items-center gap-3">
                            <span class="text-[10px] font-black text-slate-400">STATUS:</span>
                            <span class="text-[10px] font-mono font-bold text-emerald-600">OPTIMIZED</span>
                        </div>
                    </div>

                    <!-- SVG Chart Logic -->
                    <div class="relative h-64 w-full">
                        <svg class="w-full h-full" viewBox="0 0 1000 300" preserveAspectRatio="none">
                            <defs>
                                <linearGradient id="chartGradient" x1="0" y1="0" x2="0" y2="1">
                                    <stop offset="0%" stop-color="#4f46e5" stop-opacity="0.2"/>
                                    <stop offset="100%" stop-color="#4f46e5" stop-opacity="0"/>
                                </linearGradient>
                            </defs>
                            <!-- Grid Lines -->
                            <line x1="0" y1="50" x2="1000" y2="50" stroke="#f1f5f9" stroke-width="1" />
                            <line x1="0" y1="150" x2="1000" y2="150" stroke="#f1f5f9" stroke-width="1" />
                            <line x1="0" y1="250" x2="1000" y2="250" stroke="#f1f5f9" stroke-width="1" />
                            
                            @php
                                $maxCount = max($trend->pluck('count')->max() ?? 1, 5);
                                $points = "";
                                foreach($trend as $i => $t) {
                                    $x = ($i / 6) * 1000;
                                    $y = 250 - (($t->count / $maxCount) * 200);
                                    $points .= ($i === 0 ? "M" : " L") . "$x,$y";
                                }
                                $areaPoints = $points . " L1000,300 L0,300 Z";
                            @endphp

                            <!-- Path -->
                            <path d="{{ $areaPoints }}" fill="url(#chartGradient)" />
                            <path d="{{ $points ?: 'M0,250 L1000,250' }}" fill="none" stroke="#4f46e5" stroke-width="4" stroke-linecap="round" class="animate-dash" stroke-dasharray="1000" stroke-dashoffset="1000" style="animation: dash 3s ease-in-out forwards;" />
                        </svg>
                    </div>

                    <div class="flex items-center justify-between mt-8 pt-8 border-t border-slate-50">
                        @foreach($trend as $t)
                            <span class="text-[9px] font-black text-slate-300 tracking-widest">{{ \Carbon\Carbon::parse($t->date)->format('D') }}</span>
                        @endforeach
                        @if($trend->count() < 7)
                            @for($i = $trend->count(); $i < 7; $i++)
                                <span class="text-[9px] font-black text-slate-100 tracking-widest">NONE</span>
                            @endfor
                        @endif
                    </div>
                </div>

                <!-- Priority Density Card -->
                <div class="glass-morph p-10 rounded-[3rem] shadow-2xl relative overflow-hidden group tilt-card">
                    <div class="border-beam-container"><div class="border-beam" style="animation-delay: -2s;"></div></div>
                    
                    <h3 class="text-xl font-heading font-black text-slate-900 tracking-tight italic mb-8">Priority <span class="text-brand-600">Density</span></h3>
                    
                    <div class="space-y-8">
                        @php
                            $highCount = $priorityStats['high'] ?? 0;
                            $medCount = $priorityStats['medium'] ?? 0;
                            $lowCount = $priorityStats['low'] ?? 0;
                            $totalP = max($totalTasks, 1);
                            
                            $highP = round(($highCount / $totalP) * 100);
                            $medP = round(($medCount / $totalP) * 100);
                            $lowP = round(($lowCount / $totalP) * 100);
                        @endphp
                        <!-- High -->
                        <div class="space-y-2">
                            <div class="flex items-center justify-between text-[10px] font-black uppercase tracking-widest text-slate-400">
                                <span>Critical Assets</span>
                                <span class="text-red-500 font-mono">{{ $highP }}%</span>
                            </div>
                            <div class="h-2 bg-slate-100 rounded-full overflow-hidden">
                                <div class="h-full bg-red-500 rounded-full" style="width: {{ $highP }}%"></div>
                            </div>
                        </div>
                        <!-- Med -->
                        <div class="space-y-2">
                            <div class="flex items-center justify-between text-[10px] font-black uppercase tracking-widest text-slate-400">
                                <span>Standard Flow</span>
                                <span class="text-brand-600 font-mono">{{ $medP }}%</span>
                            </div>
                            <div class="h-2 bg-slate-100 rounded-full overflow-hidden">
                                <div class="h-full bg-brand-500 rounded-full" style="width: {{ $medP }}%"></div>
                            </div>
                        </div>
                        <!-- Low -->
                        <div class="space-y-2">
                            <div class="flex items-center justify-between text-[10px] font-black uppercase tracking-widest text-slate-400">
                                <span>Steady Maintenance</span>
                                <span class="text-emerald-500 font-mono">{{ $lowP }}%</span>
                            </div>
                            <div class="h-2 bg-slate-100 rounded-full overflow-hidden">
                                <div class="h-full bg-emerald-500 rounded-full" style="width: {{ $lowP }}%"></div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-12 p-6 bg-slate-50/50 rounded-2xl border border-slate-100 italic">
                        <p class="text-[10px] font-bold text-slate-500 leading-relaxed uppercase tracking-widest text-center">
                            @if($highP > 40)
                                "SYSTEM ALERT: High concentration of critical tasks. Immediate attention suggested."
                            @else
                                "Neural suggestion: Workspace distribution is currently balanced."
                            @endif
                        </p>
                    </div>
                </div>

                <!-- Secondary Metric Cards -->
                @php
                    $metrics = [
                        ['label' => 'Total Volume', 'val' => $totalTasks, 'sub' => 'All tasks in system', 'color' => 'text-slate-900'],
                        ['label' => 'verified clearance', 'val' => $completedCount, 'sub' => 'Total completed', 'color' => 'text-emerald-600'],
                        ['label' => 'Neural Sync', 'val' => 'Live', 'sub' => 'Real-time database connection', 'color' => 'text-indigo-600'],
                    ];
                @endphp

                @foreach($metrics as $m)
                <div class="glass-morph p-8 rounded-[2.5rem] shadow-xl group tilt-card hover:-translate-y-2 transition-all duration-500">
                    <span class="text-[9px] font-black uppercase tracking-[0.2em] text-slate-400 block mb-2">{{ $m['label'] }}</span>
                    <div class="flex items-center justify-between">
                        <h4 class="text-4xl font-heading font-black tracking-tighter {{ $m['color'] }}">{{ $m['val'] }}</h4>
                        <div class="w-10 h-10 bg-slate-50 rounded-xl flex items-center justify-center text-slate-300 group-hover:bg-brand-50 group-hover:text-brand-500 transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                        </div>
                    </div>
                    <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mt-4">{{ $m['sub'] }}</p>
                </div>
                @endforeach

            </div>
        </div>
    </div>

    <style>
        @keyframes dash {
            to { stroke-dashoffset: 0; }
        }
        .animate-dash {
            stroke-dasharray: 1000;
            stroke-dashoffset: 1000;
        }
    </style>
</x-app-layout>
