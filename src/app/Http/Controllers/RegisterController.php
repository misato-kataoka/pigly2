<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('register.step1'); // 登録フォームのビューを返す
    }

    public function register(ContactRequest $request)
    {
        // ユーザーを作成
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // パスワードをハッシュ化
        ]);

        // 自動的にログイン
        Auth::login(User::where('email', $request->email)->first());

        // 登録後のリダイレクト
        return redirect()->route('weight_logs.index')->with('success', '登録が完了しました。');
    }
}