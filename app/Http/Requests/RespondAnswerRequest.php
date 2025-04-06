<?php

namespace App\Http\Requests;

use App\Models\Question;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class RespondAnswerRequest extends FormRequest
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
        $question =  Question::findOrFail($this->input('question_id'));
        if(!$question->min_value || !$question->max_value) {
            $between = '0,1';
        } else {
            $between = $question->min_value . ',' . $question->max_value;
        }
        return [
            'question_id' => 'required|exists:questions,id',
            'value' => 'required|integer|between:' . $between,
        ];
    }

    public function getQuestion(): Question
    {
        return Question::findOrFail($this->validated('question_id'));
    }

    public function getValue(): int
    {
        return (int) $this->validated('value');
    }
}
