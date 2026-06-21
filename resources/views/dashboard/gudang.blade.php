<x-app-layout>
    <div class="space-y-6">

        <!-- Header -->
        <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 flex items-center gap-3">
                    <i class="fas fa-warehouse text-blue-600"></i>
                    Dashboard Gudang
                </h1>

                <p class="text-gray-500 mt-2">
                    Monitoring persediaan barang cabang
                    <span class="font-semibold text-gray-700">
                        {{ $cabang->nama }}
                    </span>
                </p>
            </div>

            <a
                href="{{ route('stok.mutasi.create') }}"
                class="inline-flex items-center gap-2 bg-blue-600 text-white px-5 py-3 rounded-xl font-semibold hover:bg-blue-700 transition shadow-sm"
            >
                <i class="fas fa-exchange-alt"></i>
                Mutasi Stok
            </a>
        </div>

        @php
            $totalItem = $stoks->count();
            $stokMenipis = $stoks->where('quantity', '<', 10)->count();
            $totalStok = $stoks->sum('quantity');
        @endphp

        <!-- Statistik -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-sm text-gray-500">
                            Total Produk
                        </p>

                        <h2 class="text-3xl font-bold text-blue-600 mt-1">
                            {{ $totalItem }}
                        </h2>
                    </div>

                    <div class="w-14 h-14 rounded-full bg-blue-100 flex items-center justify-center">
                        <i class="fas fa-box text-blue-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-sm text-gray-500">
                            Total Unit Stok
                        </p>

                        <h2 class="text-3xl font-bold text-green-600 mt-1">
                            {{ number_format($totalStok) }}
                        </h2>
                    </div>

                    <div class="w-14 h-14 rounded-full bg-green-100 flex items-center justify-center">
                        <i class="fas fa-boxes text-green-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-sm text-gray-500">
                            Stok Menipis
                        </p>

                        <h2 class="text-3xl font-bold text-red-600 mt-1">
                            {{ $stokMenipis }}
                        </h2>
                    </div>

                    <div class="w-14 h-14 rounded-full bg-red-100 flex items-center justify-center">
                        <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
                    </div>
                </div>
            </div>

        </div>

        <!-- Tabel Stok -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

            <div class="px-6 py-4 border-b border-gray-100">
                <h2 class="font-semibold text-gray-800 flex items-center gap-2">
                    <i class="fas fa-clipboard-list text-blue-500"></i>
                    Daftar Persediaan Barang
                </h2>
            </div>

            <div class="overflow-x-auto">

                <table class="w-full text-sm">

                    <thead class="bg-gray-50 text-gray-700 uppercase text-xs">
                        <tr>
                            <th class="px-6 py-4 text-center w-20">
                                No
                            </th>

                            <th class="px-6 py-4 text-left">
                                Nama Barang
                            </th>

                            <th class="px-6 py-4 text-center">
                                Stok Saat Ini
                            </th>

                            <th class="px-6 py-4 text-center">
                                Status
                            </th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($stoks as $index => $stok)
                        <tr class="border-b hover:bg-gray-50 transition">

                            <td class="px-6 py-4 text-center font-semibold text-gray-700">
                                {{ $index + 1 }}
                            </td>

                            <td class="px-6 py-4 font-medium text-gray-800">
                                {{ $stok->barang->nama }}
                            </td>

                            <td class="px-6 py-4 text-center">
                                <span class="font-bold text-lg {{ $stok->quantity < 10 ? 'text-red-600' : 'text-green-600' }}">
                                    {{ $stok->quantity }}
                                </span>
                            </td>

                            <td class="px-6 py-4 text-center">

                                @if($stok->quantity < 10)
                                    <span class="bg-red-100 text-red-700 text-xs font-semibold px-3 py-1 rounded-full">
                                        Menipis
                                    </span>
                                @else
                                    <span class="bg-green-100 text-green-700 text-xs font-semibold px-3 py-1 rounded-full">
                                        Aman
                                    </span>
                                @endif

                            </td>

                        </tr>
                        @empty

                        <tr>
                            <td colspan="4" class="py-10 text-center text-gray-400">
                                <i class="fas fa-box-open text-4xl mb-3 block text-gray-300"></i>
                                Belum ada data stok barang.
                            </td>
                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>
        </div>

    </div>
</x-app-layout>