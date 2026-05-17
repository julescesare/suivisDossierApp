<?php

use App\Http\Controllers\AnoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('base');
});
Route::get('/dashboard', function () {
    return view('pages.dashboard');
})->name('dashboard');

//Ano
Route::resource('anos', AnoController::class);
