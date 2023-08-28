<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'category_id'=>mt_rand(1,5),
            'user_id'=>mt_rand(1,4),
            'title'=> $this->faker->sentence(mt_rand(1,4)),
            'slug'=> $this->faker->paragraph(mt_rand(1,3)),
            'excerpt'=> $this->faker->paragraph(mt_rand(3,9)),
            'body'=>$this->faker->paragraph(mt_rand(30,50)),
           
        ];
    }
}
