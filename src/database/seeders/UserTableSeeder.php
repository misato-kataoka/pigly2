<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name' => 'テストユーザー',
            'email' => 'testuser@example.com',
            'password' => bcrypt('password'),
        ]);
    }
}

