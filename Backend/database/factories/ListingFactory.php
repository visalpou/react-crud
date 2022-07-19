<?php

namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;

class ListingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(),
            'tags' => 'laravel , api , backend',
            'description' => $this->faker->paragraph(),
            'company' => $this->faker->company(),
            'website' => $this->faker->url(),
            'description' => $this->faker->paragraph(5),
        ];
    }
}
