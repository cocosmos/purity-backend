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

        // Answer automatically if the next question is a child question
        $nextQuestion = $gameSession->getNextQuestion();
        if($nextQuestion && $nextQuestion->parent_id && $value === false) {
            /** @var Answer $answer */
            $answer = $gameSession->answers()->make([
                'is_truth' => false,
                'points' => $nextQuestion->false_points
            ]);
            $answer->question()->associate($nextQuestion);
            $answer->save();

            $nextQuestion = $gameSession->getNextQuestion();
        }

        if(! $nextQuestion) {
            $score = $gameSession->calculateTotalScore();
            $level = $gameSession->game->levels()
                ->orderBy('min_score', 'desc')
                ->where('min_score', '>=', -$score)
                ->where('max_score', '<=', -$score)
                ->first();

            $gameSession->finished_at = now();
            $gameSession->status = GAME_SESSION_STATUSES::FINISHED->value;
            $gameSession->score_total = $score;
            $gameSession->level()->associate($level);
            $gameSession->save();
        }

        if (! $nextQuestion) {
            return response()->json([
                'is_finished' => true,
            ])->setStatusCode(200, 'Game finished');
        }

        return response()->json([
            'next_question' => new QuestionResource($nextQuestion),
        ]);
    }
}
