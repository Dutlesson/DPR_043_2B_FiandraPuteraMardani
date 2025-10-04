<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anggota; // TAMBAHKAN USE INI

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
}