<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

use App\Models\Drone;
use Illuminate\Http\Request;
use App\Http\Requests\Drone\StoreRequest;
use App\Http\Requests\Drone\UpdateRequest;

class DroneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return response()->view('drone.index', [
            'drones' => Drone::orderBy('updated_at', 'desc')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return response()->view('drone.form');
    }

    /**
     * Store a newly created resource in storage.
     */
      public function store(StoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('gambar')) {
            $filePath = Storage::disk('public')->put('images/drones', $request->file('gambar'));
            $validated['gambar'] = $filePath;
        }

        Drone::create($validated);

        return redirect()->route('drones.index')->with('notif.success', 'Data drone berhasil ditambahkan!');
    }

    public function show(Drone $drone) 
    {
        return view('drone.show', compact('drone'));
    }

    public function edit(Drone $drone) 
    {
        return view('drone.form', compact('drone'));
    }

    public function update(UpdateRequest $request, Drone $drone): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($drone->gambar) {
                Storage::disk('public')->delete($drone->gambar);
            }

            $filePath = Storage::disk('public')->put('images/drones', $request->file('gambar'));
            $validated['gambar'] = $filePath;
        }

        $drone->update($validated);

        return redirect()->route('drones.index')->with('notif.success', 'Data drone berhasil diperbarui!');
    }

    public function destroy(Drone $drone): RedirectResponse
    {
        // Hapus gambar jika ada
        if ($drone->gambar) {
            Storage::disk('public')->delete($drone->gambar);
        }

        $drone->delete();

        return redirect()->route('drones.index')->with('notif.success', 'Data drone berhasil dihapus!');
    }
}