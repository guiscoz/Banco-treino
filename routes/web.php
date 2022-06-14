<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BankController;

Route::get('/', [BankController::class, 'index']);
Route::get('/accounts/create', [BankController::class, 'create'])->middleware('auth'); 
Route::post('/accounts', [BankController::class, 'store']);
Route::delete('/accounts/{id}', [BankController::class, 'destroy'])->middleware('auth'); 
Route::get('/accounts/edit/{id}', [BankController::class, 'edit'])->middleware('auth');
Route::put('/accounts/update/{id}', [BankController::class, 'update'])->middleware('auth'); 

Route::get('/dashboard', [BankController::class, 'dashboard'])->middleware('auth');
