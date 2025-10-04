<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Nanti akan kita isi untuk menampilkan data
        return "Halaman daftar anggota";
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
    
    // ... (method lain akan kita isi nanti)
}