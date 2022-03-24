<?php

use App\Http\Controllers\FormController;
use App\Http\Controllers\ThisController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get(
    '/', function () {
        return view('welcome');
    }
);

Route::get('/this', [ThisController::class,"index"])->name('thisme');

Route::match(
    ['get', 'post'], '/add-form', [FormController::class,'index']
)->name('form-sub');
