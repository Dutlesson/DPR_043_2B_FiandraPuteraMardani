<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-bold">Selamat Datang, {{ Auth::user()->nama_depan }}!</h1>
                    <p class="mt-2">Ini adalah dashboard untuk role Admin.</p>
                    
                    {{-- Tombol Navigasi Utama Admin --}}
                    <div class="mt-6">
                        <a href="{{ route('anggota.index') }}" class="inline-block px-4 py-2 bg-gray-600 text-white font-semibold rounded-lg shadow-md hover:bg-gray-700">
                            Kelola Anggota DPR
                        </a>
                        
                        {{-- INI TOMBOL YANG DITAMBAHKAN --}}
                        <a href="{{ route('komponen-gaji.index') }}" class="inline-block px-4 py-2 bg-green-600 text-white font-semibold rounded-lg shadow-md hover:bg-green-700">
                            Kelola Komponen Gaji
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>