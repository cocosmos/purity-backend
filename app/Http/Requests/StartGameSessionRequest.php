<?php

namespace App\Http\Requests;

use App\Models\Game;
use App\Models\Player;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StartGameSessionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'game_id' => 'required|exists:games,id',
            'player_id' => 'required|exists:players,id',
        ];
    }

    public function getGame(): Game
    {
        return Game::findOrFail($this->validated('game_id'));
    }

    public function getPlayer(): Player
    {
        return Player::findOrFail($this->validated('player_id'));
    }
}
