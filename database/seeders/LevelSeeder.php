<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\Level;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $game = Game::where('name->en', 'like', 'Purity Game')->first();

        $levels = [
            'divine' => [
                20,
                11
            ],
            'saintly' => [
                10,
                1
            ],
            'pure' => [
                0,
                0
            ],
            'normal' => [
                -1,
                -14
            ],
            'immoral' => [
                -15,
                -19
            ],
            'impure' => [
                -20,
                -24
            ],
            'indecent' => [
                -25,
                -29
            ],
            'unwholesome' => [
                -30,
                -34
            ],
            'ignoble' => [
                -35,
                -39
            ],
            'vicious' => [
                -40,
                -44
            ],
            'infamous' => [
                -45,
                -49
            ],
            'depraved' => [
                -50,
                -54
            ],
            'dangerous' => [
                -55,
                -59
            ],
            'inhuman' => [
                -60,
                -84
            ],
            'demon' => [
                -85,
                -199
            ],
            'diabolical' => [
                -200,
                -999
            ],
        ];
        foreach ($levels as $name => $score) {
            $level = Level::make([
                'name' => [
                    'en' => $name,
                ],
                'min_score' => $score[0],
                'max_score' => $score[1],
            ]);

            $level->game()->associate($game);
            $level->save();
        }
    }
}
