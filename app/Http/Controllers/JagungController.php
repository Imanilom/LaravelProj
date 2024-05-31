<?php

namespace App\Http\Controllers;

use App\Models\Jagung;
use Illuminate\Http\Request;

class JagungController extends Controller
{
    public function index()
    {
        $jagungs = Jagung::all();
        return view('kalkulator.jagungSop', ['jagungs' => $jagungs]);
    }

    public function create()
    {
        return view('kalkulator.jagungCreate');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'aktivitas' => 'required',
            'item' => 'required',
        ]);

        Jagung::create($validatedData);
        return redirect()->route('jagung.index');
    }

    public function show(string $id)
    {
        $jagung = Jagung::findOrFail($id);
        return view('kalkulator.jagungSop', ['jagungs' => collect([$jagung])]);
    }

    public function edit(string $id)
    {
        $jagung = Jagung::findOrFail($id);
        return view('kalkulator.jagungEdit', compact('jagung'));
    }

    public function update(Request $request, string $id)
    {
        $jagung = Jagung::findOrFail($id);

        $validatedData = $request->validate([
            'aktivitas' => 'required',
            'item' => 'required',
        ]);

        $jagung->update($validatedData);

        return redirect()->route('jagung.index')->with('success', 'Data jagung berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        $jagung = Jagung::findOrFail($id);
        $jagung->delete();

        return redirect()->route('jagung.index')->with('success', 'Data jagung berhasil dihapus');
    }
}
