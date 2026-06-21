<x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="space-y-6">

    <!-- HEADER -->
    <div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-6">

        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">

            <div>

                <span class="inline-flex items-center px-3 py-1 rounded-full bg-slate-100 text-slate-600 text-xs font-medium mb-3">
                    Master Data
                </span>

                <h1 class="text-3xl font-bold text-slate-800">
                    Data Barang
                </h1>

                <p class="text-slate-500 mt-2">
                    Kelola seluruh data barang yang digunakan pada sistem Jayusman Mart.
                </p>

            </div>

            <a href="{{ route('master.barang.create') }}"
                class="inline-flex items-center gap-2 px-5 py-3 rounded-2xl bg-slate-900 text-white hover:bg-slate-800 transition shadow-sm font-medium">

                <i class="fas fa-plus"></i>
                Tambah Barang

            </a>

        </div>

    </div>

    @if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
                timer: 2000,
                showConfirmButton: false
            });
        });
    </script>
    @endif

    <!-- TOTAL BARANG -->
    <div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-6">

        <div class="flex items-center justify-between">

            <div>

                <p class="text-sm text-slate-500">
                    Total Barang Terdaftar
                </p>

                <h2 class="text-4xl font-bold text-slate-800 mt-2">
                    {{ count($barangs) }}
                </h2>

            </div>

            <div class="w-16 h-16 rounded-2xl bg-indigo-100 flex items-center justify-center">

                <i class="fas fa-box text-indigo-600 text-2xl"></i>

            </div>

        </div>

    </div>

    <!-- TABLE -->
    <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">

        <div class="px-6 py-5 border-b border-slate-100">

            <div class="flex items-center justify-between">

                <div>

                    <h3 class="font-semibold text-slate-800">
                        Daftar Barang
                    </h3>

                    <p class="text-sm text-slate-500 mt-1">
                        {{ count($barangs) }} barang terdaftar
                    </p>

                </div>

            </div>

        </div>

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead>

                    <tr class="bg-slate-50">

                        <th class="px-6 py-4 text-center text-xs font-semibold uppercase tracking-wider text-slate-500">
                            ID
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Kode Barang
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Nama Barang
                        </th>

                        <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Harga Dasar
                        </th>

                        <th class="px-6 py-4 text-center text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Aksi
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($barangs as $barang)

                    <tr class="border-t border-slate-100 hover:bg-slate-50 transition">

                        <td class="px-6 py-4 text-center">

                            <span class="font-bold text-slate-800">
                                {{ $barang->id }}
                            </span>

                        </td>

                        <td class="px-6 py-4">

                            <span class="inline-flex items-center px-3 py-1 rounded-full bg-slate-100 text-slate-700 text-xs font-medium">
                                {{ $barang->kode_barang }}
                            </span>

                        </td>

                        <td class="px-6 py-4">

                            <div>

                                <h4 class="font-semibold text-slate-800">
                                    {{ $barang->nama }}
                                </h4>

                            </div>

                        </td>

                        <td class="px-6 py-4 text-right">

                            <span class="font-bold text-emerald-600">
                                Rp {{ number_format($barang->harga, 0, ',', '.') }}
                            </span>

                        </td>

                        <td class="px-6 py-4">

                            <div class="flex items-center justify-center gap-2">

                                <a href="{{ route('master.barang.edit', $barang->id) }}"
                                    class="w-10 h-10 rounded-xl bg-indigo-100 text-indigo-600 hover:bg-indigo-200 transition flex items-center justify-center"
                                    title="Edit Barang">

                                    <i class="fas fa-pen"></i>

                                </a>

                                <form id="form-hapus-{{ $barang->id }}"
                                    action="{{ route('master.barang.destroy', $barang->id) }}"
                                    method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button type="button"
                                        onclick="konfirmasiHapus({{ $barang->id }}, '{{ $barang->nama }}')"
                                        class="w-10 h-10 rounded-xl bg-red-100 text-red-600 hover:bg-red-200 transition flex items-center justify-center"
                                        title="Hapus Barang">

                                        <i class="fas fa-trash"></i>

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="5" class="py-16 text-center">

                            <div class="flex flex-col items-center">

                                <div class="w-20 h-20 rounded-full bg-slate-100 flex items-center justify-center mb-4">

                                    <i class="fas fa-box-open text-3xl text-slate-400"></i>

                                </div>

                                <h3 class="font-semibold text-slate-700">
                                    Belum Ada Data Barang
                                </h3>

                                <p class="text-sm text-slate-500 mt-2">
                                    Tambahkan data barang pertama untuk memulai pengelolaan master data.
                                </p>

                            </div>

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

<script>
    function konfirmasiHapus(id, namaBarang) {

        Swal.fire({
            title: 'Hapus Barang?',
            text: 'Apakah Anda yakin ingin menghapus "' + namaBarang + '" ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc2626',
            cancelButtonColor: '#64748b',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {

            if (result.isConfirmed) {
                document.getElementById('form-hapus-' + id).submit();
            }

        });

    }
</script>

</x-app-layout>