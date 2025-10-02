<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return view('index');
});

Route::post('/registrar',[TaskController::class,'registrar']);

