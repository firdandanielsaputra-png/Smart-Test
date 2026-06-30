<?php

namespace App\Http\Controllers;

use App\Models\Result;
use App\Models\Progress;
use Illuminate\Support\Facades\Auth;

class ProgressController extends Controller
{
    /**
     * Menampilkan progress belajar user
     */
    public function index()
    {
        $results = Result::where('user_id', Auth::id())->get();

        $quizTotal = $results->count();

        $average = $quizTotal > 0
            ? round($results->avg('score'), 2)
            : 0;

        if ($average >= 90) {

            $level = "Advanced";

        } elseif ($average >= 70) {

            $level = "Intermediate";

        } else {

            $level = "Beginner";

        }

        Progress::updateOrCreate(

            ['user_id' => Auth::id()],

            [
                'quiz_total' => $quizTotal,
                'average_score' => $average,
                'level' => $level
            ]

        );

        $progress = Progress::where('user_id', Auth::id())->first();

        return view('Progress', compact('progress'));
    }
}
