<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SensorController;

Route::post('/send-sensor-data', [SensorController::class, 'sendSensorData']);