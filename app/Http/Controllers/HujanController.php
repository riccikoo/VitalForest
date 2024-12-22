<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HujanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil 20 data terbaru
        $data = DB::table('sensors')->latest()->take(20)->get();

        // Mengambil label (waktu) dan data
        $labels = $data->pluck('created_at')->map(function ($timestamp) {
            return Carbon::parse($timestamp)->format('H:i');  // Format waktu jam:menit
        });
        $temperature = $data->pluck('temperature');
        $humidity = $data->pluck('humidity');
        $hujan = $data->pluck('hujan');

        return view('hujan-sensor.index', compact('labels', 'temperature', 'humidity', 'hujan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        //
    }
}
