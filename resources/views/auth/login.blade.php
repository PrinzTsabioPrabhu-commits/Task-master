<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="text-center mb-10 reveal-animation" style="animation-delay: 300ms;">
        <h2 class="text-3xl font-heading font-black text-slate-900 tracking-tighter">Welcome Back.</h2>
        <p class="text-slate-400 font-bold mt-2 uppercase tracking-[0.2em] text-[10px]">Access your task command center</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div class="reveal-animation" style="animation-delay: 400ms;">
            <label class="block text-[9px] font-black text-slate-400 uppercase tracking-[0.25em] mb-2 pl-1">Email Address</label>
            <input type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                class="w-full bg-slate-50/50 border border-slate-200 rounded-xl px-4 py-3.5 focus:ring-4 focus:ring-brand-100 focus:border-brand-500 outline-none transition-all duration-300 text-slate-800 font-bold placeholder-slate-300" placeholder="name@email.com">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="reveal-animation" style="animation-delay: 500ms;">
            <div class="flex justify-between items-center mb-2 px-1">
                <label class="block text-[9px] font-black text-slate-400 uppercase tracking-[0.25em]">Password</label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-[9px] font-black text-brand-600 hover:text-brand-800 uppercase tracking-[0.2em] transition-colors">
                        Forgot?
                    </a>
                @endif
            </div>
            <input type="password" name="password" required autocomplete="current-password"
                class="w-full bg-slate-50/50 border border-slate-200 rounded-xl px-4 py-3.5 focus:ring-4 focus:ring-brand-100 focus:border-brand-500 outline-none transition-all duration-300 text-slate-800 font-bold placeholder-slate-300" placeholder="••••••••">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center reveal-animation" style="animation-delay: 600ms;">
            <input id="remember_me" type="checkbox" name="remember" class="w-4 h-4 rounded border-slate-300 text-brand-600 focus:ring-brand-500 cursor-pointer transition-all">
            <label for="remember_me" class="ms-3 text-[11px] font-bold text-slate-500 cursor-pointer select-none tracking-tight">Remember this device</label>
        </div>

        <div class="pt-2 reveal-animation" style="animation-delay: 700ms;">
            <button type="submit" class="btn btn-primary w-full py-4 text-lg group shadow-lg shadow-brand-500/20">
                <span>Sign In</span>
                <svg class="w-5 h-5 ml-2 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </button>
        </div>

        <p class="text-center font-bold text-slate-400 text-[10px] uppercase tracking-widest mt-8 reveal-animation" style="animation-delay: 800ms;">
            New here? 
            <a href="{{ route('register') }}" class="text-brand-600 hover:text-brand-800 transition-colors">Create account</a>
        </p>
    </form>
</x-guest-layout>
