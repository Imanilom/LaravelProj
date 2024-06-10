<?php

// app/Models/Foto.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    protected $fillable = ['lahan_id', 'jenis_foto', 'path'];

    public function lahan()
    {
        return $this->belongsTo(Lahan::class, 'lahan_id'); // Perhatikan 'lahan_id' di sini
    }
    
}
