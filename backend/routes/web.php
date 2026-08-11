<?php

use Illuminate\Support\Facades\Route;

// ===================== HALAMAN PUBLIK =====================

Route::get('/', function () {
    return view('pages.home');
});

Route::get('/profil-desa', function () {
    return view('pages.profil-desa');
});

Route::get('/struktur-desa', function () {
    return view('pages.struktur-desa');
});

Route::get('/potensi-desa', function () {
    return view('pages.potensi-desa');
});

Route::get('/peta-desa', function () {
    return view('pages.peta-desa');
});

Route::get('/landasan-hukum', function () {
    return view('pages.landasan-hukum');
});

Route::get('/kesehatan', function () {
    return view('pages.kesehatan');
});

Route::get('/alat-pertanian', function () {
    return view('pages.alat-pertanian');
});

Route::get('/keuangan', function () {
    return view('pages.keuangan');
});

Route::get('/umkm', function () {
    return view('pages.umkm');
});

Route::get('/kebudayaan-kuliner', function () {
    return view('pages.kebudayaan-kuliner');
});

Route::get('/komoditas', function () {
    return view('pages.komoditas');
});

Route::get('/berita', function () {
    return view('pages.berita');
});

Route::get('/berita/{slug}', function () {
    return view('pages.berita-detail');
});

Route::get('/login', function () {
    return view('pages.login');
});

Route::get('/login.html', function () {
    return redirect('/login');
});

Route::get('/umkm.html', function () {
    return redirect('/umkm');
});

Route::get('/admin', function () {
    return view('pages.admin');
});

Route::get('/admin.html', function () {
    return redirect('/admin');
});
