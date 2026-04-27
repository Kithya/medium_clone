<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Technology',
            'Business',
            'Politics',
            'Entertainment',
            'Sports',
            'Health',
            'Science',

        ];

        foreach ($categories as $category) {
            Category::create(['name' => $category]);
        }

        // Post::factory(10)->create();
    }
}
