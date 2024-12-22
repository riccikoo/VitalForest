@extends('layout')

@section('title', 'Real-Time Sensor Data')

@section('content')
<div class="container mx-auto p-8">
    <h1 class="text-4xl font-semibold text-center mb-8">Real-Time Sensor Data</h1>

    <!-- Sensor Data Display -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
        <div class="bg-white shadow-lg rounded-lg p-6">
            <div id="hujan-alert" class="hidden mb-4 p-4 rounded-md text-white" role="alert"></div>
            <h2 class="text-2xl font-semibold">Hujan Level: <span id="hujan" class="font-bold text-blue-500">--</span></h2>
        </div>
        <div class="bg-white shadow-lg rounded-lg p-6">
            <div id="temperature-alert" class="hidden mb-4 p-4 rounded-md text-white" role="alert"></div>
            <h2 class="text-2xl font-semibold">Temperature: <span id="temperature" class="font-bold text-blue-500">--</span> °C</h2>
        </div>
        <div class="bg-white shadow-lg rounded-lg p-6">
            <div id="humidity-alert" class="hidden mb-4 p-4 rounded-md text-white" role="alert"></div>
            <h2 class="text-2xl font-semibold">Humidity: <span id="humidity" class="font-bold text-blue-500">--</span> %</h2>
        </div>
        <div class="bg-white shadow-lg rounded-lg p-6">
            <div id="api-alert" class="hidden mb-4 p-4 rounded-md text-white" role="alert"></div>
            <h2 class="text-2xl font-semibold">API Level: <span id="api" class="font-bold text-red-500">--</span></h2>
        </div>
    </div>

    <div class="bg-white shadow-lg rounded-lg p-6">
        <canvas id="sensor-chart" width="400" height="200"></canvas>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.socket.io/4.4.1/socket.io.min.js"></script>
<script>
    const socket = io('http://localhost:3000'); // Socket.IO server

    // Chart.js setup
    const ctx = document.getElementById('sensor-chart').getContext('2d');
    const chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [],
            datasets: [
                { label: 'Hujan', borderColor: 'blue', data: [] },
                { label: 'Temperature', borderColor: 'red', data: [] },
                { label: 'Humidity', borderColor: 'green', data: [] },
                { label: 'API', borderColor: 'orange', data: [] },
            ]
        },
        options: { responsive: true }
    });

    socket.on('updateSensorData', (data) => {
        document.getElementById('hujan').textContent = data.hujan;
        document.getElementById('temperature').textContent = data.temperature;
        document.getElementById('humidity').textContent = data.humidity;
        document.getElementById('api').textContent = data.api;

        // Update chart
        chart.data.labels.push(new Date().toLocaleTimeString());
        chart.data.datasets[0].data.push(data.hujan);
        chart.data.datasets[1].data.push(data.temperature);
        chart.data.datasets[2].data.push(data.humidity);
        chart.data.datasets[3].data.push(data.api);
        chart.update();
    });
</script>
@endsection
