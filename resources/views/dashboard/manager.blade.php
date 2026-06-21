<x-app-layout>
    <div class="space-y-6">

        <!-- Header -->
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 flex items-center gap-3">
                    <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center">
                        <i class="fas fa-user-tie text-blue-600 text-xl"></i>
                    </div>
                    Dashboard Manajer
                </h1>

                <p class="text-gray-500 mt-2">
                    Pantau performa operasional dan stok cabang secara real-time.
                </p>
            </div>

            <div class="bg-white border border-gray-200 rounded-xl px-5 py-3 shadow-sm">
                <p class="text-xs uppercase tracking-wide text-gray-400">
                    Cabang
                </p>

                <p class="font-bold text-gray-800">
                    {{ $cabang->nama }}
                </p>

                <p class="text-sm text-gray-500">
                    {{ $cabang->kota }}
                </p>
            </div>
        </div>

        <!-- Banner Cabang -->
        <div class="bg-gradient-to-r from-blue-600 to-indigo-600 rounded-2xl p-6 text-white shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-sm uppercase tracking-wider">
                        Minimarket Jayusman
                    </p>

                    <h2 class="text-3xl font-bold mt-2">
                        {{ $cabang->nama }}
                    </h2>

                    <p class="text-blue-100 mt-2">
                        Monitoring transaksi, omzet, dan stok barang cabang.
                    </p>
                </div>

                <div class="hidden md:flex w-24 h-24 rounded-2xl bg-white/20 items-center justify-center">
                    <i class="fas fa-store text-5xl"></i>
                </div>
            </div>
        </div>

        <!-- Statistik -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

            <!-- Transaksi -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                <div class="flex items-center justify-between">

                    <div>
                        <p class="text-sm text-gray-500">
                            Transaksi Hari Ini
                        </p>

                        <h3 class="text-3xl font-bold text-blue-600 mt-2">
                            {{ $transaksiHariIni }}
                        </h3>
                    </div>

                    <div class="w-14 h-14 rounded-xl bg-blue-100 flex items-center justify-center">
                        <i class="fas fa-receipt text-blue-600 text-xl"></i>
                    </div>

                </div>
            </div>

            <!-- Pendapatan -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                <div class="flex items-center justify-between">

                    <div>
                        <p class="text-sm text-gray-500">
                            Pendapatan Hari Ini
                        </p>

                        <h3 class="text-2xl font-bold text-green-600 mt-2">
                            Rp {{ number_format($pendapatanHariIni,0,',','.') }}
                        </h3>
                    </div>

                    <div class="w-14 h-14 rounded-xl bg-green-100 flex items-center justify-center">
                        <i class="fas fa-money-bill-wave text-green-600 text-xl"></i>
                    </div>

                </div>
            </div>

            <!-- Total Stok -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                <div class="flex items-center justify-between">

                    <div>
                        <p class="text-sm text-gray-500">
                            Total Stok Barang
                        </p>

                        <h3 class="text-3xl font-bold text-purple-600 mt-2">
                            {{ number_format($totalBarang) }}
                        </h3>
                    </div>

                    <div class="w-14 h-14 rounded-xl bg-purple-100 flex items-center justify-center">
                        <i class="fas fa-boxes text-purple-600 text-xl"></i>
                    </div>

                </div>
            </div>

        </div>

        <!-- Stok Menipis -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

            <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                        <i class="fas fa-exclamation-triangle text-yellow-500"></i>
                        Stok Menipis
                    </h2>

                    <p class="text-sm text-gray-500 mt-1">
                        Barang yang perlu segera dilakukan pengadaan atau mutasi stok.
                    </p>
                </div>

                <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-bold">
                    {{ $stokMenipis->count() }} Barang
                </span>
            </div>

            <div class="overflow-x-auto">

                @if($stokMenipis->count() > 0)

                    <table class="w-full text-sm">

                        <thead class="bg-gray-50 text-gray-700 uppercase text-xs">
                            <tr>
                                <th class="px-6 py-4 text-left">Nama Barang</th>
                                <th class="px-6 py-4 text-center">Stok Tersedia</th>
                                <th class="px-6 py-4 text-center">Status</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($stokMenipis as $stok)

                            <tr class="border-b border-gray-100 hover:bg-red-50 transition">

                                <td class="px-6 py-4 font-medium text-gray-800">
                                    {{ $stok->barang->nama }}
                                </td>

                                <td class="px-6 py-4 text-center">
                                    <span class="font-bold text-red-600">
                                        {{ $stok->quantity }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 text-center">
                                    <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-xs font-bold">
                                        Perlu Restok
                                    </span>
                                </td>

                            </tr>

                            @endforeach

                        </tbody>

                    </table>

                @else

                    <div class="py-16 text-center">

                        <div class="w-20 h-20 mx-auto rounded-full bg-green-100 flex items-center justify-center mb-4">
                            <i class="fas fa-check-circle text-green-600 text-4xl"></i>
                        </div>

                        <h3 class="text-lg font-bold text-green-600">
                            Semua Stok Aman
                        </h3>

                        <p class="text-gray-500 mt-2">
                            Tidak ada barang yang berada di bawah batas minimum stok.
                        </p>

                    </div>

                @endif

            </div>

        </div>

    </div>
</x-app-layout>