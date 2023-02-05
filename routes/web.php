<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DiaryController;
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

Route::middleware('auth')->group(function(){
    Route::get('/',[DiaryController::class,'index']);

    Route::post('/',[DiaryController::class,'store']);

    Route::put('/{id}',[DiaryController::class,'update']);

    Route::delete('/{id}',[DiaryController::class,'destroy']);

    Route::post('/logout',[AuthController::class,'logout']);
});

// Route::resource('/', DiaryController::class)->middleware('auth');

Route::middleware('guest')->group(function(){
    Route::get('/sign+in', [AuthController::class,'index'])->name("signin");

    Route::post('/sign+in', [AuthController::class,'authentication'])->name('authLogin');

    Route::get('/regist',[AuthController::class,'create'])->name('signup');

    Route::post('/regist',[AuthController::class,'store'])->name('createAccount');
});
