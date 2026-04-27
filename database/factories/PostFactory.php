<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'content' => $this->faker->paragraph(3, true),
            'slug' => $this->faker->slug(),
            'image' => $this->faker->imageUrl(),
            'category_id' => Category::inRandomOrder()->first()->id,
            'user_id' => User::query()->inRandomOrder()->value('id') ?? User::factory(),
            'published_at' => fake()->optional()->dateTime(),
        ];
    }
}
