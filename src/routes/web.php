<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExpenseController;

// ✅ ログイン画面（ログインフォームを表示）
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// ✅ ログイン処理（POST）
Route::post('/login', [AuthController::class, 'login'])->withoutMiddleware(['throttle:login']);

// 認証が必要なルート
Route::middleware('auth')->group(function () {
    // ✅ トップページ（カレンダー画面）
    Route::get('/calendar', [AuthController::class, 'index'])->name('calendar');
});

// ✅ 支出管理用ルート
Route::resource('expenses', ExpenseController::class);
