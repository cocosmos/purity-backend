<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $boolean = $this->faker->boolean();
        $minValue = $boolean ? $this->faker->numberBetween(1, 10) : null;
        $maxValue = $boolean ? $this->faker->numberBetween($minValue, $minValue+10) : null;
        return [
            'question' => $this->faker->sentence(),
            'points' => $this->faker->numberBetween(1, 10),
            'min_value' => $minValue,
            'max_value' => $maxValue,
        ];
    }
}
