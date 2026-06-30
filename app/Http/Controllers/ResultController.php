<?php

namespace App\Http\Controllers;

use App\Models\Result;
use Illuminate\Support\Facades\Auth;

class ResultController extends Controller
{
    /**
     * Menampilkan semua hasil quiz milik user
     */
    public function index()
    {
        $results = Result::where('user_id', Auth::id())
                        ->with('subject')
                        ->latest()
                        ->get();

        return view('HasilQuiz', compact('results'));
    }

    /**
     * Menampilkan detail hasil quiz
     */
    public function show($id)
    {
        $result = Result::with('subject')
                        ->where('user_id', Auth::id())
                        ->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $result
        ]);
    }

    /**
     * Menghapus hasil quiz
     */
    public function destroy($id)
    {
        $result = Result::where('user_id', Auth::id())
                        ->findOrFail($id);

        $result->delete();

        return response()->json([
            'success' => true,
            'message' => 'Hasil quiz berhasil dihapus'
        ]);
    }
}
