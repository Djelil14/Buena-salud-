<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\Admin\MessageController as AdminMessageController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;

Route::get('/', [ArticleController::class, 'home'])->name('home');
Route::get('/articles', [ArticleController::class, 'index'])->name('articles');
Route::get('/article/{id}', [ArticleController::class, 'show'])->name('article.show');
Route::get('/contact', [ArticleController::class, 'contact'])->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

// Admin
Route::prefix('secretadmin2025')->name('admin.')->group(function () {
    // Auth
    Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AdminAuthController::class, 'login'])->name('login.post');
    Route::post('logout', [AdminAuthController::class, 'logout'])->name('logout');

    // Zone protégée
    Route::middleware('admin')->group(function () {
        Route::get('/', [AdminArticleController::class, 'index'])->name('dashboard');
        Route::resource('articles', AdminArticleController::class)->except(['show']);
        Route::get('messages', [AdminMessageController::class, 'index'])->name('messages.index');
        Route::delete('messages/{id}', [AdminMessageController::class, 'destroy'])->name('messages.destroy');
        Route::get('messages/{id}/reply', [AdminMessageController::class, 'replyForm'])->name('messages.reply');
        Route::post('messages/{id}/reply', [AdminMessageController::class, 'sendReply'])->name('messages.sendReply');
    });
});