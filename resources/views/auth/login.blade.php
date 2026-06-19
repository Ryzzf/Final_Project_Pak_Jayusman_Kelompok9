<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Jayusman Mart</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        body{
            font-family: Inter, sans-serif;
        }
    </style>
</head>

<body class="bg-slate-100">

<div class="min-h-screen flex">

    <!-- LEFT SIDE -->
    <div class="hidden lg:flex lg:w-1/2 bg-slate-900 text-white relative">

        <div class="absolute inset-0 bg-gradient-to-br from-slate-900 via-slate-800 to-indigo-900"></div>

        <div class="relative z-10 flex flex-col justify-center px-16">

            <div class="mb-8">

                <div class="w-20 h-20 rounded-3xl bg-white/10 flex items-center justify-center mb-6">
                    <i class="fas fa-store text-4xl"></i>
                </div>

                <h1 class="text-5xl font-bold mb-4">
                    Jayusman Mart
                </h1>

                <p class="text-slate-300 text-lg leading-relaxed">
                    Sistem Monitoring Transaksi dan Stok Barang
                    untuk seluruh cabang toko dalam satu platform.
                </p>

            </div>

            <div class="grid grid-cols-2 gap-4 mt-8">

                <div class="bg-white/5 rounded-2xl p-5 backdrop-blur">
                    <i class="fas fa-chart-line text-2xl mb-3"></i>
                    <h3 class="font-semibold">Monitoring</h3>
                    <p class="text-sm text-slate-400">
                        Pantau seluruh transaksi secara realtime.
                    </p>
                </div>

                <div class="bg-white/5 rounded-2xl p-5 backdrop-blur">
                    <i class="fas fa-boxes-stacked text-2xl mb-3"></i>
                    <h3 class="font-semibold">Stok Barang</h3>
                    <p class="text-sm text-slate-400">
                        Kelola persediaan dengan mudah.
                    </p>
                </div>

            </div>

        </div>

    </div>

    <!-- RIGHT SIDE -->
    <div class="w-full lg:w-1/2 flex items-center justify-center p-8">

        <div class="w-full max-w-md">

            <div class="mb-8 text-center lg:text-left">

                <h2 class="text-3xl font-bold text-slate-800">
                    Selamat Datang
                </h2>

                <p class="text-slate-500 mt-2">
                    Silakan login untuk mengakses sistem.
                </p>

            </div>

            @if ($errors->any())
                <div class="mb-5 rounded-xl bg-red-50 border border-red-200 p-4">
                    <ul class="text-sm text-red-600">
                        @foreach ($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white rounded-3xl shadow-xl border border-slate-200 p-8">

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Email
                        </label>

                        <div class="relative">

                            <span class="absolute left-4 top-3.5 text-slate-400">
                                <i class="fas fa-envelope"></i>
                            </span>

                            <input
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autofocus
                                class="w-full pl-11 pr-4 py-3 rounded-xl border border-slate-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 outline-none">

                        </div>
                    </div>

                    <div>

                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Password
                        </label>

                        <div class="relative">

                            <span class="absolute left-4 top-3.5 text-slate-400">
                                <i class="fas fa-lock"></i>
                            </span>

                            <input
                                type="password"
                                id="password"
                                name="password"
                                required
                                class="w-full pl-11 pr-12 py-3 rounded-xl border border-slate-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 outline-none">

                            <button
                                type="button"
                                onclick="togglePassword()"
                                class="absolute right-4 top-3 text-slate-500">

                                <i class="fas fa-eye" id="toggleIcon"></i>

                            </button>

                        </div>

                    </div>

                    <div class="flex items-center justify-between">

                        <label class="flex items-center text-sm">

                            <input
                                type="checkbox"
                                name="remember"
                                class="rounded border-slate-300 text-indigo-600">

                            <span class="ml-2 text-slate-600">
                                Ingat Saya
                            </span>

                        </label>

                    </div>

                    <button
                        type="submit"
                        class="w-full bg-slate-900 hover:bg-slate-800 text-white py-3 rounded-xl font-semibold transition">

                        Masuk ke Sistem

                    </button>

                </form>

            </div>

            <div class="text-center mt-6 text-sm text-slate-500">
                © 2026 Jayusman Mart • Retail Management System
            </div>

        </div>

    </div>

</div>

<script>
    function togglePassword() {

        const password = document.getElementById('password');
        const icon = document.getElementById('toggleIcon');

        if(password.type === 'password'){
            password.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        }else{
            password.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
</script>

</body>
</html>