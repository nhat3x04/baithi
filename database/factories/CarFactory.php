<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'description' => fake()->regexify('[A-Z]{5}[0-4]{3}'),
            'model' => fake()->randomElement(['a', 'b', 'c', 'd', 'e'], 3),
            'product_on' => now(),
            'image' => 'hinh'.rand(1,4).'.png', // Sử dụng đường dẫn tương đối
            'mf_id'=>rand(1,8),
        ];
    }
}
