<?php

use App\Http\Controllers\CounterProductsController;
use Illuminate\Support\Facades\Route;

// Rota para upload de produtos de balcão
Route::post('upload', [CounterProductsController::class, 'upload'])->name('upload');

// Rota de historico de upload de arquivos

// Busca de conteúdo de arquivo
