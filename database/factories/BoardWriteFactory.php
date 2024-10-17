<?php

namespace Database\Factories;

use App\Models\BoardWrite;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<BoardWrite>
 */
class BoardWriteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'board_id' => 1,
            'table_id' => 'basic',
            'categories' => fake()->randomElement(['구글','애플','네이버','카카오','페이스북','인스타그램','트위터','유튜브']),
            'user_id' => fake()->numberBetween(1, 3),
            'subject' => fake()->sentence(10),
            'content' => fake()->paragraph(12),
            'hit' => fake()->numberBetween(0, 100),
            'writer' => fake()->name(),
            'ip' => fake()->ipv4(),
        ];
    }
}
