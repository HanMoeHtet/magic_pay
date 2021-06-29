<?php

use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TransactionControler;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware('auth:web')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/profile', [HomeController::class, 'profile'])->name('profile');

    Route::get('/transfer', [HomeController::class, 'transfer_show'])->name('transfer.show');
    Route::post('/confirm-transfer', [HomeController::class, 'transfer_confirm'])->name('transfer.confirm');
    Route::post('/transfer', [HomeController::class, 'transfer_store'])->name('transfer.store');
    Route::get('/receive_qr', [HomeController::class, 'receive_qr'])->name('receive_qr');
    Route::get('/scan_and_pay', [HomeController::class, 'scan_and_pay'])->name('scan_and_pay');

    Route::get('/transactions', [TransactionControler::class, 'index'])->name('transactions.index');
    Route::get('/transactions/datatable', [TransactionControler::class, 'datatable']);
    Route::get('/transactions/{transaction}', [TransactionControler::class, 'show'])->name('transactions.show');


    Route::get('/reset-password', [HomeController::class, 'reset_password_edit'])->name('password_reset.edit');
    Route::post('/reset-password', [HomeController::class, 'reset_password_update'])->name('password_reset.update');
});

Route::get('/dashboard/login', [LoginController::class, 'showLoginForm']);
Route::post('/dashboard/login', [LoginController::class, 'login'])->name('admin.login');
Route::post('/dashboard/logout', [LoginController::class, 'logout'])->name('admin.logout');
