<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Data Penggajian Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    
                    @if ($errors->any())
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('penggajian.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="id_anggota" class="block font-medium text-sm text-gray-700">Pilih Anggota</label>
                            <select name="id_anggota" id="id_anggota" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                <option value="">-- Pilih Anggota --</option>
                                @foreach ($anggota as $item)
                                    <option value="{{ $item->id_anggota }}">{{ $item->nama_depan }} {{ $item->nama_belakang }} ({{ $item->jabatan }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="id_komponen_gaji" class="block font-medium text-sm text-gray-700">Pilih Komponen Gaji</label>
                            <select name="id_komponen_gaji" id="id_komponen_gaji" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required disabled>
                                <option value="">-- Pilih Anggota Terlebih Dahulu --</option>
                            </select>
                        </div>

                        <div class="mt-6">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border rounded-md font-semibold text-xs text-white uppercase hover:bg-gray-700">
                                Tambahkan Komponen
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Script untuk AJAX --}}
    <script>
        document.getElementById('id_anggota').addEventListener('change', function() {
            const anggotaId = this.value;
            const komponenSelect = document.getElementById('id_komponen_gaji');
            
            // Kosongkan dan nonaktifkan dropdown komponen
            komponenSelect.innerHTML = '<option value="">Memuat...</option>';
            komponenSelect.disabled = true;

            if (anggotaId) {
                // Ambil data komponen gaji yang sesuai dari server
                fetch(`/admin/get-komponen-gaji/${anggotaId}`)
                    .then(response => response.json())
                    .then(data => {
                        komponenSelect.innerHTML = '<option value="">-- Pilih Komponen Gaji --</option>';
                        data.forEach(komponen => {
                            const option = document.createElement('option');
                            option.value = komponen.id_komponen_gaji;
                            option.textContent = `${komponen.nama_komponen} (Rp ${new Intl.NumberFormat('id-ID').format(komponen.nominal)})`;
                            komponenSelect.appendChild(option);
                        });
                        komponenSelect.disabled = false;
                    });
            } else {
                komponenSelect.innerHTML = '<option value="">-- Pilih Anggota Terlebih Dahulu --</option>';
            }
        });
    </script>
</x-app-layout>