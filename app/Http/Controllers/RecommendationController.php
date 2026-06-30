<?php

namespace App\Http\Controllers;

use App\Models\Progress;
use App\Models\Recommendation;
use Illuminate\Support\Facades\Auth;

class RecommendationController extends Controller
{
    /**
     * Menampilkan rekomendasi belajar
     */
    public function index()
    {
        $progress = Progress::where('user_id', Auth::id())->first();

        if (!$progress) {

            return response()->json([
                'message' => 'Belum ada progress belajar.'
            ]);

        }

        $recommendation = "";

        switch ($progress->level) {

            case "Advanced":
                $recommendation = "Pertahankan hasil belajar dan coba soal tingkat lanjutan.";
                break;

            case "Intermediate":
                $recommendation = "Pelajari kembali materi yang masih belum dipahami dan kerjakan latihan tambahan.";
                break;

            default:
                $recommendation = "Disarankan mengulang materi dasar sebelum mengerjakan quiz berikutnya.";
                break;
        }

        Recommendation::updateOrCreate(

            [
                'user_id' => Auth::id()
            ],

            [
                'subject_id' => 1,
                'recommendation' => $recommendation
            ]

        );

        $recommendation = Recommendation::where('user_id', Auth::id())->latest()->first();

        return response()->json([
            'success' => true,
            'data' => $recommendation
        ]);
    }
}
