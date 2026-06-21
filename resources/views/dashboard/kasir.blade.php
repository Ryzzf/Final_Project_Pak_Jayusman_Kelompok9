<x-app-layout>
    <div class="space-y-6">

        <!-- Header -->
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 flex items-center gap-3">
                    <div class="w-12 h-12 rounded-xl bg-emerald-100 flex items-center justify-center">
                        <i class="fas fa-cash-register text-emerald-600 text-xl"></i>
                    </div>
                    Dashboard Kasir
                </h1>

                <p class="text-gray-500 mt-2">
                    Kelola transaksi penjualan dan cetak struk pelanggan.
                </p>
            </div>

            <a href="{{ route('transaksi.create') }}"
               class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-3 rounded-xl font-semibold shadow-sm transition">
                <i class="fas fa-plus-circle"></i>
                Transaksi Baru
            </a>
        </div>

        <!-- Info Cabang -->
        <div class="bg-gradient-to-r from-emerald-600 to-green-500 rounded-2xl shadow-lg text-white p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-emerald-100 text-sm uppercase tracking-wide">
                        Cabang Aktif
                    </p>

                    <h2 class="text-2xl font-bold mt-1">
                        {{ $cabang->nama }}
                    </h2>

                    <p class="text-emerald-100 mt-2">
                        Selamat bekerja dan layani pelanggan dengan baik.
                    </p>
                </div>

                <div class="hidden md:flex w-20 h-20 rounded-2xl bg-white/20 items-center justify-center">
                    <i class="fas fa-store text-4xl"></i>
                </div>
            </div>
        </div>

        <!-- Statistik -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-sm text-gray-500">
                            Transaksi Hari Ini
                        </p>

                        <h3 class="text-3xl font-bold text-gray-900 mt-2">
                            {{ $transaksiSaya->count() }}
                        </h3>
                    </div>

                    <div class="w-14 h-14 rounded-xl bg-blue-100 flex items-center justify-center">
                        <i class="fas fa-receipt text-blue-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-sm text-gray-500">
                            Total Omzet Hari Ini
                        </p>

                        <h3 class="text-2xl font-bold text-green-600 mt-2">
                            Rp {{ number_format($transaksiSaya->sum('total_harga'),0,',','.') }}
                        </h3>
                    </div>

                    <div class="w-14 h-14 rounded-xl bg-green-100 flex items-center justify-center">
                        <i class="fas fa-money-bill-wave text-green-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-sm text-gray-500">
                            Rata-rata Transaksi
                        </p>

                        <h3 class="text-2xl font-bold text-purple-600 mt-2">
                            Rp {{ $transaksiSaya->count() > 0 ? number_format($transaksiSaya->avg('total_harga'),0,',','.') : '0' }}
                        </h3>
                    </div>

                    <div class="w-14 h-14 rounded-xl bg-purple-100 flex items-center justify-center">
                        <i class="fas fa-chart-line text-purple-600 text-xl"></i>
                    </div>
                </div>
            </div>

        </div>

        <!-- Riwayat Transaksi -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

            <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center">
                <div>
                    <h2 class="text-lg font-bold text-gray-800">
                        Transaksi Hari Ini
                    </h2>

                    <p class="text-sm text-gray-500 mt-1">
                        Riwayat transaksi yang telah dilakukan oleh kasir.
                    </p>
                </div>

                <div class="text-sm text-gray-400">
                    {{ now()->format('d M Y') }}
                </div>
            </div>

            <div class="overflow-x-auto">

                @if($transaksiSaya->count() > 0)

                <table class="w-full text-sm">

                    <thead class="bg-gray-50 text-gray-700 uppercase text-xs">
                        <tr>
                            <th class="px-6 py-4 text-left">Kode Transaksi</th>
                            <th class="px-6 py-4 text-left">Total Belanja</th>
                            <th class="px-6 py-4 text-left">Waktu</th>
                            <th class="px-6 py-4 text-center">Status</th>
                            <th class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach($transaksiSaya as $trx)
                        <tr class="border-b border-gray-100 hover:bg-gray-50 transition">

                            <td class="px-6 py-4">
                                <span class="font-semibold text-blue-600">
                                    {{ $trx->kode_transaksi }}
                                </span>
                            </td>

                            <td class="px-6 py-4 font-bold text-green-600">
                                Rp {{ number_format($trx->total_harga,0,',','.') }}
                            </td>

                            <td class="px-6 py-4 text-gray-600">
                                {{ $trx->created_at->format('H:i:s') }}
                            </td>

                            <td class="px-6 py-4 text-center">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                                    Selesai
                                </span>
                            </td>

                            <td class="px-6 py-4 text-center">
                                <a href="{{ route('transaksi.struk', $trx) }}"
                                   target="_blank"
                                   class="inline-flex items-center gap-2 bg-gray-800 hover:bg-black text-white px-3 py-2 rounded-lg text-xs font-medium transition">
                                    <i class="fas fa-print"></i>
                                    Cetak Struk
                                </a>
                            </td>

                        </tr>
                        @endforeach

                    </tbody>

                </table>

                @else

                <div class="py-20 text-center">

                    <div class="w-20 h-20 mx-auto rounded-full bg-gray-100 flex items-center justify-center mb-4">
                        <i class="fas fa-receipt text-3xl text-gray-400"></i>
                    </div>

                    <h3 class="text-lg font-semibold text-gray-700">
                        Belum Ada Transaksi
                    </h3>

                    <p class="text-gray-500 mt-2">
                        Belum ada transaksi yang tercatat hari ini.
                    </p>

                </div>

                @endif

            </div>
        </div>

    </div>
</x-app-layout>     