<x-app-layout>

<div class="space-y-8">

    <!-- HEADER -->
    <div class="bg-gradient-to-r from-slate-900 via-slate-800 to-indigo-900 rounded-3xl p-8 text-white shadow-lg">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">

            <div>
                <p class="text-slate-300 text-sm uppercase tracking-widest mb-2">
                    Owner Dashboard
                </p>

                <h1 class="text-4xl font-bold mb-3">
                    Selamat Datang, Owner 👋
                </h1>

                <p class="text-slate-300">
                    Pantau seluruh aktivitas cabang, transaksi, dan stok barang secara realtime dari satu dashboard.
                </p>
            </div>

            <div class="mt-6 lg:mt-0">
                <div class="bg-white/10 backdrop-blur-md rounded-2xl px-6 py-4">
                    <p class="text-sm text-slate-300">
                        Total Cabang Aktif
                    </p>

                    <h2 class="text-4xl font-bold">
                        {{ $cabangs->count() }}
                    </h2>
                </div>
            </div>

        </div>
    </div>

    <!-- STATISTIK -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

        <!-- Total Transaksi -->
        <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-slate-500 text-sm">
                        Total Transaksi
                    </p>

                    <h2 class="text-3xl font-bold text-slate-800 mt-2">
                        {{ number_format($totalTransaksi) }}
                    </h2>
                </div>

                <div class="w-14 h-14 rounded-2xl bg-sky-100 flex items-center justify-center">
                    <i class="fas fa-cart-shopping text-sky-600 text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Total Cabang -->
        <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-slate-500 text-sm">
                        Total Cabang
                    </p>

                    <h2 class="text-3xl font-bold text-slate-800 mt-2">
                        {{ $cabangs->count() }}
                    </h2>
                </div>

                <div class="w-14 h-14 rounded-2xl bg-indigo-100 flex items-center justify-center">
                    <i class="fas fa-building text-indigo-600 text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Total Barang -->
        <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-slate-500 text-sm">
                        Total Barang
                    </p>

                    <h2 class="text-3xl font-bold text-slate-800 mt-2">
                        {{ number_format($totalBarang) }}
                    </h2>
                </div>

                <div class="w-14 h-14 rounded-2xl bg-orange-100 flex items-center justify-center">
                    <i class="fas fa-boxes-stacked text-orange-600 text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Total Pendapatan -->
        <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-slate-500 text-sm">
                        Total Pendapatan
                    </p>

                    <h2 class="text-2xl font-bold text-emerald-600 mt-2">
                        Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
                    </h2>
                </div>

                <div class="w-14 h-14 rounded-2xl bg-emerald-100 flex items-center justify-center">
                    <i class="fas fa-wallet text-emerald-600 text-xl"></i>
                </div>
            </div>
        </div>

    </div>

    <!-- KONTEN -->
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

        <!-- STOK MENIPIS -->
        <div class="xl:col-span-2 bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">

            <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between">

                <div class="flex items-center gap-3">

                    <div class="w-10 h-10 rounded-xl bg-red-100 flex items-center justify-center">
                        <i class="fas fa-triangle-exclamation text-red-600"></i>
                    </div>

                    <div>
                        <h3 class="font-semibold text-slate-800">
                            Stok Menipis
                        </h3>

                        <p class="text-sm text-slate-500">
                            Monitoring seluruh cabang
                        </p>
                    </div>

                </div>

                <span class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-sm font-semibold">
                    {{ $stokMenipis->count() }} Item
                </span>

            </div>

            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead>
                        <tr class="bg-slate-50">
                            <th class="px-6 py-4 text-left text-xs text-slate-500 uppercase">
                                Cabang
                            </th>

                            <th class="px-6 py-4 text-left text-xs text-slate-500 uppercase">
                                Barang
                            </th>

                            <th class="px-6 py-4 text-center text-xs text-slate-500 uppercase">
                                Stok
                            </th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($stokMenipis as $stok)

                        <tr class="border-t border-slate-100 hover:bg-slate-50">

                            <td class="px-6 py-4 font-medium text-slate-700">
                                {{ $stok->cabang->nama ?? 'Pusat' }}
                            </td>

                            <td class="px-6 py-4 text-slate-500">
                                {{ $stok->barang->nama }}
                            </td>

                            <td class="px-6 py-4 text-center">
                                <span class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-xs font-bold">
                                    {{ $stok->quantity }}
                                </span>
                            </td>

                        </tr>

                        @empty

                        <tr>
                            <td colspan="3" class="text-center py-8 text-slate-500">
                                Semua stok dalam kondisi aman.
                            </td>
                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

        <!-- RINGKASAN -->
        <div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-6">

            <h3 class="font-semibold text-slate-800 mb-5">
                Ringkasan Sistem
            </h3>

            <div class="space-y-4">

                <div class="p-4 rounded-2xl bg-slate-50">
                    <p class="text-sm text-slate-500">Cabang Terdaftar</p>
                    <h4 class="text-2xl font-bold text-slate-800">
                        {{ $cabangs->count() }}
                    </h4>
                </div>

                <div class="p-4 rounded-2xl bg-slate-50">
                    <p class="text-sm text-slate-500">Total Barang</p>
                    <h4 class="text-2xl font-bold text-slate-800">
                        {{ number_format($totalBarang) }}
                    </h4>
                </div>

                <div class="p-4 rounded-2xl bg-slate-50">
                    <p class="text-sm text-slate-500">Total Transaksi</p>
                    <h4 class="text-2xl font-bold text-slate-800">
                        {{ number_format($totalTransaksi) }}
                    </h4>
                </div>

                <div class="p-4 rounded-2xl bg-green-50 border border-green-100">
                    <p class="text-sm text-green-600">Total Pendapatan</p>
                    <h4 class="text-xl font-bold text-green-700">
                        Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
                    </h4>
                </div>

            </div>

        </div>

    </div>

    <!-- DAFTAR CABANG -->
    <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">

        <div class="px-6 py-5 border-b border-slate-100">
            <h3 class="font-semibold text-slate-800">
                Daftar Cabang
            </h3>
        </div>

        <div class="divide-y divide-slate-100">

            @forelse($cabangs as $cabang)

            <div class="px-6 py-5 hover:bg-slate-50 transition">

                <div class="flex items-center justify-between">

                    <div class="flex items-center gap-4">

                        <div class="w-12 h-12 rounded-2xl bg-indigo-100 flex items-center justify-center">
                            <i class="fas fa-store text-indigo-600"></i>
                        </div>

                        <div>

                            <h4 class="font-semibold text-slate-800">
                                {{ $cabang->nama }}
                            </h4>

                            <p class="text-sm text-slate-500">
                                {{ $cabang->kota }}
                            </p>

                            <p class="text-xs text-slate-400">
                                {{ $cabang->alamat }}
                            </p>

                        </div>

                    </div>

                    <i class="fas fa-arrow-right text-slate-400"></i>

                </div>

            </div>

            @empty

            <div class="p-8 text-center text-slate-500">
                Belum ada cabang terdaftar.
            </div>

            @endforelse

        </div>

    </div>

</div>

</x-app-layout>