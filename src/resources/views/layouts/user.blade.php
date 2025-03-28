<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/user.css') }}">
    @yield('css')
    <title>PiGLy 管理画面</title>
</head>
<body>
    <header>
        <a href="/weight_logs">
            <h1>PiGLy</h1>
        </a>
        
            <div class="header-buttons">
                <button class="settings-button" onclick="location.href='{{ route('goal.setting') }}'">
                    <img src="{{ asset('images/setting.png') }}" alt="設定" class="settings-button-icon" style="width: 20px; height: 20px; margin-right: 5px;">目標体重設定
                </button>
                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="logout-button">
                        <img src="{{ asset('images/logout.png') }}" alt="ログアウト" class="logout-button-icon" style="width: 20px; height: 20px; margin-right: 5px;">ログアウト
                    </button>
                </form>
            </div>
    </header>

        <main>
            @yield('content')
        </main>
</body>
