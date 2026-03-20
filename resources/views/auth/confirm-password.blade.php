<x-guest-layout>
    <div class="mb-8 text-center reveal-animation" style="animation-delay: 300ms;">
        <h2 class="text-3xl font-heading font-black text-slate-900 tracking-tighter">Konfirmasi Sandi.</h2>
    </div>

    <div class="mb-8 text-[11px] font-bold text-slate-400 leading-relaxed text-center reveal-animation uppercase tracking-widest" style="animation-delay: 400ms;">
        {{ __('Harap konfirmasi kata sandi Anda sebelum melanjutkan ke area yang aman.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-6">
        @csrf

        <!-- Password -->
        <div class="reveal-animation" style="animation-delay: 500ms;">
            <label class="block text-[9px] font-black text-slate-400 uppercase tracking-[0.25em] mb-2 pl-1">Kata Sandi</label>
            <input type="password" name="password" required autocomplete="current-password"
                class="w-full bg-slate-50/50 border border-slate-200 rounded-xl px-4 py-3.5 focus:ring-4 focus:ring-brand-100 focus:border-brand-500 outline-none transition-all duration-300 text-slate-800 font-bold placeholder-slate-300" placeholder="••••••••">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="pt-4 reveal-animation" style="animation-delay: 600ms;">
            <button type="submit" class="btn btn-primary w-full py-4 text-lg shadow-lg shadow-brand-500/20 group">
                <span>Konfirmasi</span>
                <svg class="w-5 h-5 ml-2 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
            </button>
        </div>
    </form>
</x-guest-layout>
