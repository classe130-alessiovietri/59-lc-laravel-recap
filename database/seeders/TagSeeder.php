<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Helpers
use Illuminate\Support\Facades\Schema;

// Models
use App\Models\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Schema::disableForeignKeyConstraints();
        // Tag::truncate();
        // Schema::enableForeignKeyConstraints();

        /* OPPURE */

        Schema::withoutForeignKeyConstraints(function () {
            Tag::truncate();
        });

        $allTags = [
            'News',
            'Frontend',
            'Backend',
            'Web',
            'Software',
            'Hardware',
            'Cloud',
            'AI',
            'Learning',
            'Tutorial',
            'Guide',
            'Ethical Hacking'
        ];

        foreach ($allTags as $singleTag) {
            $tag = Tag::create([
                'name' => $singleTag,
                'slug' => str()->slug($singleTag),
            ]);
        }
    }
}
