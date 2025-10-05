<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;


Route::get('/', function () {
    return view('index');
});
Route::get('/login', function () {
    return redirect('/');
})->name('login');

Route::get('/create', [TaskController::class, 'create'])->middleware('auth');
Route::post('/create', [TaskController::class, 'create'])->middleware('auth');
Route::post('/store', [TaskController::class, 'store'])->middleware('auth');

Route::get('/principal', [TaskController::class, 'principal'])->middleware('auth');
Route::post('/principal', [TaskController::class, 'principal'])->middleware('auth');
Route::get('/principal', [TaskController::class, 'index'])->middleware('auth');

Route::post('/destroy/{id}', [TaskController::class, 'destroy']);

Route::get('/edit/{id}', [TaskController::class, 'edit']);
Route::post('/update/{id}', [TaskController::class, 'update']);

Route::post('/registrar', [TaskController::class,'registrar']);


Route::post('/logout', [TaskController::class,'logout']);

Route::post('/login', [TaskController::class,'login']);

Route::fallback(function () {
    return redirect('/principal')->with('info', 'Página no encontrada');
});


