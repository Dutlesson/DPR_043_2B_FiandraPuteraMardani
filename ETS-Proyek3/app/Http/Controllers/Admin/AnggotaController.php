<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Anggota; // Pastikan use model Anggota sudah ada
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Mengambil keyword pencarian dari request
        $search = $request->input('search');

        // Memulai query ke model Anggota
        $query = Anggota::query();

        // Jika ada keyword pencarian, tambahkan kondisi WHERE
        if ($search) {
            $query->where('id_anggota', 'like', "%{$search}%")
                ->orWhere('nama_depan', 'like', "%{$search}%")
                ->orWhere('nama_belakang', 'like', "%{$search}%")
                ->orWhere('jabatan', 'like', "%{$search}%");
        }

        // Eksekusi query dan ambil hasilnya
        $anggota = $query->get();

        // Kirim data hasil filter ke view
        return view('admin.anggota.index', compact('anggota'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Menampilkan view form tambah data
        return view('admin.anggota.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validasi data
        $validated = $request->validate([
            'nama_depan' => 'required|string|max:100',
            'nama_belakang' => 'required|string|max:100',
            'gelar_depan' => 'nullable|string|max:50',
            'gelar_belakang' => 'nullable|string|max:50',
            'jabatan' => 'required|in:Ketua,Wakil Ketua,Anggota',
            'status_pernikahan' => 'required|in:Kawin,Belum Kawin,Cerai Hidup,Cerai Mati',
            'jumlah_anak' => 'required|integer|min:0',
        ]);

        // 2. Simpan data ke database
        Anggota::create($validated);

        // 3. Redirect ke halaman daftar anggota dengan pesan sukses
        return redirect()->route('anggota.index')->with('success', 'Data anggota berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     * (Kita tidak gunakan method show untuk saat ini, bisa dikosongkan)
     */
    public function show(Anggota $anggota)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Anggota $anggota)
    {
        // Menampilkan view form edit dengan data anggota yang dipilih
        return view('admin.anggota.edit', compact('anggota'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Anggota $anggota)
    {
        // 1. Validasi data
        $validated = $request->validate([
            'nama_depan' => 'required|string|max:100',
            'nama_belakang' => 'required|string|max:100',
            'gelar_depan' => 'nullable|string|max:50',
            'gelar_belakang' => 'nullable|string|max:50',
            'jabatan' => 'required|in:Ketua,Wakil Ketua,Anggota',
            'status_pernikahan' => 'required|in:Kawin,Belum Kawin,Cerai Hidup,Cerai Mati',
            'jumlah_anak' => 'required|integer|min:0',
        ]);

        // 2. Update data di database
        $anggota->update($validated);

        // 3. Redirect ke halaman daftar anggota dengan pesan sukses
        return redirect()->route('anggota.index')->with('success', 'Data anggota berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Anggota $anggota)
    {
        // Hapus data dari database
        $anggota->delete();

        // Redirect ke halaman daftar anggota dengan pesan sukses
        return redirect()->route('anggota.index')->with('success', 'Data anggota berhasil dihapus!');
    }
}