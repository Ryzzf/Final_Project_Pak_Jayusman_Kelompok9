<x-app-layout>
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 flex items-center gap-2">
            <i class="fas fa-boxes text-blue-600"></i>
            Mutasi Stok Gudang
        </h1>

        <p class="text-sm text-gray-500 mt-1">
            Cabang :
            <span class="font-semibold text-gray-700">
                {{ auth()->user()->cabang->nama ?? 'Pusat' }}
            </span>
        </p>
    </div>

    {{-- Alert --}}
    @if(session('success'))
        <div class="mb-5 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl">
            <i class="fas fa-check-circle mr-2"></i>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-5 p-4 bg-red-50 border border-red-200 text-red-700 rounded-xl">
            <i class="fas fa-times-circle mr-2"></i>
            {{ session('error') }}
        </div>
    @endif

    {{-- Statistik --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">
                        Total Mutasi
                    </p>

                    <h2 class="text-3xl font-bold text-gray-900 mt-1">
                        {{ $riwayat_mutasi->count() }}
                    </h2>
                </div>

                <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center">
                    <i class="fas fa-exchange-alt text-blue-600"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">
                        Barang Tersedia
                    </p>

                    <h2 class="text-3xl font-bold text-green-600 mt-1">
                        {{ $barangs->count() }}
                    </h2>
                </div>

                <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center">
                    <i class="fas fa-box text-green-600"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">
                        Mutasi Hari Ini
                    </p>

                    <h2 class="text-3xl font-bold text-orange-500 mt-1">
                        {{ $riwayat_mutasi->where('created_at', '>=', now()->startOfDay())->count() }}
                    </h2>
                </div>

                <div class="w-12 h-12 rounded-full bg-orange-100 flex items-center justify-center">
                    <i class="fas fa-calendar-day text-orange-500"></i>
                </div>
            </div>
        </div>

    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- FORM MUTASI --}}
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

                <div class="px-5 py-4 border-b bg-gradient-to-r from-blue-600 to-indigo-600">
                    <h3 class="font-semibold text-white flex items-center gap-2">
                        <i class="fas fa-plus-circle"></i>
                        Catat Mutasi Baru
                    </h3>
                </div>

                <div class="p-5">
                    <form action="{{ route('stok.mutasi.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Barang
                            </label>

                            <select
                                name="barang_id"
                                required
                                class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                            >
                                <option value="">-- Pilih Barang --</option>

                                @foreach($barangs as $b)
                                    <option value="{{ $b->id }}">
                                        {{ $b->kode_barang }} - {{ $b->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Jenis Mutasi
                            </label>

                            <div class="grid grid-cols-2 gap-3">

                                <label class="border rounded-xl p-3 cursor-pointer hover:bg-green-50 transition">
                                    <input
                                        type="radio"
                                        name="jenis"
                                        value="masuk"
                                        checked
                                        class="mr-2"
                                    >
                                    <span class="font-medium text-green-700">
                                        <i class="fas fa-arrow-down mr-1"></i>
                                        Masuk
                                    </span>
                                </label>

                                <label class="border rounded-xl p-3 cursor-pointer hover:bg-red-50 transition">
                                    <input
                                        type="radio"
                                        name="jenis"
                                        value="keluar"
                                        class="mr-2"
                                    >
                                    <span class="font-medium text-red-700">
                                        <i class="fas fa-arrow-up mr-1"></i>
                                        Keluar
                                    </span>
                                </label>

                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Jumlah Barang
                            </label>

                            <input
                                type="number"
                                name="qty"
                                min="1"
                                required
                                class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                                placeholder="Masukkan jumlah"
                            >
                        </div>

                        <div class="mb-5">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Keterangan
                            </label>

                            <textarea
                                name="keterangan"
                                rows="3"
                                required
                                placeholder="Contoh: Barang datang dari supplier..."
                                class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                            ></textarea>
                        </div>

                        <button
                            type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-xl transition"
                        >
                            <i class="fas fa-save mr-2"></i>
                            Simpan Mutasi
                        </button>
                    </form>
                </div>

            </div>
        </div>

        {{-- RIWAYAT --}}
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

                <div class="px-5 py-4 border-b">
                    <h3 class="font-semibold text-gray-800 flex items-center gap-2">
                        <i class="fas fa-history text-blue-600"></i>
                        Riwayat Mutasi Stok
                    </h3>
                </div>

                <div class="overflow-x-auto">

                    <table class="w-full text-sm">
                        <thead class="bg-gray-50 text-gray-700 uppercase text-xs">
                            <tr>
                                <th class="px-4 py-4">Waktu</th>
                                <th class="px-4 py-4">Barang</th>
                                <th class="px-4 py-4">Jenis</th>
                                <th class="px-4 py-4">Qty</th>
                                <th class="px-4 py-4">Keterangan</th>
                                <th class="px-4 py-4">Petugas</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($riwayat_mutasi as $rm)
                            <tr class="border-b hover:bg-gray-50">

                                <td class="px-4 py-4 text-gray-600">
                                    {{ $rm->created_at->format('d M Y H:i') }}
                                </td>

                                <td class="px-4 py-4 font-semibold text-gray-800">
                                    {{ $rm->barang->nama }}
                                </td>

                                <td class="px-4 py-4">
                                    @if($rm->jenis == 'masuk')
                                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700">
                                            + MASUK
                                        </span>
                                    @else
                                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-700">
                                            - KELUAR
                                        </span>
                                    @endif
                                </td>

                                <td class="px-4 py-4 font-bold">
                                    {{ $rm->qty }}
                                </td>

                                <td class="px-4 py-4 text-gray-600">
                                    {{ $rm->keterangan }}
                                </td>

                                <td class="px-4 py-4">
                                    {{ $rm->user->name }}
                                </td>

                            </tr>
                            @empty

                            <tr>
                                <td colspan="6" class="py-16 text-center">

                                    <i class="fas fa-box-open text-5xl text-gray-300 mb-4 block"></i>

                                    <p class="text-gray-500">
                                        Belum ada riwayat mutasi stok.
                                    </p>

                                </td>
                            </tr>

                            @endforelse
                        </tbody>
                    </table>

                </div>

            </div>
        </div>

    </div>
</x-app-layout>