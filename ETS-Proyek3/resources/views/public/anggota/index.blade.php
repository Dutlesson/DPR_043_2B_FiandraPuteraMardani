<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Data Anggota DPR') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    
                    <p class="mb-4 text-gray-600">Berikut adalah daftar anggota DPR. Informasi ini bersifat read-only.</p>
                    
                    <form action="{{ route('public.anggota.index') }}" method="GET" class="mb-4">
                        <div class="flex items-center">
                            <input type="text" name="search" placeholder="Cari berdasarkan ID, Nama, atau Jabatan..."
                                   class="w-full md:w-1/3 px-3 py-2 border border-gray-300 rounded-md shadow-sm"
                                   value="{{ request('search') }}">
                            <button type="submit" class="ml-2 px-4 py-2 bg-gray-800 text-white font-semibold rounded-lg shadow-md hover:bg-gray-700">
                                Cari
                            </button>
                        </div>
                    </form>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Lengkap</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jabatan</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status Pernikahan</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah Anak</th>
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
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                            Data anggota tidak ditemukan.
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