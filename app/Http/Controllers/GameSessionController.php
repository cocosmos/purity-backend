<?php

namespace App\Http\Controllers;

use App\Http\Requests\StartGameSessionRequest;
use App\Http\Resources\GameResource;
use App\Http\Resources\GameSessionResource;
use App\Http\Resources\QuestionResource;
use App\Models\GameSession;

class GameSessionController extends Controller
{
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
            'message' => 'Game session started successfully',
            'game_session' => new GameSessionResource($gameSession),
        ]);
    }

    public function show(GameSession $gameSession)
    {
        return response()->json([
            'score' => $gameSession->score,
            'status' => $gameSession->status,
            'categories' => $gameSession->categories,
        ]);
    }
}
