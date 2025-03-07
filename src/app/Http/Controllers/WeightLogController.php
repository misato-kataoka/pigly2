<?php

/*namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WeightLog;
use App\Models\WeightTarget;

class WeightLogController extends Controller
{
    public function admin()
    {
        // weight_logsのデータを取得
        $weightLogs = WeightLog::where('user_id', 1)->paginate(8);

        // weight_targetテーブルから目標体重を取得
        $weightTarget = WeightTarget::where('user_id', 1)->first(); // ユーザーIDに基づいて取得

        // 最新の体重を取得
        $latestWeight = WeightLog::where('user_id', 1)->latest()->first()->weight ?? 0; // 最新の体重を取得

        return view('weight_logs.admin', compact('weightLogs', 'weightTarget', 'latestWeight'));
    }
}*/

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest; // ContactRequestをインポート
use App\Models\WeightLog;
use Illuminate\Http\Request;

class WeightLogController extends Controller
{
    public function index()
    {
        $weightLogs = WeightLog::where('user_id', auth()->id())->get(); // 認証ユーザーの体重ログを取得
        return view('weight_logs.index', compact('weightLogs')); // ビューを返す
    }

    public function create()
    {
        return view('weight_logs.create'); // 体重登録フォームのビューを返す
    }

    public function store(ContactRequest $request) // ContactRequestを使用
    {
        WeightLog::create([
            'user_id' => auth()->id(),
            'weight' => $request->weight,
            'date' => $request->date,
            'calories' => 0,
            'exercise_time' => '00:00',
            'exercise_content' => '',
        ]);

        return redirect()->route('weight_logs.index')->with('success', '体重が登録されました。');
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

    public function update(ContactRequest $request, $weightLogId) // ContactRequestを使用
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

    public function goalSetting()
    {
        return view('weight_logs.goal_setting'); // 目標設定のビューを返す
    }
}
