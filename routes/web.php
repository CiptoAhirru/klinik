<?php

use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\ListPendaftaranController;

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
    // $user = JWTAuth::user();
    return view('welcome');
});



Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/pendaftaran', [PendaftaranController::class, 'index'])->name('pendaftaran');
Route::post('/pendaftaran/dokter', [PendaftaranController::class, 'dokter'])->name('pendaftaran.dokter');
Route::post('/pendaftaran/save', [PendaftaranController::class, 'save'])->name('pendaftaran.save');
Route::post('/pendaftaran/history', [PendaftaranController::class, 'history'])->name('pendaftaran.history');


Route::get('/listpendaftaran', [ListPendaftaranController::class, 'index'])->name('listpendaftaran');
Route::post('/listpendaftaran/save', [ListPendaftaranController::class, 'save'])->name('listpendaftaran.save');
Route::post('/listpendaftaran/history', [ListPendaftaranController::class, 'history'])->name('listpendaftaran.history');
