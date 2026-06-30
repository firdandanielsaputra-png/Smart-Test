<?php

namespace App\Http\Controllers;

use App\Models\Result;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function index()
    {
        $results = Result::latest()->get();

        return view('HasilQuiz', compact('results'));
    }

    public function store(Request $request)
    {
        Result::create($request->all());

        return redirect('/hasil');
    }
}
