<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {


    Route::resource('question', QuestionController::class);
    Route::resource('quiz', QuizController::class);
    Route::get('/start/quiz', [QuizController::class, 'startQuiz'])->name('quiz.start');
    Route::get('/start/quiz{id}', [QuizController::class, 'Qstart'])->name('quiz.start.new');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
