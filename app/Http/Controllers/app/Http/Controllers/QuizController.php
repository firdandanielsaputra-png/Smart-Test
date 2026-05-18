<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Result;

class QuizController extends Controller
{
    public function getQuestions()
    {
        return response()->json(
            Question::all()
        );
    }

    public function submitQuiz(Request $request)
    {
        $score = 0;

        foreach ($request->answers as $answer) {

            $question = Question::find($answer['question_id']);

            if ($question->correct_answer == $answer['answer']) {

                $score += 10;
            }
        }

        $level = "Beginner";

        if ($score >= 70) {
            $level = "Intermediate";
        }

        if ($score >= 90) {
            $level = "Advanced";
        }

        $result = Result::create([
            'user_id' => $request->user_id,
            'score' => $score,
            'level' => $level
        ]);

        return response()->json([
            'message' => 'Quiz selesai',
            'score' => $score,
            'level' => $level,
            'data' => $result
        ]);
    }
}
