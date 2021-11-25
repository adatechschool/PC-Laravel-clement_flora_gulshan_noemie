<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
{
    return [
        'description' => "Mon chat est trop mignon",
        'img_url' => $this->faker->imageUrl(640, 480, 'cats'),
        'user_id' => 1
    ];
}
}
