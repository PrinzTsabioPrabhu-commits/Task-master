<x-guest-layout>
    <div class="mb-8 text-[11px] font-bold text-slate-400 leading-relaxed text-center reveal-animation uppercase tracking-widest" style="animation-delay: 300ms;">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div class="reveal-animation" style="animation-delay: 400ms;">
            <label class="block text-[9px] font-black text-slate-400 uppercase tracking-[0.25em] mb-2 pl-1">Email Address</label>
            <input type="email" name="email" value="{{ old('email') }}" required autofocus
                class="w-full bg-slate-50/50 border border-slate-200 rounded-xl px-4 py-3.5 focus:ring-4 focus:ring-brand-100 focus:border-brand-500 outline-none transition-all duration-300 text-slate-800 font-bold placeholder-slate-300" placeholder="name@email.com">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="pt-2 reveal-animation" style="animation-delay: 500ms;">
            <button type="submit" class="btn btn-primary w-full py-4 shadow-lg shadow-brand-500/20 group">
                <span>Send Recovery Link</span>
                <svg class="w-5 h-5 ml-2 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </button>
        </div>
    </form>
</x-guest-layout>
