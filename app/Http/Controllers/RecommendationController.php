<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Progress;
use App\Models\Recommendation;

class RecommendationController extends Controller
{
    /**
     * Menampilkan rekomendasi belajar user
     */
    public function index()
    {
        // Pastikan user sudah login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        /*
        |--------------------------------------------------------------------------
        | Ambil Progress User
        |--------------------------------------------------------------------------
        */

        $progress = Progress::where('user_id', Auth::id())->first();

        if (!$progress) {

            return redirect()->route('progress')
                             ->with('error', 'Belum ada progress belajar.');

        }

        /*
        |--------------------------------------------------------------------------
        | Tentukan Rekomendasi
        |--------------------------------------------------------------------------
        */

        switch ($progress->level) {

            case 'Advanced':

                $text = 'Pertahankan hasil belajar Anda dan coba kerjakan soal dengan tingkat kesulitan yang lebih tinggi.';
                break;

            case 'Intermediate':

                $text = 'Pelajari kembali materi yang belum dikuasai dan kerjakan latihan tambahan agar nilai meningkat.';
                break;

            default:

                $text = 'Disarankan mengulang materi dasar sebelum mengerjakan quiz berikutnya.';
                break;
        }

        /*
        |--------------------------------------------------------------------------
        | Simpan / Update Recommendation
        |--------------------------------------------------------------------------
        */

        $recommendation = Recommendation::updateOrCreate(

            [
                'user_id' => Auth::id(),

                // sementara menggunakan subject_id = 1
                // nanti bisa diganti sesuai mata kuliah terakhir
                'subject_id' => 1
            ],

            [
                'recommendation' => $text
            ]

        );

        /*
        |--------------------------------------------------------------------------
        | Tampilkan Halaman Recommendation
        |--------------------------------------------------------------------------
        */

        return view('Recommendation', compact('recommendation', 'progress'));
    }
}
