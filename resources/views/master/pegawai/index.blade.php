<x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="space-y-6">

    <!-- HEADER -->
    <div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-6">

        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">

            <div>

                <span class="inline-flex items-center px-3 py-1 rounded-full bg-slate-100 text-slate-600 text-xs font-medium mb-3">
                    Manajemen Pengguna
                </span>

                <h1 class="text-3xl font-bold text-slate-800">
                    Data Pegawai
                </h1>

                <p class="text-slate-500 mt-2">
                    Kelola akun pegawai dan hak akses pengguna pada sistem Jayusman Mart.
                </p>

            </div>

            <a href="{{ route('master.pegawai.create') }}"
                class="inline-flex items-center gap-2 px-5 py-3 rounded-2xl bg-slate-900 text-white hover:bg-slate-800 transition shadow-sm font-medium">

                <i class="fas fa-user-plus"></i>
                Tambah Pegawai

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

    @if(session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'error',
                title: 'Peringatan',
                text: '{{ session('error') }}'
            });
        });
    </script>
    @endif

    <!-- TOTAL PEGAWAI -->
    <div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-6">

        <div class="flex items-center justify-between">

            <div>

                <p class="text-sm text-slate-500">
                    Total Pegawai Terdaftar
                </p>

                <h2 class="text-4xl font-bold text-slate-800 mt-2">
                    {{ count($pegawais) }}
                </h2>

            </div>

            <div class="w-16 h-16 rounded-2xl bg-blue-100 flex items-center justify-center">

                <i class="fas fa-users text-blue-600 text-2xl"></i>

            </div>

        </div>

    </div>

    <!-- TABLE -->
    <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">

        <div class="px-6 py-5 border-b border-slate-100">

            <h3 class="font-semibold text-slate-800">
                Daftar Pegawai
            </h3>

            <p class="text-sm text-slate-500 mt-1">
                {{ count($pegawais) }} akun terdaftar pada sistem.
            </p>

        </div>

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead>

                    <tr class="bg-slate-50">

                        <th class="px-6 py-4 text-center text-xs font-semibold uppercase tracking-wider text-slate-500">
                            No
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Pegawai
                        </th>

                        <th class="px-6 py-4 text-center text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Role
                        </th>

                        <th class="px-6 py-4 text-center text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Cabang
                        </th>

                        <th class="px-6 py-4 text-center text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Aksi
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($pegawais as $index => $pegawai)

                    <tr class="border-t border-slate-100 hover:bg-slate-50 transition">

                        <!-- NOMOR -->
                        <td class="px-6 py-4 text-center">

                            <span class="font-bold text-slate-800">
                                {{ $index + 1 }}
                            </span>

                        </td>

                        <!-- PEGAWAI -->
                        <td class="px-6 py-4">

                            <div class="flex items-center gap-4">

                                <div class="w-12 h-12 rounded-2xl bg-slate-100 flex items-center justify-center">

                                    <i class="fas fa-user text-slate-600"></i>

                                </div>

                                <div>

                                    <h4 class="font-semibold text-slate-800">
                                        {{ $pegawai->name }}
                                    </h4>

                                    <p class="text-sm text-slate-500">
                                        {{ $pegawai->email }}
                                    </p>

                                </div>

                            </div>

                        </td>

                        <!-- ROLE -->
                        <td class="px-6 py-4 text-center">

                            @if($pegawai->role === 'owner')

                                <span class="inline-flex px-3 py-1 rounded-full bg-purple-100 text-purple-700 text-xs font-bold uppercase">
                                    Owner
                                </span>

                            @elseif($pegawai->role === 'manager')

                                <span class="inline-flex px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-xs font-bold uppercase">
                                    Manager
                                </span>

                            @elseif($pegawai->role === 'supervisor')

                                <span class="inline-flex px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-xs font-bold uppercase">
                                    Supervisor
                                </span>

                            @elseif($pegawai->role === 'kasir')

                                <span class="inline-flex px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-bold uppercase">
                                    Kasir
                                </span>

                            @elseif($pegawai->role === 'gudang')

                                <span class="inline-flex px-3 py-1 rounded-full bg-orange-100 text-orange-700 text-xs font-bold uppercase">
                                    Gudang
                                </span>

                            @else

                                <span class="inline-flex px-3 py-1 rounded-full bg-slate-100 text-slate-700 text-xs font-bold uppercase">
                                    {{ $pegawai->role }}
                                </span>

                            @endif

                        </td>

                        <!-- CABANG -->
                        <td class="px-6 py-4 text-center">

                            <span class="text-slate-700 font-medium">
                                {{ $pegawai->cabang ? $pegawai->cabang->nama : 'Semua Cabang' }}
                            </span>

                        </td>

                        <!-- AKSI -->
                        <td class="px-6 py-4">

                            <div class="flex items-center justify-center gap-2">

                                <a href="{{ route('master.pegawai.edit', $pegawai->id) }}"
                                    class="w-10 h-10 rounded-xl bg-indigo-100 text-indigo-600 hover:bg-indigo-200 transition flex items-center justify-center"
                                    title="Edit Pegawai">

                                    <i class="fas fa-pen"></i>

                                </a>

                                <form id="form-hapus-{{ $pegawai->id }}"
                                    action="{{ route('master.pegawai.destroy', $pegawai->id) }}"
                                    method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button type="button"
                                        onclick="konfirmasiHapus({{ $pegawai->id }}, '{{ $pegawai->name }}')"
                                        class="w-10 h-10 rounded-xl bg-red-100 text-red-600 hover:bg-red-200 transition flex items-center justify-center"
                                        title="Hapus Pegawai">

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

                                    <i class="fas fa-users-slash text-3xl text-slate-400"></i>

                                </div>

                                <h3 class="font-semibold text-slate-700">
                                    Belum Ada Data Pegawai
                                </h3>

                                <p class="text-sm text-slate-500 mt-2">
                                    Tambahkan akun pegawai untuk mulai mengelola operasional cabang.
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

function konfirmasiHapus(id, namaPegawai) {

    Swal.fire({
        title: 'Hapus Pegawai?',
        text: 'Apakah Anda yakin ingin menghapus akun ' + namaPegawai + ' ?',
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