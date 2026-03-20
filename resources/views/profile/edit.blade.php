<x-app-layout>
    <div class="py-16">
        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-10">
            <!-- High-Impact Statement Header -->
            <div class="mb-16 reveal-animation" style="animation-delay: 100ms;">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-white/60 backdrop-blur-sm border border-slate-200 rounded-full shadow-sm mb-6">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-brand-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-brand-500"></span>
                    </span>
                    <span class="text-[9px] font-black uppercase tracking-[0.2em] text-slate-500">System Preferences</span>
                </div>
                
                <h1 class="text-4xl md:text-7xl font-heading font-black text-slate-900 leading-[1.1] tracking-tighter">
                    Kelola <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-600 to-indigo-400">Identitas & Keamanan.</span>
                </h1>
                
                <p class="text-slate-400 font-bold text-xs mt-6 uppercase tracking-[0.25em] flex items-center gap-3">
                    <span class="w-12 h-px bg-slate-200"></span>
                    Konfigurasi lingkungan kerja Anda
                </p>
            </div>

            <!-- Update Profile Information -->
            <div class="card card-hover p-10 sm:p-14 group">
                <div class="max-w-2xl">
                    <h3 class="text-xl font-heading font-black text-slate-900 mb-10 border-b-2 border-slate-100 pb-4 inline-block tracking-tight transition-all group-hover:border-brand-500">Identity Details</h3>
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Update Password -->
            <div class="card card-hover p-10 sm:p-14 group">
                <div class="max-w-2xl">
                    <h3 class="text-xl font-heading font-black text-slate-900 mb-10 border-b-2 border-slate-100 pb-4 inline-block tracking-tight transition-all group-hover:border-brand-500">Security Credentials</h3>
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Delete User -->
            <div class="card card-hover p-10 sm:p-14 border-red-100 bg-red-50/5 group shadow-sm">
                <div class="max-w-2xl">
                    <h3 class="text-xl font-heading font-black text-red-600 mb-10 border-b-2 border-red-100 pb-4 inline-block tracking-tight transition-all group-hover:border-red-500">System Liquidation</h3>
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
