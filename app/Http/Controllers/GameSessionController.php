<?php

namespace App\Http\Controllers;

use App\Http\Requests\StartGameSessionRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\GameSessionResource;
use App\Models\GameSession;

class GameSessionController extends Controller
{
    public function index()
    {
        $gameSessions = GameSession::with([
            'game' => function ($query) {
                $query->withCount('questions');
            },
            'player',
        ])->get();

        return response()->json([
            'game_sessions' => GameSessionResource::collection($gameSessions),
        ]);
    }

    public function start(StartGameSessionRequest $request)
    {
        $game = $request->getGame();
        $player = $request->getPlayer();

        /** @var GameSession $gameSession */
        $gameSession = $game->gameSessions()->make([
            'status' => 'started',
            'started_at' => now(),
        ]);

        $gameSession->player()->associate($player);
        $gameSession->save();


        return response()->json([
            'game_session_id' => $gameSession->id,
        ]);
    }

    public function show(GameSession $gameSession)
    {
        $gameSession
            ->load([
                'level',
                'game' => function ($query) {
                    $query->withCount('questions');
                },
                'player',
            ])
            ->loadCount(['answers']);

        return response()->json([
            'game_session' => new GameSessionResource($gameSession),
        ]);
    }

    public function scores(GameSession $gameSession)
    {
        $categories = $gameSession->categories;
        $categories->map(function ($category) use ($gameSession) {
            $categoryScore = $category->getWeightedPointsForGameSession($gameSession->id);
            $category->score = $categoryScore;

            return $category;
        });

        return response()->json([
            'game_session' => new GameSessionResource($gameSession),
            'categories' => CategoryResource::collection($categories),
        ]);
    }
}
