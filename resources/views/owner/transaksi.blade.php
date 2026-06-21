<x-app-layout>
    <div class="mb-6 flex flex-col lg:flex-row lg:justify-between lg:items-center gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 flex items-center gap-2">
                <i class="fas fa-receipt text-blue-500"></i>
                Pantau Semua Transaksi
            </h1>
            <p class="text-sm text-gray-500 mt-1">
                Pantau seluruh transaksi penjualan dari setiap cabang Minimarket Jayusman.
            </p>
        </div>

        <!-- Filter Tanggal -->
        <form action="{{ route('owner.transaksi') }}" method="GET" class="flex items-center gap-2">
            <input
                type="date"
                name="date"
                value="{{ request('date') }}"
                class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500"
            >

            <button
                type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition text-sm font-medium"
            >
                <i class="fas fa-search mr-1"></i> Filter
            </button>

            @if(request('date'))
                <a
                    href="{{ route('owner.transaksi') }}"
                    class="bg-gray-100 border border-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-200 transition text-sm font-medium"
                >
                    Reset
                </a>
            @endif
        </form>
    </div>

    <!-- Ringkasan -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
        
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">
                        Total Transaksi
                    </p>
                    <h2 class="text-3xl font-bold text-gray-900 mt-1">
                        {{ $transaksis->count() }}
                    </h2>
                </div>

                <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center">
                    <i class="fas fa-shopping-cart text-blue-600 text-lg"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">
                        Total Omzet
                    </p>
                    <h2 class="text-3xl font-bold text-green-600 mt-1">
                        Rp {{ number_format($transaksis->sum('total_harga'), 0, ',', '.') }}
                    </h2>
                </div>

                <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center">
                    <i class="fas fa-money-bill-wave text-green-600 text-lg"></i>
                </div>
            </div>
        </div>

    </div>

    <!-- Tabel Transaksi -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-5 py-4 border-b border-gray-100">
            <h2 class="font-semibold text-gray-800">
                Riwayat Transaksi
            </h2>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-gray-700 uppercase text-xs">
                    <tr>
                        <th class="px-4 py-4 text-center w-16">No</th>
                        <th class="px-4 py-4">Tanggal</th>
                        <th class="px-4 py-4">Kode Transaksi</th>
                        <th class="px-4 py-4">Cabang</th>
                        <th class="px-4 py-4">Kasir</th>
                        <th class="px-4 py-4 text-right">Total Belanja</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($transaksis as $index => $trx)
                    <tr class="border-b hover:bg-gray-50 transition">
                        
                        <td class="px-4 py-4 text-center font-semibold text-gray-700">
                            {{ $index + 1 }}
                        </td>

                        <td class="px-4 py-4 text-gray-600">
                            {{ $trx->created_at->format('d M Y, H:i') }}
                        </td>

                        <td class="px-4 py-4">
                            <span class="font-semibold text-blue-600">
                                {{ $trx->kode_transaksi }}
                            </span>
                        </td>

                        <td class="px-4 py-4">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-store text-gray-400"></i>
                                <span class="font-medium text-gray-800">
                                    {{ $trx->cabang->nama ?? '-' }}
                                </span>
                            </div>
                        </td>

                        <td class="px-4 py-4 text-gray-700">
                            {{ $trx->user->name }}
                        </td>

                        <td class="px-4 py-4 text-right font-bold text-green-600">
                            Rp {{ number_format($trx->total_harga, 0, ',', '.') }}
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-4 py-12 text-center text-gray-400">
                            <i class="fas fa-receipt text-4xl mb-3 block text-gray-300"></i>

                            @if(request('date'))
                                Tidak ada transaksi pada tanggal yang dipilih.
                            @else
                                Belum ada transaksi yang tercatat.
                            @endif
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>