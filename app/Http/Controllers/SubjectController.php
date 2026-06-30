<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::all();

        return view('matakuliah', compact('subjects'));
    }

    public function show($id)
    {
        $subject = Subject::findOrFail($id);

        return view('quiz', compact('subject'));
    }
}
