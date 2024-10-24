<?php

use Illuminate\Support\Facades\Route; 
use App\Http\Controllers\ConvertorController;

// Rota para exibir o formulário
Route::get('/', [ConvertorController::class, 'index'])->name('converter.form');

// Rota para processar a conversão
Route::post('/convert', [ConvertorController::class, 'convert'])->name('converter.convert');
