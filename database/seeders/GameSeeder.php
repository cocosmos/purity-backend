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
        Game::create(['name' => 'Purity Game', 'description' => 'A game to test your purity.']);
    }
}
