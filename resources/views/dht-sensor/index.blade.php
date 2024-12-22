@extends('layout')

@section('title', 'Grafik Data DHT')

@section('content')
<div class="container mx-auto p-8">
    <h1 class="text-4xl font-semibold text-center mb-8">Grafik Data DHT Sensor</h1>

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
                <text x="10" y="{{ 55 + $i * 40 }}" font-size="12" fill="#555">{{ 100 - $i * 10 }}</text>
            @endfor

            <!-- Garis Data: Temperature -->
            <polyline
                fill="none"
                stroke="#f44336"
                stroke-width="2"
                points="
                    @foreach ($temperature as $index => $temp)
                        {{ 50 + $index * 30 }},{{ 450 - ($temp / 100 * 400) }}
                    @endforeach
                "
            />

            <!-- Titik Data: Temperature -->
            @foreach ($temperature as $index => $temp)
                <circle cx="{{ 50 + $index * 30 }}" cy="{{ 450 - ($temp / 100 * 400) }}" r="3" fill="#f44336" />
            @endforeach

            <!-- Garis Data: Humidity -->
            <polyline
                fill="none"
                stroke="#2196f3"
                stroke-width="2"
                points="
                    @foreach ($humidity as $index => $hum)
                        {{ 50 + $index * 30 }},{{ 450 - ($hum / 100 * 400) }}
                    @endforeach
                "
            />

            <!-- Titik Data: Humidity -->
            @foreach ($humidity as $index => $hum)
                <circle cx="{{ 50 + $index * 30 }}" cy="{{ 450 - ($hum / 100 * 400) }}" r="3" fill="#2196f3" />
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
            <li><span class="text-red-500 font-bold">Merah:</span> Data suhu (temperature) dari sensor DHT.</li>
            <li><span class="text-blue-500 font-bold">Biru:</span> Data kelembapan (humidity) dari sensor DHT.</li>
            <li>Data diambil dari tabel <code>sensor_data</code> dan divisualisasikan secara otomatis.</li>
            <li>Waktu di sumbu X menunjukkan waktu pengambilan data.</li>
        </ul>
    </div>
</div>
@endsection
