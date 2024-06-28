<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SensorData;

class SensorDataController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'sensor_id' => 'required|string',
            'value' => 'required|numeric',
            'recorded_at' => 'required|date',
        ]);

        SensorData::create($data);

        return response()->json(['message' => 'Data saved successfully'], 200);
    }
}
