<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Http\Requests\WeightLogRequest;
use App\Models\WeightLog;
use App\Models\WeightTarget;
use Illuminate\Http\Request;

class WeightLogController extends Controller
{
    public function index()
    {
        $weightLogs = WeightLog::where('user_id', auth()->id())->paginate(8); // 認証ユーザーの体重ログを取得
        $weightTarget = WeightTarget::where('user_id', auth()->id())->first(); // ユーザーの目標体重を取得
        $latestWeight = WeightLog::where('user_id', auth()->id())->latest()->first(); // 最新の体重を取得

        $currentWeight = $latestWeight ? $latestWeight->weight : 0; // 最新の体重が存在する場合、体重を取得し、存在しない場合は0を設定

        $dates = WeightLog::where('user_id', auth()->id())->pluck('date')->unique(); // ユーザーの体重ログから日付を取得

        return view('weight_logs.index', compact('weightLogs', 'weightTarget', 'latestWeight', 'currentWeight', 'dates')); // ビューを返す
    }

    public function create()
    {
        return view('weight_logs.create'); // 体重登録フォームのビューを返す
    }

    public function goalSetting()
    {

        $weightTarget = WeightTarget::where('user_id', auth()->id())->first();
        return view('weight_logs.goal_setting', compact('weightTarget')); // 目標設定のビューを返す

        return redirect()->route('weight_logs.index')->with('success', '目標体重が更新されました。');
    }

    public function updateGoalWeight(WeightLogRequest $request)
    {
        $validatedData = $request->validated(); // バリデーションされたデータを取得

        // ユーザーIDに基づいて目標体重を取得
        $weightTarget = WeightTarget::where('user_id', auth()->id())->first();

        if ($weightTarget) {
            // 既存のレコードがある場合は更新
            $weightTarget->update(['target_weight' => $validatedData['target_weight']]);
        } else {
            // 新規作成する場合
            WeightTarget::create([
                'user_id' => auth()->id(),
                'target_weight' => $validatedData['target_weight'],
            ]);
        }

        // weight_logs.indexへリダイレクト
        return redirect()->route('weight_logs.index')->with('success', '目標体重が更新されました。');
    }

    public function store(WeightLogRequest $request)
    {
        WeightLog::create([
            'user_id' => auth()->id(),
            'weight' => $request->weight,
            'date' => $request->date,
            'calories' => 0,
            'exercise_time' => '00:00',
            'exercise_content' => '',
        ]);
        WeightLog::create($request->all());

        return redirect()->route('weight_logs.index')->with('success', '体重が登録されました。');
    }

    public function search(Request $request)
    {
        // 検索処理
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // 体重ログの検索処理
        $weightLogs = WeightLog::where('user_id', auth()->id())
            ->whereBetween('date', [$startDate, $endDate])
            ->paginate(8);

        // ユーザーの目標体重を取得
        $weightTarget = WeightTarget::where('user_id', auth()->id())->first();

        // 最新の体重を取得
        $latestWeight = WeightLog::where('user_id', auth()->id())->latest()->first();

        // 日付のリストを取得
        $dates = WeightLog::where('user_id', auth()->id())->pluck('date')->unique();

        return view('weight_logs.index', compact('weightLogs','weightTarget','latestWeight','dates'));
    }

    public function show($weightLogId)
    {
        $weightLog = WeightLog::findOrFail($weightLogId);
        return view('weight_logs.show', compact('weightLog')); // 体重詳細のビューを返す
    }

    public function edit($weightLogId)
    {
        $weightLog = WeightLog::findOrFail($weightLogId);
        return view('weight_logs.edit', compact('weightLog')); // 体重更新フォームのビューを返す
    }

    public function update(ContactRequest $request, $weightLogId)
    {
        $weightLog = WeightLog::findOrFail($weightLogId);
        $weightLog->update([
            'weight' => $request->weight,
            'date' => $request->date,
        ]);

        return redirect()->route('weight_logs.index')->with('success', '体重が更新されました。');
    }

    public function destroy($weightLogId)
    {
        $weightLog = WeightLog::findOrFail($weightLogId);
        $weightLog->delete();

        return redirect()->route('weight_logs.index')->with('success', '体重が削除されました。');
    }

}
