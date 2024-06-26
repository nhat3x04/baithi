<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mf>
 */
class MfFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $mang=['Toyota','Suzuki','Honda','Vinfast','Ford','wave','Bugati','Lamborgini'];
        return [
           'mf_name'=>fake()->unique()->randomElement($mang),
        ];
    }
}
