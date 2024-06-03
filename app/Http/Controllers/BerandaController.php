<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lahan;
use Auth;

class BerandaController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $lahan = $user->lahan()->with(['fotoTanaman' => function ($query) {
            $query->orderBy('tanggal_upload', 'desc')->limit(3);
        }, 'fotoDrone' => function ($query) {
            $query->orderBy('tanggal_upload', 'desc')->limit(3);
        }])->get();

        return view('beranda.index', compact('lahan'));
    }
}
