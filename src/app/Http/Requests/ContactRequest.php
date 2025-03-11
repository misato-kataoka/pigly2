<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        // リクエストのURIに基づいてバリデーションルールを変更
        if ($this->route()->getName() === 'register.step1') {
            return [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:8|confirmed',
            ];
        }

        if ($this->route()->getName() === 'register.step2') {
            return [
                'weight' => 'required|numeric|digits_between:1,4|regex:/^\d+(\.\d{1})?$/', // 数値で4桁以内かつ小数点1桁まで
                'target_weight' => 'required|numeric|digits_between:1,4|regex:/^\d+(\.\d{1})?$/', // 数値で4桁以内かつ小数点1桁まで
            ];
        }

        return [];
    }

    public function messages()
    {
        return [
            'name.required' => '名前を入力してください',
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => 'メールアドレスは「ユーザー名@ドメイン」形式で入力してください',
            'password.required' => 'パスワードを入力してください',
            'weight.required' => '現在の体重を入力してください',
            'weight.numeric' => '現在の体重は数値で入力してください',
            'weight.digits_between' => '現在の体重は4桁以内で入力してください',
            'weight.regex' => '現在の体重は小数点1桁で入力してください',
            'target_weight.required' => '目標体重を入力してください',
            'target_weight.numeric' => '目標体重は数値で入力してください',
            'target_weight.digits_between' => '目標体重は4桁以内で入力してください',
            'target_weight.regex' => '目標体重は小数点1桁で入力してください',
        ];
    }
}


