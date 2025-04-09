<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class QuestionAnswer extends Model
{
    use HasTranslations;
    protected $fillable = [
        'label',
        'points',
        'position',
    ];

    public array $translatable = [
        'label',
    ];

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }
}
