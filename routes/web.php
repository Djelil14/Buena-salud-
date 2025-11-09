<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Auth\CommentAuthController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\Admin\MessageController as AdminMessageController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Models\Article;

Route::get('/', [ArticleController::class, 'home'])->name('home');
Route::get('/articles', [ArticleController::class, 'index'])->name('articles');
Route::get('/article/{id}', [ArticleController::class, 'show'])->name('article.show');
Route::post('/article/{id}/comment', [ArticleController::class, 'storeComment'])
    ->middleware('auth')
    ->name('article.comment.store');
Route::get('/contact', [ArticleController::class, 'contact'])->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

// Commentaires - Auth visiteurs
Route::get('/comment/login', [CommentAuthController::class, 'showLoginForm'])->name('comment.login');
Route::post('/comment/login', [CommentAuthController::class, 'login'])->name('comment.login.submit');
Route::get('/comment/register', [CommentAuthController::class, 'showRegisterForm'])->name('comment.register');
Route::post('/comment/register', [CommentAuthController::class, 'register'])->name('comment.register.submit');
Route::post('/comment/logout', [CommentAuthController::class, 'logout'])->name('comment.logout');

// Metrics
Route::post('/metrics/impression/{id}', function ($id) {
    // Incrémente de 1 le compteur d'impressions pour l'article donné
    Article::where('id', $id)->increment('impressions');
    return response()->noContent();
})->name('metrics.impression');

// Admin
Route::prefix('admin')->name('admin.')->group(function () {
    // Auth
    Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AdminAuthController::class, 'login'])->name('login.post');
    Route::post('logout', [AdminAuthController::class, 'logout'])->name('logout');

    // Zone protégées
    Route::middleware('admin')->group(function () {
        Route::get('/', [AdminArticleController::class, 'index'])->name('dashboard');
        Route::resource('articles', AdminArticleController::class)->except(['show']);
        Route::get('messages', [AdminMessageController::class, 'index'])->name('messages.index');
        Route::delete('messages/{id}', [AdminMessageController::class, 'destroy'])->name('messages.destroy');
        Route::get('messages/{id}/reply', [AdminMessageController::class, 'replyForm'])->name('messages.reply');
        Route::post('messages/{id}/reply', [AdminMessageController::class, 'sendReply'])->name('messages.sendReply');
    });
});