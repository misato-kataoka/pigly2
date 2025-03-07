<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WeightTarget;

class WeightTargetTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        WeightTarget::create([
            'user_id' => 1, // ユーザーID
            'target_weight' => 40.0, // 目標体重
        ]);
    }
}
