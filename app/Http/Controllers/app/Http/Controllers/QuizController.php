<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Question;
use App\Models\Result;
use App\Models\Progress;
use App\Models\Recommendation;

class QuizController extends Controller
{
    /**
     * Menampilkan soal berdasarkan mata kuliah
     */
    public function getQuestions($subjectId)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $questions = Question::where('subject_id', $subjectId)->get();

        return view('quiz', compact('questions', 'subjectId'));
    }

    /**
     * Submit jawaban quiz
     */
    public function submitQuiz(Request $request)
    {
        // Pastikan user login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $request->validate([
            'subject_id' => 'required|integer|exists:subjects,id',
            'answers'    => 'required|array'
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

        /*
        |--------------------------------------------------------------------------
        | Menentukan Level
        |--------------------------------------------------------------------------
        */

        if ($score >= 90) {

            $level = 'Advanced';

        } elseif ($score >= 70) {

            $level = 'Intermediate';

        } else {

            $level = 'Beginner';

        }

        /*
        |--------------------------------------------------------------------------
        | Simpan Result
        |--------------------------------------------------------------------------
        */

        Result::create([

            'user_id'    => Auth::id(),

            'subject_id' => $request->subject_id,

            'score'      => $score,

            'correct'    => $correct,

            'wrong'      => $wrong,

            'status'     => $level

        ]);

        /*
        |--------------------------------------------------------------------------
        | Update Progress
        |--------------------------------------------------------------------------
        */

        $quizTotal = Result::where('user_id', Auth::id())->count();

        $averageScore = Result::where('user_id', Auth::id())->avg('score');

        Progress::updateOrCreate(

            [
                'user_id' => Auth::id()
            ],

            [
                'quiz_total'    => $quizTotal,

                'average_score' => round($averageScore, 2),

                'level'         => $level
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | Recommendation
        |--------------------------------------------------------------------------
        */

        if ($score < 70) {

            Recommendation::create([

                'user_id'       => Auth::id(),

                'subject_id'    => $request->subject_id,

                'recommendation' => 'Pelajari kembali materi pada mata kuliah ini sebelum melanjutkan ke level berikutnya.'

            ]);

        }

        /*
        |--------------------------------------------------------------------------
        | Redirect ke halaman hasil
        |--------------------------------------------------------------------------
        */

        return redirect()->route('hasil.quiz')
                         ->with('success', 'Quiz berhasil diselesaikan.');
    }
