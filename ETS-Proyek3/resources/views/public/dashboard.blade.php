<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-bold">Selamat Datang, {{ Auth::user()->nama_depan }}!</h1>
                    <p class="mt-2">Ini adalah halaman publik untuk melihat transparansi gaji anggota DPR.</p>
           
                    <div class="mt-6">
                        <a href="{{ route('public.anggota.index') }}" class="inline-block px-4 py-2 bg-gray-600 text-white font-semibold rounded-lg shadow-md hover:bg-gray-700">
                            Lihat Daftar Anggota DPR
                        </a>
                        <a href="{{ route('public.penggajian.index') }}" class="inline-block px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700">
                            Lihat Data Penggajian
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>