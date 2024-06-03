<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\SensorLog;
use App\Models\Lahan;
use Illuminate\Support\Facades\Auth;
use App\Models\Upload;
use Illuminate\Http\Response;
use App\Models\Drone;
use Illuminate\Support\Facades\Schema;

class HomeController extends Controller
{


    public function home()
    {
        // Check if the logged-in user has the 'admin' role
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin'); // Replace with your admin dashboard route name
        }

        // Ambil data gambar yang diurutkan berdasarkan created_at
        // $drones = Drone::orderBy('created_at', 'desc')->get();

        Carbon::setLocale('id');
        date_default_timezone_set('Asia/Jakarta');
        $currentTime = Carbon::now();
        
        $latestEntries = SensorLog::select('sensor_id', DB::raw('MAX(updated_at) as last_update'))
        ->whereHas('sensor', function ($query) {
            $query->where('user_id', Auth::id());
        })
        ->groupBy('sensor_id')
        ->get()
        ->keyBy('sensor_id');


        $sensors = SensorLog::whereHas('sensor', function ($query) {
            $query->where('user_id', Auth::id());
        })
        ->orderBy('created_at', 'asc')
        ->get();

        $sensorStatus = [];

        foreach ($latestEntries as $sensor_id => $entry) {
            $lastUpdateTime = Carbon::parse($entry->last_update);
            $sensorStatus[$sensor_id] = $lastUpdateTime->diffInHours($currentTime) <= 3 ? 'active' : 'inactive';
        }

        $actives = [];
        $inactives = [];
        $pos = 1;

        foreach ($sensorStatus as $status) {
            if ($status === 'active') {
                $actives[] = $pos; // Use shorthand array push syntax
            } else {
                $inactives[] = $pos;
            }
            $pos++;
        }

        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin');
        }

    return view('beranda', compact('actives', 'inactives'));
    }
    
}