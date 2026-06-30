<?php

namespace App\Http\Controllers;

use App\Models\Recommendation;

class RecommendationController extends Controller
{
    public function index()
    {
        $recommendations = Recommendation::all();

        return view('Progress', compact('recommendations'));
    }
}
