<?php

namespace App\Http\Resources;

use App\Models\GameSession;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin GameSession
 */
class GameSessionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'status' => $this->status,
            'game' => new GameResource($this->whenLoaded('game')),
            'player' => new PlayerResource($this->whenLoaded('player')),
            'first_question' => new QuestionResource($this->getNextQuestion()),
        ];
    }
}
