<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lahan extends Model
{
    protected $table = 'lahans'; // Nama tabel

    protected $fillable = [
        'id_user', 'nama_lahan', 'jenis_tanaman', 'luas_lahan', 'lokasi', 'catatan'
    ];

    // Relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user'); // Sesuaikan dengan model User Anda
    }

    public function fotos()
    {
        return $this->hasMany(Foto::class, 'lahan_id');
    }
}
