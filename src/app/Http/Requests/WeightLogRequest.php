<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WeightLogRequest extends FormRequest
{
    public function authorize()
    {
        return true; // 認可を許可
    }

    public function rules()
    {
        return [
            'date' => 'required',
            'weight' => 'required|numeric|digits_between:1,4|regex:/^\d+(\.\d{1})?$/',
            'calories' => 'required|numeric|min:0',
            'exercise_time' => 'required',
            'exercise_content' => 'nullable|max:120',
            'target_weight' => 'required|numeric|digits_between:1,4|regex:/^\d+(\.\d{1})?$/',
        ];
    }

    public function messages()
    {
        return [
            'date.required' => '日付を入力してください',
            'weight.required' => '体重を入力してください',
            'weight.numeric' => '数字で入力してください',
            'weight.digits_between' => '4桁までの数字で入力してください',
            'weight.regex' => '小数点は1桁で入力してください',
            'calories.required' => '摂取カロリーを入力してください',
            'calories.numeric' => '数字で入力してください',
            'exercise_time.required' => '運動時間を入力してください。',
            'exercise_content.max' => '120文字以内で入力してください。',
            'target_weight.required' => '目標の体重を入力してください',
            'target_weight.numeric' => '数字で入力してください',
            'target_weight.digits_between' => '4桁までの数字で入力してください',
            'target_weight.regex' => '小数点は1桁で入力してください',
        ];
    }
}