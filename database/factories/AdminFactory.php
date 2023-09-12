<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'email_verified_at' => now(),
            'password' => '$2y$10$rPduyLNjeRifw5HQfUK7tezOsqEqeeKJCVABRbo9DJiHzNJ3ZmFzG',
        ];
    }
}
