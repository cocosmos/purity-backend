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
        'score',
        'status',
        'started_at',
        'finished_at',
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
        return $this->hasManyThrough(Category::class, Game::class);
    }

    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class);
    }

    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }

    public function getNextQuestion(): ?Question
    {
        return $this->game->questions()
            ->whereDoesntHave('answers', function ($query) {
                $query->where('game_session_id', $this->id);
            })
            ->inRandomOrder()
            ->first();
    }

    public function calculateScore(Question $question, int $value): int
    {
        $score = 0;

        if(! $question->min_value || ! $question->max_value) {
            if ($value === 0) {
                $score = -$question->points;
            } else {
                $score = $question->points;
            }
        }

        // If the question has a min and max value, we need to check if the value is within the range
        // and calculate the score accordingly
        // More the value is close to the min value, more the score is low
        // More the value is close to the max value, more the score is high
        if ($question->min_value && $question->max_value) {
            if ($value < $question->min_value) {
                $score = -$question->points;
            } elseif ($value > $question->max_value) {
                $score = -$question->points;
            } else {
                // Calculate the score based on the value
                $score = (($value - $question->min_value) / ($question->max_value - $question->min_value)) * $question->points;
            }
        }

        return $score;
    }
}
