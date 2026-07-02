<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\RecommendationController;

/*
|--------------------------------------------------------------------------
| SMART TEST ROUTES
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| Login
|--------------------------------------------------------------------------
*/

Route::get('/', [AuthController::class, 'index'])->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.process');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


/*
|--------------------------------------------------------------------------
| Mata Kuliah
|--------------------------------------------------------------------------
*/

Route::get('/matakuliah', [SubjectController::class, 'index'])
    ->name('matakuliah');

Route::get('/matakuliah/{id}', [SubjectController::class, 'show'])
    ->name('subject.show');


/*
|--------------------------------------------------------------------------
| Quiz
|--------------------------------------------------------------------------
*/

Route::get('/quiz/{subjectId}', [QuizController::class, 'getQuestions'])
    ->name('quiz');

Route::post('/submit-quiz', [QuizController::class, 'submitQuiz'])
    ->name('submit.quiz');


/*
|--------------------------------------------------------------------------
| Hasil Quiz
|--------------------------------------------------------------------------
*/

Route::get('/hasil-quiz', [QuizController::class, 'hasilQuiz'])
    ->name('hasil.quiz');

Route::get('/hasil-quiz/all', [ResultController::class, 'index'])
    ->name('result.index');

Route::delete('/hasil-quiz/{id}', [ResultController::class, 'destroy'])
    ->name('result.delete');


/*
|--------------------------------------------------------------------------
| Progress
|--------------------------------------------------------------------------
*/

Route::get('/progress', [ProgressController::class, 'index'])
    ->name('progress');


/*
|--------------------------------------------------------------------------
| Recommendation
|--------------------------------------------------------------------------
*/

Route::get('/recommendation', [RecommendationController::class, 'index'])
    ->name('recommendation');
