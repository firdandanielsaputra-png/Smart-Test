<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Subject;
use App\Models\Question;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Menampilkan daftar mata kuliah
     */
    public function index()
    {
        // Pastikan user sudah login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Ambil semua mata kuliah
        $subjects = Subject::orderBy('nama')->get();

        return view('matakuliah', compact('subjects'));
    }

    /**
     * Menampilkan quiz berdasarkan mata kuliah
     */
    public function show($id)
    {
        // Pastikan user sudah login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Ambil mata kuliah
        $subject = Subject::findOrFail($id);

        // Ambil soal sesuai mata kuliah
        $questions = Question::where('subject_id', $id)->get();

        return view('quiz', compact('subject', 'questions'));
    }
}
