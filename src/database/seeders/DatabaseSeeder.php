<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WeightLog;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // UserSeederを呼び出す
        $this->call(UserTableSeeder::class);
        // WeightLogのダミーデータを35件作成
        WeightLog::factory()->count(35)->create();
    }
}
