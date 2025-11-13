<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;

Route::get('/', function () {
    return redirect()->route('form.show'); // Перенаправляем главную на форму
});

Route::get('/form', [FormController::class, 'showForm'])->name('form.show');
Route::post('/form', [FormController::class, 'submitForm'])->name('form.submit');
Route::get('/data', [FormController::class, 'showData'])->name('data.show');
