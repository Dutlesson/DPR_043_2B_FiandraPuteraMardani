@extends('layouts.app') {{-- kalau kamu pakai layout breeze, bisa extend --}}
@section('content')
    <div class="p-6">
        <h1 class="text-2xl font-bold">Selamat Datang, Admin!</h1>
        <p class="mt-2">Ini adalah dashboard untuk role Admin.</p>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="mt-4 bg-red-500 text-white px-4 py-2 rounded">
                Logout
            </button>
        </form>
    </div>
@endsection
