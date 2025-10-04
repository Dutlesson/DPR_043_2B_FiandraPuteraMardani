<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ubah Komponen Gaji') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('komponen-gaji.update', $komponenGaji->id_komponen_gaji) }}" method="POST">
                        @csrf
                        @method('PUT')
                        {{-- (Isi form sama persis dengan create.blade.php, namun value-nya diisi data) --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="nama_komponen">Nama Komponen</label>
                                <input type="text" name="nama_komponen" id="nama_komponen" class="mt-1 block w-full rounded-md" value="{{ old('nama_komponen', $komponenGaji->nama_komponen) }}" required>
                            </div>
                            <div>
                                <label for="kategori">Kategori</label>
                                <select name="kategori" id="kategori" class="mt-1 block w-full rounded-md" required>
                                    <option value="Gaji Pokok" {{ $komponenGaji->kategori == 'Gaji Pokok' ? 'selected' : '' }}>Gaji Pokok</option>
                                    <option value="Tunjangan Melekat" {{ $komponenGaji->kategori == 'Tunjangan Melekat' ? 'selected' : '' }}>Tunjangan Melekat</option>
                                    <option value="Tunjangan Lain" {{ $komponenGaji->kategori == 'Tunjangan Lain' ? 'selected' : '' }}>Tunjangan Lain</option>
                                </select>
                            </div>
                            <div>
                                <label for="jabatan">Jabatan</label>
                                <select name="jabatan" id="jabatan" class="mt-1 block w-full rounded-md" required>
                                    <option value="Semua" {{ $komponenGaji->jabatan == 'Semua' ? 'selected' : '' }}>Semua</option>
                                    <option value="Ketua" {{ $komponenGaji->jabatan == 'Ketua' ? 'selected' : '' }}>Ketua</option>
                                    <option value="Wakil Ketua" {{ $komponenGaji->jabatan == 'Wakil Ketua' ? 'selected' : '' }}>Wakil Ketua</option>
                                    <option value="Anggota" {{ $komponenGaji->jabatan == 'Anggota' ? 'selected' : '' }}>Anggota</option>
                                </select>
                            </div>
                            <div>
                                <label for="satuan">Satuan</label>
                                <select name="satuan" id="satuan" class="mt-1 block w-full rounded-md" required>
                                    <option value="Bulan" {{ $komponenGaji->satuan == 'Bulan' ? 'selected' : '' }}>Bulan</option>
                                    <option value="Hari" {{ $komponenGaji->satuan == 'Hari' ? 'selected' : '' }}>Hari</option>
                                    <option value="Periode" {{ $komponenGaji->satuan == 'Periode' ? 'selected' : '' }}>Periode</option>
                                </select>
                            </div>
                            <div class="md:col-span-2">
                                <label for="nominal">Nominal (Rp)</label>
                                <input type="number" name="nominal" id="nominal" class="mt-1 block w-full rounded-md" value="{{ old('nominal', $komponenGaji->nominal) }}" required step="0.01" min="0">
                            </div>
                        </div>
                        <div class="mt-6">
                            <button type="submit" class="px-4 py-2 bg-gray-800 text-white rounded-md">Perbarui</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>