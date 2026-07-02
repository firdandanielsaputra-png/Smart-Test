<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Result;
use App\Models\Progress;

class ProgressController extends Controller
{
    /**
     * Menampilkan progress belajar user
     */
    public function index()
    {
        // Pastikan user sudah login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Ambil seluruh hasil quiz user
        $results = Result::where('user_id', Auth::id())->get();

        $quizTotal = $results->count();

        $averageScore = $quizTotal > 0
            ? round($results->avg('score'), 2)
            : 0;

        /*
        |--------------------------------------------------------------------------
        | Menentukan Level
        |--------------------------------------------------------------------------
        */

        if ($averageScore >= 90) {

            $level = 'Advanced';

        } elseif ($averageScore >= 70) {

            $level = 'Intermediate';

        } else {

            $level = 'Beginner';

        }

        /*
        |--------------------------------------------------------------------------
        | Update Progress
        |--------------------------------------------------------------------------
        */

        $progress = Progress::updateOrCreate(

            [
                'user_id' => Auth::id()
            ],

            [
                'quiz_total'    => $quizTotal,
                'average_score' => $averageScore,
                'level'         => $level
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | Tampilkan Progress
        |--------------------------------------------------------------------------
        */

        return view('Progress', compact('progress'));
    }
}
