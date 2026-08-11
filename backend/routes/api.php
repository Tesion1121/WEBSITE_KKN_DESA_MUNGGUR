<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UmkmController;
use App\Http\Controllers\PerangkatDesaController;
use App\Http\Controllers\KomoditasController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\BeritaController;
// Public routes
Route::post('/login', [AuthController::class, 'login']);
Route::get('/komoditas', [KomoditasController::class, 'index']);

// Berita (public)
Route::get('/berita', [BeritaController::class, 'index']);
Route::get('/berita/{slug}', [BeritaController::class, 'show']);
Route::get('/umkm', [UmkmController::class, 'index']);
Route::get('/umkm/{id}', [UmkmController::class, 'show']);
Route::get('/perangkat-desa', [PerangkatDesaController::class, 'index']);

// Protected routes (Admin Area)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/check-token', [AuthController::class, 'checkToken']);
    
    // UMKM Management
    Route::post('/umkm', [UmkmController::class, 'store']);
    Route::put('/umkm/{id}', [UmkmController::class, 'update']);
    Route::delete('/umkm/{id}', [UmkmController::class, 'destroy']);
    
    // Perangkat Desa Management
    Route::post('/perangkat-desa', [PerangkatDesaController::class, 'store']);
    Route::delete('/perangkat-desa/reset', [PerangkatDesaController::class, 'resetAll']);

    // Komoditas Management
    Route::post('/komoditas', [KomoditasController::class, 'store']);
    Route::put('/komoditas/{id}', [KomoditasController::class, 'update']);
    Route::delete('/komoditas/{id}', [KomoditasController::class, 'destroy']);
    
    // Berita Management
    Route::get('/admin/berita', [BeritaController::class, 'adminIndex']);
    Route::post('/berita', [BeritaController::class, 'store']);
    Route::put('/berita/{id}', [BeritaController::class, 'update']);
    Route::delete('/berita/{id}', [BeritaController::class, 'destroy']);

    // Image Upload
    Route::post('/upload', [UploadController::class, 'upload']);
});
