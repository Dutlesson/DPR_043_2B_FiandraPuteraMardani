<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Penggajian Anggota DPR') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    
                    <form action="{{ route('public.penggajian.index') }}" method="GET" class="mb-4">
                        <input type="text" name="search" placeholder="Cari berdasarkan Nama atau Jabatan..."
                               class="w-full md:w-1/3 px-3 py-2 border rounded-md shadow-sm"
                               value="{{ request('search') }}">
                        <button type="submit" class="ml-2 px-4 py-2 bg-gray-800 text-white font-semibold rounded-lg">Cari</button>
                    </form>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Lengkap</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jabatan</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Take Home Pay (Per Bulan)</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($penggajian as $item)
                                    <tr>
                                        <td class="px-6 py-4">{{ $item->gelar_depan }} {{ $item->nama_depan }} {{ $item->nama_belakang }} {{ $item->gelar_belakang }}</td>
                                        <td class="px-6 py-4">{{ $item->jabatan }}</td>
                                        <td class="px-6 py-4 font-semibold">Rp {{ number_format($item->take_home_pay, 0, ',', '.') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-6 py-4 text-center text-gray-500">Data tidak ditemukan.</td>
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