<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController;
Route::get('/', function () {
    return view('home');
});
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\RankingController;
Route::get('/', function () {
    return view('home');
})->name('home');

Route::middleware(['guest'])->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
    
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
});

// Trasa do wylogowania
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.delete');
});
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
   
        Route::get('/quiz', [QuizController::class, 'selectLevel'])->name('quiz.selectLevel'); // Strona wyboru poziomu
        Route::post('/quiz/start', [QuizController::class, 'startQuiz'])->name('quiz.start'); // Rozpoczęcie quizu
        Route::get('/quiz/play', [QuizController::class, 'playQuiz'])->name('quiz.play'); // Wypełnianie quizu
        Route::post('/quiz/answer', [QuizController::class, 'checkAnswer'])->name('quiz.checkAnswer'); // Sprawdzenie odpowiedzi
        Route::get('/quiz/end', [QuizController::class, 'endQuiz'])->name('quiz.end'); // Koniec quizu

    Route::get('/ranking', [RankingController::class, 'index'])->name('ranking');
    
});
use App\Http\Controllers\QuestionReportController;

// Trasa do zgłaszania nowego pytania
Route::middleware('auth')->group(function () {
    Route::get('/reports/create', [QuestionReportController::class, 'create'])->name('reports.create');
    Route::post('/reports/store', [QuestionReportController::class, 'store'])->name('reports.store');
});






use App\Http\Controllers\QuestionController;
use App\Http\Controllers\RaportController;


Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard'); 
    })->name('admin.dashboard');

   

    Route::get('reports', [RaportController::class, 'index'])->name('admin.reports.index');
    Route::post('reports/action', [RaportController::class, 'handleAction'])->name('admin.reports.action');
    Route::get('reports/{id}', [RaportController::class, 'show'])->name('admin.reports.show');
    Route::post('reports/{id}/accept', [RaportController::class, 'accept'])->name('admin.reports.accept');
    Route::post('reports/{id}/reject', [RaportController::class, 'reject'])->name('admin.reports.reject');

     
    Route::post('questions/delete', [QuestionController::class, 'bulkDelete'])->name('admin.questions.bulkDelete');
    
   
    Route::get('questions/create', [QuestionController::class, 'create'])->name('admin.questions.create');
    Route::post('questions/store', [QuestionController::class, 'store'])->name('admin.questions.store');


    Route::get('questions', [QuestionController::class, 'index'])->name('admin.questions.index');
    Route::get('questions/{id}/edit', [QuestionController::class, 'edit'])->name('admin.questions.edit');
    Route::put('questions/{id}', [QuestionController::class, 'update'])->name('admin.questions.update');

    

    
});