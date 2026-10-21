<?php

use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/saludo', [\App\Http\Controllers\SaludoController::class, 'index']);

// Práctica 4: vistas generadas con Google Stitch (MCP)
Route::controller(UsuarioController::class)->group(function () {
    Route::get('/usuarios', 'index')->name('usuarios.index');
    Route::get('/usuarios/registro', 'create')->name('usuarios.registro');
    Route::post('/usuarios', 'store')->name('usuarios.store');
    Route::get('/usuarios/{usuario}/editar', 'edit')->name('usuarios.editar');
    Route::put('/usuarios/{usuario}', 'update')->name('usuarios.update');
});
