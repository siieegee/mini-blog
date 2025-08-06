<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReportController;
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

    // Report post route
    Route::post('/posts/{post}/report', [App\Http\Controllers\ReportController::class, 'store'])->name('reports.store');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->group(function () {
    // Admin Dashboard
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // Admin User Management
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/users/{id}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
    Route::put('/users/{id}', [AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::get('/users/{id}/delete', [AdminController::class, 'confirmDeleteUser'])->name('admin.users.delete');
    Route::delete('/users/{id}', [AdminController::class, 'destroyUser'])->name('admin.users.destroy');

    // Admin Post Management
    Route::get('/admin/posts', [AdminController::class, 'posts'])->name('admin.posts');
    Route::get('/admin/posts/{post}/edit', [AdminController::class, 'editPost'])->name('admin.posts.edit');
    Route::put('/admin/posts/{id}', [AdminController::class, 'updatePost'])->name('admin.posts.update');
    Route::get('/admin/posts/{post}/delete', [AdminController::class, 'confirmDelete'])->name('admin.posts.delete');
    Route::delete('/admin/posts/{id}', [AdminController::class, 'destroyPost'])->name('admin.posts.destroy');

    // Admin Report Actions
    Route::get('/admin/reports/{post}', [AdminController::class, 'viewReports'])->name('admin.reports.show');
    Route::get('/admin/reports/accept', [AdminController::class, 'acceptReportView'])->name('admin.reports.acceptView');

    // Post hiding and notification
    Route::post('/admin/posts/{post}/hide', [ReportController::class, 'hidePost'])->name('admin.reports.hide');
    Route::post('/admin/posts/{post}/notify', [ReportController::class, 'notifyAuthor'])->name('admin.reports.notify');
    Route::post('/admin/reports/{post}/reject', [ReportController::class, 'rejectReport'])->name('admin.reports.reject');
});

require __DIR__ . '/auth.php';
