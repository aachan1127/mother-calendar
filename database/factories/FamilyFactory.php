<?php

namespace Database\Factories;

use App\Models\Family;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Family>
 */
class FamilyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //Fakerというライブラリを使って、架空の名字を生成
            'name' => fake()->lastName() . '家',
            // 8桁の数字で構成された文字列を生成
            'invite_code' => fake()->unique()->numerify('########'),
            // 家族を作成したユーザーを指定せずに生成
            'created_by' => null,
        ];
    }
}
