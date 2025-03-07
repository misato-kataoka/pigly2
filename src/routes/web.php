<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WeightLogController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use Laravel\Fortify\Facades\Fortify;

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

// 管理画面（体重ログ）
Route::get('/weight_logs', [WeightLogController::class, 'index'])->name('weight_logs.index');

// 体重登録
Route::get('/weight_logs/create', [WeightLogController::class, 'create'])->name('weight_logs.create');
Route::post('/weight_logs', [WeightLogController::class, 'store'])->name('weight_logs.store');

// 体重検索
Route::get('/weight_logs/search', [WeightLogController::class, 'search'])->name('weight_logs.search');

// 体重詳細
Route::get('/weight_logs/{weightLogId}', [WeightLogController::class, 'show'])->name('weight_logs.show');

// 体重更新
Route::get('/weight_logs/{weightLogId}/update', [WeightLogController::class, 'edit'])->name('weight_logs.edit');
Route::post('/weight_logs/{weightLogId}', [WeightLogController::class, 'update'])->name('weight_logs.update');

// 体重削除
Route::post('/weight_logs/{weightLogId}/delete', [WeightLogController::class, 'destroy'])->name('weight_logs.destroy');

// 目標設定
Route::get('/weight_logs/goal_setting', [WeightLogController::class, 'goalSetting'])->name('weight_logs.goal_setting');

// 会員登録
Route::get('/register/step1', [RegisterController::class, 'showRegistrationForm'])->name('register.step1');
Route::post('/register/step1', [RegisterController::class, 'register'])->name('register');

// 初期目標体重登録
Route::get('/register/step2', [WeightLogController::class, 'initialGoalWeight'])->name('register.step2');

// ログイン
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
//Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
//Route::post('/login', [LoginController::class, 'login']);

// ログアウト
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
//Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

/*Fortify::loginView(function () {
    return view('auth.login'); // ログインビューを返す
});*/