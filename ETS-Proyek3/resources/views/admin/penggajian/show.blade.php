<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Penggajian: {{ $anggota->nama_depan }} {{ $anggota->nama_belakang }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            {{-- Tombol Kembali --}}
            <div class="mb-4">
                <a href="{{ route('penggajian.index') }}" class="text-sm text-gray-700 hover:underline">&larr; Kembali ke Daftar Penggajian</a>
            </div>

            {{-- Informasi Anggota & Take Home Pay --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">Ringkasan</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-600">Jabatan</p>
                            <p class="font-medium">{{ $anggota->jabatan }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Status Keluarga</p>
                            <p class="font-medium">{{ $anggota->status_pernikahan }} ({{ $anggota->jumlah_anak }} anak)</p>
                        </div>
                    </div>
                    <div class="mt-6 pt-4 border-t">
                        <p class="text-sm text-gray-600">Total Take Home Pay (Per Bulan)</p>
                        <p class="text-3xl font-bold text-green-600">
                            Rp {{ number_format($take_home_pay, 0, ',', '.') }}
                        </p>
                    </div>
                </div>
            </div>

            {{-- Rincian Komponen Gaji --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Rincian Komponen Gaji</h3>
                    <div class="space-y-3">
                        @forelse ($anggota->allKomponenGaji as $komponen)
                        <div class="flex justify-between items-center p-3 bg-gray-50 rounded-md">
                            <div>
                                <p class="font-medium text-gray-800">{{ $komponen->nama_komponen }}</p>
                                <p class="text-sm text-gray-500">{{ $komponen->kategori }} - ({{ $komponen->satuan }})</p>
                            </div>
                            <div class="font-semibold text-gray-800">
                                Rp {{ number_format($komponen->nominal, 0, ',', '.') }}
                            </div>
                        </div>
                        @empty
                        <p class="text-center py-4 text-gray-500">Belum ada komponen gaji yang ditambahkan untuk anggota ini.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>