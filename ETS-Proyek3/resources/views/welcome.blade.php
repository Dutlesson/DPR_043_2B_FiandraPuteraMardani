<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transparansi Gaji DPR</title>
    <style>
        /* CSS Sederhana Tanpa Tailwind */
        body {
            background-color: #f7fafc; /* Warna abu-abu muda */
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            color: #4a5568; /* Warna teks abu-abu tua */
        }
        .container {
            text-align: center;
            padding: 2rem;
        }
        h1 {
            font-size: 2.25rem; /* 36px */
            font-weight: bold;
            color: #2d3748; /* Warna teks lebih gelap */
            margin-bottom: 1rem;
        }
        p {
            font-size: 1.125rem; /* 18px */
            margin-bottom: 2rem;
        }
        .button-group a {
            display: inline-block;
            text-decoration: none;
            color: white;
            font-weight: bold;
            padding: 0.75rem 1.5rem; /* 12px 24px */
            border-radius: 0.5rem; /* 8px */
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            transition: background-color 0.3s, transform 0.2s;
            margin: 0 0.5rem;
        }
        .button-group a:hover {
            transform: translateY(-2px); /* Efek tombol terangkat saat di-hover */
        }
        .login-button {
            background-color: #4f46e5; /* Warna indigo */
        }
        .login-button:hover {
            background-color: #4338ca; /* Warna indigo lebih gelap */
        }
        .register-button {
            background-color: #4b5563; /* Warna abu-abu */
        }
        .register-button:hover {
            background-color: #374151; /* Warna abu-abu lebih gelap */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Website Transparansi Penghasilan Anggota DPR</h1>
        <p>Silakan login atau register untuk melanjutkan.</p>

        <div class="button-group">
            @auth
                {{-- Jika pengguna sudah login --}}
                <a href="{{ url('/redirect') }}" class="login-button">Masuk ke Dashboard</a>
            @else
                {{-- Jika belum login --}}
                <a href="{{ route('login') }}" class="login-button">Login</a>
                
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="register-button">Register</a>
                @endif
            @endauth
        </div>
    </div>
</body>
</html>