<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    public function index()
    {
        // Ambil data dari tabel sensor_data
        $data = DB::table('sensors')
            ->select('created_at', 'api')
            ->orderBy('created_at', 'desc') // Urutkan dari yang terbaru
            ->limit(20)                   // Ambil 100 data terbaru
            ->get()
            ->reverse();                   // Balik urutan agar waktu dari lama ke baru

        // Format data untuk grafik
        $labels = $data->pluck('created_at')->map(function ($date) {
            return \Carbon\Carbon::parse($date)->format('H:i'); // Format jam:menit
        })->toArray();

        $values = $data->pluck('api')->toArray();

        return view('api-sensor.index', compact('labels', 'values'));
    }
}
