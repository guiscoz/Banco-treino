<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountDisplayController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;

Route::get('/', [HomeController::class, 'index'])->name('index');

Route::group(['middleware' => 'auth'], function(){
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

    Route::group(['prefix' => 'accounts'], function () {
        Route::get('create', [BankController::class, 'create'])->name('createAccount');
        Route::post('store', [BankController::class, 'store'])->name('storeAccount');
        Route::delete('{id}', [BankController::class, 'destroy'])->name('destroyAccount');
        Route::get('edit/{id}', [BankController::class, 'edit'])->name('editAccount');
        Route::put('update/{id}', [BankController::class, 'update'])->name('updateAccount');
        Route::get('file', [FileController::class, 'file'])->name('file');
        Route::post('upload', [FileController::class, 'upload'])->name('upload');
    });

    Route::get('/download/userFiles/{file}', [FileController::class, 'download'])->name('download');
    Route::get('/delete/userFiles/{file}/delete', [FileController::class, 'deleteFile'])->name('delete');

    Route::group(['prefix' => 'user'], function () {
        Route::get('', [UserController::class, 'index'])->name('users');
        Route::post('', [UserController::class, 'index'])->name('users');
        Route::get('/{user}/roles', [UserController::class, 'roles'])->name('user.roles');
        Route::put('/{user}/roles/sync', [UserController::class, 'rolesSync'])->name('user.rolesSync');
        Route::get('/create', [UserController::class, 'create'])->name('createUser');
        Route::post('/store', [UserController::class, 'store'])->name('storeUser');
        Route::put('/show', [UserController::class, 'show'])->name('showUsers');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('editUser');
        Route::put('/update/{id}', [UserController::class, 'update'])->name('updateUser');
        Route::delete('/delete/{id}', [UserController::class, 'destroy'])->name('destroyUser');
    });

    Route::group(['prefix' => 'role'], function () {
        Route::get('', [RoleController::class, 'index'])->name('roles');
        Route::get('/{role}/permissions', [RoleController::class, 'permissions'])->name('role.permissions');
        Route::put('/{role}/permissions/sync', [RoleController::class, 'permissionsSync'])->name('role.permissionsSync');
        Route::get('/create', [RoleController::class, 'create'])->name('createRole');
        Route::post('/store', [RoleController::class, 'store'])->name('storeRole');
        Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('editRole');
        Route::put('/update/{id}', [RoleController::class, 'update'])->name('updateRole');
        Route::delete('/delete/{id}', [RoleController::class, 'destroy'])->name('destroyRole');
    });

    Route::group(['prefix' => 'permission'], function () {
        Route::get('', [PermissionController::class, 'index'])->name('permissions');
        Route::get('/create', [PermissionController::class, 'create'])->name('createPermission');
        Route::post('/store', [PermissionController::class, 'store'])->name('storePermission');
        Route::get('/edit/{id}', [PermissionController::class, 'edit'])->name('editPermission');
        Route::put('/update/{id}', [PermissionController::class, 'update'])->name('updatePermission');
        Route::delete('/delete/{id}', [PermissionController::class, 'destroy'])->name('destroyPermission');
    });

    Route::name('user_accounts.')->group(function () {
        Route::get('user_accounts', [AccountDisplayController::class, 'index'])->name('index');
        Route::get('user_accounts/bank_list/{userId}', [AccountDisplayController::class, 'bank_list'])->name('bank_list');
        Route::get('user_accounts/bank_list/bank/{bankId}', [AccountDisplayController::class, 'user_account'])->name('user_account');
        Route::delete('user_accounts/bank_list/bank/delete/{bankId}', [AccountDisplayController::class, 'delete'])->name('delete');
    });

    Route::name('locations.')->group(function () {
        Route::get('locations', [LocationController::class, 'index'])->name('index');
        Route::get('locations/store', [LocationController::class, 'store'])->name('store');
        Route::get('locations/update/{id}', [LocationController::class, 'update'])->name('update');
    });
});