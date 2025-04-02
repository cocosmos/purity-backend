<?php

namespace App\Models;

use Database\Factories\PlayerFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Player extends Model
{
    /** @use HasFactory<PlayerFactory> */
    use HasFactory;

    protected $fillable = [
        'username',
    ];

    public function gameSessions(): HasMany
    {
        return $this->hasMany(GameSession::class);
    }

    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }


}
