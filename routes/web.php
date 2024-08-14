<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IdeaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\IdeaLikeController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\PeopleSuggestionController;
use App\Http\Middleware\SetLocale;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

// Authentication:
include base_path('routes/auth.php');

// admin
include base_path('routes/admin.php');

// Dashboard
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// People Suggestion
Route::get('/suggestions', PeopleSuggestionController::class)->name('suggestions')->middleware('auth');

// Ideas
Route::resource('ideas', IdeaController::class)->except(['index', 'create', 'show'])->middleware('auth');
Route::resource('ideas', IdeaController::class)->only(['show']);

// Comments
Route::resource('ideas.comment', CommentController::class)->only('store', 'show', 'destroy', 'edit', 'update')->middleware('auth');

// Users
Route::resource('users', UserController::class)->only('show', 'edit', 'update')->middleware('auth');

// Profile
Route::get('/profile/{user}', [UserController::class, 'profile'])->name('profile')->middleware('auth');

// Follower
Route::post('users/{user}/follow', [FollowerController::class, 'follow'])->name('users.follow')->middleware('auth');
Route::post('users/{user}/unfollow', [FollowerController::class, 'unfollow'])->name('users.unfollow')->middleware('auth');

// Like
Route::post('ideas/{idea}/like', [IdeaLikeController::class, 'like'])->name('ideas.like')->middleware('auth');
Route::post('ideas/{idea}/dislike', [IdeaLikeController::class, 'dislike'])->name('ideas.dislike')->middleware('auth');

// Feed page
Route::get('/feed', FeedController::class)->name('feed')->middleware('auth');

// lang
Route::get('lang/{lang}', function($lang) {
    if(! in_array($lang, ['en', 'es', 'fr'])) {
        abort(404);
    }

    App::setLocale($lang);
    Session::put('locale', $lang);


    return back();
})->name('language');
