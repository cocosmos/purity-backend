<?php

namespace App\Models;

use Database\Factories\QuestionFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class Question extends Model
{
    /** @use HasFactory<QuestionFactory> */
    use HasFactory, HasTranslations;

    protected $fillable = [
        'question',
        'points',
        'min_value',
        'max_value',
    ];

    public array $translatable = [
        'question',
    ];

    public function games(): BelongsToMany
    {
        return $this->belongsToMany(Game::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }
}
