<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BankController;

// Route::get('/', [BankController::class, 'index'])->name('index');
// Route::get('/accounts/create', [BankController::class, 'create'])->middleware('auth')->name('create'); 
// Route::post('/accounts/store', [BankController::class, 'store'])->middleware('auth')->name('store');
// Route::delete('/accounts/{id}', [BankController::class, 'destroy'])->middleware('auth')->name('destroy');
// Route::get('/accounts/edit/{id}', [BankController::class, 'edit'])->middleware('auth')->name('edit');
// Route::put('/accounts/update/{id}', [BankController::class, 'update'])->middleware('auth')->name('update');

// Route::get('/accounts/file', [BankController::class, 'file'])->middleware('auth')->name('file');
// Route::post('/accounts/upload', [BankController::class, 'upload'])->middleware('auth')->name('upload');
// Route::get('/download/userFiles/{file}', [BankController::class, 'download'])->middleware('auth')->name('download');
// Route::get('/delete/userFiles/{file}/delete', [BankController::class, 'deleteFile'])->middleware('auth')->name('delete');       

// Route::get('/dashboard', [BankController::class, 'dashboard'])->middleware('auth');

Route::get('/', [BankController::class, 'index'])->name('index');

Route::group(['middleware' => 'auth'], function () {

    Route::group(['prefix' => 'accounts'], function () {
        Route::get('create', [BankController::class, 'create'])->name('create'); 
        Route::post('store', [BankController::class, 'store'])->name('store');
        Route::delete('{id}', [BankController::class, 'destroy'])->name('destroy');
        Route::get('edit/{id}', [BankController::class, 'edit'])->name('edit');
        Route::put('update/{id}', [BankController::class, 'update'])->name('update');   
        Route::get('file', [BankController::class, 'file'])->name('file');
        Route::post('upload', [BankController::class, 'upload'])->name('upload');
    });

    Route::get('/download/userFiles/{file}', [BankController::class, 'download'])->name('download');
    Route::get('/delete/userFiles/{file}/delete', [BankController::class, 'deleteFile'])->name('delete'); 
    Route::get('/dashboard', [BankController::class, 'dashboard']);
});