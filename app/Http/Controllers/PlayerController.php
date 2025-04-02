<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePlayerRequest;
use App\Http\Resources\PlayerResource;
use App\Models\Player;

class PlayerController extends Controller
{
    public function store(StorePlayerRequest $request)
    {
        $player = Player::create([
            'username' => $request->getUsername(),
        ]);

        return response()->json(PlayerResource::make($player), 201);
    }
}
