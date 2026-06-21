<x-app-layout>

<div class="space-y-6">

    <!-- HEADER -->
    <div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-6">

        <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center gap-5">

            <div>

                <span class="inline-flex items-center px-3 py-1 rounded-full bg-slate-100 text-slate-600 text-xs font-medium mb-3">
                    Monitoring Inventaris
                </span>

                <h1 class="text-3xl font-bold text-slate-800">
                    Pantau Stok Seluruh Cabang
                </h1>

                <p class="text-slate-500 mt-2">
                    Monitoring stok barang seluruh cabang Jayusman Mart secara real-time.
                </p>

            </div>

            <!-- SEARCH -->
            <form action="{{ route('owner.stok') }}" method="GET" class="flex gap-2">

                <div class="relative">

                    <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Cari nama barang..."
                        class="pl-11 pr-4 py-3 w-72 rounded-2xl border border-slate-300 focus:ring-2 focus:ring-slate-900 focus:border-slate-900">

                </div>

                <button
                    type="submit"
                    class="px-5 py-3 rounded-2xl bg-slate-900 text-white hover:bg-slate-800 transition">

                    Cari

                </button>

                @if(request('search'))

                    <a href="{{ route('owner.stok') }}"
                       class="px-4 py-3 rounded-2xl bg-slate-100 hover:bg-slate-200 text-slate-700 transition">

                        <i class="fas fa-rotate-left"></i>

                    </a>

                @endif

            </form>

        </div>

    </div>

    <!-- SUMMARY -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

        <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-sm">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-slate-500 text-sm">
                        Total Data Stok
                    </p>

                    <h2 class="text-3xl font-bold text-slate-800 mt-2">
                        {{ $stoks->count() }}
                    </h2>

                </div>

                <div class="w-14 h-14 rounded-2xl bg-blue-100 flex items-center justify-center">

                    <i class="fas fa-boxes text-blue-600 text-xl"></i>

                </div>

            </div>

        </div>

        <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-sm">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-slate-500 text-sm">
                        Stok Menipis
                    </p>

                    <h2 class="text-3xl font-bold text-yellow-600 mt-2">
                        {{ $stoks->where('quantity', '<=', 10)->where('quantity', '>', 0)->count() }}
                    </h2>

                </div>

                <div class="w-14 h-14 rounded-2xl bg-yellow-100 flex items-center justify-center">

                    <i class="fas fa-triangle-exclamation text-yellow-600 text-xl"></i>

                </div>

            </div>

        </div>

        <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-sm">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-slate-500 text-sm">
                        Stok Habis
                    </p>

                    <h2 class="text-3xl font-bold text-red-600 mt-2">
                        {{ $stoks->where('quantity', 0)->count() }}
                    </h2>

                </div>

                <div class="w-14 h-14 rounded-2xl bg-red-100 flex items-center justify-center">

                    <i class="fas fa-circle-xmark text-red-600 text-xl"></i>

                </div>

            </div>

        </div>

    </div>

    <!-- SEARCH RESULT -->
    @if(request('search') && $stoks->isEmpty())

        <div class="bg-yellow-50 border border-yellow-200 rounded-2xl p-4">

            <p class="text-yellow-700 text-sm">

                Barang dengan kata kunci
                <strong>"{{ request('search') }}"</strong>
                tidak ditemukan.

            </p>

        </div>

    @endif

    <!-- TABLE -->
    <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">

        <div class="px-6 py-5 border-b border-slate-100">

            <h3 class="font-semibold text-slate-800">
                Data Stok Cabang
            </h3>

            <p class="text-sm text-slate-500 mt-1">
                Informasi stok barang seluruh cabang minimarket.
            </p>

        </div>

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead>

                    <tr class="bg-slate-50">

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase text-slate-500">
                            Cabang
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase text-slate-500">
                            Kode Barang
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase text-slate-500">
                            Nama Barang
                        </th>

                        <th class="px-6 py-4 text-center text-xs font-semibold uppercase text-slate-500">
                            Stok
                        </th>

                        <th class="px-6 py-4 text-center text-xs font-semibold uppercase text-slate-500">
                            Kondisi
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($stoks as $stok)

                    <tr class="border-t border-slate-100 hover:bg-slate-50 transition">

                        <td class="px-6 py-5">

                            <div class="flex items-center gap-3">

                                <div class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center">

                                    <i class="fas fa-store text-slate-600"></i>

                                </div>

                                <span class="font-medium text-slate-800">
                                    {{ $stok->cabang->nama ?? 'Pusat' }}
                                </span>

                            </div>

                        </td>

                        <td class="px-6 py-5 text-slate-600">
                            {{ $stok->barang->kode_barang }}
                        </td>

                        <td class="px-6 py-5 font-medium text-slate-800">
                            {{ $stok->barang->nama }}
                        </td>

                        <td class="px-6 py-5 text-center">

                            <span class="inline-flex items-center justify-center min-w-[50px] h-10 px-4 rounded-xl bg-slate-100 font-bold text-slate-800">

                                {{ $stok->quantity }}

                            </span>

                        </td>

                        <td class="px-6 py-5 text-center">

                            @if($stok->quantity == 0)

                                <span class="inline-flex px-3 py-1 rounded-full bg-red-100 text-red-700 text-xs font-semibold">
                                    Habis
                                </span>

                            @elseif($stok->quantity <= 10)

                                <span class="inline-flex px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-xs font-semibold">
                                    Menipis
                                </span>

                            @else

                                <span class="inline-flex px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold">
                                    Aman
                                </span>

                            @endif

                        </td>

                    </tr>

                    @empty

                        @if(!request('search'))

                        <tr>

                            <td colspan="5" class="py-16 text-center">

                                <div class="flex flex-col items-center">

                                    <div class="w-20 h-20 rounded-full bg-slate-100 flex items-center justify-center mb-4">

                                        <i class="fas fa-box-open text-3xl text-slate-400"></i>

                                    </div>

                                    <h3 class="font-semibold text-slate-700">
                                        Belum Ada Data Stok
                                    </h3>

                                    <p class="text-sm text-slate-500 mt-2">
                                        Data stok dari seluruh cabang akan muncul di sini.
                                    </p>

                                </div>

                            </td>

                        </tr>

                        @endif

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

</x-app-layout>