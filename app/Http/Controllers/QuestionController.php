<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index($subjectId)
    {
        $questions = Question::where('subject_id', $subjectId)->get();

        return response()->json($questions);
    }
}
