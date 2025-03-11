<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WeightLogController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
//use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
//use Laravel\Fortify\Facades\Fortify;

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
Route::get('/weight_logs/goal_setting', [WeightLogController::class, 'goalSetting'])->name('goal.setting');
Route::post('/weight_logs/goal_setting', [WeightLogController::class, 'updateGoalWeight'])->name('goal.setting.update');

// 会員登録
Route::get('/register/step1', [RegisterController::class, 'showRegistrationForm'])->name('register.step1');
Route::post('/register/step1', [RegisterController::class, 'register'])->name('register.step1.post');

// 初期目標体重登録
Route::get('/register/step2', [RegisterController::class, 'showStep2Form'])->name('register.step2'); // RegisterControllerに変更
Route::post('/register/step2', [RegisterController::class, 'registerStep2'])->name('register.step2.post'); // RegisterControllerに変更

// ログイン
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// ログアウト
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

/*Fortify::loginView(function () {
    return view('auth.login'); // ログインビューを返す
});*/