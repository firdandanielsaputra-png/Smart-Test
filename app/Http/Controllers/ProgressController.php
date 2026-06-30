<?php

namespace App\Http\Controllers;

use App\Models\Progress;

class ProgressController extends Controller
{
    public function index()
    {
        $progress = Progress::latest()->first();

        return view('Progress', compact('progress'));
    }
}
