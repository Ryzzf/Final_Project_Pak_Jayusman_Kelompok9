<section>
    <header>
        <h2 class="text-lg font-bold text-gray-900 flex items-center gap-2">
            <i class="fas fa-key text-yellow-500"></i>
            Ubah Password
        </h2>

        <p class="mt-1 text-sm text-gray-500">
            Gunakan password yang kuat dan aman untuk melindungi akun Anda.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6">
        @csrf
        @method('put')

        <div class="space-y-4">

            <div>
                <label for="update_password_current_password" class="block text-sm font-medium text-gray-700 mb-1">
                    Password Saat Ini
                </label>

                <input
                    id="update_password_current_password"
                    name="current_password"
                    type="password"
                    autocomplete="current-password"
                    class="w-full border border-gray-300 rounded-lg p-2.5 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Masukkan password saat ini">

                <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 text-red-500 text-xs" />
            </div>

            <div>
                <label for="update_password_password" class="block text-sm font-medium text-gray-700 mb-1">
                    Password Baru
                </label>

                <input
                    id="update_password_password"
                    name="password"
                    type="password"
                    autocomplete="new-password"
                    class="w-full border border-gray-300 rounded-lg p-2.5 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Minimal 8 karakter">

                <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 text-red-500 text-xs" />
            </div>

            <div>
                <label for="update_password_password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">
                    Konfirmasi Password Baru
                </label>

                <input
                    id="update_password_password_confirmation"
                    name="password_confirmation"
                    type="password"
                    autocomplete="new-password"
                    class="w-full border border-gray-300 rounded-lg p-2.5 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Ketik ulang password baru">

                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 text-red-500 text-xs" />
            </div>

        </div>

        <div class="flex items-center gap-4 mt-6 border-t border-gray-100 pt-5">
            <button
                type="submit"
                class="px-5 py-2.5 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition flex items-center gap-2">
                <i class="fas fa-save"></i>
                Simpan Password
            </button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2500)"
                    class="text-sm text-green-600 font-medium flex items-center gap-1"
                >
                    <i class="fas fa-check-circle"></i>
                    Password berhasil diperbarui
                </p>
            @endif
        </div>
    </form>
</section>