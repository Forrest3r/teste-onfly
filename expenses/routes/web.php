<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DespesasController;
use App\Http\Controllers\Auth\SairController;
use App\Http\Controllers\Auth\EntrarController;
use App\Http\Controllers\Auth\RegistrarController;

//Home
Route::get('/', function(){
    return view('home');
})->name('home');

//Entrar
Route::get('/entrar', [EntrarController::class, 'index'])->name('entrar');
Route::post('/entrar', [EntrarController::class, 'store']);

//Registrar-se
Route::get('/registrar', [RegistrarController::class, 'index'])->name('registrar');
Route::post('/registrar', [RegistrarController::class, 'store']);

//Sair
Route::post('/sair', [SairController::class, 'logout'])->name('sair');

//Despesas
Route::get('/despesas', [DespesasController::class, 'index'])->name('despesas');
Route::get('/despesas/nova', [DespesasController::class, 'create'])->name('nova.despesa');
Route::post('/despesas/nova', [DespesasController::class, 'store']);
Route::get('/despesas/{despesa}', [DespesasController::class, 'show'])->name('ver.despesa');
Route::delete('/despesas/{despesa}', [DespesasController::class, 'destroy'])->name('deletar.despesa');
Route::get('/despesas/{despesa}/editar', [DespesasController::class, 'edit'])->name('editar.despesa');
Route::put('/despesas/{despesa}/editar', [DespesasController::class, 'update']);