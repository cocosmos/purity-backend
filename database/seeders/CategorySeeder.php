<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Game;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => ['en' => 'sex'],
                'description' => ['en' => 'Sexual questions'],
                'coefficient' => 1.96,
            ],
            [
                'name' => ['en' => 'drug'],
                'description' => ['en' => 'Drug-related questions'],
                'coefficient' => 3.44,
            ],
            [
                'name' => ['en' => 'alcohol'],
                'description' => ['en' => 'Alcohol-related questions'],
                'coefficient' => 2.78,
            ],
            [
                'name' => ['en' => 'hygiene'],
                'description' => ['en' => 'Hygiene-related questions'],
                'coefficient' => 3.22,
            ],
            [
                'name' => ['en' => 'moral'],
                'description' => ['en' => 'Moral-related questions'],
                'coefficient' => 1.85,
            ],
            [
                'name' => ['en' => 'karma'],
                'description' => ['en' => 'Karma-related questions'],
                'coefficient' => 0.5
            ]
        ];

        $game = Game::where('name->en', 'Purity Game')->first();
        foreach ($categories as $categoryData) {
            $category =  Category::firstOrNew(
                ['name' => $categoryData['name']],
                [
                    'description' => $categoryData['description'],
                    'coefficient' => $categoryData['coefficient'],
                ]
            );
            $category->game()->associate($game);
            $category->save();
        }
    }
}
