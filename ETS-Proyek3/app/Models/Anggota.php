<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;

    // Menentukan nama tabel secara eksplisit
    protected $table = 'anggota';

    // Menentukan primary key
    protected $primaryKey = 'id_anggota';

    // Kolom yang boleh diisi
    protected $fillable = [
        'nama_depan',
        'nama_belakang',
        'gelar_depan',
        'gelar_belakang',
        'jabatan',
        'status_pernikahan',
        'jumlah_anak',
    ];

    // Menonaktifkan timestamps (created_at, updated_at) jika tidak ada di tabel
    public $timestamps = false;
}