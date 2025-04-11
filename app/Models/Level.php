<?php

namespace App\Models;

use Database\Factories\GameFactory;
use Database\Factories\LevelFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class Level extends Model
{
    /** @use HasFactory<LevelFactory> */
    use HasFactory, HasTranslations;
    protected $fillable = [
        'name',
        'min_score',
        'max_score',
    ];

    protected $casts = [
        'min_score' => 'integer',
        'max_score' => 'integer',
    ];

    public array $translatable = [
        'name',
    ];

    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }
}
