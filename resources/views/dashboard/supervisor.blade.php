<x-app-layout>
    <div class="space-y-6">

        <!-- Header -->
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 flex items-center gap-3">
                    <div class="w-12 h-12 rounded-xl bg-amber-100 flex items-center justify-center">
                        <i class="fas fa-user-shield text-amber-600 text-xl"></i>
                    </div>
                    Dashboard Supervisor
                </h1>

                <p class="text-gray-500 mt-2">
                    Monitoring aktivitas transaksi harian dan pengawasan operasional cabang.
                </p>
            </div>

            <div class="bg-white border border-gray-200 rounded-xl px-5 py-3 shadow-sm">
                <p class="text-xs uppercase tracking-wide text-gray-400">
                    Cabang
                </p>

                <p class="font-bold text-gray-800">
                    {{ $cabang->nama }}
                </p>
            </div>
        </div>

        <!-- Banner -->
        <div class="bg-gradient-to-r from-amber-500 to-orange-500 rounded-2xl p-6 text-white shadow-lg">
            <div class="flex items-center justify-between">

                <div>
                    <p class="text-amber-100 text-sm uppercase tracking-wider">
                        Minimarket Jayusman
                    </p>

                    <h2 class="text-3xl font-bold mt-2">
                        Monitoring Operasional Cabang
                    </h2>

                    <p class="text-amber-100 mt-2">
                        Pantau transaksi harian, omzet, dan aktivitas kasir secara real-time.
                    </p>
                </div>

                <div class="hidden md:flex w-24 h-24 rounded-2xl bg-white/20 items-center justify-center">
                    <i class="fas fa-chart-bar text-5xl"></i>
                </div>

            </div>
        </div>

        <!-- Statistik -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

            <!-- Total Transaksi -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                <div class="flex justify-between items-center">

                    <div>
                        <p class="text-sm text-gray-500">
                            Total Transaksi Hari Ini
                        </p>

                        <h3 class="text-3xl font-bold text-blue-600 mt-2">
                            {{ $transaksiHariIni->count() }}
                        </h3>
                    </div>

                    <div class="w-14 h-14 rounded-xl bg-blue-100 flex items-center justify-center">
                        <i class="fas fa-receipt text-blue-600 text-xl"></i>
                    </div>

                </div>
            </div>

            <!-- Omzet -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                <div class="flex justify-between items-center">

                    <div>
                        <p class="text-sm text-gray-500">
                            Omzet Hari Ini
                        </p>

                        <h3 class="text-2xl font-bold text-green-600 mt-2">
                            Rp {{ number_format($totalOmzet,0,',','.') }}
                        </h3>
                    </div>

                    <div class="w-14 h-14 rounded-xl bg-green-100 flex items-center justify-center">
                        <i class="fas fa-money-bill-wave text-green-600 text-xl"></i>
                    </div>

                </div>
            </div>

            <!-- Rata-rata Transaksi -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                <div class="flex justify-between items-center">

                    <div>
                        <p class="text-sm text-gray-500">
                            Rata-rata Transaksi
                        </p>

                        <h3 class="text-2xl font-bold text-purple-600 mt-2">
                            Rp {{ $transaksiHariIni->count() > 0 ? number_format($totalOmzet / $transaksiHariIni->count(),0,',','.') : '0' }}
                        </h3>
                    </div>

                    <div class="w-14 h-14 rounded-xl bg-purple-100 flex items-center justify-center">
                        <i class="fas fa-chart-line text-purple-600 text-xl"></i>
                    </div>

                </div>
            </div>

        </div>

        <!-- Tabel Transaksi -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

            <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center">
                <div>
                    <h2 class="text-lg font-bold text-gray-800">
                        Daftar Transaksi Hari Ini
                    </h2>

                    <p class="text-sm text-gray-500 mt-1">
                        Riwayat seluruh transaksi yang terjadi pada cabang hari ini.
                    </p>
                </div>

                <span class="bg-amber-100 text-amber-700 px-3 py-1 rounded-full text-xs font-bold">
                    {{ $transaksiHariIni->count() }} Transaksi
                </span>
            </div>

            <div class="overflow-x-auto">

                @if($transaksiHariIni->count() > 0)

                <table class="w-full text-sm">

                    <thead class="bg-gray-50 text-gray-700 uppercase text-xs">
                        <tr>
                            <th class="px-6 py-4 text-left">Kode Transaksi</th>
                            <th class="px-6 py-4 text-left">Kasir</th>
                            <th class="px-6 py-4 text-right">Total Belanja</th>
                            <th class="px-6 py-4 text-center">Waktu</th>
                            <th class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach($transaksiHariIni as $trx)

                        <tr class="border-b border-gray-100 hover:bg-gray-50 transition">

                            <td class="px-6 py-4">
                                <span class="font-semibold text-blue-600">
                                    {{ $trx->kode_transaksi }}
                                </span>
                            </td>

                            <td class="px-6 py-4 text-gray-700">
                                {{ $trx->user->name }}
                            </td>

                            <td class="px-6 py-4 text-right font-bold text-green-600">
                                Rp {{ number_format($trx->total_harga,0,',','.') }}
                            </td>

                            <td class="px-6 py-4 text-center text-gray-600">
                                {{ $trx->created_at->format('H:i:s') }}
                            </td>

                            <td class="px-6 py-4 text-center">
                                <a href="{{ route('transaksi.struk', $trx) }}"
                                   target="_blank"
                                   class="inline-flex items-center gap-2 bg-gray-800 hover:bg-black text-white px-3 py-2 rounded-lg text-xs font-medium transition">
                                    <i class="fas fa-eye"></i>
                                    Lihat Struk
                                </a>
                            </td>

                        </tr>

                        @endforeach

                    </tbody>

                </table>

                @else

                <div class="py-20 text-center">

                    <div class="w-20 h-20 mx-auto rounded-full bg-gray-100 flex items-center justify-center mb-4">
                        <i class="fas fa-receipt text-4xl text-gray-400"></i>
                    </div>

                    <h3 class="text-lg font-semibold text-gray-700">
                        Belum Ada Transaksi
                    </h3>

                    <p class="text-gray-500 mt-2">
                        Belum ada transaksi yang tercatat pada hari ini.
                    </p>

                </div>

                @endif

            </div>

        </div>

    </div>
</x-app-layout>