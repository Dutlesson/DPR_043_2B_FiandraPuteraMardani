<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Komponen Gaji Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    
                    @if ($errors->any())
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                            <strong class="font-bold">Oops! Terjadi kesalahan.</strong>
                            <ul class="mt-2 list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('komponen-gaji.store') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="nama_komponen" class="block font-medium text-sm text-gray-700">Nama Komponen</label>
                                <input type="text" name="nama_komponen" id="nama_komponen" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="{{ old('nama_komponen') }}" required>
                            </div>

                            <div>
                                <label for="kategori" class="block font-medium text-sm text-gray-700">Kategori</label>
                                <select name="kategori" id="kategori" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                    <option value="Gaji Pokok">Gaji Pokok</option>
                                    <option value="Tunjangan Melekat">Tunjangan Melekat</option>
                                    <option value="Tunjangan Lain">Tunjangan Lain</option>
                                </select>
                            </div>

                            <div>
                                <label for="jabatan" class="block font-medium text-sm text-gray-700">Berlaku untuk Jabatan</label>
                                <select name="jabatan" id="jabatan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                    <option value="Semua">Semua</option>
                                    <option value="Ketua">Ketua</option>
                                    <option value="Wakil Ketua">Wakil Ketua</option>
                                    <option value="Anggota">Anggota</option>
                                </select>
                            </div>

                            <div>
                                <label for="satuan" class="block font-medium text-sm text-gray-700">Satuan</label>
                                <select name="satuan" id="satuan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                    <option value="Bulan">Bulan</option>
                                    <option value="Hari">Hari</option>
                                    <option value="Periode">Periode</option>
                                </select>
                            </div>

                            <div class="md:col-span-2">
                                <label for="nominal" class="block font-medium text-sm text-gray-700">Nominal (Rp)</label>
                                <input type="number" name="nominal" id="nominal" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="{{ old('nominal') }}" required step="0.01" min="0">
                            </div>
                        </div>

                        <div class="mt-6">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                                Simpan Komponen Gaji
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>