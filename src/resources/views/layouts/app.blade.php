<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}" />
    @yield('css')
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+JP:wght@400&display=swap" rel="stylesheet">
    <title>PiGLy</title>
</head>

<body>
    <div class="container">
        <div class="form-container">
            <a href="/register/step1" style="text-decoration: none; color: inherit;">
                <h1>PiGLy</h1>
            </a>

            <main>
                @yield('content')
            </main>
        </div>
    </div>
</body>

</html>