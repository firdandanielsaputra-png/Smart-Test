<?php

namespace App\Http\Controllers;

use App\Models\Progress;
use App\Models\Recommendation;
use Illuminate\Support\Facades\Auth;

class RecommendationController extends Controller
{
    public function index()
    {
        $progress = Progress::where('user_id', Auth::id())->first();

        if (!$progress) {
            return redirect('/progress
