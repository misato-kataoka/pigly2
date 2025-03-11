<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WeightLog;
use App\Models\User; // Userモデルをuse

class WeightLogTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ユーザーを取得 (例: 最初のユーザー)
        $user = User::first();

        // ユーザーが存在する場合のみWeightLogを作成
        if ($user) {
            WeightLog::factory()->count(35)->create([
                'user_id' => $user->id, // ユーザーIDを関連付ける
            ]);
        } else {
            // ユーザーが存在しない場合の処理 (例: エラーログを出力)
            \Log::error('No users found to associate with WeightLog entries.');
        }
    }
}