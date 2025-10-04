<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Ubah Komponen Gaji untuk: {{ $anggota->nama_depan }} {{ $anggota->nama_belakang }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form action="{{ route('penggajian.update', $anggota->id_anggota) }}" method="POST">
                    @csrf
                    @method('PUT')

                    @if ($errors->any())
                        <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg" role="alert">
                            <span class="font-bold">Terjadi kesalahan validasi:</span>
                            <ul class="mt-2 list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h3 class="text-lg font-semibold mb-4">Pilih Komponen Gaji yang Berlaku</h3>
                        <p class="text-sm text-gray-600 mb-4">Centang komponen gaji yang ingin Anda berikan kepada anggota ini. Hilangkan centang untuk menghapus komponen.</p>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            @foreach ($semuaKomponen as $komponen)
                                <label class="flex items-center p-3 border rounded-md hover:bg-gray-50 cursor-pointer">
                                    <input type="checkbox" 
                                           name="komponen_ids[]" 
                                           value="{{ $komponen->id_komponen_gaji }}"
                                           class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                           @if(in_array($komponen->id_komponen_gaji, $komponenDimiliki)) checked @endif
                                    >
                                    <span class="ml-2 text-sm text-gray-700">{{ $komponen->nama_komponen }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="p-6 bg-gray-50 flex justify-end items-center">
                        <a href="{{ route('penggajian.index') }}" class="text-sm text-gray-600 mr-4">Batal</a>
                        <button type="submit" class="px-4 py-2 bg-gray-800 text-white rounded-md font-semibold text-sm hover:bg-gray-700">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>