<?php

namespace App\Http\Controllers;

use App\Enums\GAME_SESSION_STATUSES;
use App\Http\Requests\RespondAnswerRequest;
use App\Http\Resources\QuestionResource;
use App\Models\GameSession;

class AnswerController extends Controller
{
    public function respond(RespondAnswerRequest $request, GameSession $gameSession)
    {
        $question = $request->getQuestion();
        $value = $request->getValue();

        $answer = $gameSession->answers()->make([
            'value' => $value,
        ]);
        $answer->question()->associate($question);
        $answer->save();

        $score = $gameSession->calculateScore($question, $value);

        $nextQuestion = $gameSession->getNextQuestion();

        $gameSession->score += $score;
        $gameSession->finished_at = $nextQuestion ? null : now();
        $gameSession->status = $nextQuestion ? GAME_SESSION_STATUSES::IN_PROGRESS->value : GAME_SESSION_STATUSES::FINISHED->value;
        $gameSession->save();

        if (! $nextQuestion) {
            return response()->json([
                'score' => $gameSession->score,
            ]);
        }

        return response()->json([
            'next_question' => new QuestionResource($nextQuestion),
        ]);
    }
}
