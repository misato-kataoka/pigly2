<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'weight' => 'required|numeric|digits_between:1,4|regex:/^\d+(\.\d{1})?$/', // 数値で4桁以内かつ小数点1桁まで
            'target-weight' => 'required|numeric|digits_between:1,4|regex:/^\d+(\.\d{1})?$/', // 数値で4桁以内かつ小数点1桁まで
        ];
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
            'target-weight.required' => '目標体重を入力してください',
            'target-weight.numeric' => '目標体重は数値で入力してください',
            'target-weight.digits_between' => '目標体重は4桁以内で入力してください',
            'target-weight.regex' => '目標体重は小数点1桁で入力してください',
        ];
    }
}


