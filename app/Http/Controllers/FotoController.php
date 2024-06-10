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
        // Ambil nama file dari path
        $filename = basename($path);

        // Buat path yang benar untuk disimpan di database
        $path = 'storage/fotos/' . $filename;

        $foto = new Foto([
            'lahan_id' => $lahan->id,
            'jenis_foto' => $request->jenis_foto,
            'path' => $path,
        ]);
        $foto->save();

        return redirect()->back()->with('success', 'Foto berhasil diunggah.');
    }

    public function edit(Foto $foto)
    {
        // Pastikan hanya pemilik lahan yang bisa mengedit foto
        if ($foto->lahan->id_user != auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('foto.edit', compact('foto'));
    }

    public function update(Request $request, Foto $foto)
    {
        // Authorize: Ensure the user owns the photo
        if ($foto->lahan->id_user != auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
        $request->validate([
            'jenis_foto' => 'required|in:tanaman,drone',
        ]);

        $foto->update([
            'jenis_foto' => $request->jenis_foto,
        ]);

        return redirect()->back()->with('success', 'Foto berhasil diperbarui.');
    }

    public function destroy(Foto $foto)
    {
        // Pastikan hanya pemilik lahan yang bisa menghapus foto
        if ($foto->lahan->id_user != auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        // Hapus file foto dari storage
        Storage::delete($foto->path_foto);

        // Hapus data foto dari database
        $foto->delete();

        return redirect()->back()->with('success', 'Foto berhasil dihapus.');
    }

}
