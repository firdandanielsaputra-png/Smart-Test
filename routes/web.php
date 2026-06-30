<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\QuestionController;
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
| AUTH
|--------------------------------------------------------------------------
*/

Route::get('/', [AuthController::class, 'index'])->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


/*
|--------------------------------------------------------------------------
| DASHBOARD
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


/*
|--------------------------------------------------------------------------
| SUBJECT
|--------------------------------------------------------------------------
*/

Route::get('/subjects', [SubjectController::class, 'index'])->name('subjects');

Route::get('/subjects/{id}', [SubjectController::class, 'show'])->name('subjects.show');


/*
|--------------------------------------------------------------------------
| QUESTION (CRUD)
|--------------------------------------------------------------------------
*/

Route::get('/questions', [QuestionController::class, 'index']);

Route::post('/questions', [QuestionController::class, 'store']);

Route::get('/questions/{id}', [QuestionController::class, 'show']);

Route::put('/questions/{id}', [QuestionController::class, 'update']);

Route::delete('/questions/{id}', [QuestionController::class, 'destroy']);


/*
|--------------------------------------------------------------------------
| QUIZ
|--------------------------------------------------------------------------
*/

Route::get('/quiz/{subjectId}', [QuizController::class, 'getQuestions']);

Route::post('/quiz/submit', [QuizController::class, 'submitQuiz']);

Route::get('/hasil-quiz', [QuizController::class, 'hasilQuiz'])->name('hasil.quiz');


/*
|--------------------------------------------------------------------------
| RESULT
|--------------------------------------------------------------------------
*/

Route::get('/results', [ResultController::class, 'index']);

Route::get('/results/{id}', [ResultController::class, 'show']);

Route::delete('/results/{id}', [ResultController::class, 'destroy']);


/*
|--------------------------------------------------------------------------
| PROGRESS
|--------------------------------------------------------------------------
*/

Route::get('/progress', [ProgressController::class, 'index'])->name('progress');


/*
|--------------------------------------------------------------------------
| RECOMMENDATION
|--------------------------------------------------------------------------
*/

Route::get('/recommendation', [RecommendationController::class, 'index'])->name('recommendation');
