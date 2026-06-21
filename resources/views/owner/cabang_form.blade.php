<x-app-layout>

<div class="space-y-6">

    <!-- HEADER -->
    <div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-6">

        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">

            <div>

                <span class="inline-flex items-center px-3 py-1 rounded-full bg-slate-100 text-slate-600 text-xs font-medium mb-3">
                    {{ isset($cabang) ? 'Edit Cabang' : 'Tambah Cabang' }}
                </span>

                <h1 class="text-3xl font-bold text-slate-800">
                    {{ isset($cabang) ? 'Perbarui Data Cabang' : 'Tambah Cabang Baru' }}
                </h1>

                <p class="text-slate-500 mt-2">
                    Lengkapi informasi cabang minimarket Jayusman Mart yang akan digunakan dalam sistem.
                </p>

            </div>

            <a href="{{ route('owner.cabang') }}"
               class="inline-flex items-center gap-2 px-5 py-3 rounded-2xl bg-slate-100 text-slate-700 hover:bg-slate-200 transition font-medium">

                <i class="fas fa-arrow-left"></i>
                Kembali

            </a>

        </div>

    </div>

    <!-- FORM -->
    <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">

        <!-- TOP -->
        <div class="bg-gradient-to-r from-slate-900 via-slate-800 to-indigo-900 p-6">

            <div class="flex items-center gap-4">

                <div class="w-16 h-16 rounded-2xl bg-white/10 flex items-center justify-center">

                    <i class="fas fa-store text-white text-2xl"></i>

                </div>

                <div>

                    <h2 class="text-xl font-bold text-white">
                        Informasi Cabang
                    </h2>

                    <p class="text-slate-300 text-sm mt-1">
                        Data cabang digunakan untuk pengelolaan stok, transaksi, dan pegawai.
                    </p>

                </div>

            </div>

        </div>

        <!-- FORM BODY -->
        <div class="p-8">

            <form action="{{ isset($cabang) ? route('owner.cabang.update', $cabang->id) : route('owner.cabang.store') }}"
                  method="POST">

                @csrf

                @if(isset($cabang))
                    @method('PUT')
                @endif

                <!-- Nama Cabang -->
                <div class="mb-6">

                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Nama Cabang <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="text"
                        name="nama"
                        value="{{ old('nama', $cabang->nama ?? '') }}"
                        required
                        placeholder="Contoh: Jayusman Mart Cabang Banjar"
                        class="w-full rounded-2xl border border-slate-300 px-4 py-3 focus:ring-2 focus:ring-slate-900 focus:border-slate-900 transition">

                    @error('nama')
                        <p class="text-red-500 text-sm mt-2">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

                <!-- Kota -->
                <div class="mb-6">

                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Kota / Kabupaten <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="text"
                        name="kota"
                        value="{{ old('kota', $cabang->kota ?? '') }}"
                        required
                        placeholder="Contoh: Banjar"
                        class="w-full rounded-2xl border border-slate-300 px-4 py-3 focus:ring-2 focus:ring-slate-900 focus:border-slate-900 transition">

                    @error('kota')
                        <p class="text-red-500 text-sm mt-2">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

                <!-- Telepon -->
                <div class="mb-6">

                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Nomor Telepon
                    </label>

                    <input
                        type="text"
                        name="telepon"
                        value="{{ old('telepon', $cabang->telepon ?? '') }}"
                        placeholder="Contoh: 081234567890"
                        class="w-full rounded-2xl border border-slate-300 px-4 py-3 focus:ring-2 focus:ring-slate-900 focus:border-slate-900 transition">

                    @error('telepon')
                        <p class="text-red-500 text-sm mt-2">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

                <!-- Alamat -->
                <div class="mb-8">

                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Alamat Lengkap
                    </label>

                    <textarea
                        name="alamat"
                        rows="4"
                        placeholder="Masukkan alamat lengkap cabang..."
                        class="w-full rounded-2xl border border-slate-300 px-4 py-3 focus:ring-2 focus:ring-slate-900 focus:border-slate-900 transition resize-none">{{ old('alamat', $cabang->alamat ?? '') }}</textarea>

                    @error('alamat')
                        <p class="text-red-500 text-sm mt-2">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

                <!-- BUTTON -->
                <div class="border-t border-slate-200 pt-6">

                    <div class="flex flex-col sm:flex-row gap-3">

                        <a href="{{ route('owner.cabang') }}"
                           class="px-6 py-3 rounded-2xl bg-slate-100 text-slate-700 hover:bg-slate-200 transition text-center font-medium">

                            Batal

                        </a>

                        <button
                            type="submit"
                            class="px-6 py-3 rounded-2xl bg-slate-900 text-white hover:bg-slate-800 transition font-medium flex items-center justify-center gap-2">

                            <i class="fas fa-save"></i>

                            {{ isset($cabang) ? 'Simpan Perubahan' : 'Simpan Cabang' }}

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>

</x-app-layout>