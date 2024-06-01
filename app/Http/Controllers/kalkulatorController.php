<?php

namespace App\Http\Controllers;

use App\Models\Kalkulators;
use App\Models\Status;
use App\Models\User;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;



class kalkulatorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $Kalkulators = Kalkulators::with('user')->where('user_id', auth()->user()->id)->get();
    return view('kalkulator/hasil', ['Kalkulators' => $Kalkulators]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kalkulator/kalkulator');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'komoditas' => 'required',
            'varietas' => 'required',
            'jarak' => 'required|regex:/^\d+\s*x\s*\d+$/',
            'luas' => 'required',
            'date' => 'required',
        ]);
    
        // Calculate 'luas' based on 'jarak'
        preg_match('/(\d+)\s*x\s*(\d+)/', $validatedData['jarak'], $matches); 
        $jarak1 = $matches[1];
        $jarak2 = $matches[2];
    
        // Store both jarak (as an array) and luas
        $validatedData['jarak'] = $jarak1 * $jarak2; // Store as a list
    
        // Associate with user if authenticated
        if (auth()->check()) {
            $validatedData['user_id'] = auth()->id();
        }
    
        Kalkulators::create($validatedData);
    
        return redirect()->route('kalkulators');
    }
    
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $kalkulator = Kalkulators::findOrFail($id);

        // Authorization check (if applicable)
        if (Auth::check() && $kalkulator->user_id !== Auth::id()) {
            abort(403, 'Unauthorized'); // Show 403 error if the user is not authorized to view this kalkulator
        }

        return view('kalkulator.hasil', ['kalkulators' => [$kalkulator]]); // Use dot notation for subfolders
    }

// Metode tambahan untuk admin, jika diperlukan
public function showForAdmin($id)
{
    $kalkulator = kalkulators::findOrFail($id);

    // Data yang akan dikirim ke view
    $data = ['kalkulators' => collect([$kalkulator])];

    // Mengirim data ke admin-hasil.blade.php
    return view('admin/hasil-admin', $data);
}


    public function show2($id)
    {
        $kalkulator = Kalkulators::findOrFail($id); // Menggunakan findOrFail untuk menangani kasus ID tidak ditemukan
        $komoditas = request()->query('komoditas');
        $tipe = request()->query('tipe'); // Menambahkan variabel tipe untuk menentukan jenis view yang akan dikembalikan


        switch ($komoditas) {
            case 'cabai':
                return view('kalkulator/detailCabe', compact('kalkulator'));

            case 'kubis':
                return view('kalkulator/detailKubis', compact('kalkulator'));

            case 'bawang merah':
                return view('kalkulator/detail', compact('kalkulator'));

            case 'kentang':
                return view('kalkulator/detailKentang', compact('kalkulator'));

            case 'jagung':
                return view('kalkulator/detailJagung', compact('kalkulator'));
                // default:

                // return view('kalkulator/detail', compact('kalkulator'));
        }
    }


    public function show3($id)
    {
        $Kalkulators = Kalkulators::paginate(10);
        $kalkulator = Kalkulators::findOrFail($id); // Menggunakan findOrFail untuk menangani kasus ID tidak ditemukan
        $komoditas = request()->query('komoditas');
        switch ($komoditas) {
            case 'cabai':
                return view('kalkulator/sopCabai', compact('kalkulator'));

            case 'kubis':
                return view('kalkulator/sopKubis', compact('kalkulator'));

            case 'bawang merah':
                return view('kalkulator/sop', compact('kalkulator'));

            case 'kentang':
                return view('kalkulator/sopKentang', compact('kalkulator'));

            case 'jagung':
                return view('kalkulator/sopJagung', compact('kalkulator'));

          //       return view('kalkulator/sop', compact('kalkulator'));

    }
}

public function user()
{
    return $this->belongsTo(User::class);
}



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kalkulator = Kalkulators::findOrFail($id);
        $kalkulator->delete();

        return redirect()->route('kalkulators');
    }

    public function submitForm(Request $request)
    {
        $isChecked = $request->has('checkboxExample');
        // Lakukan sesuatu dengan nilai $isChecked
        return redirect()->back()->withInput();
    }

    // public function boot(){
    //     Paginator::useTailwind();
    // }


}
