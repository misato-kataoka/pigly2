@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/step1.css') }}">
@endsection

@section('content')

    <h2>新規会員登録</h2>
    <p>STEP1 アカウント情報の登録</p>
    <form action="{{ route('register.step1') }}" method="POST">
        @csrf

        <label for="name">お名前</label>
            <input type="text" id="name" name="name" placeholder="名前を入力" value="{{ old('name') }}">
            <p class="register__error-message">
                @error('name')
                    {{ $message }}
                @enderror
            </p>

        <label for="email">メールアドレス</label>
            <input type="email" id="email" name="email" placeholder="メールアドレスを入力" value="{{ old('email') }}">
            <p class="register__error-message">
                @error('email')
                    {{ $message }}
                @enderror
            </p>

        <label for="password">パスワード</label>
            <input type="password" id="password" name="password" placeholder="パスワードを入力">
            <p class="register__error-message">
                @error('password')
                    {{ $message }}
                @enderror
            </p>

        <button type="submit">次に進む</button>
    </form>
    <p><a href="{{ route('login') }}">ログインはこちら</a></p>
@endsection