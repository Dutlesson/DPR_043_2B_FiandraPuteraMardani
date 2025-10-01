<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Pengguna extends Authenticatable
{
    use Notifiable;

    protected $table = 'pengguna';   // tabel yang dipakai
    protected $primaryKey = 'id_pengguna'; // primary key kamu
    public $timestamps = false;

    protected $fillable = [
        'username',
        'password',
        'email',
        'nama_depan',
        'nama_belakang',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Supaya autentikasi pakai username (bukan email)
    public function getAuthIdentifierName()
    {
        return 'username';
    }
}
