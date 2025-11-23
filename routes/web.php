<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Public News Routes
Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{newsItem}', [NewsController::class, 'show'])->name('news.show');

// Public Books Routes
Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');

// Shelf Management Routes (authenticated)
Route::middleware('auth')->group(function () {
    Route::post('/books/{book}/shelf', [BookController::class, 'addToShelf'])->name('books.shelf.add');
    Route::patch('/books/{book}/shelf', [BookController::class, 'updateShelf'])->name('books.shelf.update');
    Route::delete('/books/{book}/shelf', [BookController::class, 'removeFromShelf'])->name('books.shelf.remove');
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
