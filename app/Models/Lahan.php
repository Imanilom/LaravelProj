<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lahan extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_user', 
        'nama_lahan', 
        'jenis_tanaman', 
        'luas_lahan', 
        'lokasi', 
        'catatan'
    ];

    public function fotoTanaman()
    {
        return $this->hasMany(FotoTanaman::class); // Relasi one-to-many dengan FotoTanaman
    }

    public function fotoDrone()
    {
        return $this->hasMany(FotoDrone::class); // Relasi one-to-many dengan FotoDrone
    }

    // Relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user'); // 'id_user' adalah foreign key di tabel lahan
    }
}
