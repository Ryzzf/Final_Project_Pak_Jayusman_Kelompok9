<x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="space-y-6">

    <!-- HEADER -->
    <div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-6">

        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">

            <div>

                <span class="inline-flex items-center px-3 py-1 rounded-full bg-slate-100 text-slate-600 text-xs font-medium mb-3">
                    Manajemen Cabang
                </span>

                <h1 class="text-3xl font-bold text-slate-800">
                    Data Cabang
                </h1>

                <p class="text-slate-500 mt-2">
                    Kelola seluruh cabang Jayusman Mart yang terdaftar dalam sistem.
                </p>

            </div>

            <a href="{{ route('owner.cabang.create') }}"
               class="inline-flex items-center gap-2 px-5 py-3 rounded-2xl bg-slate-900 text-white hover:bg-slate-800 transition shadow-sm font-medium">

                <i class="fas fa-plus"></i>
                Tambah Cabang

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

    <!-- CARD TOTAL -->
    <div class="bg-gradient-to-r from-slate-900 via-slate-800 to-indigo-900 rounded-3xl p-6 text-white">

        <div class="flex items-center justify-between">

            <div>

                <p class="text-slate-300 text-sm">
                    Total Cabang Terdaftar
                </p>

                <h2 class="text-4xl font-bold mt-2">
                    {{ count($cabangs) }}
                </h2>

                <p class="text-slate-300 text-sm mt-2">
                    Cabang aktif yang dikelola dalam sistem Jayusman Mart.
                </p>

            </div>

            <div class="w-20 h-20 rounded-3xl bg-white/10 flex items-center justify-center">

                <i class="fas fa-store text-3xl"></i>

            </div>

        </div>

    </div>

    <!-- TABLE -->
    <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">

        <div class="px-6 py-5 border-b border-slate-100">

            <h3 class="font-semibold text-slate-800">
                Daftar Cabang
            </h3>

            <p class="text-sm text-slate-500 mt-1">
                Seluruh data cabang minimarket yang telah terdaftar.
            </p>

        </div>

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead>

                    <tr class="bg-slate-50">

                        <th class="px-6 py-4 text-center text-xs font-semibold uppercase tracking-wider text-slate-500 w-20">
                            ID
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Nama Cabang
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Kota
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Alamat
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Telepon
                        </th>

                        <th class="px-6 py-4 text-center text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Aksi
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($cabangs as $cabang)

                    <tr class="border-t border-slate-100 hover:bg-slate-50 transition">

                        <!-- ID -->
                        <td class="px-6 py-5 text-center">

                            <span class="font-semibold text-slate-800">
                                {{ $cabang->id }}
                            </span>

                        </td>

                        <!-- NAMA -->
                        <td class="px-6 py-5">

                            <div class="flex items-center gap-4">

                                <div class="w-12 h-12 rounded-2xl bg-slate-100 flex items-center justify-center">

                                    <i class="fas fa-store text-slate-600"></i>

                                </div>

                                <div>

                                    <h4 class="font-semibold text-slate-800">
                                        {{ $cabang->nama }}
                                    </h4>

                                    <p class="text-sm text-slate-500">
                                        Cabang Minimarket
                                    </p>

                                </div>

                            </div>

                        </td>

                        <!-- KOTA -->
                        <td class="px-6 py-5">

                            <span class="font-medium text-slate-700">
                                {{ $cabang->kota }}
                            </span>

                        </td>

                        <!-- ALAMAT -->
                        <td class="px-6 py-5 text-slate-600">

                            {{ $cabang->alamat ?? '-' }}

                        </td>

                        <!-- TELEPON -->
                        <td class="px-6 py-5 text-slate-600">

                            {{ $cabang->telepon ?? '-' }}

                        </td>

                        <!-- AKSI -->
                        <td class="px-6 py-5">

                            <div class="flex items-center justify-center gap-2">

                                <a href="{{ route('owner.cabang.edit', $cabang->id) }}"
                                   class="w-10 h-10 rounded-xl bg-indigo-100 text-indigo-600 hover:bg-indigo-200 transition flex items-center justify-center"
                                   title="Edit Cabang">

                                    <i class="fas fa-pen"></i>

                                </a>

                                <form id="form-hapus-{{ $cabang->id }}"
                                      action="{{ route('owner.cabang.destroy', $cabang->id) }}"
                                      method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="button"
                                        onclick="konfirmasiHapus({{ $cabang->id }}, '{{ $cabang->nama }}')"
                                        class="w-10 h-10 rounded-xl bg-red-100 text-red-600 hover:bg-red-200 transition flex items-center justify-center"
                                        title="Hapus Cabang">

                                        <i class="fas fa-trash"></i>

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="6" class="py-16 text-center">

                            <div class="flex flex-col items-center">

                                <div class="w-20 h-20 rounded-full bg-slate-100 flex items-center justify-center mb-4">

                                    <i class="fas fa-store-slash text-3xl text-slate-400"></i>

                                </div>

                                <h3 class="font-semibold text-slate-700">
                                    Belum Ada Cabang
                                </h3>

                                <p class="text-sm text-slate-500 mt-2">
                                    Tambahkan cabang baru untuk mulai mengelola operasional minimarket.
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

function konfirmasiHapus(id, namaCabang) {

    Swal.fire({
        title: 'Hapus Cabang?',
        text: 'Cabang "' + namaCabang + '" akan dihapus dari sistem.',
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