<x-app-layout>
    <x-slot name="header">
        {{ __('Temporal Log') }}
    </x-slot>

    <!-- Background Elements -->
    <div class="fixed inset-0 pointer-events-none -z-10 overflow-hidden">
        <div class="absolute top-[10%] right-[-5%] w-[35%] h-[35%] bg-brand-500/5 rounded-full blur-[120px]"></div>
        <div class="absolute bottom-[-10%] left-[-10%] w-[45%] h-[45%] bg-indigo-500/5 rounded-full blur-[100px]"></div>
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
                    <span class="text-[9px] font-black uppercase tracking-[0.2em] text-slate-500">Audit History Stream</span>
                </div>
                
                <h1 class="text-4xl md:text-7xl font-heading font-black text-slate-900 leading-[1.1] tracking-tighter">
                    Temporal <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-600 to-indigo-400">Activity Log.</span>
                </h1>
                
                <p class="text-slate-400 font-bold text-xs mt-6 uppercase tracking-[0.25em] flex items-center gap-3">
                    <span class="w-12 h-px bg-slate-200"></span>
                    Sequential audit trail of system events
                </p>
            </div>

            <!-- Log Stream Container -->
            <div class="glass-morph rounded-[3rem] shadow-2xl overflow-hidden reveal-animation">
                <div class="p-10 border-b border-white/40 flex items-center justify-between bg-white/40">
                    <h3 class="text-2xl font-heading font-black text-slate-900 tracking-tight italic">Audit <span class="text-brand-600">Timeline</span></h3>
                    <div class="flex items-center gap-4">
                        <button class="px-6 py-2 bg-slate-900 text-white text-[9px] font-black tracking-widest rounded-xl hover:bg-brand-600 transition-all uppercase">Verify Sequence</button>
                    </div>
                </div>

                <div class="bg-slate-50/10 p-10">
                    <div class="relative space-y-12">
                        <!-- Timeline Line -->
                        <div class="absolute left-6 top-0 bottom-0 w-px bg-slate-200"></div>

                        @foreach($activities as $l)
                        <div class="relative pl-16 group transition-all duration-300">
                            <!-- Dot -->
                            <div class="absolute left-4 top-1.5 w-5 h-5 bg-white border-2 border-slate-200 rounded-full group-hover:border-brand-500 group-hover:scale-125 transition-all duration-500 z-10 flex items-center justify-center">
                                <div class="w-1.5 h-1.5 bg-slate-200 group-hover:bg-brand-500 rounded-full transition-colors"></div>
                            </div>

                            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 p-6 bg-white/40 border border-slate-100/50 rounded-2xl hover:bg-white hover:shadow-xl transition-all duration-500">
                                <div class="space-y-1">
                                    <div class="flex items-center gap-3">
                                        <span class="text-[9px] font-black uppercase tracking-widest px-2 py-0.5 bg-slate-900 text-white rounded">{{ $l['type'] }}</span>
                                        <span class="text-[10px] font-mono font-bold text-slate-400">{{ $l['time'] }}</span>
                                    </div>
                                    <p class="text-sm font-bold text-slate-600 leading-tight">{{ $l['desc'] }}</p>
                                </div>
                                <div class="flex items-center gap-4">
                                    <div class="text-right">
                                        <span class="text-[8px] font-black uppercase tracking-[0.2em] text-slate-400 block mb-1">{{ $l['label'] }}</span>
                                        <span class="text-[10px] font-mono font-bold text-brand-600 uppercase">{{ $l['status'] }}</span>
                                    </div>
                                    <div class="w-10 h-10 bg-slate-50 flex items-center justify-center rounded-xl text-slate-200 group-hover:text-brand-500 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                        <div class="text-center pt-8">
                            <button class="text-[9px] font-black text-slate-400 uppercase tracking-[0.3em] hover:text-brand-600 transition-colors">Load Archive Node 02...</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
