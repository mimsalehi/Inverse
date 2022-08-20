<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'slug' => $this->faker->slug,
            'title' => $this->faker->domainName,
            'description' => $this->faker->text(150),
            'price' => (rand(5,30) * (10 ** 5)), // between 500,000 and 3,000,000
            'rating' => (rand(0, 10) * 0.5) // between 0.00 and 5.00
        ];
    }
}
