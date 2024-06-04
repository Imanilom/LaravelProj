<?php

namespace App\Http\Controllers;

use App\Models\Lahan;
use Illuminate\Http\Request;
use Auth;
use Validator;
class LahanController extends Controller
{
    public function index()
    {
        $lahan = Lahan::where('id_user', auth()->user()->id)->get(); // Filter berdasarkan user yang login
        return view('lahan.index', compact('lahan'));
    }

    public function create()
    {
        return view('lahan.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_lahan' => 'required|string|max:255',
            'jenis_tanaman' => 'nullable|string|max:255',
            'luas_lahan' => 'nullable|numeric', // Assuming luas_lahan is a numeric value
            'lokasi' => 'nullable|string|max:255',
            'catatan' => 'nullable|string', 
        ]);

        $user = Auth::user();
        $validatedData['id_user'] = $user->id;

        Lahan::create($validatedData);

        return redirect()->route('lahan.index')->with('success', 'Lahan berhasil ditambahkan.');
    }

    public function show(Lahan $lahan)
    {
        return view('lahan.show', compact('lahan'));
    }

    public function edit(Lahan $lahan)
    {
        return view('lahan.edit', compact('lahan'));
    }

    public function update(Request $request, Lahan $lahan)
    {
        $validatedData = $request->validate([
            'nama_lahan' => 'required|string|max:255',
            'jenis_tanaman' => 'nullable|string|max:255',
            'luas_lahan' => 'nullable|numeric', // Assuming luas_lahan is a numeric value
            'lokasi' => 'nullable|string|max:255',
            'catatan' => 'nullable|string', 
        ]);

        $lahan->update($validatedData);

        return redirect()->route('lahan.index')->with('success', 'Lahan berhasil diperbarui.');
    }

    public function destroy(Lahan $lahans)
    {
        $lahan->delete();

        return redirect()->route('lahan.index')->with('success', 'Lahan berhasil dihapus.');
    }
}
