<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\UnitKerjaController;
use App\Http\Controllers\GolonganController;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::apiResource('pegawai', PegawaiController::class);
    Route::get('/unit-kerja', [UnitKerjaController::class, 'index']);
    Route::get('/golongan', [GolonganController::class, 'index']);
});
