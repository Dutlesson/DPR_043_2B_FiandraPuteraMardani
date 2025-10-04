<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ubah Data Anggota DPR') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    
                    @if ($errors->any())
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">Oops!</strong>
                            <span class="block sm:inline">Ada beberapa masalah dengan input Anda.</span>
                        </div>
                    @endif

                    <form action="{{ route('anggota.update', $anggota->id_anggota) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="nama_depan" class="block font-medium text-sm text-gray-700">Nama Depan</label>
                                <input type="text" name="nama_depan" id="nama_depan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="{{ old('nama_depan', $anggota->nama_depan) }}" required>
                            </div>

                            <div>
                                <label for="nama_belakang" class="block font-medium text-sm text-gray-700">Nama Belakang</label>
                                <input type="text" name="nama_belakang" id="nama_belakang" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="{{ old('nama_belakang', $anggota->nama_belakang) }}" required>
                            </div>

                            <div>
                                <label for="gelar_depan" class="block font-medium text-sm text-gray-700">Gelar Depan</label>
                                <input type="text" name="gelar_depan" id="gelar_depan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="{{ old('gelar_depan', $anggota->gelar_depan) }}">
                            </div>

                            <div>
                                <label for="gelar_belakang" class="block font-medium text-sm text-gray-700">Gelar Belakang</label>
                                <input type="text" name="gelar_belakang" id="gelar_belakang" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="{{ old('gelar_belakang', $anggota->gelar_belakang) }}">
                            </div>
                            
                            <div>
                                <label for="jabatan" class="block font-medium text-sm text-gray-700">Jabatan</label>
                                <select name="jabatan" id="jabatan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                    <option value="Ketua" {{ $anggota->jabatan == 'Ketua' ? 'selected' : '' }}>Ketua</option>
                                    <option value="Wakil Ketua" {{ $anggota->jabatan == 'Wakil Ketua' ? 'selected' : '' }}>Wakil Ketua</option>
                                    <option value="Anggota" {{ $anggota->jabatan == 'Anggota' ? 'selected' : '' }}>Anggota</option>
                                </select>
                            </div>

                            <div>
                                <label for="status_pernikahan" class="block font-medium text-sm text-gray-700">Status Pernikahan</label>
                                <select name="status_pernikahan" id="status_pernikahan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                    <option value="Kawin" {{ $anggota->status_pernikahan == 'Kawin' ? 'selected' : '' }}>Kawin</option>
                                    <option value="Belum Kawin" {{ $anggota->status_pernikahan == 'Belum Kawin' ? 'selected' : '' }}>Belum Kawin</option>
                                    <option value="Cerai Hidup" {{ $anggota->status_pernikahan == 'Cerai Hidup' ? 'selected' : '' }}>Cerai Hidup</option>
                                    <option value="Cerai Mati" {{ $anggota->status_pernikahan == 'Cerai Mati' ? 'selected' : '' }}>Cerai Mati</option>
                                </select>
                            </div>

                            <div>
                                <label for="jumlah_anak" class="block font-medium text-sm text-gray-700">Jumlah Anak</label>
                                <input type="number" name="jumlah_anak" id="jumlah_anak" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="{{ old('jumlah_anak', $anggota->jumlah_anak) }}" required min="0">
                            </div>
                        </div>

                        <div class="mt-6">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                                Perbarui Anggota
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>