<x-guest-layout>
    <div class="mb-8 text-center reveal-animation" style="animation-delay: 300ms;">
        <h2 class="text-3xl font-heading font-black text-slate-900 tracking-tighter">Verifikasi Email.</h2>
    </div>

    <div class="mb-8 text-[11px] font-bold text-slate-400 leading-relaxed text-center reveal-animation uppercase tracking-widest" style="animation-delay: 400ms;">
        {{ __('Terima kasih telah mendaftar! Silakan verifikasi alamat email Anda melalui link yang baru saja kami kirimkan. Jika tidak ada, kami akan mengirimkan yang baru.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-6 p-4 bg-brand-50/50 border border-brand-100/50 rounded-2xl font-bold text-[10px] text-brand-600 text-center uppercase tracking-widest reveal-animation" style="animation-delay: 450ms;">
            {{ __('Link verifikasi baru telah dikirim ke alamat email Anda.') }}
        </div>
    @endif

    <div class="mt-10 flex flex-col gap-4">
        <form method="POST" action="{{ route('verification.send') }}" class="reveal-animation" style="animation-delay: 500ms;">
            @csrf
            <button type="submit" class="btn btn-primary w-full py-4 text-lg shadow-lg shadow-brand-500/20 group">
                <span>{{ __('Kirim Ulang Email') }}</span>
                <svg class="w-5 h-5 ml-2 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}" class="flex justify-center reveal-animation" style="animation-delay: 600ms;">
            @csrf
            <button type="submit" class="text-[10px] font-black text-slate-400 hover:text-red-500 transition-colors uppercase tracking-[0.3em]">
                {{ __('Keluar Akun') }}
            </button>
        </form>
    </div>
</x-guest-layout>
