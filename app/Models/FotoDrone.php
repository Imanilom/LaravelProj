<?php // FotoTanaman.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FotoDrone extends Model
{
    protected $fillable = ['lahan_id', 'path_foto', 'tanggal_upload'];

    public function lahan()
    {
        return $this->belongsTo(Lahan::class);
    }
}
