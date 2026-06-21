<x-app-layout>
    <div class="mb-6 flex flex-col lg:flex-row lg:justify-between lg:items-center gap-4 print:hidden">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 flex items-center gap-3">
                <i class="fas fa-chart-line text-blue-600"></i>
                Laporan Cabang
            </h1>
            <p class="text-sm text-gray-500 mt-1">
                Cabang:
                <span class="font-semibold text-gray-700">
                    {{ auth()->user()->cabang->nama ?? 'Pusat' }}
                </span>
            </p>
        </div>

        <button
            onclick="window.print()"
            class="bg-gray-900 text-white px-5 py-3 rounded-xl hover:bg-gray-800 transition shadow-sm flex items-center gap-2"
        >
            <i class="fas fa-print"></i>
            Cetak Laporan
        </button>
    </div>

    <!-- FILTER -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 mb-6 print:hidden">
        <form action="{{ route('laporan.manager') }}" method="GET" class="flex flex-col md:flex-row gap-4 items-end">

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Dari Tanggal
                </label>
                <input
                    type="date"
                    name="start_date"
                    value="{{ $start_date->format('Y-m-d') }}"
                    class="border-gray-300 rounded-xl shadow-sm focus:ring-blue-500 focus:border-blue-500"
                >
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Sampai Tanggal
                </label>
                <input
                    type="date"
                    name="end_date"
                    value="{{ $end_date->format('Y-m-d') }}"
                    class="border-gray-300 rounded-xl shadow-sm focus:ring-blue-500 focus:border-blue-500"
                >
            </div>

            <button
                type="submit"
                class="bg-blue-600 text-white px-5 py-2.5 rounded-xl hover:bg-blue-700 transition"
            >
                <i class="fas fa-search mr-1"></i>
                Tampilkan
            </button>

        </form>
    </div>

    <!-- KARTU RINGKASAN -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-6 print:hidden">

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-sm text-gray-500">
                        Total Transaksi
                    </p>

                    <h2 class="text-3xl font-bold text-blue-600 mt-1">
                        {{ $transaksis->count() }}
                    </h2>
                </div>

                <div class="w-14 h-14 bg-blue-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-receipt text-blue-600 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-sm text-gray-500">
                        Total Omzet
                    </p>

                    <h2 class="text-2xl font-bold text-green-600 mt-1">
                        Rp {{ number_format($total_pendapatan, 0, ',', '.') }}
                    </h2>
                </div>

                <div class="w-14 h-14 bg-green-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-wallet text-green-600 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-sm text-gray-500">
                        Temuan Audit
                    </p>

                    <h2 class="text-3xl font-bold text-red-600 mt-1">
                        {{ $opnames->count() }}
                    </h2>
                </div>

                <div class="w-14 h-14 bg-red-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-clipboard-check text-red-600 text-xl"></i>
                </div>
            </div>
        </div>

    </div>

    <!-- AREA CETAK -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 print:shadow-none print:border-none print:p-0">

        <!-- KOP LAPORAN -->
        <div class="text-center border-b-2 border-gray-800 pb-5 mb-8">
            <h2 class="text-3xl font-extrabold tracking-wide uppercase">
                Minimarket Jayusman
            </h2>

            <p class="text-gray-600 mt-1">
                Laporan Operasional Cabang
            </p>

            <p class="font-semibold text-gray-800">
                {{ auth()->user()->cabang->nama ?? 'Pusat' }}
            </p>

            <p class="text-sm text-gray-500 mt-2">
                Periode:
                {{ $start_date->format('d M Y') }}
                -
                {{ $end_date->format('d M Y') }}
            </p>
        </div>

        <!-- TRANSAKSI -->
        <div class="mb-10">
            <h3 class="font-bold text-lg text-gray-800 mb-4 flex items-center gap-2">
                <i class="fas fa-shopping-cart text-blue-500"></i>
                Rekap Transaksi Penjualan
            </h3>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 text-gray-700 uppercase text-xs">
                        <tr>
                            <th class="px-4 py-3 text-left">Tanggal</th>
                            <th class="px-4 py-3 text-left">Kode Transaksi</th>
                            <th class="px-4 py-3 text-left">Kasir</th>
                            <th class="px-4 py-3 text-right">Nominal</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($transaksis as $trx)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-3">
                                {{ $trx->created_at->format('d/m/Y H:i') }}
                            </td>

                            <td class="px-4 py-3 font-semibold text-blue-600">
                                {{ $trx->kode_transaksi }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $trx->user->name }}
                            </td>

                            <td class="px-4 py-3 text-right font-bold text-green-600">
                                Rp {{ number_format($trx->total_harga, 0, ',', '.') }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-6 text-gray-400">
                                Tidak ada transaksi pada periode ini.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- AUDIT STOK -->
        <div>
            <h3 class="font-bold text-lg text-gray-800 mb-4 flex items-center gap-2">
                <i class="fas fa-clipboard-list text-red-500"></i>
                Laporan Audit Stok
            </h3>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 text-gray-700 uppercase text-xs">
                        <tr>
                            <th class="px-4 py-3">Tanggal</th>
                            <th class="px-4 py-3">Barang</th>
                            <th class="px-4 py-3 text-center">Selisih</th>
                            <th class="px-4 py-3">Keterangan</th>
                            <th class="px-4 py-3">Petugas</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($opnames as $op)
                        <tr class="border-b hover:bg-gray-50">

                            <td class="px-4 py-3">
                                {{ $op->created_at->format('d/m/Y') }}
                            </td>

                            <td class="px-4 py-3 font-medium">
                                {{ $op->barang->nama }}
                            </td>

                            <td class="px-4 py-3 text-center">
                                <span class="font-bold {{ $op->selisih < 0 ? 'text-red-600' : 'text-green-600' }}">
                                    {{ $op->selisih }}
                                </span>
                            </td>

                            <td class="px-4 py-3">
                                {{ $op->keterangan ?? '-' }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $op->user->name }}
                            </td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-6 text-gray-400">
                                Tidak ada temuan audit stok.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- TTD CETAK -->
        <div class="mt-16 text-right hidden print:block">
            <p class="mb-16">
                Manajer Cabang
            </p>

            <p class="font-bold border-b border-gray-500 inline-block w-56">
                {{ auth()->user()->name }}
            </p>
        </div>

    </div>

    <style>
        @media print {

    #sidebar,
    header,
    button,
    .print\:hidden {
        display: none !important;
    }

    body,
    html {
        background: white !important;
        margin: 0 !important;
        padding: 0 !important;
    }

    main {
        width: 100% !important;
        margin: 0 !important;
        padding: 0 !important;
        overflow: visible !important;
    }

    .max-w-7xl {
        max-width: 100% !important;
    }
}
    </style>
</x-app-layout>