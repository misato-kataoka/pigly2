<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <title>PiGLy 管理画面</title>
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
        <div class="header-underline"></div>

    <div class="container">
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

        <div class="search-table-container">
            <div class="search-section">
                <form action="{{ route('weight_logs.search') }}" method="GET">
                    <select name="start_date" class="date-select">
                        <option value="">開始日</option>
                        @foreach ($dates as $date)
                            <option value="{{ $date }}">{{ $date }}</option>
                        @endforeach
                    </select>
                    <span class="separator">～</span>
                    <select name="end_date" class="date-select">
                        <option value="">終了日</option>
                        @foreach ($dates as $date)
                            <option value="{{ $date }}">{{ $date }}</option>
                        @endforeach
                    </select>

                    <button type="submit" class="search-button">検索</button>
                    <label for="modal-toggle" class="add-data-button">データ追加</label> <!-- データ追加ボタン -->
                </form>
            </div>

        <input type="checkbox" id="modal-toggle" style="display:none;" {{ $errors->any() ? 'checked' : '' }} />

        <div id="addWeightLogModal" class="modal">
            <div class="modal-content">
                <h2>Weight Logを追加</h2>
                <form id="weightLogForm" method="POST" action="{{ route('weight_logs.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="date">日付<span class="required">必須</span></label>
                        <input type="date" name="date" id="date" value="{{ date('Y-m-d') }}" value="{{ old('date')}}">
                    </div>
                    <p class="weight_log__error-message">
                        @error('date')
                        {{ $message }}
                        @enderror
                    </p>

                    <div class="form-group">
                        <label for="weight">体重<span class="required">必須</span></label>
                        <div class="input-group">
                            <input type="number" name="weight" step="0.1" placeholder="50.0" value="{{ old('weight')}}">
                            <span class="unit">kg</span>
                        </div>
                    </div>
                    <p class="weight_log__error-message">
                        @if ($errors->has('weight'))
                            @foreach ($errors->get('weight') as $message)
                                <span>{{ $message }}</span><br>
                            @endforeach
                        @endif
                    </p>

                    <div class="form-group">
                        <label for="calories">食事摂取カロリー<span class="required">必須</span></label>
                        <div class="input-group">
                            <input type="number" name="calories" placeholder="1200" value="{{ old('calories')}}">
                            <span class="unit">cal</span>
                        </div>
                    </div>
                    <p class="weight_log__error-message">
                        @if ($errors->has('calories'))
                            @foreach ($errors->get('calories') as $message)
                                <span>{{ $message }}</span><br>
                            @endforeach
                        @endif
                    </p>

                    <div class="form-group">
                        <label for="exercise_time">運動時間<span class="required">必須</span></label>
                        <input type="time" name="exercise_time" placeholder="00:00" value="{{ old('exercise_time')}}">
                    </div>
                    <p class="weight_log__error-message">
                        @if ($errors->has('exercise_time'))
                            @foreach ($errors->get('exercise_time') as $message)
                                <span>{{ $message }}</span><br>
                            @endforeach
                        @endif
                    </p>

                    <div class="form-group">
                        <label for="exercise_content">運動内容</label>
                        <textarea name="exercise_content" placeholder="運動内容を追加" value="{{ old('exercise_content')}}"></textarea>
                    </div>
                    <p class="weight_log__error-message">
                        @if ($errors->has('exercise_content'))
                            @foreach ($errors->get('exercise_content') as $message)
                                <span>{{ $message }}</span><br>
                            @endforeach
                        @endif
                    </p>

                    <div class="button-group">
                        <a href="#!" class="cancel-button" onclick="document.getElementById('modal-toggle').checked = false;">戻る</a>
                        <button type="submit" class="submit-button">登録</button>
                    </div>
                </form>
            </div>
        </div>

        <!--<button class="add-data-button" onclick="location.href='{{ route('weight_logs.create') }}'">データ追加</button> <!-- データ追加へのリンク -->

            <div class="table-section">
                <table>
                    <thead>
                        <tr>
                            <th style="width: 35%;">日付</th>
                            <th style="width: 20%;">体重</th>
                            <th style="width: 20%;">食事摂取カロリー</th>
                            <th style="width: 15%;">運動時間</th>
                            <th style="width: 10%;">編集</th>
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
            </div>
        </div>

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

    </div>
</body>
</html>