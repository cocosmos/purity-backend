<?php

namespace App\Models;

use Database\Factories\GameSessionFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class GameSession extends Model
{
    /** @use HasFactory<GameSessionFactory> */
    use HasFactory;

    protected $fillable = [
        'score_total',
        'status',
        'started_at',
        'finished_at',
        'categories_scores',
    ];

    protected $casts = [
        'categories_scores' => 'array',
        'started_at' => 'datetime',
        'finished_at' => 'datetime',
    ];

    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }

    public function questions(): HasManyThrough
    {
        return $this->hasManyThrough(Question::class, Game::class);
    }

    public function categories(): HasManyThrough
    {
        return $this->hasManyThrough(
            Category::class,
            Game::class,
            'id',
            'game_id',
            'game_id',
            'id'
        );
    }

    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class);
    }

    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }

    public function level(): BelongsTo
    {
        return $this->belongsTo(Level::class);
    }

    public function getNextQuestion(): ?Question
    {
        return $this->game->questions()
            ->whereDoesntHave('answers', function ($query) {
                $query->where('game_session_id', $this->id);
            })
            ->with(['questionAnswers' => function ($query) {
                $query->orderBy('position');
            }])
            ->orderBy('position')
            ->first();
    }

    public function calculateTotalScore(): int
    {
        $categories = $this->categories;
        $categoryScores = $categories->map(function ($category) {
            return $category->getWeightedPointsForGameSession($this->id);
        });

        return $categoryScores->sum();
    }
}
