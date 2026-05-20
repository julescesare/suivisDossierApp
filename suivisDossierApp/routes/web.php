<?php

use App\Http\Controllers\AnoController;
use App\Http\Controllers\AutoriteController;
use App\Http\Controllers\EntiteController;
use App\Http\Controllers\InstructionController;
use App\Http\Controllers\NatureController;
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
//Autorite
Route::resource('autorites', AutoriteController::class);
//Instruction
Route::resource('instructions', InstructionController::class);
//Nature
Route::resource('natures', NatureController::class);
//entite
Route::resource('entites', EntiteController::class);
//fonction
Route::resource('fonctions', \App\Http\Controllers\FonctionController::class);
