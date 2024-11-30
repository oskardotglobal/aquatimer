<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\MeasurementsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AppController::class, 'index']);
Route::post("/api/measurements/create", [MeasurementsController::class, "create"]);


