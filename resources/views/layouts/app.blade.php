<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jayusman Mart</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
        
        /* Custom scrollbar tipis */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    </style>
</head>
<body class="bg-slate-100 min-h-screen">

<div class="flex h-screen overflow-hidden">

    {{-- Sidebar --}}
    <aside id="sidebar" class="w-72 bg-slate-900 text-white flex flex-col">

        <div>
    <div class="h-20 flex items-center px-6 border-b border-slate-800">
        <div>
            <h1 class="text-xl font-bold">Jayusman Mart</h1>
            <p class="text-xs text-slate-400">
                Retail Management System
            </p>
        </div>
    </div>

    <div class="px-4 py-4 border-b border-slate-800">
        <div class="bg-slate-800 rounded-xl p-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-indigo-500 flex items-center justify-center">
                    <i class="fas fa-user text-white"></i>
                </div>

                <div>
                    <p class="font-semibold text-sm">
                        {{ auth()->user()->name }}
                    </p>

                    <p class="text-xs text-slate-400 uppercase">
                        {{ auth()->user()->role }}
                    </p>

                    @if(auth()->user()->cabang)
                        <p class="text-xs text-indigo-300 mt-1">
                            <i class="fas fa-store"></i>
                            {{ auth()->user()->cabang->nama }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="mt-3 flex items-center gap-2 text-green-400 text-xs">
                <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                Sistem Online
            </div>
        </div>
    </div>
</div>

        <nav class="flex-1 overflow-y-auto px-4 py-6">

            <div class="mb-6">
                <p class="text-xs uppercase text-slate-500 mb-3">
                    Main Menu
                </p>

                <a href="{{ route('dashboard') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl bg-indigo-600 text-white">
                    <i class="fas fa-chart-line"></i>
                    Dashboard
                </a>
                @if(auth()->check() && in_array(auth()->user()->role, ['owner', 'manager']))
                <div class="px-3 py-3 mt-2 text-[10px] font-bold text-gray-400 uppercase tracking-wider">Master Data</div>
                
                <a href="{{ route('master.barang') }}" class="flex items-center gap-3 px-3 py-2.5 text-gray-600 hover:bg-gray-50 rounded-lg text-sm transition">
                    <i class="fas fa-box w-5 text-center"></i> 
                    <span>Kelola Data Barang</span>
                </a>
                
               <a href="{{ route('master.pegawai') }}" class="flex items-center gap-3 px-3 py-2.5 text-gray-600 hover:bg-gray-50 rounded-lg text-sm transition">
                    <i class="fas fa-users-cog w-5 text-center"></i> 
                    <span>Kelola Akun Pegawai</span>
                </a>
            @endif
            @if(auth()->check() && auth()->user()->role === 'owner')
                <div class="px-3 py-3 mt-2 text-[10px] font-bold text-gray-400 uppercase tracking-wider">Akses Pemilik</div>
                
                <a href="{{ route('owner.cabang') }}" class="flex items-center gap-3 px-3 py-2.5 text-gray-600 hover:bg-gray-50 rounded-lg text-sm transition">
                    <i class="fas fa-building w-5 text-center"></i> 
                    <span>Kelola Semua Cabang</span>
                </a>
                <a href="{{ route('owner.stok') }}" class="flex items-center gap-3 px-3 py-2.5 text-gray-600 hover:bg-gray-50 rounded-lg text-sm transition">
                    <i class="fas fa-boxes w-5 text-center"></i> 
                    <span>Pantau Semua Stok</span>
                </a>
                <a href="{{ route('owner.transaksi') }}" class="flex items-center gap-3 px-3 py-2.5 text-gray-600 hover:bg-gray-50 rounded-lg text-sm transition">
                    <i class="fas fa-receipt w-5 text-center"></i> 
                    <span>Pantau Semua Transaksi</span>
                </a>
                <a href="{{ route('owner.laporan') }}" class="flex items-center gap-3 px-3 py-2.5 text-gray-600 hover:bg-gray-50 rounded-lg text-sm transition">
                    <i class="fas fa-chart-pie w-5 text-center"></i> 
                    <span>Laporan Gabungan</span>
                </a>
            @endif

            @if(auth()->check() && auth()->user()->role === 'manager')
                <div class="px-3 py-3 mt-2 text-[10px] font-bold text-gray-400 uppercase tracking-wider">Akses Manajer</div>

                <a href="{{ route('manager.stok') }}" class="flex items-center gap-3 px-3 py-2.5 text-gray-600 hover:bg-gray-50 rounded-lg text-sm transition">
                    <i class="fas fa-box-open w-5 text-center"></i> 
                    <span>Lihat Stok Toko</span>
                </a>
                <a href="{{ route('supervisi.transaksi') }}" class="flex items-center gap-3 px-3 py-2.5 text-gray-600 hover:bg-gray-50 rounded-lg text-sm transition">
                    <i class="fas fa-shopping-cart w-5 text-center"></i> 
                    <span>Lihat Transaksi Toko</span>
                </a>
                <a href="{{ route('laporan.manager') }}" class="flex items-center gap-3 px-3 py-2.5 text-gray-600 hover:bg-gray-50 rounded-lg text-sm transition">
                    <i class="fas fa-calendar-alt w-5 text-center"></i> 
                    <span>Cetak Laporan</span>
                </a>
            @endif

            @if(auth()->check() && auth()->user()->role === 'supervisor')
                <div class="px-3 py-3 mt-2 text-[10px] font-bold text-gray-400 uppercase tracking-wider">Akses Supervisor</div>

                <a href="{{ route('supervisi.transaksi') }}" class="flex items-center gap-3 px-3 py-2.5 text-gray-600 hover:bg-gray-50 rounded-lg text-sm transition">
                    <i class="fas fa-eye w-5 text-center"></i> 
                    <span>Pantau Transaksi (Live)</span>
                </a>
            @endif

            @if(auth()->check() && auth()->user()->role === 'kasir')
                <div class="px-3 py-3 mt-2 text-[10px] font-bold text-gray-400 uppercase tracking-wider">Akses Kasir</div>

                <a href="{{ route('transaksi.create') }}" class="flex items-center gap-3 px-3 py-2.5 text-gray-600 hover:bg-gray-50 rounded-lg text-sm transition">
                    <i class="fas fa-desktop w-5 text-center"></i> 
                    <span>Input Penjualan</span>
                </a>
            @endif

            @if(auth()->check() && auth()->user()->role === 'gudang')
                <div class="px-3 py-3 mt-2 text-[10px] font-bold text-gray-400 uppercase tracking-wider">Akses Gudang</div>

                <a href="{{ route('stok.mutasi.create') }}" class="flex items-center gap-3 px-3 py-2.5 text-gray-600 hover:bg-gray-50 rounded-lg text-sm transition">
                    <i class="fas fa-truck-loading w-5 text-center"></i> 
                    <span>Barang Masuk / Keluar</span>
                </a>
                <a href="{{ route('stok.opname.index') }}" class="flex items-center gap-3 px-3 py-2.5 text-gray-600 hover:bg-gray-50 rounded-lg text-sm transition">
                    <i class="fas fa-clipboard-list w-5 text-center"></i> 
                    <span>Stok Opname</span>
                </a>
            @endif
            
            <div class="pt-4 mt-4 border-t border-gray-100"></div>

            <a href="{{ route('profile.edit') ?? '#' }}" class="flex items-center gap-3 px-3 py-2.5 text-gray-600 hover:bg-gray-50 rounded-lg text-sm transition">
                <i class="far fa-user w-5 text-center"></i> 
                <span>Profil Saya</span>
            </a>
            <form id="form-logout" method="POST" action="{{ route('logout') ?? '#' }}">
                @csrf
                <button type="button" onclick="konfirmasiLogout()" class="flex items-center gap-3 px-3 py-2.5 w-full text-red-500 hover:bg-red-50 rounded-lg text-sm font-medium transition text-left mt-2">
                    <i class="fas fa-sign-out-alt w-5 text-center"></i> 
                    <span>Logout</span>
                </button>
            </form>
            </div>

            {{-- Semua menu role dipindahkan ke sini --}}
            {{-- Gunakan menu lama Anda --}}
        </nav>

    </aside>

    {{-- Main Content --}}
    <div class="flex-1 flex flex-col overflow-hidden">

        {{-- Header --}}
        <header class="bg-white border-b border-slate-200 h-20 px-8 flex items-center justify-between shadow-sm">

            <div>
                <h2 class="text-xl font-bold text-slate-800">
                    Dashboard
                </h2>

                <p class="text-sm text-slate-500">
                    Monitoring transaksi dan stok barang
                </p>
            </div>

            <div class="flex items-center gap-6">

    <div class="hidden lg:block text-right">
        <p id="tanggal" class="text-xs text-slate-500"></p>
        <p id="jam" class="font-semibold text-slate-700"></p>
    </div>

    <div class="text-right">
        <p class="font-semibold text-slate-700">
            {{ auth()->user()->name }}
        </p>

        <p class="text-xs text-slate-500 uppercase">
            {{ auth()->user()->role }}
        </p>

        @if(auth()->user()->cabang)
            <p class="text-xs text-blue-500">
                {{ auth()->user()->cabang->nama }}
            </p>
        @endif
    </div>

    <div class="w-12 h-12 rounded-full bg-indigo-100 flex items-center justify-center">
        <i class="fas fa-user text-indigo-600"></i>
    </div>

</div>

        </header>

        {{-- Content --}}
        <main class="flex-1 overflow-y-auto p-8">

            <div class="max-w-7xl mx-auto">

                {{ $slot }}

            </div>

        </main>

    </div>

    <script>
function updateClock() {
    const now = new Date();

    const tanggal = now.toLocaleDateString('id-ID', {
        weekday: 'long',
        day: 'numeric',
        month: 'long',
        year: 'numeric'
    });

    const jam = now.toLocaleTimeString('id-ID');

    const elTanggal = document.getElementById('tanggal');
    const elJam = document.getElementById('jam');

    if (elTanggal) elTanggal.innerHTML = tanggal;
    if (elJam) elJam.innerHTML = jam;
}

setInterval(updateClock, 1000);
updateClock();
</script>

</div>

</body>
</html>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
         // Script Konfirmasi Logout dengan SweetAlert
        function konfirmasiLogout() {
            Swal.fire({
                title: 'Apakah Anda yakin ingin keluar?',
                text: "Anda akan diarahkan kembali ke halaman login.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Keluar',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('form-logout').submit();
                }
            });
        }
    </script>