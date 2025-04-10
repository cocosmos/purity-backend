<?php

namespace App\Models;

use Database\Factories\CategoryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    /** @use HasFactory<CategoryFactory> */
    use HasFactory, HasTranslations;

    protected $fillable = [
        'name',
        'description',
        'coefficient',
        'image_path',
    ];

    public array $translatable = [
        'name',
        'description',
    ];

    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }

    public function answers(): HasManyThrough
    {
        return $this->hasManyThrough(Answer::class, Question::class);
    }

    public function getRawPointsForGameSession(int $gameSessionId): int
    {
        return -$this->answers()
            ->whereHas('gameSession', function ($query) use ($gameSessionId) {
                $query->where('id', $gameSessionId);
            })
            ->sum('points');
    }

    public function getWeightedPointsForGameSession(int $gameSessionId): int
    {
        return $this->getRawPointsForGameSession($gameSessionId) * $this->coefficient;
    }

    public function getMaxScoreAttribute(): int
    {
        $questionTruthPoints = $this->questions->sum('truth_points');
        $questionFalsePoints = $this->questions->sum('false_points');
        $questionOtherPoints = $this->questions->map(function ($question) {
            return $question->questionAnswers->sum('points');
        })->sum();
        $questionPoints = - $questionTruthPoints - $questionFalsePoints - $questionOtherPoints;
        return $questionPoints * $this->coefficient;
    }
}
