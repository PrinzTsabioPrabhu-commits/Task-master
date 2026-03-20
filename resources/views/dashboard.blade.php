<x-app-layout>
    <x-slot name="header">
        {{ __('Dashboard') }}
    </x-slot>

    <!-- Background Elements (Match Welcome Page) -->
    <div class="fixed inset-0 pointer-events-none -z-10 overflow-hidden">
        <div class="absolute top-[-5%] right-[-5%] w-[35%] h-[35%] bg-brand-500/10 rounded-full blur-[120px] animate-pulse"></div>
        <div class="absolute bottom-[20%] left-[-10%] w-[30%] h-[30%] bg-indigo-500/5 rounded-full blur-[100px]"></div>
    </div>

    <div class="py-16" x-data="{ 
        openAdd: false, 
        openDelete: false, 
        openEdit: false, 
        targetId: null, 
        taskTitle: '', 
        taskPriority: 'medium',
        taskDueDate: '',
        taskTags: '',
        search: '',
        priorityFilter: 'all'
    }">
        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-10">
            
            @php
                $totalTasks = \App\Models\Task::count();
                $activeTasks = \App\Models\Task::where('is_completed', false)->count();
                $completedTasks = \App\Models\Task::where('is_completed', true)->count();
            @endphp

            <!-- High-Impact Statement Header -->
            <div class="mb-16 reveal-stagger">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-white/60 backdrop-blur-sm border border-slate-200 rounded-full shadow-sm mb-6">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-brand-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-brand-500"></span>
                    </span>
                    <span class="text-[9px] font-black uppercase tracking-[0.2em] text-slate-500">Live Workspace Monitoring</span>
                </div>
                
                <h1 class="text-4xl md:text-7xl font-heading font-black text-slate-900 leading-[1.1] tracking-tighter">
                    Tingkatkan <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-600 to-indigo-400">Efisiensi Anda, {{ Auth::user()->name }}.</span>
                </h1>
                
                <p class="text-slate-400 font-bold text-xs mt-6 uppercase tracking-[0.25em] flex items-center gap-3">
                    <span class="w-12 h-px bg-slate-200"></span>
                    Anda memiliki {{ $activeTasks }} fokus utama hari ini
                </p>
            </div>

            <!-- Overview Stats Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-16">
                <!-- Total -->
                <div class="glass-morph p-8 rounded-[2.5rem] shadow-2xl shadow-slate-200/50 transition-all duration-700 tilt-card group reveal-animation relative overflow-hidden" style="animation-delay: 100ms;">
                    <div class="border-beam-container"><div class="border-beam"></div></div>
                    <div class="relative z-10 transition-transform duration-700 group-hover:translate-z-10">
                        <div class="absolute -right-10 -top-10 w-32 h-32 bg-slate-100 rounded-full group-hover:scale-150 transition-transform duration-1000 ease-out-quint opacity-50"></div>
                        <div class="relative z-20">
                            <div class="flex items-center justify-between mb-8">
                                <div class="w-12 h-12 bg-white border border-slate-100 rounded-xl flex items-center justify-center text-slate-900 shadow-sm transition-all duration-500 group-hover:bg-slate-950 group-hover:text-white group-hover:rotate-6">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                                </div>
                                <div class="text-right">
                                    <span class="text-[9px] font-black uppercase tracking-[0.25em] text-slate-400 block">Total Volume</span>
                                    <span class="text-[8px] font-bold text-emerald-500">+12.4% <span class="text-slate-300">YoY</span></span>
                                </div>
                            </div>
                            <div class="flex items-end justify-between mb-2">
                                <h2 class="text-5xl font-heading font-black text-slate-900 tracking-tighter group-hover:translate-x-1 transition-transform duration-500">{{ $totalTasks }}</h2>
                                <!-- Mini Sparkline CSS -->
                                <div class="flex items-end gap-1 mb-2 h-6 opacity-40 group-hover:opacity-100 transition-opacity">
                                    <div class="w-1 h-3 bg-slate-200 rounded-full"></div>
                                    <div class="w-1 h-5 bg-slate-400 rounded-full"></div>
                                    <div class="w-1 h-2 bg-slate-200 rounded-full"></div>
                                    <div class="w-1 h-4 bg-slate-600 rounded-full"></div>
                                </div>
                            </div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Tugas Terdaftar</p>
                        </div>
                    </div>
                </div>
                <!-- Active -->
                <div class="glass-morph p-8 rounded-[2.5rem] shadow-2xl shadow-brand-500/5 transition-all duration-700 tilt-card group reveal-animation relative overflow-hidden" style="animation-delay: 200ms;">
                    <div class="border-beam-container"><div class="border-beam" style="animation-delay: -1.5s;"></div></div>
                    <div class="relative z-10 transition-transform duration-700 group-hover:translate-z-10">
                        <div class="absolute -right-10 -top-10 w-32 h-32 bg-brand-50 rounded-full group-hover:scale-150 transition-transform duration-1000 ease-out-quint opacity-50"></div>
                        <div class="relative z-20">
                            <div class="flex items-center justify-between mb-8">
                                <div class="w-12 h-12 bg-white border border-slate-100 rounded-xl flex items-center justify-center text-slate-900 shadow-sm transition-all duration-500 group-hover:bg-brand-600 group-hover:text-white group-hover:rotate-6">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <div class="text-right">
                                    <span class="text-[9px] font-black uppercase tracking-[0.25em] text-slate-400 block">Active Velocity</span>
                                    <span class="text-[8px] font-bold text-brand-500">Live <span class="animate-pulse">●</span></span>
                                </div>
                            </div>
                            <div class="flex items-end justify-between mb-2">
                                <h2 class="text-5xl font-heading font-black text-brand-600 tracking-tighter group-hover:translate-x-1 transition-transform duration-500">{{ $activeTasks }}</h2>
                                <div class="flex items-end gap-1 mb-2 h-6 opacity-40 group-hover:opacity-100 transition-opacity">
                                    <div class="w-1 h-5 bg-brand-200 rounded-full"></div>
                                    <div class="w-1 h-3 bg-brand-400 rounded-full"></div>
                                    <div class="w-1 h-6 bg-brand-600 rounded-full"></div>
                                    <div class="w-1 h-4 bg-brand-300 rounded-full"></div>
                                </div>
                            </div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Tugas Aktif</p>
                        </div>
                    </div>
                </div>
                <!-- Completed -->
                <div class="glass-morph p-8 rounded-[2.5rem] shadow-2xl shadow-emerald-500/5 transition-all duration-700 tilt-card group reveal-animation relative overflow-hidden" style="animation-delay: 300ms;">
                    <div class="border-beam-container"><div class="border-beam" style="animation-delay: -3s;"></div></div>
                    <div class="relative z-10 transition-transform duration-700 group-hover:translate-z-10">
                        <div class="absolute -right-10 -top-10 w-32 h-32 bg-emerald-50 rounded-full group-hover:scale-150 transition-transform duration-1000 ease-out-quint opacity-50"></div>
                        <div class="relative z-20">
                            <div class="flex items-center justify-between mb-8">
                                <div class="w-12 h-12 bg-white border border-slate-100 rounded-xl flex items-center justify-center text-slate-900 shadow-sm transition-all duration-500 group-hover:bg-emerald-600 group-hover:text-white group-hover:rotate-6">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                </div>
                                <div class="text-right">
                                    <span class="text-[9px] font-black uppercase tracking-[0.25em] text-slate-400 block">Yield Progress</span>
                                    <span class="text-[8px] font-bold text-emerald-500">+8.2% <span class="text-slate-300">Mth</span></span>
                                </div>
                            </div>
                            <div class="flex items-end justify-between mb-2">
                                <h2 class="text-5xl font-heading font-black text-emerald-600 tracking-tighter group-hover:translate-x-1 transition-transform duration-500">{{ $completedTasks }}</h2>
                                <div class="flex items-end gap-1 mb-2 h-6 opacity-40 group-hover:opacity-100 transition-opacity">
                                    <div class="w-1 h-2 bg-emerald-200 rounded-full"></div>
                                    <div class="w-1 h-4 bg-emerald-400 rounded-full"></div>
                                    <div class="w-1 h-3 bg-emerald-300 rounded-full"></div>
                                    <div class="w-1 h-5 bg-emerald-600 rounded-full"></div>
                                </div>
                            </div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Selesai Diverifikasi</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Task List Main View -->
            <div class="glass-morph overflow-hidden rounded-[3rem] shadow-2xl shadow-slate-200/40 reveal-animation" style="animation-delay: 400ms;">
                <div class="px-8 py-12 sm:px-12 border-b border-white/40 flex flex-col md:flex-row justify-between items-start md:items-center gap-8">
                    <div>
                        <h2 class="text-3xl font-heading font-black text-slate-900 tracking-tighter italic leading-none">
                            Sprint <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-600 to-indigo-400">Aktif</span>
                        </h2>
                        <p class="text-slate-400 font-bold text-[10px] uppercase tracking-[0.25em] mt-4 flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-brand-500"></span>
                            Management & Priority Intelligence
                        </p>
                    </div>
                    <button @click="openAdd = true" class="group relative flex items-center gap-4 px-10 py-4 bg-slate-900 text-white text-sm font-bold rounded-2xl hover:bg-brand-600 transition-all shadow-2xl shadow-brand-500/20 active:scale-95 overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-tr from-white/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        <div class="w-6 h-6 bg-white/10 rounded-lg flex items-center justify-center group-hover:rotate-90 transition-transform duration-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path></svg>
                        </div>
                        <span class="relative z-10">Deploy Tugas</span>
                    </button>
                </div>

                <div class="p-8 sm:p-10 bg-slate-50/20">
                    <!-- Search & Filter Bar (Reactive) -->
                    <div class="mb-14 space-y-8">
                        <div class="relative group max-w-2xl">
                            <div class="absolute -inset-1 bg-gradient-to-r from-brand-600 to-indigo-400 rounded-2xl blur opacity-0 group-focus-within:opacity-20 transition duration-1000 group-hover:duration-200"></div>
                            <input type="text" x-model="search" placeholder="Cari berdasarkan judul atau tag..." 
                                   class="relative w-full bg-white border border-slate-200 rounded-2xl px-6 py-5 pl-14 focus:ring-4 focus:ring-brand-100 focus:border-brand-500 outline-none transition-all duration-500 text-sm font-bold placeholder-slate-300 shadow-sm">
                            <svg class="w-5 h-5 text-slate-300 absolute left-6 top-5.5 group-focus-within:text-brand-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        
                        <div class="flex p-1 bg-slate-100/80 rounded-xl w-full sm:w-fit backdrop-blur-sm border border-slate-200">
                            <button @click="priorityFilter = 'all'" :class="priorityFilter === 'all' ? 'bg-white text-slate-900 shadow-sm' : 'text-slate-400 hover:text-slate-600'" class="px-8 py-2.5 rounded-lg text-[9px] font-black tracking-[0.2em] transition-all">SEMUA</button>
                            <button @click="priorityFilter = 'high'" :class="priorityFilter === 'high' ? 'bg-white text-red-600 shadow-sm' : 'text-slate-400 hover:text-slate-600'" class="px-8 py-2.5 rounded-lg text-[9px] font-black tracking-[0.2em] transition-all">CRITICAL</button>
                            <button @click="priorityFilter = 'medium'" :class="priorityFilter === 'medium' ? 'bg-white text-brand-600 shadow-sm' : 'text-slate-400 hover:text-slate-600'" class="px-8 py-2.5 rounded-lg text-[9px] font-black tracking-[0.2em] transition-all">STANDARD</button>
                            <button @click="priorityFilter = 'low'" :class="priorityFilter === 'low' ? 'bg-white text-emerald-600 shadow-sm' : 'text-slate-400 hover:text-slate-600'" class="px-8 py-2.5 rounded-lg text-[9px] font-black tracking-[0.2em] transition-all">STEADY</button>
                        </div>
                    </div>

                    <div class="task-workspace px-4 pb-32 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @forelse($tasks ?? [] as $index => $task)
                        @php
                            $priorityStyle = match($task->priority) {
                                'high' => ['bg' => 'bg-red-500/5', 'text' => 'text-red-500', 'border' => 'border-red-500/20', 'label' => 'Critical', 'glow' => 'shadow-red-500/10'],
                                'low' => ['bg' => 'bg-emerald-500/5', 'text' => 'text-emerald-500', 'border' => 'border-emerald-500/20', 'label' => 'Steady', 'glow' => 'shadow-emerald-500/10'],
                                default => ['bg' => 'bg-brand-500/5', 'text' => 'text-brand-500', 'border' => 'border-brand-500/20', 'label' => 'Standard', 'glow' => 'shadow-brand-500/10']
                            };
                        @endphp
                        <div x-show="((!search || '{{ strtolower($task->title) }}'.includes(search.toLowerCase()) || '{{ strtolower($task->tags ?? '') }}'.includes(search.toLowerCase())) && (priorityFilter === 'all' || '{{ $task->priority }}' === priorityFilter))"
                             x-transition:enter="transition ease-out duration-500"
                             x-transition:enter-start="opacity-0 scale-90 translate-y-4"
                             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                             class="group relative bg-white border border-slate-100 rounded-[2.5rem] p-6 transition-all duration-700 hover:shadow-2xl {{ $priorityStyle['glow'] }} reveal-animation flex flex-col justify-between min-h-[250px] tilt-card {{ $task->is_completed ? 'opacity-30 grayscale-[50%] scale-[0.98]' : 'hover:-translate-y-2' }}" 
                             style="animation-delay: {{ 500 + ($index * 100) }}ms;">
                            <!-- Premium Border Beam -->
                            <div class="border-beam-container">
                                <div class="border-beam" style="background: conic-gradient(from 0deg, transparent, {{ $task->priority === 'high' ? '#ef4444' : ($task->priority === 'low' ? '#10b981' : '#6366f1') }}, transparent); animation-duration: 4s;"></div>
                            </div>

                            <!-- Card Background Hover Effect -->
                            <div class="absolute inset-0 rounded-[2.5rem] bg-gradient-to-br from-slate-50 to-white opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
                            
                            <div class="relative z-10">
                                <div class="flex items-start justify-between mb-4">
                                    <form action="/tasks/{{ $task->id }}" method="POST">
                                        @csrf @method('PATCH')
                                        <button class="h-10 w-10 rounded-xl border-2 flex items-center justify-center transition-all duration-500 {{ $task->is_completed ? 'bg-emerald-600 border-emerald-600 text-white' : 'border-slate-100 bg-white/50 hover:border-brand-500 hover:scale-110' }}">
                                            @if($task->is_completed) 
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M5 13l4 4L19 7"></path></svg>
                                            @endif
                                        </button>
                                    </form>
                                    <div class="flex flex-col items-end gap-2">
                                        <div class="flex items-center gap-2 px-3 py-1 rounded-full border {{ $priorityStyle['bg'] }} {{ $priorityStyle['text'] }} {{ $priorityStyle['border'] }} backdrop-blur-sm">
                                            <span class="w-1.5 h-1.5 rounded-full bg-current {{ $task->priority === 'high' ? 'animate-pulse' : '' }}"></span>
                                            <span class="text-[8px] font-black uppercase tracking-widest">{{ $priorityStyle['label'] }}</span>
                                        </div>
                                        @if($task->due_at)
                                            <div class="text-[8px] font-black text-brand-600 uppercase tracking-widest bg-brand-50 px-2 py-1 rounded-md border border-brand-100">
                                                Deadline: {{ \Carbon\Carbon::parse($task->due_at)->format('d M') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="cursor-pointer" @click="openEdit = true; targetId = {{ $task->id }}; taskTitle = '{{ addslashes($task->title) }}'; taskPriority = '{{ $task->priority ?? 'medium' }}'; taskDueDate = '{{ $task->due_at ? \Carbon\Carbon::parse($task->due_at)->format('Y-m-d\TH:i') : '' }}'; taskTags = '{{ addslashes($task->tags ?? '') }}'">
                                    <h4 class="text-xl font-heading font-black text-slate-800 leading-tight mb-3 group-hover:text-brand-600 transition-colors {{ $task->is_completed ? 'line-through text-slate-400' : '' }}">
                                        {{ $task->title }}
                                    </h4>
                                    
                                    <!-- Neural Tags Display -->
                                    <div class="flex flex-wrap items-center gap-2 mb-4">
                                        @if($task->tags)
                                            @foreach(explode(',', $task->tags) as $tag)
                                                <span class="px-2 py-0.5 bg-slate-100 text-[7px] font-black text-slate-500 uppercase tracking-tighter rounded-md border border-slate-200">#{{ trim($tag) }}</span>
                                            @endforeach
                                        @else
                                            <span class="text-[8px] font-bold text-slate-300 uppercase italic tracking-widest">No Metadata Tags</span>
                                        @endif
                                    </div>

                                    <div class="flex flex-wrap items-center gap-3">
                                        <span class="text-[8px] font-bold text-slate-400 uppercase tracking-widest flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            {{ $task->created_at->diffForHumans() }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="relative z-10 mt-6 pt-4 border-t border-slate-50 flex items-center justify-between">
                                <div class="flex -space-x-2">
                                    <div class="w-6 h-6 rounded-lg bg-slate-100 border-2 border-white flex items-center justify-center text-[8px] font-black text-slate-400">NT</div>
                                    <div class="w-6 h-6 rounded-lg bg-brand-50 border-2 border-white flex items-center justify-center text-[8px] font-black text-brand-600">SM</div>
                                </div>
                                <div class="flex items-center gap-1 opacity-0 group-hover:opacity-100 transition-all duration-500 translate-y-2 group-hover:translate-y-0">
                                    <button @click="openEdit = true; targetId = {{ $task->id }}; taskTitle = '{{ addslashes($task->title) }}'; taskPriority = '{{ $task->priority ?? 'medium' }}'; taskDueDate = '{{ $task->due_at ? \Carbon\Carbon::parse($task->due_at)->format('Y-m-d\TH:i') : '' }}'; taskTags = '{{ addslashes($task->tags ?? '') }}'" class="w-8 h-8 flex items-center justify-center text-slate-400 hover:text-slate-900 hover:bg-slate-100 rounded-lg transition-all">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                    </button>
                                    <button @click="openDelete = true; targetId = {{ $task->id }}" class="w-8 h-8 flex items-center justify-center text-slate-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-all">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col-span-full text-center py-32 border-2 border-dashed border-slate-200/50 rounded-[3rem] bg-white/30 backdrop-blur-sm group hover:border-brand-300 transition-all duration-1000 overflow-hidden relative">
                            <!-- Background Atmosphere -->
                            <div class="absolute inset-0 bg-gradient-to-b from-transparent to-slate-50/50 opacity-0 group-hover:opacity-100 transition-opacity duration-1000"></div>
                            
                            <div class="relative z-10 flex flex-col items-center">
                                <div class="w-24 h-24 bg-white rounded-[2rem] shadow-2xl shadow-slate-200/50 flex items-center justify-center mb-8 text-slate-200 group-hover:text-brand-500 transition-all duration-700 group-hover:rotate-[15deg] group-hover:scale-110 border border-slate-50">
                                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                                </div>
                                <h3 class="text-2xl font-heading font-black text-slate-300 group-hover:text-slate-900 transition-all duration-500 uppercase tracking-[0.3em] italic">System Idle</h3>
                                <p class="text-slate-400 font-bold mt-4 text-[10px] uppercase tracking-[0.25em] max-w-xs leading-relaxed opacity-60 group-hover:opacity-100 transition-all duration-700">
                                    Neural engine is operational. <br>
                                    Waiting for task deployment sequence...
                                </p>
                                
                                <div class="mt-12 flex items-center gap-6 opacity-20 group-hover:opacity-100 transition-all duration-1000">
                                    <div class="flex flex-col items-center">
                                        <span class="text-[8px] font-black text-slate-400 uppercase">Latency</span>
                                        <span class="text-[10px] font-mono font-bold text-brand-600">0.02ms</span>
                                    </div>
                                    <div class="w-px h-6 bg-slate-200"></div>
                                    <div class="flex flex-col items-center">
                                        <span class="text-[8px] font-black text-slate-400 uppercase">Nodes</span>
                                        <span class="text-[10px] font-mono font-bold text-slate-900">ACTIVE</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Modals (Simplified Design) -->
            <!-- Add Modal -->
            <div x-show="openAdd" class="fixed inset-0 z-[100] flex items-center justify-center p-6" x-cloak>
                <div x-show="openAdd" x-transition.opacity class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm"></div>
                <div x-show="openAdd" @click.away="openAdd = false" x-transition class="relative bg-white w-full max-w-lg rounded-[2.5rem] p-10 shadow-2xl z-10">
                    <h2 class="text-3xl font-heading font-black text-slate-900 mb-8 tracking-tight">New Entry</h2>
                    <form action="/tasks" method="POST" class="space-y-6">
                        @csrf
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Title</label>
                            <input type="text" name="title" required autofocus placeholder="What needs to be done?"
                                   class="w-full border-b-2 border-slate-100 focus:border-brand-500 outline-none py-3 text-lg font-bold text-slate-900 placeholder-slate-200 transition-colors">
                        </div>
                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Deadline</label>
                                <input type="datetime-local" name="due_at"
                                       class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-4 font-bold text-slate-700 outline-none hover:border-brand-500 transition-all shadow-sm">
                            </div>
                            <div>
                                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Neural Tags (CSV)</label>
                                <input type="text" name="tags" placeholder="tech, core, sync"
                                       class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-4 font-bold text-slate-700 outline-none hover:border-brand-500 transition-all shadow-sm">
                            </div>
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Priority</label>
                            <div x-data="{ open: false }" class="relative">
                                <input type="hidden" name="priority" x-model="taskPriority">
                                <button type="button" @click="open = !open" class="w-full flex items-center justify-between bg-slate-50 border border-slate-200 rounded-xl px-4 py-4 font-bold text-slate-700 outline-none hover:border-brand-500 hover:bg-white transition-all shadow-sm">
                                    <div class="flex items-center gap-3">
                                        <template x-if="taskPriority === 'low'">
                                            <div class="flex items-center gap-3 text-emerald-600"><span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>Steady</div>
                                        </template>
                                        <template x-if="taskPriority === 'medium'">
                                            <div class="flex items-center gap-3 text-brand-600"><span class="w-2.5 h-2.5 rounded-full bg-brand-500"></span>Standard</div>
                                        </template>
                                        <template x-if="taskPriority === 'high'">
                                            <div class="flex items-center gap-3 text-red-600"><span class="w-2.5 h-2.5 rounded-full bg-red-500 animate-pulse"></span>Critical</div>
                                        </template>
                                    </div>
                                    <svg class="w-4 h-4 text-slate-400 transition-transform duration-500" :class="open ? 'rotate-180 text-brand-500' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"></path></svg>
                                </button>
                                
                                <div x-show="open" @click.away="open = false" 
                                     x-transition:enter="transition ease-out duration-300" 
                                     x-transition:enter-start="opacity-0 translate-y-4 scale-95" 
                                     x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                                     x-transition:leave="transition ease-in duration-200"
                                     x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                                     x-transition:leave-end="opacity-0 translate-y-4 scale-95"
                                     class="absolute left-0 right-0 bottom-full mb-3 z-[110] bg-white border border-slate-200 rounded-[2rem] shadow-2xl p-2 space-y-1">
                                    <!-- Options -->
                                    <button type="button" @click="taskPriority = 'low'; open = false" class="w-full flex items-center gap-4 px-5 py-4 rounded-2xl hover:bg-emerald-50 text-slate-600 hover:text-emerald-700 font-bold transition-all group">
                                         <span class="w-2 h-2 rounded-full bg-emerald-500"></span>Steady <span class="ml-auto text-[9px] font-black opacity-30 group-hover:opacity-100 uppercase tracking-widest">Low</span>
                                    </button>
                                    <button type="button" @click="taskPriority = 'medium'; open = false" class="w-full flex items-center gap-4 px-5 py-4 rounded-2xl hover:bg-brand-50 text-slate-600 hover:text-brand-700 font-bold transition-all group">
                                         <span class="w-2 h-2 rounded-full bg-brand-500"></span>Standard <span class="ml-auto text-[9px] font-black opacity-30 group-hover:opacity-100 uppercase tracking-widest">Med</span>
                                    </button>
                                    <button type="button" @click="taskPriority = 'high'; open = false" class="w-full flex items-center gap-4 px-5 py-4 rounded-2xl hover:bg-red-50 text-slate-600 hover:text-red-700 font-bold transition-all group">
                                         <span class="w-2 h-2 rounded-full bg-red-500 animate-pulse"></span>Critical <span class="ml-auto text-[9px] font-black opacity-30 group-hover:opacity-100 uppercase tracking-widest">High</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="flex gap-4 pt-6">
                            <button type="button" @click="openAdd = false" class="flex-1 py-4 px-6 rounded-2xl border border-slate-100 text-slate-400 font-bold hover:bg-slate-50 hover:text-slate-900 transition-all">Cancel</button>
                            <button type="submit" class="flex-1 py-4 px-6 rounded-2xl bg-slate-900 text-white font-bold hover:bg-brand-600 transition-all shadow-xl shadow-brand-500/10 active:scale-95">Create Task</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Delete Confirmation -->
            <div x-show="openDelete" class="fixed inset-0 z-[100] flex items-center justify-center p-6" x-cloak>
                <div x-show="openDelete" x-transition.opacity class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm"></div>
                <div x-show="openDelete" @click.away="openDelete = false" x-transition class="relative bg-white w-full max-w-sm rounded-[2.5rem] p-10 shadow-2xl z-10 text-center">
                    <div class="w-16 h-16 bg-red-50 text-red-500 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    </div>
                    <h2 class="text-2xl font-heading font-black text-slate-900 mb-2">Delete Task?</h2>
                    <p class="text-slate-500 font-medium mb-8">This action is permanent.</p>
                    <form :action="'/tasks/' + targetId" method="POST">
                        @csrf @method('DELETE')
                        <div class="flex gap-4">
                            <button type="button" @click="openDelete = false" class="btn btn-secondary flex-1 py-3">No</button>
                            <button type="submit" class="btn bg-red-500 text-white hover:bg-red-600 flex-1 py-3">Yes, Delete</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Edit Modal (Simplified) -->
            <div x-show="openEdit" class="fixed inset-0 z-[100] flex items-center justify-center p-6" x-cloak>
                <div x-show="openEdit" x-transition.opacity class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm"></div>
                <div x-show="openEdit" @click.away="openEdit = false" x-transition class="relative bg-white w-full max-w-lg rounded-[2.5rem] p-10 shadow-2xl z-10">
                    <h2 class="text-3xl font-heading font-black text-slate-900 mb-8 tracking-tight">Edit Entry</h2>
                    <form :action="'/tasks/' + targetId" method="POST" class="space-y-6">
                        @csrf @method('PUT')
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Title</label>
                            <input type="text" name="title" x-model="taskTitle" required
                                   class="w-full border-b-2 border-slate-100 focus:border-brand-500 outline-none py-3 text-lg font-bold text-slate-900 transition-colors">
                        </div>
                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Deadline</label>
                                <input type="datetime-local" name="due_at" x-model="taskDueDate"
                                       class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-4 font-bold text-slate-700 outline-none hover:border-brand-500 transition-all shadow-sm">
                            </div>
                            <div>
                                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Neural Tags (CSV)</label>
                                <input type="text" name="tags" x-model="taskTags" placeholder="tech, core, sync"
                                       class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-4 font-bold text-slate-700 outline-none hover:border-brand-500 transition-all shadow-sm">
                            </div>
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Priority</label>
                            <div x-data="{ open: false }" class="relative">
                                <input type="hidden" name="priority" x-model="taskPriority">
                                <button type="button" @click="open = !open" class="w-full flex items-center justify-between bg-slate-50 border border-slate-200 rounded-xl px-4 py-4 font-bold text-slate-700 outline-none hover:border-brand-500 hover:bg-white transition-all shadow-sm">
                                    <div class="flex items-center gap-3">
                                        <template x-if="taskPriority === 'low'">
                                            <div class="flex items-center gap-3 text-emerald-600"><span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>Steady</div>
                                        </template>
                                        <template x-if="taskPriority === 'medium'">
                                            <div class="flex items-center gap-3 text-brand-600"><span class="w-2.5 h-2.5 rounded-full bg-brand-500"></span>Standard</div>
                                        </template>
                                        <template x-if="taskPriority === 'high'">
                                            <div class="flex items-center gap-3 text-red-600"><span class="w-2.5 h-2.5 rounded-full bg-red-500 animate-pulse"></span>Critical</div>
                                        </template>
                                    </div>
                                    <svg class="w-4 h-4 text-slate-400 transition-transform duration-500" :class="open ? 'rotate-180 text-brand-500' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"></path></svg>
                                </button>
                                
                                <div x-show="open" @click.away="open = false" 
                                     x-transition:enter="transition ease-out duration-300" 
                                     x-transition:enter-start="opacity-0 translate-y-4 scale-95" 
                                     x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                                     x-transition:leave="transition ease-in duration-200"
                                     x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                                     x-transition:leave-end="opacity-0 translate-y-4 scale-95"
                                     class="absolute left-0 right-0 bottom-full mb-3 z-[110] bg-white border border-slate-200 rounded-[2rem] shadow-2xl p-2 space-y-1">
                                    <button type="button" @click="taskPriority = 'low'; open = false" class="w-full flex items-center gap-4 px-5 py-4 rounded-2xl hover:bg-emerald-50 text-slate-600 hover:text-emerald-700 font-bold transition-all group">
                                         <span class="w-2 h-2 rounded-full bg-emerald-500"></span>Steady <span class="ml-auto text-[9px] font-black opacity-30 group-hover:opacity-100 uppercase tracking-widest">Low</span>
                                    </button>
                                    <button type="button" @click="taskPriority = 'medium'; open = false" class="w-full flex items-center gap-4 px-5 py-4 rounded-2xl hover:bg-brand-50 text-slate-600 hover:text-brand-700 font-bold transition-all group">
                                         <span class="w-2 h-2 rounded-full bg-brand-500"></span>Standard <span class="ml-auto text-[9px] font-black opacity-30 group-hover:opacity-100 uppercase tracking-widest">Med</span>
                                    </button>
                                    <button type="button" @click="taskPriority = 'high'; open = false" class="w-full flex items-center gap-4 px-5 py-4 rounded-2xl hover:bg-red-50 text-slate-600 hover:text-red-700 font-bold transition-all group">
                                         <span class="w-2 h-2 rounded-full bg-red-500 animate-pulse"></span>Critical <span class="ml-auto text-[9px] font-black opacity-30 group-hover:opacity-100 uppercase tracking-widest">High</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="flex gap-4 pt-6">
                            <button type="button" @click="openEdit = false" class="flex-1 py-4 px-6 rounded-2xl border border-slate-100 text-slate-400 font-bold hover:bg-slate-50 hover:text-slate-900 transition-all">Cancel</button>
                            <button type="submit" class="flex-1 py-4 px-6 rounded-2xl bg-brand-600 text-white font-bold hover:bg-brand-700 transition-all shadow-xl shadow-brand-500/20 active:scale-95">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
