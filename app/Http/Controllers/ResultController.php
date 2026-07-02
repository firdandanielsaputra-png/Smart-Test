<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Result;

class ResultController extends Controller
{
    /**
     * Menampilkan semua hasil quiz user
     */
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $results = Result::with('subject')
                        ->where('user_id', Auth::id())
                        ->latest()
                        ->get();

        return view('HasilQuiz', compact('results'));
    }

    /**
     * Menampilkan detail hasil quiz
     */
    public function show($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $result = Result::with('subject')
                        ->where('user_id', Auth::id())
                        ->findOrFail($id);

        return view('HasilQuiz', compact('result'));
    }

    /**
     * Menghapus hasil quiz
     */
    public function destroy($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $result = Result::where('user_id', Auth::id())
                        ->findOrFail($id);

        $result->delete();

        return redirect()->route('hasil.quiz')
                         ->with('success', 'Hasil quiz berhasil dihapus.');
    }
}
