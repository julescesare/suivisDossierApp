<?php

use App\Http\Controllers\AnoController;
use App\Http\Controllers\TypeVersionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.dashboard');
});
Route::get('/dashboard', function () {
    return view('pages.dashboard');
})->name('dashboard');

//Ano
Route::resource('anos', AnoController::class);
//TypeVersion
Route::resource('type_versions', TypeVersionController::class);
