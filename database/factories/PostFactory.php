<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

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
            //
            'title' => fake() ->sentence,
            'body' => fake()->paragraph(2,true),
            'image' => fake()->imageUrl(), 
            'created_by' => User::factory()->create()->id,
        ];
    }
}
