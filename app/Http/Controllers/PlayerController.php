<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePlayerRequest;
use App\Http\Resources\PlayerResource;
use App\Models\Player;

class PlayerController extends Controller
{
    public function show(Player $player)
    {
        $player->load('gameSessions');
        return response()->json([
            'player' => PlayerResource::make($player),
        ]);
    }
    public function store(StorePlayerRequest $request)
    {
        $player = Player::create([
            'username' => $request->getUsername(),
        ]);

        return response()->json(['player' => PlayerResource::make($player)], 201);
    }
}
