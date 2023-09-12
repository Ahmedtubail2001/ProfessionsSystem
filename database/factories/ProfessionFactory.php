<?php

namespace Database\Factories;

use App\Models\Profession;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profession>
 */
class ProfessionFactory extends Factory
{
    protected $model = Profession::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //
            'title' => $this->faker->jobTitle(),
            'description' => $this->faker->sentence(),
            'allow_register' => $this->faker->boolean(),
            'specialtie_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}
