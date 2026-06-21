<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Jayusman Mart</title>

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Font Awesome -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gradient-to-br from-slate-900 via-slate-800 to-indigo-900">

    <div class="min-h-screen flex items-center justify-center px-4">

        <div class="w-full max-w-md">

            <!-- Logo & Judul -->
            <div class="text-center mb-6">

                <div class="w-20 h-20 mx-auto rounded-2xl bg-white/10 backdrop-blur flex items-center justify-center shadow-lg border border-white/20">
                    <i class="fas fa-store text-3xl text-white"></i>
                </div>

                <h1 class="mt-4 text-3xl font-bold text-white">
                    Jayusman Mart
                </h1>

                <p class="text-slate-300 text-sm mt-1">
                    Sistem Manajemen Toko & Cabang
                </p>

            </div>

            <!-- Card Login -->
            <div class="bg-white rounded-2xl shadow-2xl border border-gray-100 overflow-hidden">

                <!-- Header Card -->
                <div class="bg-indigo-600 px-6 py-5 text-white">
                    <h2 class="font-bold text-lg flex items-center gap-2">
                        <i class="fas fa-lock"></i>
                        Login Sistem
                    </h2>

                    <p class="text-indigo-100 text-sm mt-1">
                        Silakan masuk menggunakan akun Anda.
                    </p>
                </div>

                <!-- Form -->
                <div class="p-6">
                    {{ $slot }}
                </div>

            </div>

            <!-- Footer -->
            <div class="mt-6 text-center text-xs text-slate-300">
                © {{ date('Y') }} Jayusman Mart
                <br>
                Retail Management System
            </div>

        </div>

    </div>

</body>
</html>