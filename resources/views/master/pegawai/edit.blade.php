<x-app-layout>

<div class="space-y-6">

    <!-- HEADER -->
    <div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-6">

        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">

            <div>

                <span class="inline-flex items-center px-3 py-1 rounded-full bg-slate-100 text-slate-600 text-xs font-medium mb-3">
                    Manajemen Pengguna
                </span>

                <h1 class="text-3xl font-bold text-slate-800">
                    Edit Pegawai
                </h1>

                <p class="text-slate-500 mt-2">
                    Perbarui informasi akun untuk
                    <span class="font-semibold text-slate-700">
                        {{ $pegawai->name }}
                    </span>
                </p>

            </div>

            <a href="{{ route('master.pegawai') }}"
                class="inline-flex items-center gap-2 px-5 py-3 rounded-2xl border border-slate-300 bg-white text-slate-700 hover:bg-slate-100 transition">

                <i class="fas fa-arrow-left"></i>
                Kembali

            </a>

        </div>

    </div>

    <!-- INFO CARD -->
    <div class="bg-gradient-to-r from-slate-900 via-slate-800 to-indigo-900 rounded-3xl p-6 text-white">

        <div class="flex items-center gap-4">

            <div class="w-16 h-16 rounded-2xl bg-white/10 flex items-center justify-center">

                <i class="fas fa-user-edit text-2xl"></i>

            </div>

            <div>

                <p class="text-slate-300 text-sm">
                    Update Data Pegawai
                </p>

                <h2 class="text-2xl font-bold">
                    {{ $pegawai->name }}
                </h2>

                <p class="text-slate-300 text-sm mt-1">
                    Ubah data akun, role, cabang, atau password pegawai.
                </p>

            </div>

        </div>

    </div>

    <!-- FORM -->
    <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden max-w-5xl">

        <div class="px-6 py-5 border-b border-slate-100">

            <h3 class="font-semibold text-slate-800">
                Informasi Pegawai
            </h3>

            <p class="text-sm text-slate-500 mt-1">
                Pastikan data yang dimasukkan sudah benar sebelum menyimpan perubahan.
            </p>

        </div>

        <form action="{{ route('master.pegawai.update', $pegawai->id) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="p-6 space-y-6">

                <!-- NAMA -->
                <div>

                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Nama Lengkap
                        <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name', $pegawai->name) }}"
                        required
                        class="w-full rounded-2xl border border-slate-300 px-4 py-3 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 outline-none">

                    @error('name')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror

                </div>

                <!-- EMAIL -->
                <div>

                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Email
                        <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email', $pegawai->email) }}"
                        required
                        class="w-full rounded-2xl border border-slate-300 px-4 py-3 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 outline-none">

                    @error('email')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror

                </div>

                <!-- ROLE -->
                <div>

                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Hak Akses (Role)
                        <span class="text-red-500">*</span>
                    </label>

                    <select
                        name="role"
                        required
                        class="w-full rounded-2xl border border-slate-300 px-4 py-3 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 outline-none">

                        @if(auth()->user()->role === 'owner')
                            <option value="owner"
                                {{ old('role', $pegawai->role) == 'owner' ? 'selected' : '' }}>
                                Owner (Pemilik)
                            </option>
                        @endif

                        <option value="manager"
                            {{ old('role', $pegawai->role) == 'manager' ? 'selected' : '' }}>
                            Manager
                        </option>

                        <option value="supervisor"
                            {{ old('role', $pegawai->role) == 'supervisor' ? 'selected' : '' }}>
                            Supervisor
                        </option>

                        <option value="kasir"
                            {{ old('role', $pegawai->role) == 'kasir' ? 'selected' : '' }}>
                            Kasir
                        </option>

                        <option value="gudang"
                            {{ old('role', $pegawai->role) == 'gudang' ? 'selected' : '' }}>
                            Gudang
                        </option>

                    </select>

                    @error('role')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror

                </div>

                <!-- CABANG -->
                <div>

                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Penempatan Cabang
                        <span class="text-red-500">*</span>
                    </label>

                    <select
                        name="cabang_id"
                        {{ auth()->user()->role !== 'owner' ? 'required' : '' }}
                        class="w-full rounded-2xl border border-slate-300 px-4 py-3 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 outline-none">

                        @if(auth()->user()->role === 'owner')

                            <option value="">
                                Pusat (Akses Semua Cabang)
                            </option>

                        @else

                            @if(!$pegawai->cabang_id)
                                <option value="" disabled selected>
                                    -- Pilih Cabang --
                                </option>
                            @endif

                        @endif

                        @foreach($cabangs as $cabang)

                            <option
                                value="{{ $cabang->id }}"
                                {{ old('cabang_id', $pegawai->cabang_id) == $cabang->id ? 'selected' : '' }}>

                                {{ $cabang->nama }} - {{ $cabang->kota }}

                            </option>

                        @endforeach

                    </select>

                    @if(auth()->user()->role === 'owner')

                        <p class="text-xs text-slate-500 mt-2">
                            Kosongkan jika akun ini merupakan Owner.
                        </p>

                    @else

                        <p class="text-xs text-orange-500 mt-2">
                            Pegawai wajib ditempatkan pada salah satu cabang.
                        </p>

                    @endif

                    @error('cabang_id')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror

                </div>

                <!-- RESET PASSWORD -->
                <div class="border-t border-slate-200 pt-6">

                    <div class="mb-5">

                        <h3 class="text-lg font-bold text-slate-800 flex items-center gap-2">

                            <i class="fas fa-key text-amber-500"></i>

                            Reset Password

                        </h3>

                        <p class="text-sm text-slate-500 mt-2">
                            Biarkan kosong jika tidak ingin mengganti password pegawai ini.
                        </p>

                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>

                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                Password Baru
                            </label>

                            <input
                                type="password"
                                name="password"
                                placeholder="Minimal 8 karakter"
                                class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 outline-none">

                            @error('password')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror

                        </div>

                        <div>

                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                Konfirmasi Password Baru
                            </label>

                            <input
                                type="password"
                                name="password_confirmation"
                                placeholder="Ketik ulang password baru"
                                class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 outline-none">

                        </div>

                    </div>

                </div>

            </div>

            <!-- FOOTER -->
            <div class="px-6 py-5 border-t border-slate-100 bg-slate-50">

                <div class="flex flex-col sm:flex-row gap-3">

                    <button
                        type="submit"
                        class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-2xl bg-slate-900 text-white hover:bg-slate-800 transition font-medium">

                        <i class="fas fa-save"></i>
                        Simpan Perubahan

                    </button>

                    <a href="{{ route('master.pegawai') }}"
                        class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-2xl border border-slate-300 bg-white text-slate-700 hover:bg-slate-100 transition">

                        <i class="fas fa-times"></i>
                        Batal

                    </a>

                </div>

            </div>

        </form>

    </div>

</div>

</x-app-layout>