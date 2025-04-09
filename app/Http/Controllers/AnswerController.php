<?php

namespace App\Http\Controllers;

use App\Enums\GAME_SESSION_STATUSES;
use App\Http\Requests\RespondAnswerRequest;
use App\Http\Resources\QuestionResource;
use App\Models\Answer;
use App\Models\GameSession;

class AnswerController extends Controller
{
    public function respond(RespondAnswerRequest $request, GameSession $gameSession)
    {
        // Save the answer
        $question = $request->getQuestion();
        $value = $request->getValue();
        $questionAnswer = $request->getQuestionAnswer();
        $points = $questionAnswer ? $questionAnswer->points : ($value ? $question->truth_points : $question->false_points);

        /** @var Answer $answer */
        $answer = $gameSession->answers()->make([
            'is_truth' => $value,
            'points' => $points
        ]);
        $answer->question()->associate($question);
        if($questionAnswer) {
            $answer->questionAnswer()->associate($questionAnswer);
        }
        $answer->save();

        // TODO: Calculate the score

       // $score = $gameSession->calculateScore($question, $value);

        $nextQuestion = $gameSession->getNextQuestion();

        //$gameSession->score += $score;
        $gameSession->finished_at = $nextQuestion ? null : now();
        $gameSession->status = $nextQuestion ? GAME_SESSION_STATUSES::IN_PROGRESS->value : GAME_SESSION_STATUSES::FINISHED->value;
        $gameSession->save();

        if (! $nextQuestion) {
            return response()->json([
                'score' => 0,
                   // $gameSession->score,
            ]);
        }

        return response()->json([
            'next_question' => new QuestionResource($nextQuestion),
        ]);
    }
}
