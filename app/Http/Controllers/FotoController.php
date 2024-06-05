<?php

namespace App\Http\Controllers;
use App\Models\Foto;
use App\Models\Lahan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FotoController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'lahan_id' => 'required|exists:lahans,id',
            'jenis_foto' => 'required|in:tanaman,drone',
            'foto' => 'required|image|max:2048', // Validasi gambar
        ]);

        $lahan = Lahan::findOrFail($request->lahan_id);

        $path = $request->file('foto')->store('public/fotos');

        $foto = new Foto([
            'lahan_id' => $lahan->id,
            'jenis_foto' => $request->jenis_foto,
            'path' => $path,
        ]);
        $foto->save();

        return redirect()->back()->with('success', 'Foto berhasil diunggah.');
    }

}
