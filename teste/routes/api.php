<?php

use App\Http\Controllers\CounterProductsController;
use Illuminate\Support\Facades\Route;

Route::post('file-upload', [CounterProductsController::class, 'fileUpload'])->name('file-upload');
Route::get('file-history/{FileName?}/{RptDt?}', [CounterProductsController::class, 'fileHistory'])->name('file-history');
Route::post('file-search', [CounterProductsController::class, 'fileSearch'])->name('file-search');
