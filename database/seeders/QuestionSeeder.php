<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Question;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Question::insert([

            [
                'subject_id' => 1,
                'question' => 'HTML merupakan singkatan dari?',
                'option_a' => 'Hyper Text Markup Language',
                'option_b' => 'High Text Machine Language',
                'option_c' => 'Hyper Tool Markup Language',
                'option_d' => 'Home Text Markup Language',
                'correct_answer' => 'A'
            ],

            [
                'subject_id' => 1,
                'question' => 'Tag HTML untuk membuat paragraf adalah?',
                'option_a' => '<div>',
                'option_b' => '<h1>',
                'option_c' => '<p>',
                'option_d' => '<span>',
                'correct_answer' => 'C'
            ],

            [
                'subject_id' => 2,
                'question' => 'DBMS adalah?',
                'option_a' => 'Database Management System',
                'option_b' => 'Data Machine System',
                'option_c' => 'Digital Base Management',
                'option_d' => 'Database Main System',
                'correct_answer' => 'A'
            ],

            [
                'subject_id' => 3,
                'question' => 'Algoritma adalah?',
                'option_a' => 'Bahasa Pemrograman',
                'option_b' => 'Langkah-langkah penyelesaian masalah',
                'option_c' => 'Database',
                'option_d' => 'Framework',
                'correct_answer' => 'B'
            ],

            [
                'subject_id' => 4,
                'question' => 'AI merupakan singkatan dari?',
                'option_a' => 'Artificial Intelligence',
                'option_b' => 'Automatic Internet',
                'option_c' => 'Application Interface',
                'option_d' => 'Artificial Internet',
                'correct_answer' => 'A'
            ]

        ]);
    }
}
