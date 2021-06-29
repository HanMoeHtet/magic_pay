<?php

use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\DashBoardController;
use App\Http\Controllers\Admin\RegisterController;
use Illuminate\Support\Facades\Route;

Route::prefix('dashboard')->name('dashboard.')->middleware('auth:admin')->group(function () {
  Route::get('/', [DashBoardController::class, 'dashboard'])->name('index');

  Route::get('admins/datatable', [AdminUserController::class, 'datatable']);

  Route::resource('admins', AdminUserController::class);
});
