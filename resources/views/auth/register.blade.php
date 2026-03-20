<x-guest-layout>
    <div class="text-center mb-10 reveal-animation" style="animation-delay: 300ms;">
        <h2 class="text-3xl font-heading font-black text-slate-900 tracking-tighter">Create Account.</h2>
        <p class="text-slate-400 font-bold mt-2 uppercase tracking-[0.2em] text-[10px]">Join the new era of productivity</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <!-- Name -->
        <div class="reveal-animation" style="animation-delay: 400ms;">
            <label class="block text-[9px] font-black text-slate-400 uppercase tracking-[0.25em] mb-2 pl-1">Full Name</label>
            <input type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                class="w-full bg-slate-50/50 border border-slate-200 rounded-xl px-4 py-3.5 focus:ring-4 focus:ring-brand-100 focus:border-brand-500 outline-none transition-all duration-300 text-slate-800 font-bold placeholder-slate-300" placeholder="John Doe">
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="reveal-animation" style="animation-delay: 500ms;">
            <label class="block text-[9px] font-black text-slate-400 uppercase tracking-[0.25em] mb-2 pl-1">Email Address</label>
            <input type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                class="w-full bg-slate-50/50 border border-slate-200 rounded-xl px-4 py-3.5 focus:ring-4 focus:ring-brand-100 focus:border-brand-500 outline-none transition-all duration-300 text-slate-800 font-bold placeholder-slate-300" placeholder="name@email.com">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="reveal-animation" style="animation-delay: 600ms;">
            <label class="block text-[9px] font-black text-slate-400 uppercase tracking-[0.25em] mb-2 pl-1">Password</label>
            <input type="password" name="password" required autocomplete="new-password"
                class="w-full bg-slate-50/50 border border-slate-200 rounded-xl px-4 py-3.5 focus:ring-4 focus:ring-brand-100 focus:border-brand-500 outline-none transition-all duration-300 text-slate-800 font-bold placeholder-slate-300" placeholder="••••••••">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="reveal-animation" style="animation-delay: 700ms;">
            <label class="block text-[9px] font-black text-slate-400 uppercase tracking-[0.25em] mb-2 pl-1">Confirm Password</label>
            <input type="password" name="password_confirmation" required autocomplete="new-password"
                class="w-full bg-slate-50/50 border border-slate-200 rounded-xl px-4 py-3.5 focus:ring-4 focus:ring-brand-100 focus:border-brand-500 outline-none transition-all duration-300 text-slate-800 font-bold placeholder-slate-300" placeholder="••••••••">
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="pt-2 reveal-animation" style="animation-delay: 800ms;">
            <button type="submit" class="btn btn-primary w-full py-4 text-lg group shadow-lg shadow-brand-500/20">
                <span>Create Account</span>
                <svg class="w-5 h-5 ml-2 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </button>
        </div>

        <p class="text-center font-bold text-slate-400 text-[10px] uppercase tracking-widest mt-8 reveal-animation" style="animation-delay: 900ms;">
            Already have an account? 
            <a href="{{ route('login') }}" class="text-brand-600 hover:text-brand-800 transition-colors">Sign in</a>
        </p>
    </form>
</x-guest-layout>
