<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transparansi Gaji DPR</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans">
    <div class="flex flex-col items-center justify-center min-h-screen">
        <h1 class="text-4xl font-bold text-gray-800 mb-4">
            Website Transparansi Penghasilan Anggota DPR
        </h1>
        <p class="text-lg text-gray-600 mb-8">
            Silakan login untuk melanjutkan.
        </p>

        <div class="space-x-4">
            @auth
                <a href="{{ url('/redirect') }}" class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 transition">
                    Masuk ke Dashboard
                </a>
            @else
                <a href="{{ route('login') }}" class="px-6 py-3 bg-indigo-600 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700 transition">
                    Login
                </a>
                
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="px-6 py-3 bg-gray-600 text-white font-semibold rounded-lg shadow-md hover:bg-gray-700 transition">
                        Register
                    </a>
                @endif
            @endauth
        </div>
    </div>
</body>
</html>