<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;


Route::get('/', function () {
    return view('index');
});

Route::get('/principal', [TaskController::class, 'principal'])->middleware('auth');

Route::post('/registrar', [TaskController::class,'registrar']);

Route::post('/logout', [TaskController::class,'logout']);

Route::post('/login', [TaskController::class,'login']);

