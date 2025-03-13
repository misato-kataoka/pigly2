<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/goal_setting.css') }}">
    <title>目標体重設定</title>
</head>

<body>
    <header>
        <h1>PiGLy</h1>
        <div class="header-buttons">
            <button class="settings-button" onclick="location.href='{{ route('goal.setting') }}'">目標体重設定</button>
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="logout-button">ログアウト</button>
                </form>
        </div>
    </header>
@extends('layouts.user')

@section('css')
<link rel="stylesheet" href="{{ asset('css/goal_setting.css') }}">
@endsection

@section('content')

    <div class="container">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <h2>目標体重設定</h2>
        <form action="{{ route('goal.setting.update') }}" method="POST">
            @csrf
            <input type="number" name="target_weight" step="0.1" value="{{ old('target_weight', $weightTarget ? $weightTarget->target_weight : '')}}">
            <span class="unit">kg</span>
                <p class="target_weight__error-message">
                    @if ($errors->has('target_weight'))
                        @foreach ($errors->get('target_weight') as $message)
                            <span>{{ $message }}</span><br>
                        @endforeach
                    @endif
                </p>

            <div class="button-group">
                <a href="{{ route('weight_logs.index') }}" class="back-button">戻る</a>
                <button type="submit" class="update-button">更新</button>
            </div>
        </form>
    </div>
@endsection
