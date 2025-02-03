<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExpenseController;

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

// ログイン処理
Route::post('/login', [AuthController::class, 'login'])->withoutMiddleware(['throttle:login']);

// 認証が必要なルート
Route::middleware('auth')->group(function () {
    // トップページ（カレンダー画面）
    Route::get('/', [AuthController::class, 'index'])->name('home');
});

// カレンダー専用ページ（必要であれば）
Route::get('/calendar', function () {
    return view('layouts.calendar');
});

Route::resource('expenses', ExpenseController::class);
