<?php

namespace App\Models;

use Database\Factories\AnswerFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Answer extends Model
{
    /** @use HasFactory<AnswerFactory> */
    use HasFactory;

    protected $fillable = [
        'is_truth',
        'points'
    ];

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }

    public function gameSession(): BelongsTo
    {
        return $this->belongsTo(GameSession::class);
    }

    public function questionAnswer(): BelongsTo
    {
        return $this->belongsTo(QuestionAnswer::class);
    }
}
