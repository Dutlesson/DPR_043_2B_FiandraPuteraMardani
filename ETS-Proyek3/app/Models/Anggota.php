<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;

    protected $table = 'anggota';
    protected $primaryKey = 'id_anggota';

    protected $fillable = [
        'nama_depan',
        'nama_belakang',
        'gelar_depan',
        'gelar_belakang',
        'jabatan',
        'status_pernikahan',
        'jumlah_anak',
    ];

    public $timestamps = false;

    /**
     * Mendefinisikan relasi many-to-many ke KomponenGaji
     * melalui tabel 'penggajian'.
     */
    public function allKomponenGaji()
    {
        return $this->belongsToMany(KomponenGaji::class, 'penggajian', 'id_anggota', 'id_komponen_gaji');
    }
}