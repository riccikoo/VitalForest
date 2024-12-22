<?php

namespace App\Http\Controllers;

use App\Models\SensorData;
use Illuminate\Http\Request;

class SensorController extends Controller
{
    public function sendSensorData(Request $request)
    {
        // Validasi data yang diterima
        $validated = $request->validate([
            'hujan' => 'required|numeric',
            'dht' => 'required|array',
            'dht.temperature' => 'required|numeric',
            'dht.humidity' => 'required|numeric',
            'api' => 'required|numeric',
        ]);

        // Simpan data ke database
        SensorData::create([
            'hujan' => $validated['hujan'],
            'temperature' => $validated['dht']['temperature'],
            'humidity' => $validated['dht']['humidity'],
            'api' => $validated['api']
        ]);

        // Kirim respon
        return response()->json(['message' => 'Sensor data saved successfully.']);
    }
}
