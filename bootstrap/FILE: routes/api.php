<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\ResultController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/questions', [QuizController::class, 'getQuestions']);
Route::post('/submit-quiz', [QuizController::class, 'submitQuiz']);

Route::get('/results', [ResultController::class, 'index']);
