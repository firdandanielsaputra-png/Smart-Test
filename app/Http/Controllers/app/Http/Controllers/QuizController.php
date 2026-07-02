<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Question;
use App\Models\Result;

class QuizController extends Controller
{
    /**
     * Mengambil soal berdasarkan mata kuliah
     */
    public function getQuestions($subjectId)
    {
        $questions = Question::where('subject_id', $subjectId)->get();

        return view('quiz', compact('questions', 'subjectId'));
    }

    /**
     * Submit jawaban quiz
     */
    public function submitQuiz(Request $request)
    {
        $request->validate([
            'subject_id' => 'required|integer',
            'answers' => 'required|array'
        ]);

        $score = 0;
        $correct = 0;
        $wrong = 0;

        foreach ($request->answers as $answer) {

            $question = Question::find($answer['question_id']);

            if (!$question) {
                continue;
            }

            if ($question->correct_answer == $answer['answer']) {

                $correct++;
                $score += 10;

            } else {

                $wrong++;

            }
        }

        // Menentukan level
        if ($score >= 90) {

            $level = "Advanced";

        } elseif ($score >= 70) {

            $level = "Intermediate";

        } else {

            $level = "Beginner";

        }

        // Simpan hasil quiz
        $result = Result::create([

            'user_id' => Auth::id(),

            'subject_id' => $request->subject_id,

            'score' => $score,

            'correct' => $correct,

            'wrong' => $wrong,

            'status' => $level

        ]);

        return response()->json([

            'success' => true,

            'message' => 'Quiz berhasil diselesaikan',

            'score' => $score,

            'correct' => $correct,

            'wrong' => $wrong,

            'level' => $level,

            'result' => $result

        ]);
    }

    /**
     * Menampilkan hasil quiz terakhir user
     */
    public function hasilQuiz()
    {
        $result = Result::where('user_id', Auth::id())
                        ->latest()
                        ->first();

        return view('HasilQuiz', compact('result'));
    }
}
