<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anggota;
use Illuminate\Support\Facades\DB;

class PublicController extends Controller
{
    public function index()
    {
        return view('public.dashboard');
    }

    // TAMBAHKAN METHOD BARU INI
    public function showAnggota(Request $request)
    {
        $search = $request->input('search');
        $query = Anggota::query();

        if ($search) {
            $query->where('id_anggota', 'like', "%{$search}%")
                  ->orWhere('nama_depan', 'like', "%{$search}%")
                  ->orWhere('nama_belakang', 'like', "%{$search}%")
                  ->orWhere('jabatan', 'like', "%{$search}%");
        }

        $anggota = $query->get();
        return view('public.anggota.index', compact('anggota'));
    }

    public function showPenggajian(Request $request)
    {
        $search = $request->input('search');

        $query = DB::table('anggota')
            ->join('penggajian', 'anggota.id_anggota', '=', 'penggajian.id_anggota')
            ->join('komponen_gaji', 'penggajian.id_komponen_gaji', '=', 'komponen_gaji.id_komponen_gaji')
            ->select(
                'anggota.nama_depan', 'anggota.nama_belakang', 'anggota.gelar_depan', 'anggota.gelar_belakang', 'anggota.jabatan',
                DB::raw('SUM(komponen_gaji.nominal) as take_home_pay')
            )
            ->where('komponen_gaji.satuan', 'Bulan')
            ->groupBy(
                'anggota.id_anggota', 'anggota.nama_depan', 'anggota.nama_belakang', 'anggota.gelar_depan', 'anggota.gelar_belakang', 'anggota.jabatan'
            );

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('anggota.nama_depan', 'like', "%{$search}%")
                  ->orWhere('anggota.nama_belakang', 'like', "%{$search}%")
                  ->orWhere('anggota.jabatan', 'like', "%{$search}%");
            });
        }
        
        $penggajian = $query->get();

        return view('public.penggajian.index', compact('penggajian'));
    }
}