<x-app-layout>
    <div class="space-y-6">

        <!-- Header -->
        <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 flex items-center gap-2">
                    <i class="fas fa-user-circle text-blue-500"></i>
                    Profil & Pengaturan Akun
                </h1>
                <p class="text-sm text-gray-500 mt-1">
                    Kelola informasi akun dan keamanan sistem Anda.
                </p>
            </div>
        </div>

        <!-- Informasi Akun -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
            <div class="flex flex-col md:flex-row md:items-center gap-5">

                <div class="w-16 h-16 rounded-full bg-blue-100 flex items-center justify-center">
                    <i class="fas fa-user text-blue-600 text-2xl"></i>
                </div>

                <div class="flex-1">
                    <h2 class="text-lg font-bold text-gray-900">
                        {{ auth()->user()->name }}
                    </h2>

                    <p class="text-sm text-gray-500">
                        {{ auth()->user()->email }}
                    </p>

                    <div class="mt-3 flex flex-wrap gap-2">

                        @if(auth()->user()->role === 'owner')
                            <span class="bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-xs font-bold uppercase">
                                Owner
                            </span>
                        @elseif(auth()->user()->role === 'manager')
                            <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-bold uppercase">
                                Manager
                            </span>
                        @elseif(auth()->user()->role === 'supervisor')
                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-bold uppercase">
                                Supervisor
                            </span>
                        @elseif(auth()->user()->role === 'kasir')
                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold uppercase">
                                Kasir
                            </span>
                        @elseif(auth()->user()->role === 'gudang')
                            <span class="bg-orange-100 text-orange-700 px-3 py-1 rounded-full text-xs font-bold uppercase">
                                Gudang
                            </span>
                        @endif

                        @if(auth()->user()->cabang)
                            <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-xs font-bold">
                                {{ auth()->user()->cabang->nama }}
                            </span>
                        @else
                            <span class="bg-indigo-100 text-indigo-700 px-3 py-1 rounded-full text-xs font-bold">
                                PUSAT
                            </span>
                        @endif

                    </div>
                </div>
            </div>
        </div>

        <!-- Form Update Profil -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        @if(in_array(auth()->user()->role, ['owner', 'manager']))

            <!-- Form Password -->
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Riwayat Password -->
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <h2 class="text-lg font-bold text-gray-900 flex items-center gap-2 mb-4">
                    <i class="fas fa-history text-blue-500"></i>
                    Riwayat Perubahan Password
                </h2>

                @php
                    $histories = \App\Models\RiwayatPassword::where('user_id', auth()->id())
                        ->latest()
                        ->get();
                @endphp

                @if($histories->count() > 0)

                    <div class="space-y-3">

                        @foreach($histories as $history)

                            <div class="flex items-center gap-4 p-4 rounded-lg border border-gray-200 bg-gray-50">
                                <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center">
                                    <i class="fas fa-key text-blue-600"></i>
                                </div>

                                <div>
                                    <p class="font-semibold text-gray-900">
                                        Password berhasil diperbarui
                                    </p>

                                    <p class="text-xs text-gray-500">
                                        {{ $history->created_at->format('d M Y - H:i:s') }} WIB
                                    </p>
                                </div>
                            </div>

                        @endforeach

                    </div>

                @else

                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 text-center text-sm text-gray-500">
                        Belum ada riwayat perubahan password.
                    </div>

                @endif
            </div>

            <!-- Hapus Akun -->
            <div class="bg-red-50 p-6 rounded-xl border border-red-100">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        @else

            <!-- Informasi Hak Akses -->
            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-5 rounded-r-xl shadow-sm">
                <div class="flex items-start gap-3">
                    <i class="fas fa-shield-alt text-yellow-600 mt-1"></i>

                    <div>
                        <h3 class="font-bold text-yellow-800">
                            Akses Keamanan Dibatasi
                        </h3>

                        <p class="text-sm text-yellow-700 mt-1">
                            Untuk menjaga keamanan sistem, fitur perubahan password dan penghapusan akun tidak tersedia untuk peran Anda.
                        </p>

                        <p class="text-sm text-yellow-600 mt-2">
                            Jika Anda ingin mengganti password atau mengalami kendala saat login,
                            silakan hubungi Manager atau Owner.
                        </p>
                    </div>
                </div>
            </div>

        @endif

    </div>
</x-app-layout>