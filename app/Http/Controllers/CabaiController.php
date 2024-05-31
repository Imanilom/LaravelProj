<?php
namespace App\Http\Controllers;
use App\Models\Cabai;
use Illuminate\Http\Request;
use App\Http\Controllers\kalkulatorController;

class CabaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Cabai = cabai::all();

        return view('kalkulator/cabaiSop', ['cabai' => $Cabai]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kalkulator/cabaiCreate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'aktivitas' => 'required',
            'item' => 'required',
        ]);

        Cabai::create($validate);
        return redirect()->route('cabai.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cabai = cabai::findOrFail($id);
        return view('kalkulator/cabaiSop',['cabais' => collect([$cabai])]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $cabai = Cabai::findOrFail($id);
        return view('kalkulator.cabaiEdit', compact('cabai')); 
    }

    public function update(Request $request, string $id)
    {
        $cabai = Cabai::findOrFail($id);

        $validatedData = $request->validate([
            'aktivitas' => 'required',
            'item' => 'required',
        ]);

        $cabai->update($validatedData);

        return redirect()->route('cabai.index')->with('success', 'Data cabai berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        $cabai = Cabai::findOrFail($id);
        $cabai->delete();

        return redirect()->route('cabai.index')->with('success', 'Data cabai berhasil dihapus');
    }
}
