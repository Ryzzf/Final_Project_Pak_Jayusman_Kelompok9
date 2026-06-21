<section>

    <header class="mb-6">
        <h2 class="text-lg font-bold text-gray-900 flex items-center gap-2">
            <i class="fas fa-user-edit text-blue-500"></i>
            Informasi Profil
        </h2>

        <p class="mt-1 text-sm text-gray-500">
            Perbarui nama dan alamat email yang digunakan untuk masuk ke sistem.
        </p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-5">
        @csrf
        @method('PATCH')

        <!-- Nama -->
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                Nama Lengkap <span class="text-red-500">*</span>
            </label>

            <x-text-input
                id="name"
                name="name"
                type="text"
                class="block w-full"
                :value="old('name', $user->name)"
                required
                autofocus
                autocomplete="name"
                placeholder="Masukkan nama lengkap"
            />

            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                Alamat Email <span class="text-red-500">*</span>
            </label>

            <x-text-input
                id="email"
                name="email"
                type="email"
                class="block w-full"
                :value="old('email', $user->email)"
                required
                autocomplete="username"
                placeholder="contoh@email.com"
            />

            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        <!-- Tombol -->
        <div class="flex items-center gap-4 pt-3 border-t border-gray-100">

            <button
                type="submit"
                class="inline-flex items-center gap-2 px-5 py-2.5 bg-blue-600 border border-transparent rounded-lg font-medium text-sm text-white hover:bg-blue-700 transition"
            >
                <i class="fas fa-save"></i>
                Simpan Perubahan
            </button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2500)"
                    class="text-sm text-green-600 font-medium flex items-center gap-2"
                >
                    <i class="fas fa-check-circle"></i>
                    Profil berhasil diperbarui.
                </p>
            @endif

        </div>
    </form>

</section>