<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Anggota DPR') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    
                    {{-- Tombol untuk menambah anggota baru --}}
                    <a href="{{ route('anggota.create') }}" class="inline-block mb-4 px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700">
                        + Tambah Anggota Baru
                    </a>
                        <form action="{{ route('anggota.index') }}" method="GET" class="mb-4">
                            <div class="flex items-center">
                                <input type="text" name="search" placeholder="Cari berdasarkan ID, Nama, atau Jabatan..."
                                    class="w-full md:w-1/3 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                    value="{{ request('search') }}">
                                <button type="submit" class="ml-2 px-4 py-2 bg-gray-800 text-white font-semibold rounded-lg shadow-md hover:bg-gray-700">
                                    Cari
                                </button>
                            </div>
                        </form>
                    {{-- Menampilkan pesan sukses jika ada --}}
                    @if (session('success'))
                        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Lengkap</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jabatan</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status Pernikahan</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah Anak</th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Aksi</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($anggota as $item)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $item->id_anggota }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $item->gelar_depan }} {{ $item->nama_depan }} {{ $item->nama_belakang }} {{ $item->gelar_belakang }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $item->jabatan }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $item->status_pernikahan }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $item->jumlah_anak }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            
                                            {{-- Nanti tombol Edit & Hapus akan ditaruh di sini --}}
                                             <a href="{{ route('anggota.edit', $item->id_anggota) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
    
                                            {{-- Form untuk Tombol Hapus --}}
                                            <form action="{{ route('anggota.destroy', $item->id_anggota) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 ml-4">
                                                    Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                            Belum ada data anggota.
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