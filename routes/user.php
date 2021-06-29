<?php

use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:admin')->group(function () {
  Route::get('users/datatable', [UserController::class, 'datatable']);

  Route::get('users', [UserController::class, 'index'])->name('users.index');
  Route::delete('users/{id}', [UserController::class, 'destroy'])->name('users.destory');
});
