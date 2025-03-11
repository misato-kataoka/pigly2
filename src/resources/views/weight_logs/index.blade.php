<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <title>PiGLy 管理画面</title>
</head>
<body>
    <div class="container">
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
        <div class="header-underline"></div>

        <div class="goal-info">
            <div class="goal-weight">
                <span>目標体重</span>
                <span>{{ $weightTarget ? $weightTarget->target_weight : '設定なし' }} kg</span>
            </div>
            <div class="goal-difference">
                <span>目標まで</span>
                <span>{{ $weightTarget ? ($weightTarget->target_weight - $currentWeight) : '設定なし' }} kg</span>
            </div>
            <div class="latest-weight">
                <span>最新体重</span>
                <span>{{ $latestWeight ? $latestWeight->weight : 'データなし' }} kg</span>
            </div>
        </div>

        <div class="search-section">
            <form action="{{ route('weight_logs.search') }}" method="GET">
                <select name="start_date">
                    <option value="">開始日</option>
                    @foreach ($dates as $date)
                        <option value="{{ $date }}">{{ $date }}</option>
                    @endforeach
                </select>
                <span>～</span>
                <select name="end_date">
                    <option value="">終了日</option>
                    @foreach ($dates as $date)
                        <option value="{{ $date }}">{{ $date }}</option>
                    @endforeach
                </select>
                <button type="submit" class="search-button">検索</button>
            </form>
        </div>

        <table>
            <thead>
                <tr>
                    <th>日付</th>
                    <th>体重</th>
                    <th>食事摂取カロリー</th>
                    <th>運動時間</th>
                    <th>編集</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($weightLogs as $log)
                <tr>
                    <td>{{ $log->date }}</td>
                    <td>{{ $log->weight }}kg</td>
                    <td>{{ $log->calories }}cal</td>
                    <td>{{ $log->exercise_time }}</td>
                    <td>
                        <button class="edit-button" onclick="location.href='{{ route('weight_logs.edit', $log->id) }}'">✎</button> <!-- 編集ボタン -->
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="pagination">
            @if ($weightLogs->hasPages())
                <a href="{{ $weightLogs->previousPageUrl() }}" class="prev-button">&lt;</a>

                @php
                    $currentPage = $weightLogs->currentPage();
                    $lastPage = $weightLogs->lastPage();
                    $startPage = max(1, $currentPage - 1); // 現在のページの1つ前から表示
                    $endPage = min($lastPage, $currentPage + 2); // 現在のページの1つ後まで表示
                @endphp

                @for ($page = $startPage; $page <= $endPage; $page++)
                    @if ($page == $currentPage)
                        <span class="active">{{ $page }}</span>
                    @else
                        <a href="{{ $weightLogs->url($page) }}">{{ $page }}</a>
                    @endif
                @endfor

                <a href="{{ $weightLogs->nextPageUrl() }}" class="next-button">&gt;</a>
            @else
                <span>データがありません</span>
            @endif
        </div>

        <button class="add-data-button" onclick="location.href='{{ route('weight_logs.create') }}'">データ追加</button> <!-- データ追加へのリンク -->
    </div>
</body>
</html>