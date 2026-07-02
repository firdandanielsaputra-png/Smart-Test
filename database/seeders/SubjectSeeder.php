<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subject;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Subject::insert([
            [
                'kode' => 'MK001',
                'nama' => 'Pemrograman Web',
                'deskripsi' => 'Quiz dasar Pemrograman Web'
            ],
            [
                'kode' => 'MK002',
                'nama' => 'Basis Data',
                'deskripsi' => 'Quiz dasar Basis Data'
            ],
            [
                'kode' => 'MK003',
                'nama' => 'Algoritma',
                'deskripsi' => 'Quiz dasar Algoritma'
            ],
            [
                'kode' => 'MK004',
                'nama' => 'Kecerdasan Buatan',
                'deskripsi' => 'Quiz dasar AI'
            ]
        ]);
    }
}
