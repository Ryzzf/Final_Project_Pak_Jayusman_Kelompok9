<x-app-layout>

<div class="space-y-6">

    <!-- HEADER -->
    <div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-6">

        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">

            <div>

                <span class="inline-flex items-center px-3 py-1 rounded-full bg-slate-100 text-slate-600 text-xs font-medium mb-3">
                    Master Data
                </span>

                <h1 class="text-3xl font-bold text-slate-800">
                    Edit Barang
                </h1>

                <p class="text-slate-500 mt-2">
                    Perbarui informasi barang
                    <span class="font-semibold text-slate-700">
                        {{ $barang->nama }}
                    </span>
                    yang tersimpan dalam sistem Jayusman Mart.
                </p>

            </div>

            <a href="{{ route('master.barang') }}"
                class="inline-flex items-center gap-2 px-5 py-3 rounded-2xl border border-slate-300 bg-white text-slate-700 hover:bg-slate-100 transition">

                <i class="fas fa-arrow-left"></i>
                Kembali

            </a>

        </div>

    </div>

    <!-- INFO CARD -->
    <div class="bg-gradient-to-r from-slate-900 via-slate-800 to-indigo-900 rounded-3xl p-6 text-white">

        <div class="flex items-center gap-4">

            <div class="w-16 h-16 rounded-2xl bg-white/10 flex items-center justify-center">

                <i class="fas fa-box text-2xl"></i>

            </div>

            <div>

                <p class="text-slate-300 text-sm">
                    Barang yang sedang diedit
                </p>

                <h2 class="text-2xl font-bold">
                    {{ $barang->nama }}
                </h2>

                <p class="text-slate-300 text-sm mt-1">
                    Kode Barang: {{ $barang->kode_barang }}
                </p>

            </div>

        </div>

    </div>

    <!-- FORM -->
    <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden max-w-4xl">

        <div class="px-6 py-5 border-b border-slate-100">

            <h3 class="font-semibold text-slate-800">
                Informasi Barang
            </h3>

            <p class="text-sm text-slate-500 mt-1">
                Pastikan data barang sudah sesuai sebelum menyimpan perubahan.
            </p>

        </div>

        <form action="{{ route('master.barang.update', $barang->id) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="p-6 space-y-6">

                <!-- KODE BARANG -->
                <div>

                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Kode Barang
                        <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="text"
                        name="kode_barang"
                        value="{{ old('kode_barang', $barang->kode_barang) }}"
                        required
                        class="w-full rounded-2xl border border-slate-300 px-4 py-3 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 outline-none">

                    @error('kode_barang')
                        <p class="text-red-500 text-sm mt-2">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

                <!-- NAMA BARANG -->
                <div>

                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Nama Barang
                        <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="text"
                        name="nama"
                        value="{{ old('nama', $barang->nama) }}"
                        required
                        class="w-full rounded-2xl border border-slate-300 px-4 py-3 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 outline-none">

                    @error('nama')
                        <p class="text-red-500 text-sm mt-2">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

                <!-- SATUAN -->
                <div>

                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Satuan
                        <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="text"
                        name="satuan"
                        value="{{ old('satuan', $barang->satuan) }}"
                        required
                        placeholder="Contoh: Pcs, Botol, Dus, Pack"
                        class="w-full rounded-2xl border border-slate-300 px-4 py-3 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 outline-none">

                    @error('satuan')
                        <p class="text-red-500 text-sm mt-2">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

                <!-- HARGA -->
                <div>

                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Harga Dasar
                        <span class="text-red-500">*</span>
                    </label>

                    <div class="relative">

                        <span class="absolute left-4 top-3.5 text-slate-500 font-medium">
                            Rp
                        </span>

                        <input
                            type="number"
                            name="harga"
                            value="{{ old('harga', $barang->harga) }}"
                            required
                            min="0"
                            class="w-full rounded-2xl border border-slate-300 pl-12 pr-4 py-3 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 outline-none">

                    </div>

                    <p class="text-xs text-slate-500 mt-2">
                        Perubahan harga akan tercatat atas nama
                        <span class="font-semibold">
                            {{ Auth::user()->name }}
                        </span>.
                    </p>

                    @error('harga')
                        <p class="text-red-500 text-sm mt-2">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

            </div>

            <!-- FOOTER -->
            <div class="px-6 py-5 border-t border-slate-100 bg-slate-50">

                <div class="flex flex-col sm:flex-row gap-3">

                    <button
                        type="submit"
                        class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-2xl bg-slate-900 text-white hover:bg-slate-800 transition font-medium">

                        <i class="fas fa-save"></i>
                        Simpan Perubahan

                    </button>

                    <a href="{{ route('master.barang') }}"
                        class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-2xl border border-slate-300 bg-white text-slate-700 hover:bg-slate-100 transition">

                        <i class="fas fa-times"></i>
                        Batal

                    </a>

                </div>

            </div>

        </form>

    </div>

</div>

</x-app-layout>