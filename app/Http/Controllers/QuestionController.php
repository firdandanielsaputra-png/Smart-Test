<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Subject;

class QuestionController extends Controller
{
    /**
     * Menampilkan semua soal
     */
    public function index()
    {
        $questions = Question::with('subject')->get();

        return response()->json([
            'success' => true,
            'data' => $questions
        ]);
    }

    /**
     * Menampilkan form tambah soal
     */
    public function create()
    {
        $subjects = Subject::all();

        return response()->json([
            'subjects' => $subjects
        ]);
    }

    /**
     * Menyimpan soal baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'subject_id' => 'required',
            'question' => 'required',
            'option_a' => 'required',
            'option_b' => 'required',
            'option_c' => 'required',
            'option_d' => 'required',
            'correct_answer' => 'required'
        ]);

        $question = Question::create([

            'subject_id' => $request->subject_id,

            'question' => $request->question,

            'option_a' => $request->option_a,

            'option_b' => $request->option_b,

            'option_c' => $request->option_c,

            'option_d' => $request->option_d,

            'correct_answer' => strtoupper($request->correct_answer)

        ]);

        return response()->json([

            'success' => true,

            'message' => 'Soal berhasil ditambahkan',

            'data' => $question

        ]);
    }

    /**
     * Menampilkan detail soal
     */
    public function show($id)
    {
        $question = Question::findOrFail($id);

        return response()->json($question);
    }

    /**
     * Update soal
     */
    public function update(Request $request, $id)
    {
        $question = Question::findOrFail($id);

        $question->update([

            'subject_id' => $request->subject_id,

            'question' => $request->question,

            'option_a' => $request->option_a,

            'option_b' => $request->option_b,

            'option_c' => $request->option_c,

            'option_d' => $request->option_d,

            'correct_answer' => strtoupper($request->correct_answer)

        ]);

        return response()->json([

            'success' => true,

            'message' => 'Soal berhasil diperbarui',

            'data' => $question

        ]);
    }

    /**
     * Hapus soal
     */
    public function destroy($id)
    {
        $question = Question::findOrFail($id);

        $question->delete();

        return response()->json([

            'success' => true,

            'message' => 'Soal berhasil dihapus'

        ]);
    }
}
