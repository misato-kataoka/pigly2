@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/step2.css') }}">
@endsection

@section('content')

    <h2>新規会員登録</h2>
    <p>STEP2 体重データの入力</p>
    <form action="{{ route('register.step2.post') }}" method="POST">
        @csrf

        <label for="weight">現在の体重</label>
            <input type="text" id="weight" name="weight" placeholder="現在の体重を入力" value="{{ old('weight') }}">kg
            <p class="weight__error-message">
                @error('weight')
                    {{ $message }}
                @enderror
            </p>

        <label for="target-weight">目標の体重</label>
            <input type="text" id="target-weight" name="target-weight" placeholder="目標の体重を入力" value="{{ old('target-weight') }}">kg
            <p class="weight__error-message">
                @error('target_weight')
                    {{ $message }}
                @enderror
            </p>

        <button type="submit">アカウント作成</button>
    </form>
@endsection