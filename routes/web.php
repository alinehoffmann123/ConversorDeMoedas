<?php

use Illuminate\Support\Facades\Route; 
use App\Http\Controllers\ConversorController;

Route::get('/', [ConversorController::class, 'index'])->name('converter.form');
Route::post('/converter', [ConversorController::class, 'converter'])->name('converter.converter');
