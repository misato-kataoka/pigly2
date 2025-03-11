<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/step1.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+JP:wght@400&display=swap" rel="stylesheet">
    <title>PiGLy 新規会員登録 Step1</title>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <a href="/register/step1" style="text-decoration: none; color: inherit;">
                <h1>PiGLy</h1>
            </a>
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
        </div>
    </div>
</body>
</html>