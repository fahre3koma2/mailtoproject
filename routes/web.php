<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KirimEmailController;
use App\Http\Controllers\UserController;

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
    return view('dashboard');
});


Route::resource('/kirimemail', KirimEmailController::class);
Route::get('/kirim/{id}', [KirimEmailController::class, 'send'])->name('kirim');
Route::get('/verifikasi/{id}', [KirimEmailController::class, 'verifikasi'])->name('verifikasi');
Route::resource('/user', UserController::class);
