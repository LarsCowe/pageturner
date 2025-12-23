<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookClubController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Public News Routes
Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{newsItem}', [NewsController::class, 'show'])->name('news.show');

// Public Books Routes
Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');

// Public Book Club Routes
Route::get('/book-clubs', [BookClubController::class, 'index'])->name('book-clubs.index');
Route::get('/book-clubs/create', [BookClubController::class, 'create'])->middleware('auth')->name('book-clubs.create');
Route::get('/book-clubs/{bookClub}', [BookClubController::class, 'show'])->name('book-clubs.show');

// Shelf Management Routes (authenticated)
Route::middleware('auth')->group(function () {
    Route::post('/books/{book}/shelf', [BookController::class, 'addToShelf'])->name('books.shelf.add');
    Route::patch('/books/{book}/shelf', [BookController::class, 'updateShelf'])->name('books.shelf.update');
    Route::delete('/books/{book}/shelf', [BookController::class, 'removeFromShelf'])->name('books.shelf.remove');
    
    // Review Routes
    Route::post('/books/{book}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::patch('/reviews/{review}', [ReviewController::class, 'update'])->name('reviews.update');
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
    
    // Book Club Routes
    Route::post('/book-clubs', [BookClubController::class, 'store'])->name('book-clubs.store');
    Route::post('/book-clubs/{bookClub}/join', [BookClubController::class, 'join'])->name('book-clubs.join');
    Route::post('/book-clubs/{bookClub}/leave', [BookClubController::class, 'leave'])->name('book-clubs.leave');
    Route::get('/book-clubs/{bookClub}/edit', [BookClubController::class, 'edit'])->name('book-clubs.edit');
    Route::patch('/book-clubs/{bookClub}', [BookClubController::class, 'update'])->name('book-clubs.update');
    Route::delete('/book-clubs/{bookClub}', [BookClubController::class, 'destroy'])->name('book-clubs.destroy');

    // Book Club Discussions
    Route::post('/book-clubs/{bookClub}/posts', [\App\Http\Controllers\ClubPostController::class, 'store'])->name('book-clubs.posts.store');
    Route::get('/book-clubs/{bookClub}/posts/{post}', [\App\Http\Controllers\ClubPostController::class, 'show'])->name('book-clubs.posts.show');
    Route::post('/book-clubs/posts/{post}/comments', [\App\Http\Controllers\ClubCommentController::class, 'store'])->name('book-clubs.comments.store');
});

// Public FAQ Routes
Route::get('/faq', [FaqController::class, 'index'])->name('faq.index');
Route::get('/faq/{category:slug}', [FaqController::class, 'show'])->name('faq.show');

// Public Contact Route
Route::get('/contact', [ContactController::class, 'create'])->name('contact.create');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Public Profile Routes
Route::get('/profile/{user:username}', [ProfileController::class, 'show'])->name('profile.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::resource('news', \App\Http\Controllers\Admin\NewsController::class);
    Route::resource('books', \App\Http\Controllers\Admin\BookController::class)->except(['show']);
    Route::resource('book-clubs', \App\Http\Controllers\Admin\BookClubController::class)->except(['show']);
    
    // User Management
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
    Route::post('/users/{user}/toggle-admin', [\App\Http\Controllers\Admin\UserController::class, 'toggleAdmin'])->name('users.toggle-admin');
    
    // FAQ Management
    Route::prefix('faq')->name('faq.')->group(function () {
        Route::resource('categories', \App\Http\Controllers\Admin\FaqCategoryController::class);
        Route::resource('items', \App\Http\Controllers\Admin\FaqItemController::class);
    });
});

require __DIR__.'/auth.php';
