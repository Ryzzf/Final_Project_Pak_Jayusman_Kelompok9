<x-app-layout>
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 flex items-center gap-2">
            <i class="fas fa-clipboard-check text-blue-600"></i>
            Audit Stok (Stok Opname)
        </h1>

        <p class="text-sm text-gray-500 mt-1">
            Lakukan pemeriksaan fisik barang untuk mendeteksi kehilangan, kerusakan, atau selisih stok.
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
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-sm text-gray-500">
                        Barang Dicek
                    </p>

                    <h2 class="text-3xl font-bold text-gray-900 mt-1">
                        {{ $stoks->count() }}
                    </h2>
                </div>

                <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center">
                    <i class="fas fa-box text-blue-600"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-sm text-gray-500">
                        Temuan Audit
                    </p>

                    <h2 class="text-3xl font-bold text-red-500 mt-1">
                        {{ $riwayat->count() }}
                    </h2>
                </div>

                <div class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center">
                    <i class="fas fa-search text-red-500"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-sm text-gray-500">
                        Audit Hari Ini
                    </p>

                    <h2 class="text-3xl font-bold text-green-600 mt-1">
                        {{ $riwayat->where('created_at', '>=', now()->startOfDay())->count() }}
                    </h2>
                </div>

                <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center">
                    <i class="fas fa-calendar-check text-green-600"></i>
                </div>
            </div>
        </div>

    </div>

    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">

        {{-- FORM OPNAME --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

            <div class="px-5 py-4 bg-gradient-to-r from-blue-600 to-indigo-600">
                <h3 class="font-semibold text-white flex items-center gap-2">
                    <i class="fas fa-edit"></i>
                    Form Input Stok Fisik
                </h3>
            </div>

            <div class="p-5">

                <form action="{{ route('stok.opname.store') }}" method="POST">
                    @csrf

                    <div class="overflow-x-auto">

                        <table class="w-full text-sm">
                            <thead class="bg-gray-50 text-gray-700 uppercase text-xs">
                                <tr>
                                    <th class="px-3 py-3 text-left">
                                        Barang
                                    </th>

                                    <th class="px-3 py-3 text-center">
                                        Stok Sistem
                                    </th>

                                    <th class="px-3 py-3 text-center">
                                        Stok Fisik
                                    </th>

                                    <th class="px-3 py-3 text-left">
                                        Catatan
                                    </th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($stoks as $stok)

                                <tr class="border-b hover:bg-gray-50">

                                    <td class="px-3 py-3 font-medium text-gray-800">
                                        {{ $stok->barang->nama }}

                                        <input
                                            type="hidden"
                                            name="barang_id[]"
                                            value="{{ $stok->barang_id }}"
                                        >
                                    </td>

                                    <td class="px-3 py-3 text-center">
                                        <span class="bg-blue-100 text-blue-700 font-bold px-3 py-1 rounded-full text-xs">
                                            {{ $stok->quantity }}
                                        </span>

                                        <input
                                            type="hidden"
                                            name="stok_sistem[]"
                                            value="{{ $stok->quantity }}"
                                        >
                                    </td>

                                    <td class="px-3 py-2">
                                        <input
                                            type="number"
                                            name="stok_fisik[]"
                                            value="{{ $stok->quantity }}"
                                            min="0"
                                            required
                                            class="w-full rounded-lg border-gray-300 text-center focus:border-blue-500 focus:ring-blue-500"
                                        >
                                    </td>

                                    <td class="px-3 py-2">
                                        <input
                                            type="text"
                                            name="keterangan[]"
                                            placeholder="Isi jika ada selisih..."
                                            class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                                        >
                                    </td>

                                </tr>

                                @endforeach
                            </tbody>
                        </table>

                    </div>

                    <button
                        type="submit"
                        class="w-full mt-5 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-xl transition"
                    >
                        <i class="fas fa-save mr-2"></i>
                        Simpan Hasil Audit
                    </button>

                </form>

            </div>

        </div>

        {{-- LAPORAN AUDIT --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

            <div class="px-5 py-4 border-b">
                <h3 class="font-semibold text-red-600 flex items-center gap-2">
                    <i class="fas fa-exclamation-triangle"></i>
                    Laporan Temuan Selisih
                </h3>
            </div>

            <div class="overflow-x-auto">

                <table class="w-full text-sm">

                    <thead class="bg-gray-50 text-gray-700 uppercase text-xs">
                        <tr>
                            <th class="px-3 py-4">Tanggal</th>
                            <th class="px-3 py-4">Barang</th>
                            <th class="px-3 py-4 text-center">Sistem</th>
                            <th class="px-3 py-4 text-center">Fisik</th>
                            <th class="px-3 py-4 text-center">Selisih</th>
                            <th class="px-3 py-4">Petugas</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($riwayat as $r)

                        <tr class="border-b hover:bg-gray-50">

                            <td class="px-3 py-4 text-gray-600">
                                {{ $r->created_at->format('d M Y') }}
                            </td>

                            <td class="px-3 py-4 font-semibold text-gray-800">
                                {{ $r->barang->nama }}
                            </td>

                            <td class="px-3 py-4 text-center">
                                {{ $r->stok_sistem }}
                            </td>

                            <td class="px-3 py-4 text-center font-bold">
                                {{ $r->stok_fisik }}
                            </td>

                            <td class="px-3 py-4 text-center">

                                @if($r->selisih < 0)

                                    <span class="px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-700">
                                        {{ $r->selisih }} Barang Hilang
                                    </span>

                                @else

                                    <span class="px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700">
                                        +{{ $r->selisih }} Barang Lebih
                                    </span>

                                @endif

                            </td>

                            <td class="px-3 py-4">
                                {{ $r->user->name }}
                            </td>

                        </tr>

                        @empty

                        <tr>
                            <td colspan="6" class="py-16 text-center">

                                <i class="fas fa-shield-check text-5xl text-green-300 mb-4 block"></i>

                                <h3 class="font-semibold text-gray-700 mb-2">
                                    Tidak Ada Temuan Selisih
                                </h3>

                                <p class="text-gray-500">
                                    Seluruh stok fisik sesuai dengan stok sistem.
                                </p>

                            </td>
                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>
</x-app-layout>