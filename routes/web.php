<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/matkul', function () {
    return view('matkul.index');
});

Route::get('/quiz', function () {
    return view('quiz.index');
});

Route::get('/result', function () {
    return view('result.index');
});

Route::get('/progress', function () {
    return view('progress.index');
});
