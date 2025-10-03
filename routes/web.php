<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;


Route::get('/', function () {
    return view('index');
});


Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create')->middleware('auth');

Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store')->middleware('auth');

Route::get('/principal', [TaskController::class, 'principal'])->middleware('auth');

Route::post('/registrar', [TaskController::class,'registrar']);

Route::post('/logout', [TaskController::class,'logout']);

Route::post('/login', [TaskController::class,'login']);

