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
            <button class="settings-button">目標体重設定</button>>
            <button class="logout-button">ログアウト</button>
        </div>
    </header>

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
        <input type="number" name="target_weight" step="0.1" value="{{ $weightTarget ? $weightTarget->target_weight : '' }}" required>
        <span class="unit">kg</span>
            <div class="button-group">
                <a href="{{ route('weight_logs.index') }}" class="back-button">戻る</a>
                <button type="submit" class="update-button">更新</button>
            </div>
        </form>
    </div>
</body>
</html>