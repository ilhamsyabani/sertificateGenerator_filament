<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/sertifikat/{id}', function ($id) {
    $sertifikat = \App\Models\Sertifikat::find($id);
    return view('sertifikat', [
        'sertifikat' => $sertifikat
    ]);
});


