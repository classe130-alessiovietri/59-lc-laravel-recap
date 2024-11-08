<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Helpers
use Illuminate\Support\Facades\Schema;

// Models
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Schema::disableForeignKeyConstraints();
        // Category::truncate();
        // Schema::enableForeignKeyConstraints();

        /* OPPURE */

        Schema::withoutForeignKeyConstraints(function () {
            Category::truncate();
        });

        $allCategories = [
            'HTML',
            'CSS',
            'JavaScript',
            'Vue',
            'SQL',
            'PHP',
            'Laravel'
        ];

        foreach ($allCategories as $singleCategory) {
            $category = Category::create([
                'name' => $singleCategory,
                'slug' => Category::getUniqueSlug($singleCategory),
            ]);
        }
    }
}
