<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Helpers
use Illuminate\Support\Facades\Schema;

// Models
use App\Models\{
    Post,
    Category,
    Tag
};

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::withoutForeignKeyConstraints(function () {
            Post::truncate();
        });

        for ($i = 0; $i < 100; $i++) {
            $name = fake()->sentence();
            $slug = str()->slug($name);

            $randomCategoryId = null;
            if (rand(0, 1)) {
                /* Prendo una categoria casuale dal db */
                $randomCategory = Category::inRandomOrder()->first();
                $randomCategoryId = $randomCategory->id;
            }

            $post = Post::create([
                'title' => $name,
                'slug' => $slug,
                'content' => fake()->paragraph(),
                'cover' => fake()->optional()->imageUrl(),
                'likes' => rand(0, 999),
                'published' => fake()->boolean(70),
                'category_id' => $randomCategoryId
            ]);

            $tagIds = [];
            $tagsCount = Tag::count();
            for ($j = 0; $j < rand(0, $tagsCount); $j++) {
                $randomTag = Tag::inRandomOrder()->first();

                if (!in_array($randomTag->id, $tagIds)) {
                    $tagIds[] = $randomTag->id;
                }
            }

            $post->tags()->sync($tagIds);
        }
    }
}
