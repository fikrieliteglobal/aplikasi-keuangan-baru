<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'halamanIndex']);

Route::get('/contoh', [HomeController::class, 'contoh']);

Route::post('/simpanKategori', [HomeController::class, 'simpanKategori']);

Route::post('/ubahKategori', [HomeController::class, 'ubahKategori']);

Route::get('/deleteKategori/{id}', [HomeController::class, 'deleteKategori']);

Route::get('/halamanPemasukan', [HomeController::class, 'halamanPemasukan']);

Route::post('/simpanPemasukan', [HomeController::class, 'simpanPemasukan']);

Route::get('/deletePemasukan/{id}', [HomeController::class, 'deletePemasukan']);

Route::get('/halamanPengeluaran', [HomeController::class, 'halamanPengeluaran']);

Route::post('/simpanPengeluaran', [HomeController::class, 'simpanPengeluaran']);

Route::get('/deletePengeluaran/{id}', [HomeController::class, 'deletePengeluaran']);

Route::get('/halamanDashboard', [HomeController::class, 'halamanDashboard']);

Route::post('/dataCharts', [HomeController::class, 'dataCharts']);