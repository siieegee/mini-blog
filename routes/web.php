<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::view('/about', 'about')->name('about');

// Protected routes
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard (list posts)
    Route::get('/dashboard', [PostController::class, 'index'])->name('dashboard');

    // Custom route for delete confirmation before actual destroy
    Route::get('/posts/{post}/delete', [PostController::class, 'confirmDelete'])->name('posts.delete');

    // Resource routes for posts (includes index, create, store, show, edit, update, destroy)
    Route::resource('posts', PostController::class)->except(['index']);

     // Comment route
    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

/*
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
*/