<?php

use App\Http\Controllers\ProdukController;
use App\Http\Controllers\UserController;
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

Route::middleware(['auth'])->group(function () {
    
    Route::get('/', [ProdukController::class, 'index']);
    Route::resource('/produk', ProdukController::class);

    Route::get('/profil', [UserController::class, 'index']);
    Route::put('/profil/{id}', [UserController::class, 'update']);
});

Auth::routes();
