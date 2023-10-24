<?php

use App\Http\Controllers\{DashboardController, ProfileController, QuestionController, Question};
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/question/store', [QuestionController::class, 'store'])->name('question.store');
Route::post('/question/{question}/like', Question\LikeController::class)->name('question.vote');

require __DIR__.'/auth.php';
