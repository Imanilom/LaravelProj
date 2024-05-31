<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;


class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $statuses = Status::all();
        return view('kalkulator/sop', ['statuses' => $statuses]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kalkualtor/sop');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'status' => 'required'
        ]);

        Status::create($validate);
        return redirect()->route('status.index');
    }

    /**
     * Display the specified resource.
     */
  public function show(string $id)
{
    $status = Status::findOrFail($id);
    return view('kalkulator/sop', ['statuses' => collect([$status])]);
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $status = Status::findOrFail($id);
        return view('kalkulator.sopEdit', compact('status')); // View untuk edit status
    }

    public function update(Request $request, string $id)
    {
        $status = Status::findOrFail($id);

        $validatedData = $request->validate([
            'status' => 'required'
        ]);

        $status->update($validatedData);

        return redirect()->route('status.index')->with('success', 'Status berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        $status = Status::findOrFail($id);
        $status->delete();

        return redirect()->route('status.index')->with('success', 'Status berhasil dihapus');
    }
}
