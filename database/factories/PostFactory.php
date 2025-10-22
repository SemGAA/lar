<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'slug' => $this->faker->slug(),
            'content' => $this->faker->paragraphs(3, true),
            'excerpt' => $this->faker->sentence(),
            'is_published' => $this->faker->boolean(80),
            'published_at' => $this->faker->dateTimeThisYear(),
        ];
    }
}