<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest; // ContactRequestをインポート
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Laravel\Fortify\Facades\Fortify;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login'); // ログインフォームのビューを返す
    }

    public function login(ContactRequest $request) // ContactRequestを使用
    {
        // 認証試行
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // 認証成功
            return redirect()->intended('/weight_logs')->with('success', 'ログインしました。');
        }

        // 認証失敗
        return back()->withErrors([
            'email' => 'メールアドレスまたはパスワードが間違っています。',
        ])->withInput(); // 入力内容を保持
    }

    public function logout(Request $request)
    {
        Auth::logout(); // ログアウト処理
        return redirect('/login')->with('success', 'ログアウトしました。');
    }
}