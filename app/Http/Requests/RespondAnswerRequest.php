<?php

namespace App\Http\Requests;

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
        $question =  Question::findOrFail($this->input('question_id'));
        $isRequired = false;
        if(!$question->truth_points || !$question->false_points) {
            $isRequired = true;
        }
        return [
            'question_id' => 'required|exists:questions,id',
            'value' => 'boolean'. ($isRequired ? '|required' : '|nullable'),
            'question_answer_id' => 'integer|exists:question_answers,id' . ($isRequired ? '|required' : '|nullable'),
        ];
    }

    public function getQuestion(): Question
    {
        return Question::findOrFail($this->validated('question_id'));
    }

    public function getQuestionAnswer(): ?QuestionAnswer
    {
        if (!$this->has('question_answer_id')) {
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
