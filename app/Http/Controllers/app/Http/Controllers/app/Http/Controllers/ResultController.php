<?php

namespace App\Http\Controllers;

use App\Models\Result;

class ResultController extends Controller
{
    public function index()
    {
        return response()->json(
            Result::all()
        );
    }
}
