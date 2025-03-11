<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('register.step1'); // 登録フォームのビューを返す
    }

    public function register(ContactRequest $request)
    {
        $validatedData = $request->validated();

        // セッションにデータを保存
        $request->session()->put('registration_data', $validatedData);

        // step2へリダイレクト
        return redirect()->route('register.step2');
    }

    public function showStep2Form()
    {
        // セッションにstep1のデータがあるか確認
        if (!session()->has('registration_data')) {
            return redirect()->route('register.step1'); // step1に戻す
        }

        return view('register.step2'); // step2のフォームを表示
    }

    public function registerStep2(ContactRequest $request)
    {
        // セッションからstep1のデータを取得
        $registrationData = $request->session()->get('registration_data');

        // データがない場合は、登録画面に戻す
        if (!$registrationData) {
            return redirect()->route('register.step1');
        }

        // ユーザーを作成
        $user = User::create([
            'name' => $registrationData['name'],
            'email' => $registrationData['email'],
            'password' => Hash::make($registrationData['password']), // パスワードをハッシュ化
            'weight' => $request->weight, // step2の体重データ
            'target_weight' => $request->input('target-weight'), // step2の目標体重データ
        ]);

        // 自動的にログイン
        Auth::login($user);

        // セッションデータを削除
        $request->session()->forget('registration_data');

        // 登録後のリダイレクト
        return redirect()->route('weight_logs.index')->with('success', '登録が完了しました。');
    }
}