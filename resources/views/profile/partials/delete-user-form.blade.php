<section class="space-y-6">
    <header>
        <h2 class="text-lg font-bold text-red-700 flex items-center gap-2">
            <i class="fas fa-exclamation-triangle"></i>
            Hapus Akun
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Menghapus akun akan menghilangkan seluruh data yang terkait dengan akun ini secara permanen dan tidak dapat dikembalikan.
        </p>
    </header>

    <div class="bg-red-50 border border-red-200 rounded-lg p-4">
        <div class="flex items-start gap-3">
            <i class="fas fa-shield-alt text-red-500 text-lg mt-0.5"></i>
            <div>
                <h4 class="font-semibold text-red-700">
                    Perhatian
                </h4>
                <p class="text-sm text-red-600 mt-1">
                    Sebelum menghapus akun, pastikan Anda telah mencadangkan data penting yang masih diperlukan.
                </p>
            </div>
        </div>
    </div>

    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="px-5 py-2.5 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 transition flex items-center gap-2"
    >
        <i class="fas fa-trash-alt"></i>
        Hapus Akun
    </button>

    <x-modal
        name="confirm-user-deletion"
        :show="$errors->userDeletion->isNotEmpty()"
        focusable
    >
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center">
                    <i class="fas fa-trash-alt text-red-600 text-xl"></i>
                </div>

                <div>
                    <h2 class="text-lg font-bold text-gray-900">
                        Konfirmasi Hapus Akun
                    </h2>
                    <p class="text-sm text-gray-500">
                        Tindakan ini tidak dapat dibatalkan.
                    </p>
                </div>
            </div>

            <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-5">
                <p class="text-sm text-red-700">
                    Seluruh data akun, riwayat aktivitas, dan informasi yang terkait dengan akun ini akan dihapus secara permanen dari sistem.
                </p>
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                    Masukkan Password untuk Konfirmasi
                </label>

                <input
                    id="password"
                    name="password"
                    type="password"
                    class="w-full border border-gray-300 rounded-lg p-2.5 focus:ring-red-500 focus:border-red-500"
                    placeholder="Masukkan password Anda"
                />

                <x-input-error
                    :messages="$errors->userDeletion->get('password')"
                    class="mt-2 text-red-500 text-xs"
                />
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <button
                    type="button"
                    x-on:click="$dispatch('close')"
                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition"
                >
                    Batal
                </button>

                <button
                    type="submit"
                    class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 transition flex items-center gap-2"
                >
                    <i class="fas fa-trash-alt"></i>
                    Ya, Hapus Akun
                </button>
            </div>
        </form>
    </x-modal>
</section>