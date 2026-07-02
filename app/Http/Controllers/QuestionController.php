<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Question;
use App\Models\Subject;

class QuestionController extends Controller
{
    /**
     * Menampilkan semua soal
     */
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $questions = Question::with('subject')
                    ->orderBy('subject_id')
                    ->get();

        return view('questions.index', compact('questions'));
    }

    /**
     * Form tambah soal
     */
    public function create()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $subjects = Subject::orderBy('nama')->get();

        return view('questions.create', compact('subjects'));
    }

    /**
     * Simpan soal
     */
    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $request->validate([
            'subject_id'     => 'required|exists:subjects,id',
            'question'       => 'required',
            'option_a'       => 'required',
            'option_b'       => 'required',
            'option_c'       => 'required',
            'option_d'       => 'required',
            'correct_answer' => 'required|in:A,B,C,D'
        ]);

        Question::create([

            'subject_id'     => $request->subject_id,

            'question'       => $request->question,

            'option_a'       => $request->option_a,

            'option_b'       => $request->option_b,

            'option_c'       => $request->option_c,

            'option_d'       => $request->option_d,

            'correct_answer' => strtoupper($request->correct_answer)

        ]);

        return redirect()->back()
                         ->with('success', 'Soal berhasil ditambahkan.');
    }

    /**
     * Detail soal
     */
    public function show($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $question = Question::with('subject')->findOrFail($id);

        return view('questions.show', compact('question'));
    }

    /**
     * Update soal
     */
    public function update(Request $request, $id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $request->validate([
            'subject_id'     => 'required|exists:subjects,id',
            'question'       => 'required',
            'option_a'       => 'required',
            'option_b'       => 'required',
            'option_c'       => 'required',
            'option_d'       => 'required',
            'correct_answer' => 'required|in:A,B,C,D'
        ]);

        $question = Question::findOrFail($id);

        $question->update([

            'subject_id'     => $request->subject_id,

            'question'       => $request->question,

            'option_a'       => $request->option_a,

            'option_b'       => $request->option_b,

            'option_c'       => $request->option_c,

            'option_d'       => $request->option_d,

            'correct_answer' => strtoupper($request->correct_answer)

        ]);

        return redirect()->back()
                         ->with('success', 'Soal berhasil diperbarui.');
    }

    /**
     * Hapus soal
     */
    public function destroy($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $question = Question::findOrFail($id);

        $question->delete();

        return redirect()->back()
                         ->with('success', 'Soal berhasil dihapus.');
    }
}
