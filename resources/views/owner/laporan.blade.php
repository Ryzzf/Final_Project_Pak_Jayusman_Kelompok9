<x-app-layout>
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 flex items-center gap-2">
            <i class="fas fa-chart-pie text-blue-500"></i>
            Laporan Gabungan Seluruh Cabang
        </h1>
        <p class="text-sm text-gray-500 mt-1">
            Ringkasan transaksi dan stok opname seluruh cabang Jayusman Mart.
        </p>
    </div>

    {{-- Filter --}}
    <form action="{{ route('owner.laporan') }}"
          method="GET"
          class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 mb-6">

        <div class="flex flex-wrap items-end gap-4">

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Dari Tanggal
                </label>
                <input type="date"
                       name="start_date"
                       value="{{ $start_date->format('Y-m-d') }}"
                       class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Sampai Tanggal
                </label>
                <input type="date"
                       name="end_date"
                       value="{{ $end_date->format('Y-m-d') }}"
                       class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg font-medium transition">
                <i class="fas fa-filter mr-1"></i>
                Tampilkan
            </button>

            <a href="{{ route('owner.laporan.pdf', [
                    'start_date' => $start_date->format('Y-m-d'),
                    'end_date' => $end_date->format('Y-m-d')
                ]) }}"
               class="bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded-lg font-medium transition">
                <i class="fas fa-file-pdf mr-1"></i>
                Cetak PDF
            </a>

        </div>
    </form>

    {{-- Statistik --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">

        <div class="bg-green-600 text-white rounded-xl p-6 shadow-sm">
            <p class="text-sm opacity-90">
                Total Pendapatan
            </p>
            <h2 class="text-3xl font-bold mt-2">
                Rp {{ number_format($total_pendapatan, 0, ',', '.') }}
            </h2>
        </div>

        <div class="bg-blue-600 text-white rounded-xl p-6 shadow-sm">
            <p class="text-sm opacity-90">
                Total Transaksi
            </p>
            <h2 class="text-3xl font-bold mt-2">
                {{ $transaksis->count() }}
            </h2>
        </div>

    </div>

    {{-- Rekap Transaksi --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 mb-6">
        <div class="p-5 border-b">
            <h2 class="font-bold text-lg text-gray-800">
                Rekap Transaksi
            </h2>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-gray-700 uppercase text-xs">
                    <tr>
                        <th class="px-4 py-3 text-left">Tanggal</th>
                        <th class="px-4 py-3 text-left">Kode Transaksi</th>
                        <th class="px-4 py-3 text-left">Cabang</th>
                        <th class="px-4 py-3 text-left">Kasir</th>
                        <th class="px-4 py-3 text-right">Total</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($transaksis as $trx)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-3">
                                {{ $trx->created_at->format('d M Y H:i') }}
                            </td>

                            <td class="px-4 py-3 font-medium text-gray-900">
                                {{ $trx->kode_transaksi }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $trx->cabang->nama ?? '-' }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $trx->user->name }}
                            </td>

                            <td class="px-4 py-3 text-right font-semibold">
                                Rp {{ number_format($trx->total_harga, 0, ',', '.') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5"
                                class="px-4 py-8 text-center text-gray-400">
                                Tidak ada transaksi pada periode ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Rekap Stok Opname --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100">
        <div class="p-5 border-b">
            <h2 class="font-bold text-lg text-gray-800">
                Rekap Stok Opname
            </h2>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-gray-700 uppercase text-xs">
                    <tr>
                        <th class="px-4 py-3 text-left">Cabang</th>
                        <th class="px-4 py-3 text-left">Barang</th>
                        <th class="px-4 py-3 text-left">Status</th>
                        <th class="px-4 py-3 text-left">Petugas</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($opnames as $op)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-3">
                                {{ $op->cabang->nama ?? '-' }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $op->barang->nama }}
                            </td>

                            <td class="px-4 py-3">
                                @if($op->keterangan)
                                    <span class="text-red-600 font-medium">
                                        {{ $op->keterangan }}
                                    </span>
                                @else
                                    <span class="text-green-600 font-medium">
                                        Normal
                                    </span>
                                @endif
                            </td>

                            <td class="px-4 py-3">
                                {{ $op->user->name }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4"
                                class="px-4 py-8 text-center text-gray-400">
                                Tidak ada data stok opname pada periode ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>