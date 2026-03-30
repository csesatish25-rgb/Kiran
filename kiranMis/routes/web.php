<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PasswordController;
use App\Http\Middleware\EnsurePasswordChanged;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'create'])->name('login');
Route::post('/login', [AuthController::class, 'store'])->name('login.store');

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');

    Route::get('/admin/password/change', [PasswordController::class, 'edit'])->name('admin.password.edit');
    Route::put('/admin/password/change', [PasswordController::class, 'update'])->name('admin.password.update');

    Route::middleware(EnsurePasswordChanged::class)->group(function () {
        Route::get('/home', [DashboardController::class, 'index'])->name('admin.home');
        Route::redirect('/admin', '/home');
        Route::redirect('/admin/dashboard', '/home');
    });
});
