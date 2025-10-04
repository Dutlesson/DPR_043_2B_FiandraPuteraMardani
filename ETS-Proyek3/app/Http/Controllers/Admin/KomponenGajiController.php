<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KomponenGaji;
use Illuminate\Http\Request;

class KomponenGajiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // app/Http/Controllers/Admin/KomponenGajiController.php

    public function index(Request $request)
    {
        $search = $request->input('search');
        $query = KomponenGaji::query();

        if ($search) {
            $query->where('id_komponen_gaji', 'like', "%{$search}%")
                ->orWhere('nama_komponen', 'like', "%{$search}%")
                ->orWhere('kategori', 'like', "%{$search}%")
                ->orWhere('jabatan', 'like', "%{$search}%")
                ->orWhere('nominal', 'like', "%{$search}%")
                ->orWhere('satuan', 'like', "%{$search}%");
        }

        $komponenGaji = $query->orderBy('id_komponen_gaji', 'desc')->get();

        return view('admin.komponen-gaji.index', compact('komponenGaji'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.komponen-gaji.create');
    }

    /**
     * Store a newly created resource in storage.
     */
     public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_komponen' => 'required|string|max:100',
            'kategori' => 'required|in:Gaji Pokok,Tunjangan Melekat,Tunjangan Lain',
            'jabatan' => 'required|in:Semua,Ketua,Wakil Ketua,Anggota',
            'nominal' => 'required|numeric|min:0',
            'satuan' => 'required|in:Bulan,Hari,Periode',
        ]);

        KomponenGaji::create($validated);

        return redirect()->route('komponen-gaji.index')->with('success', 'Komponen gaji berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KomponenGaji $komponenGaji)
    {
        return view('admin.komponen-gaji.edit', compact('komponenGaji'));
    }

    public function update(Request $request, KomponenGaji $komponenGaji)
    {
        $validated = $request->validate([
            'nama_komponen' => 'required|string|max:100',
            'kategori' => 'required|in:Gaji Pokok,Tunjangan Melekat,Tunjangan Lain',
            'jabatan' => 'required|in:Semua,Ketua,Wakil Ketua,Anggota',
            'nominal' => 'required|numeric|min:0',
            'satuan' => 'required|in:Bulan,Hari,Periode',
        ]);

        $komponenGaji->update($validated);

        return redirect()->route('komponen-gaji.index')->with('success', 'Komponen gaji berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KomponenGaji $komponenGaji)
    {
        $komponenGaji->delete();
        return redirect()->route('komponen-gaji.index')->with('success', 'Komponen gaji berhasil dihapus!');
    }
}
