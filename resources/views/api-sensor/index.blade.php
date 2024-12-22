@extends('layout')

@section('title', 'Grafik Data API Sensor')

@section('content')
<div class="container mx-auto p-8">
    <h1 class="text-4xl font-semibold text-center mb-8">Grafik Data API Sensor</h1>

    <!-- Tombol Print -->
    <button class="no-print bg-blue-500 text-white px-4 py-2 rounded-lg" onclick="window.print()">Print Grafik</button>

    <!-- Grafik -->
    <div class="bg-white shadow-lg rounded-lg p-6">
        <svg viewBox="0 0 700 500" xmlns="http://www.w3.org/2000/svg">
            <!-- Background -->
            <rect x="0" y="0" width="700" height="500" fill="#f9f9f9" />
            
            <!-- Garis Grid -->
            @for ($i = 0; $i <= 10; $i++)
                <line x1="50" y1="{{ 50 + $i * 40 }}" x2="650" y2="{{ 50 + $i * 40 }}" stroke="#ddd" />
            @endfor

            <!-- Label Sumbu Y -->
            @for ($i = 0; $i <= 10; $i++)
                <text x="10" y="{{ 55 + $i * 40 }}" font-size="12" fill="#555">{{ 1000 - $i * 100 }}</text>
            @endfor

            <!-- Garis Data -->
            <polyline
                fill="none"
                stroke="#f44336"
                stroke-width="2"
                points=" 
                    @foreach ($values as $index => $value)
                        {{ 50 + $index * 30 }},{{ 450 - ($value / 1000 * 400) }}
                    @endforeach
                "
            />

            <!-- Titik Data -->
            @foreach ($values as $index => $value)
                <circle cx="{{ 50 + $index * 30 }}" cy="{{ 450 - ($value / 1000 * 400) }}" r="3" fill="#f44336" />
            @endforeach

            <!-- Label Sumbu X -->
            @foreach ($labels as $index => $label)
                <text x="{{ 45 + $index * 30 }}" y="470" font-size="10" fill="#555">{{ $label }}</text>
            @endforeach
        </svg>
    </div>

    <!-- Keterangan -->
    <div class="mt-6 bg-gray-100 rounded-lg p-4">
        <h2 class="text-lg font-semibold">Keterangan:</h2>
        <ul class="list-disc pl-6">
            <li><strong>API:</strong> Nilai API berdasarkan data sensor, yang menunjukkan kualitas udara.</li>
            <li>Data diambil dari tabel <code>sensor_data</code> secara otomatis dan divisualisasikan.</li>
            <li>Waktu di sumbu X menunjukkan waktu pengambilan data.</li>
        </ul>
    </div>
</div>
@endsection
