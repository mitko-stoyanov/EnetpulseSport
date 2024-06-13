<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;


Route::get('/', function () {
    return view('index');
    });
Route::get('/events', [HomeController::class, 'index']);
