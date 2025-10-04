<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penggajian extends Model
{
    use HasFactory;

    protected $table = 'penggajian';
    
    // Karena primary key terdiri dari 2 kolom, kita set false
    public $incrementing = false;
    protected $primaryKey = ['id_komponen_gaji', 'id_anggota'];

    // Kolom yang boleh diisi
    protected $fillable = [
        'id_komponen_gaji',
        'id_anggota',
    ];

    public $timestamps = false;
}