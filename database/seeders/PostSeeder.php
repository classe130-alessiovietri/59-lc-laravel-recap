<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Models
use App\Models\Post;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Post::truncate();

        for ($i = 0; $i < 10; $i++) {
            $name = fake()->sentence();
            $slug = str()->slug($name);
            Post::create([
                'title' => $name,
                'slug' => $slug,
                'content' => fake()->paragraph(),
                'cover' => fake()->optional()->imageUrl(),
                'likes' => rand(0, 999),
                'published' => fake()->boolean(70),
            ]);
        }
    }
}
