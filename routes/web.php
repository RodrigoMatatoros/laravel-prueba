<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;


Route::get('/', function () {
    return view('index');
});
Route::get('/login', function () {
    return redirect('/'); // ← Redirige a la raíz que SÍ existe
})->name('login');

Route::get('/create', [TaskController::class, 'create'])->middleware('auth');

Route::get('/principal', [TaskController::class, 'principal'])->middleware('auth');

Route::post('/registrar', [TaskController::class,'registrar']);


Route::post('/logout', [TaskController::class,'logout']);

Route::post('/login', [TaskController::class,'login']);


