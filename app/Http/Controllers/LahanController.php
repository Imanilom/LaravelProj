<?php

namespace App\Http\Controllers;

use App\Models\Lahan;
use Illuminate\Http\Request;
use Auth;

class LahanController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $lahan = $user->lahan; 
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
            'luas_lahan' => 'nullable|numeric',
            'lokasi' => 'nullable|string|max:255',
            'catatan' => 'nullable|text',
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
            'luas_lahan' => 'nullable|numeric',
            'lokasi' => 'nullable|string|max:255',
            'catatan' => 'nullable|text',
        ]);

        $lahan->update($validatedData);

        return redirect()->route('lahan.index')->with('success', 'Lahan berhasil diperbarui.');
    }

    public function destroy(Lahan $lahan)
    {
        $lahan->delete();

        return redirect()->route('lahan.index')->with('success', 'Lahan berhasil dihapus.');
    }
}
