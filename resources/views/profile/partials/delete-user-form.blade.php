<section class="space-y-6">
    <header>
        <h2 class="text-xl font-bold text-red-600">
            {{ __('Hapus Akun') }}
        </h2>

        <p class="mt-2 text-sm font-medium text-slate-500">
            {{ __('Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen. Sebelum menghapus akun, harap unduh data atau informasi apa pun yang ingin Anda pertahankan.') }}
        </p>
    </header>

    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="btn bg-red-600/10 text-red-600 hover:bg-red-600 hover:text-white px-10 py-4 font-black uppercase text-xs tracking-widest transition-all duration-500 rounded-xl"
    >{{ __('Terminate Account') }}</button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-10 bg-white rounded-[3rem]">
            @csrf
            @method('delete')

            <h2 class="text-3xl font-heading font-black text-slate-900 tracking-tight">
                {{ __('Confirm Termination?') }}
            </h2>
            <div class="h-1 w-20 bg-red-500 mt-4 rounded-full"></div>

            <p class="mt-8 text-lg font-medium text-slate-500 leading-relaxed">
                {{ __('Once your account is terminated, all of its resources and data will be permanently deleted. Please enter your credentials to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="mt-10">
                <x-input-label for="password" value="{{ __('Verification') }}" class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-full bg-slate-50/50 border-slate-200 focus:border-red-500 focus:ring-red-500/10 rounded-xl px-5 py-4 font-bold text-slate-900 transition-all duration-300 placeholder-slate-300"
                    placeholder="{{ __('Enter your credentials') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2 text-[10px] font-black text-red-500 uppercase tracking-widest" />
            </div>

            <div class="mt-12 flex justify-end gap-6">
                <button type="button" x-on:click="$dispatch('close')" class="btn btn-secondary px-8 py-4 font-black uppercase text-xs tracking-widest">
                    {{ __('Cancel') }}
                </button>

                <button type="submit" class="btn bg-red-600 text-white hover:bg-red-700 shadow-[0_10px_30px_rgba(220,38,38,0.3)] px-10 py-4 font-black uppercase text-xs tracking-widest transition-all">
                    {{ __('Delete Permanently') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>
