<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| 公開ルート（認証不要）
|--------------------------------------------------------------------------
| 認証が不要なページに関するルートを定義します。
*/

// トップページ（従業員一覧）
Route::get('/', [EmployeeController::class, 'index']);

// 従業員一覧ページ
Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');

// お知らせページ
Route::get('/info', [InfoController::class, 'show'])->name('info');

// お問い合わせフォーム
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

/*
|--------------------------------------------------------------------------
| 認証関連ルート
|--------------------------------------------------------------------------
| ユーザー認証（ログイン・ログアウト）に関するルートを定義します。
*/

// ログインページ
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// ログイン処理
Route::post('/login', [AuthController::class, 'login']);

// ログアウト処理
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| 認証が必要なルート
|--------------------------------------------------------------------------
| ログイン済みユーザーのみがアクセスできるルートを定義します。
*/

Route::middleware('auth')->group(function () {
    // 従業員管理（CRUD操作）
    Route::resource('employees', EmployeeController::class)->except('index');
});

