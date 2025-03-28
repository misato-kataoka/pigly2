<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
//use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user=[
            'name'=>'sample',
            'email'=>'hoge@example.com',
            'password'=>Hash::make('hoge1234')
        ];
        DB::table('users')->insert($user);
        $weight_target=[
            'user_id'=>1,
            'target_weight'=>40.0
        ];
        DB::table('weight_targets')->insert($weight_target);
        $weight_log=[
            'user_id'=>1,
            'weight'=>45.0,
            'calories'=>1200,
            'exercise_time'=>'02:20:00',
            'date'=>'2025-01-15'
        ];
        DB::table('weight_logs')->insert($weight_log);
    }
}

    /*public function run()
    {
        User::factory()->create([
            'name' => 'テストユーザー',
            'email' => 'testuser@example.com',
            'password' => bcrypt('password'),
        ]);
    }
}*/

