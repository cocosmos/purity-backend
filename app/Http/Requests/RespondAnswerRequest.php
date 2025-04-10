<?php

namespace App\Http\Requests;

use App\Enums\QUESTION_TYPES;
use App\Models\Question;
use App\Models\QuestionAnswer;
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
        /**
         * @var Question $question
         */
        $question =  Question::findOrFail($this->input('question_id'));
        $isRequiredAnswer = $question->type === QUESTION_TYPES::MULTIPLE->value;

        return [
            'question_id' => 'required|exists:questions,id',
            'value' => 'boolean'. ($isRequiredAnswer ? '|nullable': '|required'),
            'question_answer_id' => ($isRequiredAnswer ? 'required|' : 'nullable|').'integer|exists:question_answers,id',
        ];
    }

    public function getQuestion(): Question
    {
        return Question::findOrFail($this->validated('question_id'));
    }

    public function getQuestionAnswer(): ?QuestionAnswer
    {
        if (!$this->validated('question_answer_id')) {
            return null;
        }
        return QuestionAnswer::findOrFail($this->validated('question_answer_id'));
    }

    public function getValue(): ?bool
    {
        if (!$this->has('value')) {
            return null;
        }
        return (bool) $this->validated('value');
    }
}
