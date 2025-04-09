<?php

namespace App\Models;

use Database\Factories\QuestionFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Spatie\Translatable\HasTranslations;

class Question extends Model
{
    /** @use HasFactory<QuestionFactory> */
    use HasFactory, HasTranslations;

    protected $fillable = [
        'question',
        'type',
        'truth_points',
        'false_points',
        'position'
    ];

    public array $translatable = [
        'question',
    ];

    public function game(): HasOneThrough
    {
        return $this->hasOneThrough(Game::class, Category::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Question::class, 'parent_id');
    }

    public function questionAnswers(): HasMany
    {
        return $this->hasMany(QuestionAnswer::class);
    }
}
