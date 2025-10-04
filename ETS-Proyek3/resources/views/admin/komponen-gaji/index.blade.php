<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Komponen Gaji') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    
                    <a href="{{ route('komponen-gaji.create') }}" class="inline-block mb-4 px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700">
                        + Tambah Komponen Gaji
                    </a>

                    <form action="{{ route('komponen-gaji.index') }}" method="GET" class="mb-4">
                        <div class="flex items-center">
                            <input type="text" name="search" placeholder="Cari komponen gaji..."
                                   class="w-full md:w-1/3 px-3 py-2 border border-gray-300 rounded-md shadow-sm"
                                   value="{{ request('search') }}">
                            <button type="submit" class="ml-2 px-4 py-2 bg-gray-800 text-white font-semibold rounded-lg shadow-md hover:bg-gray-700">
                                Cari
                            </button>
                        </div>
                    </form>

                    @if (session('success'))
                        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Komponen</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kategori</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jabatan</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nominal</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Satuan</th>
                                    <th class="relative px-6 py-3"><span class="sr-only">Aksi</span></th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($komponenGaji as $komponen)
                                    <tr>
                                        <td class="px-6 py-4">{{ $komponen->id_komponen_gaji }}</td>
                                        <td class="px-6 py-4">{{ $komponen->nama_komponen }}</td>
                                        <td class="px-6 py-4">{{ $komponen->kategori }}</td>
                                        <td class="px-6 py-4">{{ $komponen->jabatan }}</td>
                                        <td class="px-6 py-4">Rp {{ number_format($komponen->nominal, 2, ',', '.') }}</td>
                                        <td class="px-6 py-4">{{ $komponen->satuan }}</td>
                                        <td class="px-6 py-4 text-right text-sm font-medium">
                                            {{-- Akan diisi di langkah selanjutnya --}}
                                            <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                            <a href="#" class="text-red-600 hover:text-red-900 ml-4">Hapus</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                            Data tidak ditemukan.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>