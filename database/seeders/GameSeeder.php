<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Game;
use App\Models\Question;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $games = Game::factory(5)->create();
        $categories = Category::factory(10)->create();

        $games->each(function ($game) use ($categories) {
            $categories = $categories->random(3);
            $game->categories()->attach($categories->pluck('id')->toArray());
            $questions = Question::factory(20)->create();
            $game->questions()->attach($questions->pluck('id')->toArray());
            $questions->each(function ($question) use ($categories) {
                $question->categories()->attach($categories->random(2)->pluck('id')->toArray());
            });
        });
    }
}
