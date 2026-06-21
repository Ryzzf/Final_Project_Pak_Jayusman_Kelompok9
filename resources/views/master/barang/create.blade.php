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
                    Tambah Barang Baru
                </h1>

                <p class="text-slate-500 mt-2">
                    Tambahkan produk baru yang akan tersedia pada seluruh cabang Jayusman Mart.
                </p>

            </div>

            <a href="{{ route('master.barang') }}"
                class="inline-flex items-center gap-2 px-5 py-3 rounded-2xl border border-slate-300 bg-white text-slate-700 hover:bg-slate-100 transition">

                <i class="fas fa-arrow-left"></i>
                Kembali

            </a>

        </div>

    </div>

    <!-- FORM -->
    <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden max-w-4xl">

        <div class="px-6 py-5 border-b border-slate-100">

            <h3 class="font-semibold text-slate-800">
                Informasi Barang
            </h3>

            <p class="text-sm text-slate-500 mt-1">
                Lengkapi data barang yang akan ditambahkan ke sistem.
            </p>

        </div>

        <form action="{{ route('master.barang.store') }}" method="POST">

            @csrf

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
                        value="{{ old('kode_barang') }}"
                        required
                        placeholder="Contoh: BRG-001"
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
                        value="{{ old('nama') }}"
                        required
                        placeholder="Contoh: Indomie Goreng, Aqua 600ml, Teh Botol"
                        class="w-full rounded-2xl border border-slate-300 px-4 py-3 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 outline-none">

                    @error('nama')
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
                            value="{{ old('harga') }}"
                            min="0"
                            required
                            placeholder="10000"
                            class="w-full rounded-2xl border border-slate-300 pl-12 pr-4 py-3 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 outline-none">

                    </div>

                    <p class="text-xs text-slate-500 mt-2">
                        Masukkan nominal tanpa titik atau koma.
                    </p>

                    @error('harga')
                        <p class="text-red-500 text-sm mt-2">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

            </div>

            <!-- FOOTER BUTTON -->
            <div class="px-6 py-5 border-t border-slate-100 bg-slate-50">

                <div class="flex flex-col sm:flex-row gap-3">

                    <button
                        type="submit"
                        class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-2xl bg-slate-900 text-white hover:bg-slate-800 transition font-medium">

                        <i class="fas fa-save"></i>
                        Simpan Barang

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