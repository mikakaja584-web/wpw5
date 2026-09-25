<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;

Route::get('/form', function () {
    return view('form');
});

Route::post('/submit', [FormController::class, 'submitForm']);