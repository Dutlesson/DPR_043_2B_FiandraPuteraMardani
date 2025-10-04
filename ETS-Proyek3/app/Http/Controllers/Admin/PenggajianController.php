<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\KomponenGaji;
use App\Models\Penggajian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class PenggajianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Memuat relasi allKomponenGaji yang satuannya 'Bulan'
        $query = Anggota::query()->with(['allKomponenGaji' => function($q){
            $q->where('satuan', 'Bulan');
        }]);
        
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('nama_depan', 'like', "%{$search}%")
                ->orWhere('nama_belakang', 'like', "%{$search}%")
                ->orWhere('jabatan', 'like', "%{$search}%")
                ->orWhere('id_anggota', 'like', "%{$search}%");
            });
        }
        
        $anggotaList = $query->get();

        // Kalkulasi Take Home Pay untuk setiap anggota
        $anggotaList->each(function ($anggota) {
            // Ambil semua komponen yang per bulan
            $komponenBulanan = $anggota->allKomponenGaji;

            // Pisahkan komponen dasar dengan tunjangan keluarga
            $baseComponents = $komponenBulanan->whereNotIn('nama_komponen', ['Tunjangan Istri/Suami', 'Tunjangan Anak']);
            $tunjanganIstri = $komponenBulanan->firstWhere('nama_komponen', 'Tunjangan Istri/Suami');
            $tunjanganAnak = $komponenBulanan->firstWhere('nama_komponen', 'Tunjangan Anak');

            // Jumlahkan gaji pokok dan tunjangan melekat lainnya
            $total = $baseComponents->sum('nominal');

            // Tambahkan tunjangan istri jika status kawin dan komponennya ada
            if ($anggota->status_pernikahan == 'Kawin' && $tunjanganIstri) {
                $total += $tunjanganIstri->nominal;
            }

            // Tambahkan tunjangan anak (maksimal 2) jika punya anak dan komponennya ada
            if ($anggota->jumlah_anak > 0 && $tunjanganAnak) {
                $jumlahAnakDihitung = min($anggota->jumlah_anak, 2);
                $total += ($tunjanganAnak->nominal * $jumlahAnakDihitung);
            }
            
            $anggota->take_home_pay = $total;
        });

        // Filtering untuk Take Home Pay
        if ($search && is_numeric(str_replace('.', '', $search))) {
            $searchTermNumeric = (float) str_replace('.', '', $search);
            $anggotaList = $anggotaList->filter(function ($anggota) use ($searchTermNumeric) {
                return $anggota->take_home_pay == $searchTermNumeric;
            });
        }

        return view('admin.penggajian.index', compact('anggotaList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $anggota = Anggota::orderBy('nama_depan')->get();
        return view('admin.penggajian.create', compact('anggota'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_anggota' => 'required|exists:anggota,id_anggota',
            'id_komponen_gaji' => [
                'required',
                'exists:komponen_gaji,id_komponen_gaji',
                Rule::unique('penggajian')->where(function ($query) use ($request) {
                    return $query->where('id_anggota', $request->id_anggota);
                })
            ],
        ], [
            'id_komponen_gaji.unique' => 'Anggota ini sudah memiliki komponen gaji tersebut.'
        ]);

        Penggajian::create($validated);

        // Arahkan ke halaman detail anggota yang baru diupdate
        return redirect()->route('penggajian.show', $request->id_anggota)->with('success', 'Komponen gaji berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Anggota $anggota)
    {
        // Akan kita buat di langkah selanjutnya
        return "Halaman detail untuk anggota: " . $anggota->nama_depan;
    }

    /**
     * Show the form for editing the specified resource.
     * (Untuk penggajian, kita tidak edit, tapi hapus komponen satu per satu di halaman detail)
     */
    public function edit(Anggota $anggota)
    {
        // 1. Ambil semua jenis komponen gaji yang ada di sistem
        $semuaKomponen = KomponenGaji::orderBy('nama_komponen')->get();
        
        // 2. Ambil ID dari komponen yang sudah dimiliki anggota ini
        $komponenDimiliki = $anggota->allKomponenGaji()->pluck('komponen_gaji.id_komponen_gaji')->toArray();

        // 3. Kirim semua data ke view 'edit'
        return view('admin.penggajian.edit', compact('anggota', 'semuaKomponen', 'komponenDimiliki'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Anggota $anggota)
    {
        // 1. Validasi input (opsional tapi sangat direkomendasikan)
        $request->validate([
            'komponen_ids' => 'nullable|array', // Pastikan komponen_ids adalah array jika ada
            'komponen_ids.*' => 'exists:komponen_gaji,id_komponen_gaji', // Pastikan setiap ID valid
        ]);

        // 2. Ambil semua ID komponen yang dicentang dari form
        //    Jika tidak ada yang dicentang, akan menjadi array kosong []
        $selectedKomponenIds = $request->input('komponen_ids', []);

        // 3. Gunakan sync() untuk melakukan sinkronisasi
        $anggota->allKomponenGaji()->sync($selectedKomponenIds);

        // 4. Redirect dengan pesan sukses
        return redirect()->route('penggajian.index')->with('success', 'Data penggajian untuk ' . $anggota->nama_depan . ' berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     * (Untuk penggajian, kita akan buat fungsi hapus per komponen, bukan seluruh data penggajian anggota)
     */
    public function destroy(string $id)
    {
        // Method ini tidak kita gunakan secara langsung
        abort(404);
    }

    // Method untuk mendapatkan komponen gaji berdasarkan jabatan anggota (AJAX)
    public function getKomponenGajiForAnggota(Anggota $anggota)
    {
        $existingKomponenIds = DB::table('penggajian')->where('id_anggota', $anggota->id_anggota)->pluck('id_komponen_gaji');

        $komponen = KomponenGaji::where(function ($query) use ($anggota) {
            $query->where('jabatan', $anggota->jabatan)
                  ->orWhere('jabatan', 'Semua');
        })
        ->whereNotIn('id_komponen_gaji', $existingKomponenIds)
        ->get();

        return response()->json($komponen);
    }
}