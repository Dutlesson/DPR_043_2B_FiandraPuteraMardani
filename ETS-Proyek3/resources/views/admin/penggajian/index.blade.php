<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Penggajian Anggota') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    
                    <a href="{{ route('penggajian.create') }}" class="inline-block mb-4 px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700">
                        + Tambah Data Penggajian
                    </a>

                    <form action="{{ route('penggajian.index') }}" method="GET" class="mb-4">
                        <input type="text" name="search" placeholder="Cari berdasarkan Nama, Jabatan, atau THP..."
                               class="w-full md:w-1/3 px-3 py-2 border rounded-md shadow-sm"
                               value="{{ request('search') }}">
                        <button type="submit" class="px-4 py-2 bg-gray-800 text-white font-semibold rounded-lg shadow-md hover:bg-gray-700">Cari</button>
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
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Lengkap</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jabatan</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Take Home Pay (Bulanan)</th>
                                    <th class="relative px-6 py-3"><span class="sr-only">Aksi</span></th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($anggotaList as $anggota)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $anggota->gelar_depan }} {{ $anggota->nama_depan }} {{ $anggota->nama_belakang }} {{ $anggota->gelar_belakang }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $anggota->jabatan }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap font-bold">Rp {{ number_format($anggota->take_home_pay, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            {{-- Tombol Edit --}}
                                            <a href="{{ route('penggajian.edit', $anggota->id_anggota) }}" class="text-green-600 hover:text-green-900">Edit</a>
                                            {{-- Tombol Detail --}}
                                            <a href="{{ route('penggajian.show', $anggota->id_anggota) }}" class="text-blue-600 hover:text-blue-900">Detail</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">
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