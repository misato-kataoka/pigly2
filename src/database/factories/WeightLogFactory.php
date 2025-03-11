<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\WeightLog;

class WeightLogFactory extends Factory
{
    protected $model = WeightLog::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // 特定のユーザーIDを指定
        $userId = 1;

        // 日付の範囲を指定
        $startDate = now()->subDays(50); // 50日前の日付
        $endDate = now(); // 現在の日付

        return [
            'user_id' => $userId,
            'date' => $this->faker->dateTimeBetween($startDate, $endDate)->format('Y-m-d'), // 日付の範囲を指定
            'weight' => $this->faker->randomFloat(1, 40, 45), // 40kgから45kgの範囲
            'calories' => $this->faker->numberBetween(900, 1500), // 900から1500の範囲
            'exercise_time' => $this->faker->time(),
            'exercise_content' => $this->faker->realText(20),
        ];
    }
}
