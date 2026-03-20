<section>
    <header>
        <h2 class="text-xl font-heading font-black text-slate-900 tracking-tight italic">
            Perbarui Kata Sandi
        </h2>

        <p class="mt-2 text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em]">
            Pastikan akun Anda menggunakan kata sandi acak yang panjang agar tetap aman.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-8 space-y-6">
        @csrf
        @method('put')
        <div class="space-y-2">
            <x-input-label for="update_password_current_password" :value="__('Kata Sandi Saat Ini')" class="text-[9px] font-black uppercase tracking-[0.25em] text-slate-400 pl-1" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full bg-slate-50/50 border-slate-200 focus:ring-4 focus:ring-brand-100 focus:border-brand-500 rounded-xl transition-all duration-300 py-3 font-bold text-sm" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div class="space-y-2">
            <x-input-label for="update_password_password" :value="__('Kata Sandi Baru')" class="text-[9px] font-black uppercase tracking-[0.25em] text-slate-400 pl-1" />
            <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full bg-slate-50/50 border-slate-200 focus:ring-4 focus:ring-brand-100 focus:border-brand-500 rounded-xl transition-all duration-300 py-3 font-bold text-sm" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div class="space-y-2">
            <x-input-label for="update_password_password_confirmation" :value="__('Konfirmasi Kata Sandi')" class="text-[9px] font-black uppercase tracking-[0.25em] text-slate-400 pl-1" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full bg-slate-50/50 border-slate-200 focus:ring-4 focus:ring-brand-100 focus:border-brand-500 rounded-xl transition-all duration-300 py-3 font-bold text-sm" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-6 pt-2">
            <button type="submit" class="btn btn-primary px-8 py-3 rounded-xl shadow-lg shadow-brand-500/20 group">
                <span>Perbarui Sandi</span>
                <svg class="w-5 h-5 ml-2 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm font-bold text-green-600 flex items-center gap-2"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                    {{ __('Tersimpan.') }}
                </p>
            @endif
        </div>
    </form>
</section>
