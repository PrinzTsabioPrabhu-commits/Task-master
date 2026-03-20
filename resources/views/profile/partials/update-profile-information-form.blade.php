<section>
    <header>
        <h2 class="text-xl font-heading font-black text-slate-900 tracking-tight italic">
            Informasi Profil
        </h2>

        <p class="mt-2 text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em]">
            Perbarui informasi profil akun dan alamat email Anda.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-8 space-y-6">
        @csrf
        @method('patch')

        <div class="space-y-2">
            <x-input-label for="name" :value="__('Nama')" class="text-[9px] font-black uppercase tracking-[0.25em] text-slate-400 pl-1" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full bg-slate-50/50 border-slate-200 focus:ring-4 focus:ring-brand-100 focus:border-brand-500 rounded-xl transition-all duration-300 py-3 font-bold text-sm" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div class="space-y-2">
            <x-input-label for="email" :value="__('Email')" class="text-[9px] font-black uppercase tracking-[0.25em] text-slate-400 pl-1" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full bg-slate-50/50 border-slate-200 focus:ring-4 focus:ring-brand-100 focus:border-brand-500 rounded-xl transition-all duration-300 py-3 font-bold text-sm" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-4 p-4 bg-amber-50 rounded-xl border border-amber-100">
                    <p class="text-xs font-bold text-amber-800">
                        {{ __('Alamat email Anda belum terverifikasi.') }}

                        <button form="send-verification" class="underline hover:text-amber-900 transition-colors">
                            {{ __('Klik di sini untuk mengirim ulang email verifikasi.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-xs font-black text-emerald-600 uppercase tracking-widest">
                            {{ __('Tautan verifikasi baru telah dikirim ke alamat email Anda.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-6 pt-2">
            <button type="submit" class="btn btn-primary px-8 py-3 rounded-xl shadow-lg shadow-brand-500/20">
                Simpan Perubahan
            </button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-[10px] font-black uppercase tracking-widest text-emerald-600"
                >{{ __('Tersimpan.') }}</p>
            @endif
        </div>
    </form>
</section>
